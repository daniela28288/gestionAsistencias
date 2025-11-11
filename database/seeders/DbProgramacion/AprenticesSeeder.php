<?php

namespace Database\Seeders\DbProgramacion;

use App\Models\DbProgramacion\Apprentice;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AprenticesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('apprentices')->insert([
            ['id_person' => 2, 'id_status' => 2],
            ['id_person' => 3, 'id_status' => 2],
            ['id_person' => 4, 'id_status' => 2],
            ['id_person' => 5, 'id_status' => 2],
            ['id_person' => 6, 'id_status' => 2]
        ]);
    }
}
