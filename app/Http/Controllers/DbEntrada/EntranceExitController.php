<?php

namespace App\Http\Controllers\DbEntrada;

use App\Http\Controllers\Controller;
use App\Models\DbProgramacion\EntranceExit;
use App\Models\DbProgramacion\Person;
use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

use function PHPUnit\Framework\isNull;

class EntranceExitController extends Controller
{
    public function create()
    {
        return view('pages.entrance.entrance');
    }

    // METODO PARA GESTIONAR ENTRADA Y SALIDA EN TIEMPO REAL
    public function store(Request $request)
    {
        // VALIDACION DE DOCUMENTO EJ:(LONGITUD)
        try {
            $data = $request->validate([
                'document_number' => 'required|string|max:12|min:7'
            ]);
        } catch (ValidationException $e) {
            // DELVUELVE UN JSON LIMPIO CON EL ERROR
            return response()->json([
                'error' => 'Documento inválido. Verifique el número ingresado.'
            ], 422);
        }

        // BUSCAMOS A LA PERSONA EN LA BASE DE DATOS POR EL NUMERO DE DOCUMENTO
        $person = Person::where('document_number', $data['document_number'])->first();

        // VALIDACION EN CASO DE QUE NO EXISTA
        if (!$person) {
            return response()->json([
                'position' => "N/A",
                'error' => 'Documento no registrado en el sistema.'
            ], 404);
        }

        // OBTENEMOS LA POSICION DE LA PERSONA (si no existe, poner "No definida")
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
