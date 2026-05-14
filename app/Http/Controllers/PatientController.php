<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Consultation;
use Carbon\Carbon;

class PatientController extends Controller
{
    // Formulario público
    public function createForm()
    {
        return response()->view('patient.form')->header('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0')->header('Pragma', 'no-cache');
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
            'last_name' => 'required|string|max:150',
            'date_of_birth' => 'required|date',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:150',
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

        // Buscar paciente existente
        $patient = Patient::where('name', $request->name)->where('date_of_birth', $request->date_of_birth)->first();

        if (!$patient) {
            // 🔹 Crear paciente nuevo
            $patient = Patient::create($data);

            // 🔹 Crear su primera consulta automáticamente
            Consultation::create([
                'patient_id' => $patient->id,
                'registration_date' => Carbon::now('America/Cancun'),

                'name' => $data['name'] ?? null,
                'last_name' => $data['last_name'] ?? null,
                'date_of_birth' => $data['date_of_birth'] ?? null,
                'phone' => $data['phone'] ?? null,
                'email' => $data['email'] ?? null,
                'address' => $data['address'] ?? null,

                'emergency_name' => $data['emergency_name'] ?? null,
                'emergency_relationship' => $data['emergency_relationship'] ?? null,
                'emergency_phone' => $data['emergency_phone'] ?? null,

                'pregnant' => $data['pregnant'] ?? null,
                'vitamins_intolerance' => $data['vitamins_intolerance'] ?? null,
                'minerals_intolerance' => $data['minerals_intolerance'] ?? null,

                'allergy_medicine' => $data['allergy_medicine'] ?? null,
                'allergy_food' => $data['allergy_food'] ?? null,
                'reaction' => $data['reaction'] ?? null,

                'medications' => $data['medications'] ?? null,
                'supplements' => $data['supplements'] ?? null,
                'physical_exam' => $data['physical_exam'] ?? null,

                'consent_accepted' => $data['consent_accepted'] ?? null,
                'digital_signature' => $data['digital_signature'] ?? null,
                'authorized_procedure' => $data['authorized_procedure'] ?? null,

                'heart_rate' => $data['heart_rate'] ?? null,
                'oxygen_saturation' => $data['oxygen_saturation'] ?? null,
                'temperature' => $data['temperature'] ?? null,
                'blood_pressure' => $data['blood_pressure'] ?? null,

                'notes' => $data['notes'] ?? null,
                'iv_type' => $data['iv_type'] ?? null,
                'symptoms' => $data['symptoms'] ?? null,
                'reason' => $data['reason'] ?? null,
                'referral_source' => $data['referral_source'] ?? null,
                'referral_other' => $data['referral_other'] ?? null,
            ]);

            // Diferenciar según la ruta
            if ($request->route()->getName() === 'patient.form.store') {
                // Formulario público → regresar a la misma vista con alerta
                return back()->with('success', 'Your data has been saved successfully');
            } else {
                // Formulario interno → ir al listado
                return redirect()->route('patients.index')->with('success', 'Paciente creado correctamente');
            }
        }

        // 🔹 Paciente ya existe → crear nueva consulta
        $consultation = Consultation::create([
            'patient_id' => $patient->id,
            'registration_date' => Carbon::now('America/Cancun'),
            'name' => $data['name'] ?? null,
            'last_name' => $data['last_name'] ?? null,
            'date_of_birth' => $data['date_of_birth'] ?? null,
            'phone' => $data['phone'] ?? null,
            'email' => $data['email'] ?? null,
            'address' => $data['address'] ?? null,
            'emergency_name' => $data['emergency_name'] ?? null,
            'emergency_relationship' => $data['emergency_relationship'] ?? null,
            'emergency_phone' => $data['emergency_phone'] ?? null,
            'pregnant' => $data['pregnant'] ?? null,
            'vitamins_intolerance' => $data['vitamins_intolerance'] ?? null,
            'minerals_intolerance' => $data['minerals_intolerance'] ?? null,
            'allergy_medicine' => $data['allergy_medicine'] ?? null,
            'allergy_food' => $data['allergy_food'] ?? null,
            'reaction' => $data['reaction'] ?? null,
            'medications' => $data['medications'] ?? null,
            'supplements' => $data['supplements'] ?? null,
            'physical_exam' => $data['physical_exam'] ?? null,
            'consent_accepted' => $data['consent_accepted'] ?? null,
            'digital_signature' => $data['digital_signature'] ?? null, // 🔹 aquí el fix
            'authorized_procedure' => $data['authorized_procedure'] ?? null,
            'heart_rate' => $data['heart_rate'] ?? null,
            'oxygen_saturation' => $data['oxygen_saturation'] ?? null,
            'temperature' => $data['temperature'] ?? null,
            'blood_pressure' => $data['blood_pressure'] ?? null,
            'notes' => $data['notes'] ?? null,
            'iv_type' => $data['iv_type'] ?? null,
            'symptoms' => $data['symptoms'] ?? null,
            'reason' => $data['reason'] ?? null,
            'referral_source' => $data['referral_source'] ?? null,
            'referral_other' => $data['referral_other'] ?? null,
        ]);

        return redirect()->route('consultas.show', $consultation->id)->with('success', 'Consulta registrada correctamente ✅');
    }

    // Mostrar detalle
    public function show($id)
    {
        $patient = Patient::findOrFail($id);
        $consultation = $patient->consultations()->latest('registration_date')->first();

        return view('consultas.show', compact('consultation'));
    }

    // Editar
    public function edit($id)
    {
        $patient = Patient::findOrFail($id);
        $consultation = $patient->consultations()->latest('registration_date')->first();

        return view('consultas.edit', compact('patient', 'consultation'));
    }

    // Actualizar
    public function update(Request $request, $id)
    {
        $patient = Patient::findOrFail($id);

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
            'heart_rate' => 'nullable|integer',
            'oxigen_saturation' => 'nullable|integer',
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
        $data['consent_accepted'] = $request->input('consent_accepted', 0);
        $data['pregnant'] = $request->input('pregnant', 0);
        $data['vitamins_intolerance'] = $request->input('vitamins_intolerance', 0);
        $data['minerals_intolerance'] = $request->input('minerals_intolerance', 0);
        // Checkboxes: convertir array a string separado por comas
        $data['symptoms'] = $request->has('symptoms') ? implode(',', $request->input('symptoms')) : null;

        $data['referral_source'] = $request->has('referral_source') ? implode(',', $request->input('referral_source')) : null;

        $data['referral_other'] = $request->input('referral_other');

        // Fecha de registro
        $data['registration_date'] = Carbon::now('America/Cancun');

        $patient->update($data);

        // Redirigir a la última consulta del paciente
        $consultation = $patient->consultations()->latest('registration_date')->first();

        return redirect()->route('consultas.show', $consultation->id)->with('success', 'Paciente actualizado correctamente ✅');
    }

    // Eliminar
    public function destroy($id)
    {
        $patient = Patient::findOrFail($id);
        $patient->delete();
        return redirect()->route('pacientes.index')->with('success', 'Paciente eliminado correctamente ✅');
    }

    public function addToGroup(Request $request, $id)
    {
        $patient = Patient::findOrFail($id);

        // Verificar si hay grupos
        $groups = Group::all();
        if ($groups->isEmpty()) {
            return response()->json(['error' => 'No hay ningún grupo creado'], 404);
        }

        // Agregar paciente al grupo seleccionado
        $groupId = $request->input('group_id');
        $group = Group::findOrFail($groupId);

        $group->patients()->attach($patient->id);

        return response()->json(['success' => 'Paciente agregado al grupo correctamente']);
    }
}
