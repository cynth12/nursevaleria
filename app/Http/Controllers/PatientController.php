<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use Carbon\Carbon;

class PatientController extends Controller
{
    // Formulario público
    public function createForm()
    {
        return view('patient.form');
    }

    // Formulario interno
    public function createIndex()
    {
        return view('patient.index');
    }

    // Guardar paciente
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:150',
            'date_of_birth' => 'required|date',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:150|unique:patients,email',
            'address' => 'nullable|string|max:255',

            'emergency_name' => 'nullable|string|max:150',
            'emergency_relationship' => 'nullable|string|max:100',
            'emergency_phone' => 'nullable|string|max:20',

            'pregnant' => 'nullable|string',
            'vitamins_intolerance' => 'nullable|string',
            'minerals_intolerance' => 'nullable|string',

            'allergy_medicine' => 'nullable|string|max:100',
            'allergy_food' => 'nullable|string|max:150',
            'reaction' => 'nullable|string|max:150',

            'medications' => 'nullable|string',
            'supplements' => 'nullable|string',
            'physical_exam' => 'nullable|string',

            'consent_accepted' => 'nullable|string',
            'digital_signature' => 'nullable|string',
            'authorized_procedure' => 'nullable|string|max:255',

            'heart_rate' => 'nullable|integer',
            'oxygen_saturation' => 'nullable|integer',
            'temperature' => 'nullable|numeric',
            'blood_pressure' => 'nullable|string|max:20',

            'notes' => 'nullable|string',
            'iv_type' => 'nullable|string|max:255',
            'symptoms' => 'nullable|array',
            'reason' => 'nullable|string',
            'referral_source' => 'nullable|array',
            'referral_other' => 'nullable|string|max:255',
        ]);

        // Normalizar valores Yes/No → 1/0
        $data['pregnant'] = $request->pregnant === 'yes' ? 1 : 0;
        $data['vitamins_intolerance'] = $request->vitamins_intolerance === 'yes' ? 1 : 0;
        $data['minerals_intolerance'] = $request->minerals_intolerance === 'yes' ? 1 : 0;
        $data['consent_accepted'] = $request->consent_accepted === 'yes' ? 1 : 0;

        // Checkboxes: convertir array a string separado por comas
        $data['symptoms'] = $request->has('symptoms') ? implode(',', $request->input('symptoms')) : null;

        $data['referral_source'] = $request->has('referral_source') ? implode(',', $request->input('referral_source')) : null;

        $data['referral_other'] = $request->input('referral_other');

        // Fecha de registro
        $data['registration_date'] = Carbon::now('America/Cancun');

        Patient::create($data);

        // 🔹 Diferenciar según la ruta
        if ($request->route()->getName() === 'patient.form.store') {
            // Formulario público → regresar a la misma vista con alerta
            return back()->with('success', 'Your data has been saved successfully');
        } else {
            // Formulario interno → ir al listado
            return redirect()->route('pacientes.index')->with('success', 'Paciente creado correctamente');
        }
    }

    // Mostrar detalle
    public function show($id)
    {
        $patient = Patient::findOrFail($id);
        return view('patient.show', compact('patient'));
    }

    // Editar
    public function edit($id)
    {
        $patient = Patient::findOrFail($id);
        return view('patient.edit', compact('patient'));
    }

    // Actualizar
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
            'pregnant' => 'nullable|string',
            'vitamins_intolerance' => 'nullable|string',
            'minerals_intolerance' => 'nullable|string',
            'allergy_medicine' => 'nullable|string|max:100',
            'allergy_food' => 'nullable|string|max:150',
            'reaction' => 'nullable|string|max:150',
            'medications' => 'nullable|string',
            'supplements' => 'nullable|string',
            'physical_exam' => 'nullable|string',
            'consent_accepted' => 'nullable|string',
            'digital_signature' => 'nullable|string',
            'authorized_procedure' => 'nullable|string|max:255',
            'heart_rate' => 'nullable|integer',
            'oxygen_saturation' => 'nullable|integer',
            'temperature' => 'nullable|numeric',
            'blood_pressure' => 'nullable|string|max:20',
            'notes' => 'nullable|string',
            'registration_date' => 'nullable|date',
            'iv_type' => 'nullable|string|max:255',
            'symptoms' => 'nullable|array',
            'reason' => 'nullable|string',
            'referral_source' => 'nullable|array',
            'referral_other' => 'nullable|string|max:255',
        ]);

        // Normalizar valores Yes/No → 1/0
        $data['pregnant'] = $request->pregnant === 'Yes' ? 1 : 0;
        $data['vitamins_intolerance'] = $request->vitamins_intolerance === 'Yes' ? 1 : 0;
        $data['minerals_intolerance'] = $request->minerals_intolerance === 'Yes' ? 1 : 0;
        $data['consent_accepted'] = $request->consent_accepted === 'Yes' ? 1 : 0;

        // Checkboxes: convertir array a string separado por comas
        $data['symptoms'] = $request->has('symptoms') ? implode(',', $request->input('symptoms')) : null;

        $data['referral_source'] = $request->has('referral_source') ? implode(',', $request->input('referral_source')) : null;

        $data['referral_other'] = $request->input('referral_other');

        // Fecha de registro
        $data['registration_date'] = Carbon::now('America/Cancun');

        $patient->update($data);

        return redirect()->route('patient.show', $patient->id)->with('success', 'Paciente actualizado correctamente ✅');
    }

    // Eliminar
    public function destroy($id)
    {
        $patient = Patient::findOrFail($id);
        $patient->delete();
        return redirect()->route('pacientes.index')->with('success', 'Paciente eliminado correctamente ✅');
    }
}
