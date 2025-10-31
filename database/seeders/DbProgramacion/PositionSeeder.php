<?php

namespace Database\Seeders\DbProgramacion;

use App\Models\DbProgramacion\Position;
use Illuminate\Database\Seeder;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $positions = [
            ['name' => 'Coordinador'],
            ['name' => 'Administrativo'],
            ['name' => 'Aprendiz'],
            ['name' => 'Instructor'],
            ['name' => 'Visitante'],
        ];

        Position::insert($positions);
    }
}


//     Position::create([
//         'name' => 'Coordinador'
//     ]);
//     Position::create([
//         'name' => 'Administrativo'
//     ]);

//     Position::create([
//         'name' => 'Aprendiz'
//     ]);

//     Position::create([
//         'name' => 'Instructor'
//     ]);

//     Position::create([
//         'name' => 'Visitante'
//     ]);
// }
