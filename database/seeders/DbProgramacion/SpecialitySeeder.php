<?php

namespace Database\Seeders\DbProgramacion;

use App\Models\DbProgramacion\Speciality;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SpecialitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('specialities')->insert([
            ["name" => "Ingeniería de Sistemas"],
            ["name" => "Administración de Empresas"],
            ["name" => "Contaduría Pública"],
            ["name" => "Psicología"],
            ["name" => "Diseño Gráfico"],
            ["name" => "Medicina"],
            ["name" => "Arquitectura"],
            ["name" => "Derecho"],
            ["name" => "Ingeniería Electrónica"],
            ["name" => "Marketing Digital"],
        ]);

    }
}
