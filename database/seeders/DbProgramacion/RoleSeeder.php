<?php

namespace Database\Seeders\DbProgramacion;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // Forzar conexión a la base de datos específica
        app(Role::class)->setConnection('db_programacion');
        app(Permission::class)->setConnection('db_programacion');

        // Definir roles
        $roles = [
            'Coordinador',
            'Admin-Entrada',
            'Apoyo-Coordinacion-Juicios-Evaluativos',
            'Admin-Programacion',
            'Sofia-Programacion',
            'Seguimiento-Programacion',
            'Inspector-Programacion',
            'Aprendiz',
            'Instructor',
            'Digitador',
            'Verificador',
        ];

        // Crear los roles
        $rolesCollection = collect($roles)->mapWithKeys(fn($r) => [$r => Role::firstOrCreate(['name' => $r])]);

        // Alias rápido
        $r = $rolesCollection;


        // Definir permisos agrupados por módulo
        $permissions = [

            // Módulo de Entrada
            'entrance' => [
                'entrance.admin' => ['Coordinador', 'Admin-Entrada'],
                'entrance.people.index' => ['Coordinador', 'Admin-Entrada'],
                'entrance.people.create' => ['Coordinador', 'Admin-Entrada'],
                'entrance.people.store' => ['Coordinador', 'Admin-Entrada'],
                'entrance.people.update' => ['Coordinador', 'Admin-Entrada'],
                'entrance.people.delete' => ['Coordinador', 'Admin-Entrada'],
                'entrance.people.show' => ['Coordinador', 'Admin-Entrada'],
                'entrance.excel.upload' => ['Coordinador', 'Admin-Entrada'],
                'entrance.people.edit' => ['Coordinador', 'Admin-Entrada'],
                'entrance.absence.index' => ['Coordinador', 'Admin-Entrada'],
                'entrance.absence.show' => ['Coordinador', 'Admin-Entrada'],
                'entrance.assistance.index' => ['Coordinador', 'Admin-Entrada'],
                'entrance.assistance.show' => ['Coordinador', 'Admin-Entrada', 'Aprendiz'],
                'entrance.assistance.show_history' => ['Coordinador', 'Admin-Entrada', 'Aprendiz'],
                'entrance.assistance.all' => ['Coordinador', 'Admin-Entrada'],
                'entrance.assistance.export' => ['Coordinador', 'Admin-Entrada'],
            ],

            // Módulo de Programación
            'programming' => [
                'programming.admin' => ['Coordinador', 'Admin-Programacion'],
                'programing.programan_store_add' => ['Coordinador', 'Admin-Entrada'],
                'programmig.programming_cohort_index' => ['Coordinador', 'Admin-Programacion'],
                'programmig.programming_cohort_Register' => ['Coordinador', 'Admin-Programacion'],
                'programmig.programming_cohort_delete' => ['Coordinador', 'Admin-Programacion'],
                'apprentice.show' => ['Aprendiz'],
                'programmig.programming_update_index' => ['Coordinador', 'Admin-Programacion'],
                'programmig.programming_update_store' => ['Coordinador', 'Admin-Programacion'],
                'programing.add_apprentices_cohorts' => ['Coordinador', 'Admin-Entrada'],
                'programing.add_apprentices_store' => ['Coordinador', 'Admin-Entrada'],
                'programing.apprentices_list' => ['Coordinador', 'Admin-Entrada'],
                'programing.apprentices_cohorts_list' => ['Coordinador', 'Admin-Entrada'],
                'programing.competencies_store' => ['Coordinador', 'Admin-Entrada'],
                'programing.competencies_update' => ['Coordinador', 'Admin-Entrada'],
                'programing.competencies_programming_index' => ['Coordinador', 'Admin-Entrada'],
                'programing.competencies_programming_store' => ['Coordinador', 'Admin-Entrada'],
                'programing.competencies_programan_index' => ['Coordinador', 'Admin-Entrada'],
                'programing.instructor_programan_index' => ['Coordinador', 'Admin-Entrada'],
                'programing.register_programming_instructor_index' => ['Coordinador', 'Admin-Entrada'],
                'programing.register_programming_instructor_store' => ['Coordinador', 'Admin-Entrada'],
                'programing.programming_update_index' => ['Coordinador', 'Admin-Entrada'],
                'programing.programming_update' => ['Coordinador', 'Admin-Entrada'],
                'programing.programming_index_states' => ['Coordinador', 'Admin-Entrada'],
                'programing.instructors_competences_profile' => ['Coordinador', 'Admin-Entrada'],
                'programing.instructors_competencies_profile_store' => ['Coordinador', 'Admin-Entrada'],
                'programing.classrooms_programming_classrooms_index' => ['Coordinador', 'Admin-Entrada'],
                'programmig.programming_update_store_programing' => ['Coordinador', 'Admin-Entrada'],
                'programing.classrooms_programming_classrooms_store' => ['Coordinador', 'Admin-Entrada'],
                'programing.unrecorded_days_index' => ['Coordinador', 'Admin-Entrada'],
                'programing.unrecorded_days_store' => ['Coordinador', 'Admin-Entrada'],
                'programing.classroom_store' => ['Coordinador', 'Admin-Entrada'],
                'programing.unrecorded_days_delete' => ['Coordinador', 'Admin-Entrada'],
                'programing.ambiente_delete' => ['Coordinador', 'Admin-Entrada'],
                'programing.ambiente_update' => ['Coordinador', 'Admin-Entrada'],
                'programaciones_index' => ['Coordinador', 'Admin-Entrada'],
                'programaciones_store' => ['Coordinador', 'Admin-Entrada'],
                'programing.competencies_index_administrar' => ['Coordinador', 'Admin-Entrada'],
                'programing.programming.competencies_copy' => ['Coordinador', 'Admin-Entrada'],
            ],
        ];


        // Crear permisos dinámicamente y asignarlos
        foreach ($permissions as $group => $items) {
            foreach ($items as $permissionName => $roleNames) {
                $permission = Permission::firstOrCreate(['name' => $permissionName]);
                $permission->syncRoles($r->only($roleNames)->values());
            }
        }
    }
}
