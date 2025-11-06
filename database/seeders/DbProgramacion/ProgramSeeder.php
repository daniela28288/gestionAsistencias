<?php

namespace Database\Seeders\DbProgramacion;

use App\Models\DbProgramacion\Program;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // PROGRAMAS DE NIVEL 2 (Tecnólogo) - Diversificados
        $programs = [
            ["000112", "Gestión Logística y Cadena de Suministro", 2],
            ["000113", "Gastronomía Internacional y Técnicas Moleculares", 2],
            ["000114", "Producción Audiovisual y Efectos Digitales", 2],
            ["000115", "Gestión de Empresas Creativas", 2],
            ["000116", "Biotecnología Alimentaria", 1],
            ["000117", "Diseño de Experiencia de Usuario (UX/UI)", 1],
            ["000118", "Comercio Electrónico y Marketing Digital", 3],
            ["000119", "Animación 3D y Arte Digital", 2],
            ["000110", "Gestión de Turismo Sostenible", 3],
            ["0001111", "Diseño de Moda Tecnológica (Wearables)", 3],
        ];

        $data = array_map(function ($item) {
            return [
                'id_level' => 2, // TODOS SON NIVEL 2 EN ESTA OCACION
                'program_code' => $item[0],
                'program_version' => '1', // TODOS TIENE AL VERSION 1 TAMBIEN EN ESTA OCACION
                'name' => $item[1],
                'instructor_id' => $item[2],
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }, $programs);

        // INSERTA TODOS LOS PROGRAMAS DE UNA SOLA VEZ, EN LUGAR DE HACER REGISTRO POR REGISTRO
        Program::insert($data);



    }
}
