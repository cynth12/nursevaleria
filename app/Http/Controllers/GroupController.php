<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Group;
use App\Models\Patient;
use App\Models\Consultation;
use Carbon\Carbon;

class GroupController extends Controller
{
    // Listado de grupos
    public function index()
    {
        $groups = Group::all();
        return view('grupos.index', compact('groups'));
    }

    // Formulario para crear grupo
    public function create()
    {
        return view('grupos.create');
    }

    // Guardar grupo
    public function store(Request $request)
    {
        $data = $request->validate([
            'place' => 'required|string|max:150',
        ]);

        // Fecha automática
        $data['date'] = Carbon::now('America/Cancun');

        // Token único para el formulario público
        $data['public_token'] = \Illuminate\Support\Str::random(40);

        Group::create($data);

        return redirect()->route('grupos.index')->with('success', 'Grupo creado correctamente ✅');
    }

    // Mostrar un grupo y sus pacientes
    public function show($id)
    {
        $group = Group::findOrFail($id);

        $patients = $group->patients()->orderBy('name')->get();

        return view('grupos.show', compact('group', 'patients'));
    }

    public function publicForm($public_token)
    {
        $group = Group::where('public_token', $public_token)->firstOrFail();

        return view('grupos.public-form', compact('group'));
    }

    public function publicStore(Request $request, $public_token)
    {
        // Buscar el grupo mediante su token público
        $group = Group::where('public_token', $public_token)->firstOrFail();

        // Validar formulario
        $data = $request->validate([
            'name' => 'required|string|max:150',
            'last_name' => 'required|string|max:150',
            'date_of_birth' => ['required', 'regex:/^\d{4}-\d{2}-\d{2}$/', 'date_format:Y-m-d'],
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
            'oxigen_saturation' => 'nullable|integer',
            'temperature' => 'nullable|numeric',
            'blood_pressure' => 'nullable|string|max:20',

            'notes' => 'nullable|string',
            'iv_type' => 'nullable|string|max:255',
            'symptoms' => 'nullable|array',
            'reason' => 'nullable|string',
            'referral_source' => 'nullable|array',
            'referral_other' => 'nullable|string|max:255',
        ]);

        // Convertir Yes / No a 1 / 0
        $data['pregnant'] = $request->pregnant === 'yes' ? 1 : 0;

        $data['vitamins_intolerance'] = $request->vitamins_intolerance === 'yes' ? 1 : 0;

        $data['minerals_intolerance'] = $request->minerals_intolerance === 'yes' ? 1 : 0;

        $data['consent_accepted'] = $request->consent_accepted === 'yes' ? 1 : 0;

        // Convertir checkboxes a string
        $data['symptoms'] = $request->has('symptoms') ? implode(',', $request->input('symptoms')) : null;

        $data['referral_source'] = $request->has('referral_source') ? implode(',', $request->input('referral_source')) : null;

        $data['referral_other'] = $request->input('referral_other');

        // Fecha de registro
        $data['registration_date'] = Carbon::now('America/Cancun');

        // MUY IMPORTANTE:
        // Este paciente pertenece directamente al grupo
        $data['group_id'] = $group->id;

        // Crear paciente REAL
        $patient = Patient::create($data);

        // Crear primera consulta automáticamente
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
            'oxigen_saturation' => $data['oxigen_saturation'] ?? null,
            'temperature' => $data['temperature'] ?? null,
            'blood_pressure' => $data['blood_pressure'] ?? null,

            'notes' => $data['notes'] ?? null,
            'iv_type' => $data['iv_type'] ?? null,
            'symptoms' => $data['symptoms'] ?? null,
            'reason' => $data['reason'] ?? null,
            'referral_source' => $data['referral_source'] ?? null,
            'referral_other' => $data['referral_other'] ?? null,
        ]);

        return redirect()->route('group.public.form', $group->public_token)->with('success', 'Your data has been saved successfully');
    }

    public function removePatient($groupId, $patientId)
    {
        $group = Group::findOrFail($groupId);

        $patient = Patient::where('id', $patientId)->where('group_id', $group->id)->firstOrFail();

        // Eliminar todas las consultas del paciente
        $patient->consultations()->delete();

        // Eliminar al paciente completamente
        $patient->delete();

        return redirect()->route('grupos.show', $group->id)->with('success', 'Paciente y todas sus consultas eliminados correctamente ✅');
    }

    public function destroy($id)
    {
        $group = Group::findOrFail($id);
        $group->delete();

        return redirect()->route('grupos.index')->with('success', 'Grupo eliminado correctamente ✅');
    }
    public function list()
    {
        return response()->json(Group::all());
    }
}
