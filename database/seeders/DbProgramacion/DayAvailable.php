<?php

namespace Database\Seeders\DbProgramacion;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DayAvailable extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // LIMPIAMOS LA TABLA ANTES DE INSERTAR
        DB::table('days_available')->delete();


        DB::connection('db_programacion')->table('days_available')->insert([
            ['name' => 'Lunes', 'name_english' => 'Monday'],
            ['name' => 'Martes', 'name_english' => 'Tuesday',],
            ['name' => 'Miércoles', 'name_english' => 'Wednesday',],
            ['name' => 'Jueves', 'name_english' => 'Thursday',],
            ['name' => 'Viernes', 'name_english' => 'Friday',],
            ['name' => 'Sábado', 'name_english' => 'Saturday',],
            ['name' => 'Domingo', 'name_english' => 'Sunday',],

        ]);
    }
}
