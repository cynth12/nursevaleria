<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PatientForm; // el modelo que guardará las respuestas

class PatientFormController extends Controller
{
    // Mostrar el formulario
    public function create()
    {
        return view('patient.form'); // resources/views/patient/form.blade.php
    }

    // Guardar las respuestas
    public function store(Request $request)
    {
        // Validación básica
        $request->validate([
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
            'consent_accepted' => 'nullable|boolean',
            'digital_signature' => 'nullable|string',
            'authorized_procedure' => 'nullable|string|max:150',
        ]);

        // Guardar en la base de datos
        PatientForm::create($request->all());

        return redirect()->route('patient.form')
            ->with('success', 'Formulario enviado correctamente.');
    }
}
