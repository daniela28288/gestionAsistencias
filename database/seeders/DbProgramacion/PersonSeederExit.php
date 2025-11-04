<?php

namespace Database\Seeders\DbProgramacion;

use Illuminate\Database\Seeder;
use App\Models\DbProgramacion\People_days_available;
use App\Models\DbProgramacion\Person;
use Illuminate\Support\Facades\DB;

class PersonSeederExit extends Seeder
{
    public function run(): void
    {
        // TOMAR LOS IDS DE TODAS LAS PERSONAS EXISTENTES
        $personIds = Person::pluck('id');

        // Obtener todos los IDs de días disponibles
        $daysIds = DB::table('days_available')->pluck('id');

        // ITERA SOBRE CADA ID DE PERSONA PARA ASIGNARLE DATOS
        foreach ($personIds as $personaId) {
            // SE CONSTRUYE UN ARRAY DE DIAS DISPONIBLES PARA LA PERSONA ACTUAL
            $daysAvailable = [];
            foreach ($daysIds as $dayId) {
                $daysAvailable[] = [
                    'id_person' => $personaId,
                    'id_day_available' => $dayId,
                ];
            }

            // INSERTAMOS TODOS LOS DIAS DISPONIBLES DE UNA SOLA VEZ
            People_days_available::insert($daysAvailable);
        }

        // NOTA: No generamos asistencias en esta tabla, 
        // para que comience vacía y se llenen solo con registros reales
    }
}
