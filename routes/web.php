<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;


Route::get('/', function () {
    return redirect('/login'); // Redirige al login si entra a la raíz
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])
    ->middleware('auth')
    ->name('home');


    use App\Http\Controllers\PatientController; 

    Route::get('/patient', [PatientController::class, 'index'])->middleware('auth');

    use App\Http\Controllers\PacientesController; 
    
    Route::get('/pacientes', [PacientesController::class, 'index'])->middleware('auth');