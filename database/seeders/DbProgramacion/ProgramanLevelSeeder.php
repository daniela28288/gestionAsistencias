<?php

namespace Database\Seeders\DbProgramacion;

use App\Models\DbProgramacion\Program_Level;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProgramanLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('program_level')->insert([
            ['name' => 'Técnico'],
            ['name' => 'Tecnólogo'],
        ]);

    }
}
