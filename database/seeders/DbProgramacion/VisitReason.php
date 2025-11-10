<?php

namespace Database\Seeders\DbProgramacion;

use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VisitReason extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('visit_reasons')->insert([
            ['reason' => 'Formación profesional integral'],
            ['reason' => 'Oportunidades de empleo y pasantías'],
            ['reason' => 'Apoyo al emprendimiento'],
            ['reason' => 'Certificación y homologación'],
            ['reason' => 'Bienestar y apoyo económico'],
        ]);
    }
}
