<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Consultation;
use App\Models\Patient;
use Carbon\Carbon;

class ConsultationController extends Controller
{
    // Listar consultas de un paciente
    public function index(Patient $patient)
    {
        $consultations = Consultation::where('patient_id', $patient->id)->orderBy('registration_date', 'desc')->paginate(10);

        return view('consultas.index', compact('consultations', 'patient'));
    }

    // Formulario para nueva consulta
    public function create(Patient $patient)
    {
        return view('consultas.create', compact('patient'));
    }

    // Guardar nueva consulta
    public function store(Request $request, Patient $patient)
    {
        $data = $request->validate([
            'name' => 'required|string|max:150',
            'last_name' => 'required|string|max:150',
            'date_of_birth' => 'required|date',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:150',
            'emergency_name' => 'nullable|string|max:150',
            'emergency_relationship' => 'nullable|string|max:100',
            'emergency_phone' => 'nullable|string|max:20',
            'pregnant' => 'nullable|boolean',
            'vitamins_intolerance' => 'nullable|boolean',
            'minerals_intolerance' => 'nullable|boolean',
            'allergy_medicine' => 'nullable|string|max:100',
            'allergy_food' => 'nullable|string|max:150',
            'reaction' => 'nullable|string|max:150',
            'medications' => 'nullable|string',
            'supplements' => 'nullable|string',
            'physical_exam' => 'nullable|string',
            'consent_accepted' => 'nullable|boolean',
            'digital_signature' => 'nullable|string',
            'authorized_procedure' => 'nullable|string|max:255',
            'pre_heart_rate' => 'nullable|integer',
            'pre_oxygen_saturation' => 'nullable|integer',
            'pre_temperature' => 'nullable|numeric',
            'pre_blood_pressure' => 'nullable|string|max:20',
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

        $data['patient_id'] = $patient->id;

        $data['consent_accepted'] = $request->input('consent_accepted', 0);
        $data['pregnant'] = $request->input('pregnant', 0);
        $data['vitamins_intolerance'] = $request->input('vitamins_intolerance', 0);
        $data['minerals_intolerance'] = $request->input('minerals_intolerance', 0);

        $data['symptoms'] = $request->has('symptoms') ? implode(',', $request->input('symptoms')) : null;

        $data['referral_source'] = $request->has('referral_source') ? implode(',', $request->input('referral_source')) : null;

        $data['registration_date'] = now();

        $consultation = Consultation::create($data);

        return redirect()->route('consultas.show', $consultation->id)->with('success', 'Nueva consulta creada correctamente ✅');
    }

    // Mostrar detalle de una consulta
    public function show(Consultation $consultation)
    {
        return view('consultas.show', compact('consultation'));
    }

    // Formulario de edición
    public function edit(Consultation $consultation)
    {
        $patient = $consultation->patient;
        return view('consultas.edit', compact('consultation', 'patient'));
    }

    // Actualizar consulta
    public function update(Request $request, Consultation $consultation)
    {
        $data = $request->validate([
            'name' => 'required|string|max:150',
            'last_name' => 'required|string|max:150',
            'date_of_birth' => 'required|date',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:150',
            'emergency_name' => 'nullable|string|max:150',
            'emergency_relationship' => 'nullable|string|max:100',
            'emergency_phone' => 'nullable|string|max:20',
            'pregnant' => 'nullable|boolean',
            'vitamins_intolerance' => 'nullable|boolean',
            'minerals_intolerance' => 'nullable|boolean',
            'allergy_medicine' => 'nullable|string|max:100',
            'allergy_food' => 'nullable|string|max:150',
            'reaction' => 'nullable|string|max:150',
            'medications' => 'nullable|string',
            'supplements' => 'nullable|string',
            'physical_exam' => 'nullable|string',
            'consent_accepted' => 'nullable|boolean',
            'digital_signature' => 'nullable|string',
            'authorized_procedure' => 'nullable|string|max:255',
            'pre_heart_rate' => 'nullable|integer',
            'pre_oxygen_saturation' => 'nullable|integer',
            'pre_temperature' => 'nullable|numeric',
            'pre_blood_pressure' => 'nullable|string|max:20',
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
        // Normalizar valores Yes/No → 1/0
        $data['consent_accepted'] = $request->input('consent_accepted', 0);
        $data['pregnant'] = $request->input('pregnant', 0);
        $data['vitamins_intolerance'] = $request->input('vitamins_intolerance', 0);
        $data['minerals_intolerance'] = $request->input('minerals_intolerance', 0);
        // Checkboxes: convertir array a string separado por comas
        $data['symptoms'] = $request->has('symptoms') ? implode(',', $request->input('symptoms')) : null;

        $data['referral_source'] = $request->has('referral_source') ? implode(',', $request->input('referral_source')) : null;

        $data['referral_other'] = $request->input('referral_other');

        // Fecha de registro

        // Actualizar la consulta
        $consultation->update($data);

        $consultation->patient->update([
            'name' => $data['name'],
            'last_name' => $data['last_name'],
            'date_of_birth' => $data['date_of_birth'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'registration_date' => $data['registration_date'],
        ]);

        return redirect()->route('consultas.show', $consultation->id)->with('success', 'Consulta actualizada correctamente ✅');
    }

    // Eliminar consulta
    public function destroy(Consultation $consultation)
    {
        $patientId = $consultation->patient_id;
        $consultation->delete();

        return redirect()->route('consultas.index', $patientId)->with('success', 'Consulta eliminada correctamente ✅');
    }
}
