<?php

namespace App\Http\Controllers\DbEntrada;

use App\Http\Controllers\Controller;
use App\Models\DbEntrada\EntranceExit;
use App\Models\DbEntrada\Person;
use App\Models\DbProgramacion\VisitReason;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function entrada_asistencia(Request $request)
    {
        // Cargar los motivos de visita
        $visitReasons = VisitReason::all();

        // Retornar la vista con la variable
        return view('pages.entrance.entrance', compact('visitReasons'));
    }


    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

}
