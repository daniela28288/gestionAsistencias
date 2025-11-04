<?php

namespace Database\Seeders\DbProgramacion;


use App\Models\DbProgramacion\Person;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\DbProgramacion\User;

use Illuminate\Support\Facades\Hash;
use Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $person = Person::first();


        //usuario general ahora
        User::create([
            'id_person' => $person->id,
            'user_name' => 'Marlon',
            'password' => bcrypt("123123")
        ])->assignRole('Coordinador');

        User::create([
            'id_person' => $person->id,
            'user_name' => '5314051',
            'password' => bcrypt("5314051")
        ])->assignRole('Aprendiz');

        User::create([
            'id_person' => $person->id,
            'user_name' => '4444444444',
            'password' => bcrypt("4444444444")
        ])->assignRole('Aprendiz');
    }
}
