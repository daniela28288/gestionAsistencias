<?php

namespace Database\Seeders\DbProgramacion;

use App\Models\DbEntrada\Position;
use App\Models\DbProgramacion\Person;
use App\Models\DbProgramacion\Town;
use Illuminate\Database\Seeder;

class PersonSeeder extends Seeder
{
    public function run(): void
    {

        $positions = Position::pluck('id', 'name');
        $towns = Town::pluck('id', 'name');

        // ARRAY ASOCIATIVO CON LOS DATOS DE PRUEBA
        $people = [
            [
                'id_position' => $positions['Coordinador'],
                'id_town' => $towns['San Juan del Cesar'],
                'document_number' => '1111111111',
                'name' => 'Marlon Saenz',
                'email' => 'marlonsaenz@gmail.com',
                'address' => 'Calle 20#32-43',
                'phone_number' => '300123123',
            ],
            [
                'id_position' => $positions['Aprendiz'],
                'id_town' => $towns['Albania'],
                'document_number' => '5314051',
                'name' => 'Andres Echeverria',
                'email' => 'andres@gmail.com',
                'address' => 'Calle 11 n° 15-29',
                'phone_number' => '3103029788',
            ],
            [
                'id_position' => $positions['Aprendiz'],
                'id_town' => $towns['Distracción'],
                'document_number' => '1122811493',
                'name' => 'Daniela Brito',
                'email' => 'daniela@gmail.com',
                'address' => 'Calle 8#23-56',
                'phone_number' => '3004445555',
            ],
            [
                'id_position' => $positions['Instructor'],
                'id_town' => $towns['Distracción'],
                'document_number' => '8888888888',
                'name' => 'Sara Juliana Lopez',
                'email' => 'sara.lopez@example.com',
                'address' => 'Calle 16#30-40',
                'phone_number' => '3048889999',
            ],
            [
                'id_position' => $positions['Instructor'],
                'id_town' => $towns['Fonseca'],
                'document_number' => '9999999999',
                'name' => 'David Esteban Castro',
                'email' => 'david@example.com',
                'address' => 'Carrera 25#15-60',
                'phone_number' => '3059990000',
            ],
            [
                'id_position' => $positions['Instructor'],
                'id_town' => $towns['Fonseca'],
                'document_number' => '7777777777',
                'name' => 'Juan Camilo Vargas',
                'email' => 'camilo@example.com',
                'address' => 'Avenida 7#11-22',
                'phone_number' => '3037778888',
            ],

        ];
        // SE EVITA USAR "create()" PARA UN MEJOR RENDIMIENTO Y NO TENER QUE HACER UNA CONSULTA POR CADA REGISTRO
        Person::insert(array_map(fn($p) => array_merge($p, [
            'start_date' => '2025-01-23',
            'end_date' => '2025-12-22',
            'created_at' => now(),
            'updated_at' => now(),
        ]), $people));
    }
}

