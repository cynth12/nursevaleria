<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ConsentimientoController extends Controller
{
    // Listado de consentimientos
    public function index()
    {
        $consentimientos = Consentimiento::with('patient')->get();
        return view('consentimiento.index', compact('consentimientos'));
    }

    // Mostrar un consentimiento específico
    public function show($id)
    {
        $consentimiento = Consentimiento::with('patient')->findOrFail($id);
        return view('consentimiento.show', compact('consentimiento'));
    }

    // Registrar consentimiento para un paciente
    public function store(Request $request, $patientId)
    {
        $validated = $request->validate([
            'consent_accepted' => 'required|boolean',
            'digital_signature' => 'nullable|string',
            'consent_date' => 'nullable|date',
            'authorized_procedure' => 'nullable|string|max:150',
        ]);

        $validated['patient_id'] = $patientId;

        Consentimiento::create($validated);

        return redirect()->route('consentimiento.index')
            ->with('success', 'Consentimiento registrado correctamente ✅');
    }
}
