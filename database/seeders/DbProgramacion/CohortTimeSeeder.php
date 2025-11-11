<?php

namespace Database\Seeders\DbProgramacion;

use App\Models\DbProgramacion\CohorTime;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CohortTimeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('cohort_times')->insert([
            ['name' => 'Diurna'],
            ['name' => 'Nocturna']
        ]);
    }
}
