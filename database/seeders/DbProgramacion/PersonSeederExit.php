<?php

namespace Database\Seeders\DbProgramacion;

use Illuminate\Database\Seeder;
use App\Models\DbProgramacion\People_days_available;

class PersonSeederExit extends Seeder
{
    public function run(): void
    {
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
                ];
            }

            // INSERTAMOS TODOS LOS DIAS DISPONIBLES DE UNA SOLA VEZ
            People_days_available::insert($daysAvailable);
        }

        // NOTA: No generamos asistencias en esta tabla, 
        // para que comience vacía y se llenen solo con registros reales
    }
}
