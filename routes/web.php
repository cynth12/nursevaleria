<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\PacientesController;
use App\Http\Controllers\ConsentimientoController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ImportedPatientsController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\GroupPatientController;
use App\Http\Controllers\ConsultationController;
use App\Http\Controllers\StatsController;
use App\Http\Controllers\ImportFileController;
use App\Http\Controllers\TreatmentController;
use App\Http\Controllers\CalendarController;


Route::get('/', function () {
    return redirect('/login');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->middleware('auth') ->name('home');

// Formulario que ve el paciente
Route::get('/patient/form', [PatientController::class, 'createForm'])->name('patient.form');
Route::post('/patient/form', [PatientController::class, 'store'])->name('patient.form.store');

Route::middleware(['auth'])->group(function () {
// Listado de pacientes
Route::get('/pacientes', [PacientesController::class, 'index'])->name('pacientes.index');

// Formulario interno de tu sistema
Route::get('/patient/index', [PatientController::class, 'createIndex'])->name('patient.index');
Route::post('/patient/index', [PatientController::class, 'store'])->name('patient.index.store');

// Mostrar detalle de un paciente
Route::get('/patient/{id}', [PatientController::class, 'show'])->name('patient.show');

// Editar paciente
Route::get('/patient/{id}/edit', [PatientController::class, 'edit'])->name('patient.edit');
Route::put('/patient/{id}', [PatientController::class, 'update'])->name('patient.update');

// Eliminar paciente
Route::delete('/patient/{id}', [PatientController::class, 'destroy'])->name('patient.destroy');
Route::post('/patients/{id}/add-to-group', [PatientController::class, 'addToGroup']);

// Consentimientos
Route::get('/consentimientos', [ConsentimientoController::class, 'index'])
    ->name('consentimiento.index');

Route::get('/consentimientos/create/{consultationId}', [ConsentimientoController::class, 'create'])
    ->name('consentimiento.create');

Route::post('/consentimientos/{consultationId}', [ConsentimientoController::class, 'store'])
    ->name('consentimiento.store');

Route::get('/consentimientos/{id}', [ConsentimientoController::class, 'show'])
    ->name('consentimiento.show');

Route::get('/consentimientos/{id}/edit', [ConsentimientoController::class, 'edit'])
    ->name('consentimiento.edit');

Route::put('/consentimientos/{id}', [ConsentimientoController::class, 'update'])
    ->name('consentimiento.update');

Route::delete('/consentimientos/{id}', [ConsentimientoController::class, 'destroy'])
    ->name('consentimiento.destroy');


//grupos
Route::get('/grupos', [App\Http\Controllers\GroupController::class, 'index'])->name('grupos.index');
Route::get('/grupos/create', [App\Http\Controllers\GroupController::class, 'create'])->name('grupos.create');
Route::post('/grupos', [App\Http\Controllers\GroupController::class, 'store'])->name('grupos.store');
Route::get('/grupos/{id}', [App\Http\Controllers\GroupController::class, 'show'])->name('grupos.show');
Route::delete('/grupos/{id}', [App\Http\Controllers\GroupController::class, 'destroy'])->name('grupos.destroy');
Route::get('/groups/list', [App\Http\Controllers\GroupController::class, 'list'])->name('groups.list');;






// Pacientes dentro de grupos
Route::post('/groupPatients', [App\Http\Controllers\GroupPatientController::class, 'store'])->name('groupPatients.store');
Route::get('/groupPatients/{id}', [App\Http\Controllers\GroupPatientController::class, 'show'])->name('groupPatients.show');
Route::get('/groupPatients/{id}/edit', [App\Http\Controllers\GroupPatientController::class, 'edit'])->name('groupPatients.edit');
Route::put('/groupPatients/{id}', [App\Http\Controllers\GroupPatientController::class, 'update'])->name('groupPatients.update');
Route::delete('/groupPatients/{id}', [App\Http\Controllers\GroupPatientController::class, 'destroy'])->name('groupPatients.destroy');



// Ruta de busqueda
Route::get('/buscar', [SearchController::class, 'index'])->name('buscar');

// Ruta de importacion
Route::get('/imported_patients', [ImportedPatientsController::class, 'index'])
    ->name('imported_patients.index');

Route::post('/imported_patients/import', [ImportedPatientsController::class, 'import'])
    ->name('imported_patients.import');

Route::delete('/imported_patients/destroy-all', [ImportedPatientsController::class, 'destroyAll'])
    ->name('imported_patients.destroyAll');
    });

Route::get('/imports/download/{id}', [ImportedPatientsController::class, 'download'] )->name('imports.download');
Route::delete('/imports/{id}', [ImportedPatientsController::class, 'destroyFile'])->name('imports.destroy');


//patients

Route::get('/patients/{patient}/consultas', [ConsultationController::class, 'index'])
    ->name('consultas.index');

Route::get('/consultas/{consultation}', [ConsultationController::class, 'show'])
    ->name('consultas.show');

Route::get('/consultas/{consultation}/edit', [ConsultationController::class, 'edit'])
    ->name('consultas.edit');

Route::put('/consultas/{consultation}', [ConsultationController::class, 'update'])
    ->name('consultas.update');

Route::delete('/consultas/{consultation}', [ConsultationController::class, 'destroy'])
    ->name('consultas.destroy');
    
Route::get('/patients/{patient}/consultations/create', [ConsultationController::class, 'create'])
    ->name('consultas.create');

Route::post('/patients/{patient}/consultations',[ConsultationController::class, 'store'])
    ->name('consultas.store');

Route::get('/estadisticas', [StatsController::class, 'index'])->name('stats.index');
Route::post('/patients/{patient}/assign-group', [PacientesController::class, 'assignGroup'])
    ->name('patients.assignGroup');


//calendario
Route::get('/calendar', [CalendarController::class, 'index'])
    ->name('calendar.index');
Route::get('/calendario/{year}/{mes}', [PacientesController::class, 'mes'])
    ->name('calendario');
//tratamientos

Route::get('/treatments', [TreatmentController::class, 'index'])->name('treatments.index');

Route::get('/treatments/create', [TreatmentController::class, 'create'])->name('treatments.create');

Route::post('/treatments', [TreatmentController::class, 'store'])->name('treatments.store');

Route::get('/treatments/{treatment}', [TreatmentController::class, 'show'])->name('treatments.show');

Route::get('/treatments/{treatment}/edit', [TreatmentController::class, 'edit'])->name('treatments.edit');

Route::put('/treatments/{treatment}', [TreatmentController::class, 'update'])->name('treatments.update');

Route::delete('/treatments/{treatment}', [TreatmentController::class, 'destroy'])->name('treatments.destroy');

//print pdf
Route::get('/consultas/{consultation}/pdf', [ConsultationController::class, 'pdf'])
    ->name('consultas.pdf');



    




