<?php

namespace Database\Seeders;

use Database\Seeders\DbProgramacion\AprenticesSeeder;
use Database\Seeders\DbProgramacion\CohortTimeSeeder;
use Database\Seeders\DbProgramacion\PositionSeeder;
use Database\Seeders\DbProgramacion\TownSeeder;
use Database\Seeders\DbProgramacion\DayAvailable;
use Database\Seeders\DbProgramacion\PersonSeeder;
use Database\Seeders\DbProgramacion\PersonSeederExit;
use Database\Seeders\DbProgramacion\RoleSeeder;
use Database\Seeders\DbProgramacion\UserSeeder;
use Database\Seeders\DbProgramacion\ApprenticeStatusSeeder;
use Database\Seeders\DbProgramacion\BlokSeeder;
use Database\Seeders\DbProgramacion\ClassRoomSeeder;

use Database\Seeders\DbProgramacion\InstructorSeeder;
use Database\Seeders\DbProgramacion\InstructorStatusSeeder;
use Database\Seeders\DbProgramacion\LinkTypeSeeder;
use Database\Seeders\DbProgramacion\ProgramanLevelSeeder;
use Database\Seeders\DbProgramacion\ProgramSeeder;
use Database\Seeders\DbProgramacion\SpecialitySeeder;

use Database\Seeders\DbProgramacion\CohortSeeder;
use Database\Seeders\DbProgramacion\Dayseeder as DbProgramacionDayseeder;
use Database\Seeders\DbProgramacion\DaysTrainingSeeder;

use Database\Seeders\DbProgramacion\VisitReasonSeeder;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Base de datos de programación
        Config::set('database.default', 'db_programacion');
        DB::connection('db_programacion')->beginTransaction();

        $this->call([
            VisitReasonSeeder::class,
            PositionSeeder::class,
            RoleSeeder::class,
            TownSeeder::class,
            PersonSeeder::class,       // Personas primero
            UserSeeder::class,         // Usuarios dependen de Person
            DayAvailable::class,       // Días disponibles antes de PersonSeederExit
            PersonSeederExit::class,   // Asignación de días y asistencias

            CohortTimeSeeder::class,
            LinkTypeSeeder::class,
            SpecialitySeeder::class,
            InstructorStatusSeeder::class,
            ApprenticeStatusSeeder::class,
            ProgramanLevelSeeder::class,
            InstructorSeeder::class,
            ProgramSeeder::class,
            AprenticesSeeder::class,
            BlokSeeder::class,
            ClassRoomSeeder::class,
            CohortSeeder::class,
            DbProgramacionDayseeder::class,
            DaysTrainingSeeder::class
        ]);

        DB::connection('db_programacion')->commit();
    }
}
