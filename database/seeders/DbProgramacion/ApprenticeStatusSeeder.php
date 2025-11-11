<?php

namespace Database\Seeders\DbProgramacion;

use App\Models\DbProgramacion\ApprenticeStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ApprenticeStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('apprentices_status')->insert([
            ['name' => 'En Formación'],
            ['name' => 'Cancelado'],
            ['name' => 'Retiro Voluntario'],
            ['name' => 'Aplazado'],
        ]);
    }
}
