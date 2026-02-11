<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\PacientesController;

Route::get('/', function () {
    return redirect('/login');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])
    ->middleware('auth')
    ->name('home');

// Formulario y creación de paciente
Route::get('/patient/create', [PatientController::class, 'create'])
    ->middleware('auth')
    ->name('patient.create');

Route::post('/patient', [PatientController::class, 'store'])
    ->middleware('auth')
    ->name('patient.store');
Route::delete('/patient/{id}', [PatientController::class, 'destroy']) 
->middleware('auth') 
->name('patient.destroy');

// Listado de pacientes
Route::get('/pacientes', [PacientesController::class, 'index'])
    ->middleware('auth')
    ->name('pacientes.index');

// Ver detalle de un paciente
Route::get('/patient/{id}', [PatientController::class, 'show'])
    ->middleware('auth')
    ->name('patient.show');
