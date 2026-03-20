<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Consentimiento;
use App\Models\Patient;

class ConsentimientoController extends Controller
{
    // Listado de todos los consentimientos
    public function index()
    {
        $consentimientos = Consentimiento::with('patient')->get();
        return view('consentimiento.index', compact('consentimientos'));
    }

    // Mostrar el consentimiento firmado de un paciente
    public function show($id)
    {
        $consentimiento = Consentimiento::with('patient')->findOrFail($id);
        return view('consentimiento.show', compact('consentimiento'));
    }

    // Formulario para firmar consentimiento
    public function create($patientId)
    {
        $patient = Patient::findOrFail($patientId);
        return view('consentimiento.create', compact('patient'));
    }

    // Guardar consentimiento firmado
    public function store(Request $request, $patientId)
    {
        $validated = $request->validate([
            'consent_accepted' => 'required|boolean',
            'digital_signature' => 'nullable|string',
            'consent_date' => 'nullable|date',
            'authorized_procedure' => 'nullable|string|max:150',
            'nurse_name' => 'nullable|string|max:150',
            'nurse_id' => 'nullable|string|max:50',
        ]);

        $validated['patient_id'] = $patientId;

        Consentimiento::create($validated);

        return redirect()->route('consentimiento.index')->with('success', 'Consentimiento firmado y guardado correctamente ✅');
    }

    public function destroy($id)
    {
        $consentimiento = Consentimiento::findOrFail($id);
        $consentimiento->delete();

        return redirect()->route('consentimiento.index')->with('success', 'Consentimiento eliminado correctamente ✅');
    }
}
