<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Consentimiento;
use Carbon\Carbon;

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
        $data = $request->validate([
            'name' => 'required|string|max:150',
            'date_of_birth' => 'required|date',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:150',
            // aquí agregas los demás campos que quieras validar
        ]);

        // Guardar fecha/hora de registro en zona horaria de Cancún
        $data['registration_date'] = Carbon::now('America/Cancun');

        Patient::create($data);

        return redirect()->route('patient.index')->with('success', 'Paciente creado correctamente ✅');
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
    public function edit($id)
    {
        $patient = Patient::findOrFail($id);
        return view('patient.edit', compact('patient'));
    }

    public function update(Request $request, $id)
    {
        $patient = Patient::findOrFail($id);

        $data = $request->validate([
            'name' => 'required|string|max:150',
            'date_of_birth' => 'required|date',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:150',
            'emergency_name' => 'nullable|string|max:150',
            'emergency_relationship' => 'nullable|string|max:100',
            'emergency_phone' => 'nullable|string|max:20',
            'pregnant' => 'nullable|boolean',
            'vitamins_intolerance' => 'nullable|boolean',
            'minerals_intolerance' => 'nullable|boolean',
            'allergy_medicine' => 'nullable|string|max:150',
            'allergy_food' => 'nullable|string|max:150',
            'reaction' => 'nullable|string|max:255',
            'medications' => 'nullable|string',
            'supplements' => 'nullable|string',
            'physical_exam' => 'nullable|string',
            'consent_accepted' => 'nullable|boolean',
            'digital_signature' => 'nullable|string',
            'authorized_procedure' => 'nullable|string|max:150',
            'heart_rate' => 'nullable|integer',
            'oxygen_saturation' => 'nullable|integer',
            'temperature' => 'nullable|numeric',
            'blood_pressure' => 'nullable|string|max:20',
            'notes' => 'nullable|string',
            'registration_date' => 'nullable|date',
        ]);

        $patient->update($data);

        return redirect()->route('patient.show', $patient->id)->with('success', 'Paciente actualizado correctamente ✅');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $patient = Patient::findOrFail($id);
        $patient->delete();
        return redirect()->route('pacientes.index')->with('success', 'Paciente eliminado correctamente ✅');
    }
}
