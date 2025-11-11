<?php

namespace Database\Seeders\DbProgramacion;

use App\Models\DbProgramacion\LinkType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LinkTypeSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {

    DB::table('link_types')->insert([
      ['name' => 'Instructor de Planta'],
      ['name' => 'Instructor Contratista'],
      ['name' => 'Carrera Administrativa'],
    ]);
  }
}
