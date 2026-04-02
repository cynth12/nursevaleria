<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GroupPatient;
use App\Models\Group;
use Carbon\Carbon;

class GroupPatientController extends Controller
{
    // Guardar un paciente dentro de un grupo
    public function store(Request $request)
    {
        $data = $request->validate([
            'group_id' => 'required|exists:groups,id',
            'name' => 'required|string|max:150',
            'date_of_birth' => 'nullable|date',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:150',
            'address' => 'nullable|string|max:255',

            // Historial médico
            'pregnant' => 'nullable|in:0,1',
            'vitamins_intolerance' => 'nullable|in:0,1',
            'minerals_intolerance' => 'nullable|in:0,1',

            // Alergias
            'allergy_medicine' => 'nullable|string|max:255',
            'allergy_food' => 'nullable|string|max:255',
            'reaction' => 'nullable|string|max:255',

            // Medicamentos y suplementos
            'medications' => 'nullable|string',
            'supplements' => 'nullable|string',
            'physical_exam' => 'nullable|string',

            // Consentimiento
            'consent_accepted' => 'nullable|in:0,1',
            'digital_signature' => 'nullable|string',
            'authorized_procedure' => 'nullable|string|max:255',

            // Signos vitales
            'heart_rate' => 'nullable|integer',
            'oxygen_saturation' => 'nullable|integer',
            'temperature' => 'nullable|numeric',
            'blood_pressure' => 'nullable|string|max:20',

            // Notas
            'notes' => 'nullable|string',
        ]);

        // Normalizar booleanos
        $data['pregnant'] = $request->pregnant === '1' ? 1 : 0;
        $data['vitamins_intolerance'] = $request->vitamins_intolerance === '1' ? 1 : 0;
        $data['minerals_intolerance'] = $request->minerals_intolerance === '1' ? 1 : 0;
        $data['consent_accepted'] = $request->consent_accepted === '1' ? 1 : 0;

        // Fecha de registro automática
        $data['created_at'] = Carbon::now('America/Cancun');

        GroupPatient::create($data);

        return redirect()->route('groups.show', $request->group_id)
                         ->with('success', 'Paciente agregado al grupo correctamente ✅');
    }
}
