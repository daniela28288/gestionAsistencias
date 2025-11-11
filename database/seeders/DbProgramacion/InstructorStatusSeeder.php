<?php

namespace Database\Seeders\DbProgramacion;

use App\Models\DbProgramacion\InstructorStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InstructorStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('instructors_status')->insert([
            ['name' => 'Activo'],
            ['name' => 'Inactivo'],
        ]);
    }
}
