<?php

use App\Http\Controllers\DbEntrada\AbsenceController;
use App\Http\Controllers\DbEntrada\ApprenticeController;
use App\Http\Controllers\DbEntrada\AssistanceController;
use App\Http\Controllers\DbEntrada\AuthController as EntranceAuthController;
use App\Http\Controllers\DbEntrada\EntranceAdminController;
use App\Http\Controllers\DbEntrada\EntranceExitController;
use App\Http\Controllers\DbEntrada\UserController;
use App\Http\Controllers\DbProgramacion\AdminController as ProgrammingAdminController;
use App\Http\Controllers\DbProgramacion\AuthController as ProgrammingAuthController;
use App\Models\DbEntrada\User;
use Illuminate\Support\Facades\Route;
//Pagina inicial
Route::get('/', function () {
    return view('pages.start_page');
})->name('login');
//Logout universal
Route::post('logout', [EntranceAuthController::class, 'logout'])->name('logout');

//Entrada ------------------------------------------------------------------------------

//login
Route::post('entrance/login', [EntranceAuthController::class, 'login'])->name('entrance-login');

//Modulo Entrada
Route::get('/entrance', [EntranceExitController::class,  'create'])->middleware('can:entrance.create')->name('entrance.create');
Route::post('/entrance/store', [EntranceExitController::class, 'store'])->middleware('can:entrance.store')->name('entrance.store');

//Modulo Entrada - Administrador
//Primera vista del administrador
Route::get('entrance/admin/people', [EntranceAdminController::class, 'peopleIndex'])->middleware('can:entrance.people.index')->name('entrance.people.index');
Route::get('entrance/admin/people/create', [EntranceAdminController::class, 'peopleCreate'])->middleware('can:entrance.people.create')->name('entrance.people.create');
Route::post('entrance/admin/people/store', [EntranceAdminController::class, 'peopleStore'])->middleware('can:entrance.people.store')->name('entrance.people.store');
Route::get('entrance/admin/people/{id}', [EntranceAdminController::class, 'peopleShow'])->middleware('can:entrance.people.show')->name('entrance.people.show');
Route::get('entrance/admin/people/{id}/edit', [EntranceAdminController::class, 'peopleEdit'])->middleware('can:entrance.people.edit')->name('entrance.people.edit');
Route::put('entrance/admin/people/{id}', [EntranceAdminController::class, 'peopleUpdate'])->middleware('can:entrance.people.update')->name('entrance.people.update');
Route::delete('entrance/admin/people/{id}', [EntranceAdminController::class, 'peopleDelete'])->middleware('can:entrance.people.delete')->name('entrance.people.delete');
Route::post('/entrance/upload/excel/people', [EntranceAdminController::class, 'storePeopleExcel'])->middleware('can:entrance.excel.upload')->name('entrance.excel.upload');

//Modulo Entrada - Asistencias
Route::get('/entrance/assistance/index', [AssistanceController::class, 'assistanceIndex'])->middleware('can:entrance.assistance.index')->name('entrance.assistance.index');
//Route::get('/entrance/assistance_show_history/{$id}', [AssistanceController::class, 'showPeoples_history'])->middleware('can:entrance.assistance.show_history')->name('assistance_show_history');

Route::get('/entrance/assistance_show_history/{id}', [AssistanceController::class, 'showPeoples_history'])
    ->middleware('can:entrance.assistance.show_history')
    ->name('assistance_show_history');

//Modulo Entrada - Aprendiz
Route::get('entrance/apprentice/{id}', [ApprenticeController::class, 'show'])->name('apprentice.show');

//Modulo Entrada - Inasistencias
Route::get('entrance/admin/absences', [AbsenceController::class, 'absenceIndex'])->middleware('can:entrance.absence.index')->name('entrance.absence.index');
Route::get('entrance/admin/absences/{id}', [AbsenceController::class, 'absenceShow'])->middleware('can:entrance.absence.show')->name('entrance.absence.show');

Route::get('entrance/justify-absence/{id}', [AbsenceController::class, 'absenceAnswer'])->name('entrance.absence.answer'); //Formulario que se le abre al arendiz para poner el motivo de su inasistencia

Route::put('entrance/justify-absence/answer/{id}', [AbsenceController::class, 'AbsenceUpdateAnswered'])->name('entrance.absence.update.answer'); //Se guarda  en base a lo responddido por el aprendiz en el formulario de inasistencia

Route::put('entrance/justify-absence/{id}', [AbsenceController::class, 'AbsenceUpdateReaded'])->name('entrance.absence.update.readed'); //Se guarda si el administrador de la entrada ya leyó la excusa de inasistencia de alguien


//  Route::get('entrance/justify-absence/{id}',[AbsenceController::class,''])
//agregar rutas para el apartado de programacion





//rutas de Asistencias Admin

Route::get('entrance/admin/assistance', [AssistanceController::class, 'assistanceIndex'])->middleware('can:entrance.assistance.index')->name('entrance.assistance.index');
Route::get('entrance/admin/assistance/{id}', [AssistanceController::class, 'showPeoples'])->middleware('can:entrance.assistance.show')->name('entrance.assistance.show');
Route::get('/entrance/assistance/all', [AssistanceController::class, 'allAssistances'])
    ->middleware('can:entrance.assistance.all')
    ->name('entrance.assistance.all');

// Ruta para cambiar la contraseña
Route::get('/password', [UserController::class, 'showChangeForm'])->name('password.change');
Route::post('/changePassword', [UserController::class, 'changePassword'])->name('password.update');


//Programación ------------------------------------------------------------------------

//login
Route::post('programming/login', [ProgrammingAuthController::class, 'login'])->name('programming-login');

//Modulo Programación
Route::get('programming/admin', [ProgrammingAdminController::class, 'dashboard'])->middleware('can:programming.admin')->name('programming.admin');
