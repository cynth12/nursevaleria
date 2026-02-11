<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;

class PatientController extends Controller
{
    // Mostrar formulario de creación
    public function create()
    {
        return view('patient.index'); // tu formulario está en patient/index.blade.php
    }

    // Guardar paciente
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:150',
            'email' => 'required|email|unique:patients,email',
        ]);

        Patient::create($request->all());

        return redirect()->route('pacientes.index')
            ->with('success', 'Paciente registrado correctamente ✅');
    }

    // Mostrar detalle de un paciente
    public function show($id)
    {
        $patient = Patient::findOrFail($id);
        return view('patient.show', compact('patient')); // tu vista está en patient/show.blade.php
    }
    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) 
    { $patient = Patient::findOrFail($id); 
        $patient->delete(); 
        return redirect()->route('pacientes.index') 
        ->with('success', 'Paciente eliminado correctamente ✅'); }
}
