<?php

namespace Database\Seeders\DbProgramacion;

use Illuminate\Database\Seeder;
use App\Models\DbProgramacion\Person;
use \App\Models\DbProgramacion\People_days_available;
use App\Models\DbProgramacion\EntranceExit;
use Carbon\Carbon;

class PersonSeederExit extends Seeder
{
    public function run(): void
    {
        $personas = Person::all();

        // Obtener todos los IDs de días disponibles
        $daysIds = \DB::table('days_available')->pluck('id');

        foreach ($personas as $persona) {
            // Asociar todos los días disponibles
            foreach ($daysIds as $dayId) {
                People_days_available::create([
                    'id_person' => $persona->id,
                    'id_day_available' => $dayId,
                ]);
            }

            // Generar asistencias entre enero y julio
            $asistencias = $this->generateAsistenciasParaMeses(2025, 1, 7);

            foreach ($asistencias as $asistencia) {
                EntranceExit::create([
                    'id_person' => $persona->id,
                    'date_time' => $asistencia['date'] . ' ' . $asistencia['entrada'],
                    'action' => 'entrada',
                ]);

                EntranceExit::create([
                    'id_person' => $persona->id,
                    'date_time' => $asistencia['date'] . ' ' . $asistencia['salida'],
                    'action' => 'salida',
                ]);
            }
        }
    }

    private function generateAsistenciasParaMeses(int $year, int $monthStart, int $monthEnd): array
    {
        $asistencias = [];

        for ($mes = $monthStart; $mes <= $monthEnd; $mes++) {
            $cantidad = rand(20, 40); // entre 20 y 40 asistencias por mes

            for ($i = 0; $i < $cantidad; $i++) {
                $dia = rand(1, 28); // asegurar que el día sea válido
                $fecha = Carbon::create($year, $mes, $dia)->format('Y-m-d');

                $horaEntrada = Carbon::createFromTime(rand(5, 9), rand(0, 59), 0);
                $horaSalida = (clone $horaEntrada)->addHours(rand(3, 5))->addMinutes(rand(0, 59));

                $asistencias[] = [
                    'date' => $fecha,
                    'entrada' => $horaEntrada->format('H:i:s'),
                    'salida' => $horaSalida->format('H:i:s'),
                ];
            }
        }

        return $asistencias;
    }
}
