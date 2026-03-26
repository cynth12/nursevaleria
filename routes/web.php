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


// Listado de pacientes
Route::get('/pacientes', [PacientesController::class, 'index'])->name('pacientes.index');



Route::get('/patient/create', [PatientController::class, 'create'])->name('patient.create');
Route::post('/patient', [PatientController::class, 'store'])->name('patient.store');
Route::get('/patient/{id}', [PatientController::class, 'show'])->name('patient.show');
Route::get('/patient/{id}/edit', [PatientController::class, 'edit'])->name('patient.edit');
Route::put('/patient/{id}', [PatientController::class, 'update'])->name('patient.update');
Route::delete('/patient/{id}', [PatientController::class, 'destroy'])->name('patient.destroy');

Route::get('/consentimientos', [ConsentimientoController::class, 'index'])->name('consentimiento.index');
Route::get('/consentimientos/create/{patientId}', [ConsentimientoController::class, 'create'])->name('consentimiento.create');
Route::post('/consentimientos/{patientId}', [ConsentimientoController::class, 'store'])->name('consentimiento.store');
Route::get('/consentimientos/{id}', [ConsentimientoController::class, 'show'])->name('consentimiento.show');
Route::delete('/consentimientos/{id}', [ConsentimientoController::class, 'destroy'])->name('consentimiento.destroy');