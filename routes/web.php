<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\PacientesController;
use App\Http\Controllers\ConsentimientoController;

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

   

// Listado de consentimientos
Route::get('/consentimientos', [ConsentimientoController::class, 'index'])
    ->name('consentimiento.index');

// Ver un consentimiento específico
Route::get('/consentimientos/{id}', [ConsentimientoController::class, 'show'])
    ->name('consentimiento.show');

// Registrar consentimiento para un paciente
Route::post('/consentimientos/{patientId}', [ConsentimientoController::class, 'store'])
    ->name('consentimiento.store');
