<?php

use App\Http\Controllers\ActionController;
use App\Http\Controllers\DirectorController;
use App\Http\Controllers\GenerationController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\LevelPDFController;
use App\Http\Controllers\MateriaController;
use App\Http\Controllers\MostrarNivelController;
use App\Http\Controllers\PagoInscripcionController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\PDFLevelController;
use App\Http\Controllers\PeriodoController;
use App\Http\Controllers\PersonnelController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SupervisorController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\TutorController;
use App\Models\Teacher;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('admin.dashboard');
})->name('dashboard');

// Route::get('/perfil', function () {
//     return view('admin.perfil');
// })->name('perfil');

// RUTAS DE LAS ACCIONES

Route::resource('acciones', ActionController::class)->names('actions');

// RUTAS DEL CONTROLADOR SUPERVISOR
Route::resource('supervisores', SupervisorController::class)->names('supervisores');

// RUTAS DEL CONTROLADOR DIRECTOR
Route::resource('directores', DirectorController::class)->names('directores');

// RUTAS DEL CONTROLADOR ADMINISTADOR DE NIVELES
Route::resource('administrar-niveles', LevelController::class)->names('levels');

// RUTAS DEL PERIODO
Route::resource('periodos', PeriodoController::class)->names('periodos');



// RUTAS DEL GRUPO
Route::resource('grupos', GroupController::class)->names('groups');


// RUTAS DE LA GENERACIÓN
Route::resource('generaciones', GenerationController::class)->names('generations');

// RUTAS DE LOS GRADOS
Route::resource('grados', GradeController::class)->names('grades');

// RUTAS DEL TUTOR
Route::resource('tutores', TutorController::class)->names('tutors');

//RUTAS DEL PERSONAL
Route::resource('personal', PersonnelController::class)->names('personnels');

// RUTAS DEL PROFESOR
Route::resource('asignacion-personal', TeacherController::class)->names('teachers');

// RUTAS DEL ESTUDIANTE
Route::resource('matricula-general', StudentController::class)->names('students');



// EDITAR MATERIA
Route::resource('materias', MateriaController::class)->names('materias');



// PDFS

// Route::get('nivelesPDF', [PDFLevelController::class, 'nivelesPDF'])->name('nivelespdf');
Route::get('/expediente-alumno/{alumno}', [PDFLevelController::class, 'expedienteAlumno'])->name('expediente.alumno');


Route::get('/lista-alumnos/{level}/{grade}', [PDFLevelController::class, 'listaAlumnosGrade'])->name('lista.alumnos.grade');
Route::get('/lista-alumnos/{level}/{grade}/{group}', [PDFLevelController::class, 'listaAlumnosGroup'])->name('lista.alumnos.group');
Route::get('/lista-alumnos/{level}/{grade}/{group}/{gender}', [PDFLevelController::class, 'listaAlumnosGroupGender'])->name('lista.alumnos.gender');


Route::get('/recibo-inscripcion/{alumno}', [PDFLevelController::class, 'reciboInscripcion'])->name('recibo.inscripcion');

Route::get('/recibo-colegiatura/{alumno}/{mes}', [PDFLevelController::class, 'reciboColegiatura'])->name('recibo.colegiatura');
Route::get('/estado-cuenta/{alumno}', [PDFLevelController::class, 'estadoCuenta'])->name('estado.cuenta');


Route::get('/horarios/{level}/{grade}/{group}', [PDFLevelController::class, 'horarios'])->name('horario');




// RUTAS DEL CONTROLADOR DE NIVELES
Route::get('/niveles', [MostrarNivelController::class, 'index'])->name('level.index');

Route::get('/niveles/{nivel}', [MostrarNivelController::class, 'nivel'])->name('level.nivel');

Route::get('/niveles/{nivel}/{action}/{grade}', [MostrarNivelController::class, 'action'])->name('level.action');


Route::get('/niveles/{nivel}/{action}/{grado}', [MostrarNivelController::class, 'matricula'])->name('level.grados');



// RUTAS DE PAGO DE INSCRIPCIÓN
Route::resource('/pago-inscripcion', PagoInscripcionController::class)->names('pago-inscripcion');

// RUTAS DE LAS MATERIAS
// Route::get('/niveles/{nivel}/{action}/{grado}', [MostrarNivelController::class, 'materias'])->name('level.materias');
