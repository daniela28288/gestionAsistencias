<?php

namespace App\Http\Controllers\DbProgramacion;

use App\Http\Controllers\Controller;
use App\Models\DbProgramacion\Block;
use App\Models\DbProgramacion\Classroom;
use App\Models\DbProgramacion\Cohort;
use App\Models\DbProgramacion\CohorTime;
use App\Models\DbProgramacion\Instructor;
use App\Models\DbProgramacion\Person;
use App\Models\DbProgramacion\Program;
use App\Models\DbProgramacion\Program_Level;
use App\Models\DbProgramacion\Programming;
use App\Models\DbProgramacion\Town;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function login(Request $request)
    {
        // Validar campos obligatorios (sin 'module')
        $request->validate([
            'user_name' => 'required|string',
            'password' => 'required|string',
        ]);

        // Solo se usan las credenciales para la autenticación
        $credentials = $request->only('user_name', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // OBTENER EL ROL DEL USUARIO
            // SUPONIENDO QUE EL USUARIO TIENE VARIOS ROLES, TOMAMOS EL PRIMERO
            $role = $user->roles->pluck('name')->first();

            // REDIRIGIR SEGUN EL ROL SELECCIONADO
            switch ($role) {
                case 'Aprendiz':
                    return redirect()->route('apprentice.show', ['id' => $user->id]);

                case 'Coordinador':
                    return redirect()->route('programing.admin_inicio');

                default:
                    // Si el rol no coincide con los esperados
                    Auth::logout();
                    $request->session()->invalidate();
                    $request->session()->regenerateToken();

                    return redirect()
                        ->route('login')
                        ->withErrors(['login_error' => 'Tu cuenta no tiene un rol válido asignado.']);
            }
        }

        // VALIDACION EN CASO DE QUE LAS CREDENCIALES SEAN INCORRECTAS
        return redirect()
            ->route('login')
            ->withErrors(['login_error' => 'Las credenciales proporcionadas son incorrectas.'])
            ->withInput($request->only('user_name'));
    }


    public function dashboard()
    {
        //hacer calculos reales de la cantidad de programaciones y demas
        $programaciones = Programming::all();

        $personas = Person::all();
        $instructores = Instructor::with('person')->get();
        $ambientes = Classroom::all();

        return view('pages.programming.Admin.programan.competencies_program_index', compact('programaciones', 'personas', 'ambientes', 'instructores'));
    }


    // GESTION DE PROGRAMAS DE FORMACION
    public function programan_index()
    {

        // INSTRUCTORES CON RELACIONES Y CALCULOS DE HORAS
        $instructors = Instructor::with(['person', 'speciality', 'programming'])->get();

        foreach ($instructors as $instructor) {

            // HORAS PROGRAMADAS CON ESTADOS ACTIVOS
            $horasProgramadas = $instructor->programming
                ->whereIn('status', ['pendiente', 'en_ejecucion', 'finalizada_evaluada'])
                ->sum('hours_duration');

            // CALCULAR HORAS RESTANTES
            $instructor->horas_restantes = max(0, $instructor->assigned_hours - $horasProgramadas);
            $instructor->horas_programadas = $horasProgramadas;
        }

        // RETORNAR TODOS LOS DATOS USADOS EN EL DASHBOARD
        return view('pages.programming.Admin.programming_dashboard', [
            // PROGRAMAS CON SUS RESPECTIVOS INSTRUTORES
            'programs' => Program::with(['instructor.person'])->get(),
            // TRAER INSTRUCTORES CON LA RELACION 'PERSON' Y LAS HORAS CALCULADAS
            'instructors' => $instructors,
            // NIVELES DEL PROGRAMA
            'level_program' => Program_Level::all(),
            // JORNADAS
            'cohortimes' => CohorTime::all(),
            // MUNICIPIOS
            'towns' => Town::all(),
            // AMBIENTES
            'ambientes' => Classroom::with(['towns', 'Block'])->get(),
            // TRAE COHORTES VIGENTES CON SUS
            'cohorts' => Cohort::with(['program', 'competences'])
                ->where('end_date', '>', today())
                ->get(),
        ]);
    }


}
