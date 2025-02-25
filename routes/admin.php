<?php

use App\Http\Controllers\DirectorController;
use App\Http\Controllers\GenerationController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\LevelPDFController;
use App\Http\Controllers\MostrarNivelController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\PDFLevelController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SupervisorController;
use App\Http\Controllers\TutorController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('admin.dashboard');
})->name('dashboard');

// Route::get('/perfil', function () {
//     return view('admin.perfil');
// })->name('perfil');


// RUTAS DEL CONTROLADOR SUPERVISOR
Route::resource('supervisores', SupervisorController::class)->names('supervisores');

// RUTAS DEL CONTROLADOR DIRECTOR
Route::resource('directores', DirectorController::class)->names('directores');

// RUTAS DEL CONTROLADOR ADMINISTADOR DE NIVELES
Route::resource('administrar-niveles', LevelController::class)->names('levels');



// RUTAS DEL GRUPO
Route::resource('grupos', GroupController::class)->names('groups');


// RUTAS DE LA GENERACIÓN
Route::resource('generaciones', GenerationController::class)->names('generations');

// RUTAS DE LOS GRADOS
Route::resource('grados', GradeController::class)->names('grades');

// RUTAS DEL TUTOR
Route::resource('tutores', TutorController::class)->names('tutors');

// RUTAS DEL ESTUDIANTE
Route::resource('inscripcion-estudiantes', StudentController::class)->names('students');


Route::get('nivelesPDF', [PDFLevelController::class, 'nivelesPDF'])->name('nivelespdf');




// RUTAS DEL CONTROLADOR DE NIVELES
Route::get('/niveles', [MostrarNivelController::class, 'index'])->name('level.index');

Route::get('/niveles/{action}', [MostrarNivelController::class, 'action'])->name('level.action');
