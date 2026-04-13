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
            'name' => 'required|string|max:255',
            'dob' => 'nullable|date',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email',
            // agrega validaciones para los demás campos del cuestionario
        ]);

        // Guardar en la base de datos
        PatientForm::create($request->all());

        return redirect()->route('patient.public')
            ->with('success', 'Formulario enviado correctamente.');
    }
}
