<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\PacientesController;
use App\Http\Controllers\ConsentimientoController;
use App\Http\Controllers\SearchController;

Route::get('/', function () {
    return redirect('/login');
});

Auth::routes(['register' => false]);

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

// Grupos
Route::get('/grupos', [App\Http\Controllers\GroupController::class, 'index'])->name('grupos.index');
Route::get('/grupos/create', [App\Http\Controllers\GroupController::class, 'create'])->name('grupos.create');
Route::post('/grupos', [App\Http\Controllers\GroupController::class, 'store'])->name('grupos.store');
Route::get('/grupos/{id}', [App\Http\Controllers\GroupController::class, 'show'])->name('grupos.show');
Route::delete('/grupos/{id}', [App\Http\Controllers\GroupController::class, 'destroy'])->name('grupos.destroy');



// Pacientes dentro de grupos
Route::post('/groupPatients', [App\Http\Controllers\GroupPatientController::class, 'store'])->name('groupPatients.store');
Route::get('/groupPatients/{id}', [App\Http\Controllers\GroupPatientController::class, 'show'])->name('groupPatients.show');
Route::get('/groupPatients/{id}/edit', [App\Http\Controllers\GroupPatientController::class, 'edit'])->name('groupPatients.edit');
Route::put('/groupPatients/{id}', [App\Http\Controllers\GroupPatientController::class, 'update'])->name('groupPatients.update');
Route::delete('/groupPatients/{id}', [App\Http\Controllers\GroupPatientController::class, 'destroy'])->name('groupPatients.destroy');


// Ruta de busqueda
Route::get('/buscar', [SearchController::class, 'index'])->name('buscar');

