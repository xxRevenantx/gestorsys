<?php

use App\Http\Controllers\DirectorController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\LevelPDFController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\PDFLevelController;
use App\Http\Controllers\SupervisorController;
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

// RUTAS DEL CONTROLADOR NIVEL
Route::resource('niveles', LevelController::class)->names('levels');
Route::get('nivelesPDF', [PDFLevelController::class, 'nivelesPDF'])->name('nivelespdf');
