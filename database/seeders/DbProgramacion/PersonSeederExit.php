<?php

namespace Database\Seeders\DbProgramacion;

use Illuminate\Database\Seeder;
<<<<<<< HEAD
use App\Models\DbProgramacion\People_days_available;
=======
use App\Models\DbProgramacion\Person;
use \App\Models\DbProgramacion\People_days_available;
use App\Models\DbProgramacion\EntranceExit;
use Carbon\Carbon;
>>>>>>> 69fe02617cbc962c6c0d51a4fa7c74213548e0ec

class PersonSeederExit extends Seeder
{
    public function run(): void
    {
<<<<<<< HEAD
        // CREAMOS UN ARRAY DE ID DE PERSONAS
        $personIds = range(1, 9);

        // ITERA SOBRE CADA ID DE PERSONA PARA ASIGNARLE DATOS
        foreach ($personIds as $personaId) {
            // SE CONSTRUYE UN ARRAY DE DIAS DISPONIBLES PARA LA PERSONA ACTUAL
            $daysAvailable = [];
            foreach (range(1, 7) as $day) { // range(1,7) REPRESENTA LOS 7 DIAS DE LA SEMANA
                $daysAvailable[] = [
                    'id_person' => $personaId,
                    'id_day_available' => $day,
=======
        $personas = Person::all();

        // Obtener todos los IDs de días disponibles
        $daysIds = \DB::table('days_available')->pluck('id');

        foreach ($personas as $persona) {
            // Asociar todos los días disponibles
            foreach ($daysIds as $dayId) {
                People_days_available::create([
                    'id_peruson' => $persona->id,
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
>>>>>>> 69fe02617cbc962c6c0d51a4fa7c74213548e0ec
                ];
            }

            // INSERTAMOS TODOS LOS DIAS DISPONIBLES DE UNA SOLA VEZ
            People_days_available::insert($daysAvailable);
        }

        // NOTA: No generamos asistencias en esta tabla, 
        // para que comience vacía y se llenen solo con registros reales
    }
}
