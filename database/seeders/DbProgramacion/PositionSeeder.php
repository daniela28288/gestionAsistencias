<?php

namespace Database\Seeders\DbProgramacion;

use App\Models\DbProgramacion\Position;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('positions')->insert([
            ['name' => 'Coordinador'],
            ['name' => 'Administrativo'],
            ['name' => 'Aprendiz'],
            ['name' => 'Instructor'],
            ['name' => 'Visitante'],
        ]);
    }
}