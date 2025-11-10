<?php

namespace App\Http\Controllers\DbEntrada;

use App\Http\Controllers\Controller;
use App\Models\DbProgramacion\EntranceExit;
use App\Models\DbProgramacion\Person;
use App\Models\DbProgramacion\Position;
use App\Models\DbProgramacion\VisitorEntry;
use App\Models\DbProgramacion\VisitReason;
use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

use function PHPUnit\Framework\isNull;

class EntranceExitController extends Controller
{
    public function create()
    {
        $visitReasons = VisitReason::all();
        return view('pages.entrance.entrance', compact('visitReasons'));
    }

    // METODO PARA GESTIONAR ENTRADA Y SALIDA EN TIEMPO REAL
    public function store(Request $request)
    {
        // VALIDACION DE DOCUMENTO EJ:(LONGITUD)
        try {
            $data = $request->validate([
                'document_number' => 'required|string|max:12|min:7',
                'id_reason' => 'nullable|exists:visit_reasons,id' // SOLO PARA VISITANTES
            ]);
        } catch (ValidationException $e) {
            // DELVUELVE UN JSON LIMPIO CON EL ERROR
            return response()->json([
                'error' => 'Documento inválido. Verifique el número ingresado.'
            ], 422);
        }

        // BUSCAMOS A LA PERSONA EN LA BASE DE DATOS POR EL NUMERO DE DOCUMENTO
        $person = Person::where('document_number', $data['document_number'])->first();

        // SI NO EXISTE -> REGISTRAR VISITA COMO VISITANTE
        if (!$person) {
            // POSICION "Visitante"
            $visitorPosition = Position::where('name', 'Visitante')->first();

            if (empty($data['id_reason'])) {

                return response()->json([
                    'error' => 'Debe seleccionar un motivo de visita.'
                ], 422);
            }

            // SALIDA AUTOMÁTICA DE VISITAS ANTIGUAS SIN SALIDA
            $closingHour = Carbon::createFromTime(18, 0, 0); // 6:00 PM

            // Cerrar automáticamente entradas sin salida de días anteriores
            VisitorEntry::where('document_number', $data['document_number'])
                ->whereNull('exit_time')
                ->whereDate('entry_time', '<', now()->toDateString())
                ->update([
                    'exit_time' => $closingHour->copy()->subDay(), // salida automática del día anterior
                    'status' => 'cerrada_automatica'
                ]);

            // Verificar si el visitante tiene una entrada abierta hoy
            $existingEntry = VisitorEntry::where('document_number', $data['document_number'])
                ->whereDate('entry_time', now()->toDateString())
                ->whereNull('exit_time')
                ->first();

            if ($existingEntry) {
                // Si ya es hora de cierre, marcar salida automática
                if (now()->greaterThan($closingHour)) {
                    $existingEntry->update([
                        'exit_time' => $closingHour,
                        'status' => 'cerrada_automatica'
                    ]);

                    return response()->json([
                        'action' => 'salida_automatica',
                        'message' => 'Salida marcada automáticamente por fin de jornada.',
                        'position' => $visitorPosition->name,
                        'document_number' => $existingEntry->document_number
                    ]);
                }

                // Si el visitante tiene una entrada activa, marcar salida manual
                $existingEntry->update([
                    'exit_time' => now(),
                    'status' => 'completa'
                ]);

                return response()->json([
                    'action' => 'salida',
                    'message' => 'Salida registrada exitosamente.',
                    'position' => $visitorPosition->name,
                    'document_number' => $existingEntry->document_number
                ]);
            }

            // VERIFICAR SI YA SE REGISTRO RECIENTEMENTE CON EL MISMO DOCUMENTO
            $recentVisitor = VisitorEntry::where('document_number', $data['document_number'])
                ->where('entry_time', '>=', now()->subSeconds(30))
                ->exists();

            if ($recentVisitor) {
                return response()->json([
                    'error' => 'Ya se registró una visita reciente. Espere unos segundos.'
                ], 429);
            }

            // REGISTRAR VISITANTE
            $visitor = VisitorEntry::create([
                'document_number' => $data['document_number'],
                'id_reason' => $data['id_reason'],
                'id_position' => $visitorPosition->id,
                'entry_time' => now(),
                'status' => 'abierta'
            ]);

            return response()->json([
                'action' => 'entrada',
                'message' => 'Entrada registrada exitosamente.',
                'position' => $visitorPosition->name,
                'reason' => $visitor->reason->reason,
                'document_number' => $visitor->document_number
            ], 201);
        }

        // SI EXISTE -> FLUJO NORMAL (PERSONA REGISTRADA)
        $position = $person->position->name ?? 'No definida';

        // VALIDAMOS QUE LA PERSONA AUN ESTE ACTIVA EN EL CENTRO DE FORMACION
        if ($person->start_date > now() || $person->end_date < now()) {
            return response()->json([
                'action' => "ACCESO RESTRINGIDO: USTED YA NO HACE PARTE DEL CENTRO DE FORMACION",
                'position' => $position,
                'name' => $person->name
            ]);
        }

        // VALIDAMOS SI LA PERSONA PUEDE ACCERDER HOY SEGUN SUS DIAS DISPONIBLES
        $currentDay = Carbon::now()->format('l'); // Día actual en inglés, ej: "Monday"
        $isAvailable = $person->days_available()
            ->where('name_english', $currentDay)
            ->exists();

        if (!$isAvailable) {
            return response()->json([
                'action' => "NO PUEDE ACCEDER HOY AL CENTRO DE FORMACIÓN",
                'position' => $position,
                'name' => $person->name
            ]);
        }

        // OBTENER LA ULTIMA ASISTENCIA RESGISTRADA PARA ESA PERSONA
        $last_assistance = EntranceExit::where('id_person', $person->id)
            ->orderBy('date_time', 'desc')
            ->first();

        // VALOR POR DEFECTO O INICIAL
        $action = "entrada";

        if (is_null($last_assistance)) {
            // SI NO HAY REGISTROS PREVIOS ES EL PRIMER INGRESO DEL DIA -> entrada
            $action = "entrada";
        } elseif ($last_assistance->date_time->isToday()) {
            // SI YA HAY REGISTRO HOY -> salida
            if ($last_assistance->action == "entrada") {
                $action = "salida";
            } else {
                // SI LA ULTIMA ACCION FUE SALIDA -> REGISTRAR NUEVA ENTRADA
                $action = "entrada";
            }
        } else {
            // SI EL ULTIMO REGISTRO ES DE OTRO DIA-> NUEVA ENTRADA
            $action = "entrada";
        }

        // EVITAR DUPLICADOS SI SE REGISTRA VARIAS VECES EN POCOS SEGUNDOS
        // VERIFICAMOS SI YA HAY UN REGISTRO CON LA MISMA ACCION EN EL ULTIMO MINUTO
        $recent = EntranceExit::where('id_person', $person->id)
            ->where('action', $action)
            ->where('date_time', '>=', now()->subSecond(30))
            ->exists();

        if ($recent) {
            return response()->json([
                'error' => 'Ya registró esta acción recientemente. Espere 30 segundos.'
            ], 429);
        }

        if (!$recent) {
            // CREAR EL REGISTRO DE entrada/salida
            EntranceExit::create([
                'id_person' => $person->id,
                'date_time' => now(),
                'action' => $action
            ]);
        }

        // FINALMENTE RETORNAMOS UN JSON CON LA INFORMACION DE LA ACCION
        return response()->json([
            'action' => $action,
            'position' => $position,
            'name' => $person->name
        ]);
    }

}
