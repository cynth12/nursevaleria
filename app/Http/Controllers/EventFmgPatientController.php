<?php

namespace App\Http\Controllers;

use App\Models\EventFmgPatient;
use App\Models\Patient;
use App\Models\Consultation;
use Illuminate\Http\Request;
use Carbon\Carbon;

class EventFmgPatientController extends Controller
{

    /**
     * Formulario público
     */
    public function create()
    {
        return view('event-fmg.create');
    }

    /**
     * Guardar participante
     */
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

        'reason' => 'nullable|string',
        'symptoms' => 'nullable|array',
        'referral_source' => 'nullable|array',
        'referral_other' => 'nullable|string|max:255',

        'iv_type' => 'nullable|string|max:255',
    ]);

    // Normalizar Yes / No
    $data['pregnant'] = $request->pregnant === 'yes' ? 1 : 0;
    $data['vitamins_intolerance'] = $request->vitamins_intolerance === 'yes' ? 1 : 0;
    $data['minerals_intolerance'] = $request->minerals_intolerance === 'yes' ? 1 : 0;

    // Checkboxes
    $data['symptoms'] = $request->has('symptoms')
        ? implode(',', $request->symptoms)
        : null;

    $data['referral_source'] = $request->has('referral_source')
        ? implode(',', $request->referral_source)
        : null;

    $data['registration_date'] = Carbon::now('America/Cancun');

    EventFmgPatient::create($data);

    return back()->with(
        'success',
        'Thank you! Your registration has been received successfully.'
    );
}
  

    /**
     * Lista de participantes
     */
    public function index()
    {
        $participants = EventFmgPatient::latest()->paginate(20);

        return view('event-fmg.index', compact('participants'));
    }

    /**
     * Ver participante
     */
    public function show(EventFmgPatient $eventFmgPatient)
    {
        return view('event-fmg.show', compact('eventFmgPatient'));
    }

    /**
     * Editar participante
     */
    public function edit(EventFmgPatient $eventFmgPatient)
    {
        return view('event-fmg.edit', compact('eventFmgPatient'));
    }

    /**
     * Actualizar participante
     */
  public function update(Request $request, EventFmgPatient $eventFmgPatient)
{
    $data = $request->validate([
        'name'                    => 'required|string|max:150',
        'last_name'               => 'required|string|max:150',
        'date_of_birth'           => 'required|date',
        'phone'                   => 'nullable|string|max:20',
        'email'                   => 'nullable|email|max:150',
        'address'                 => 'nullable|string|max:255',

        'emergency_name'          => 'nullable|string|max:150',
        'emergency_relationship'  => 'nullable|string|max:100',
        'emergency_phone'         => 'nullable|string|max:20',

        'pregnant'                => 'nullable',
        'vitamins_intolerance'    => 'nullable',
        'minerals_intolerance'    => 'nullable',

        'allergy_medicine'        => 'nullable|string|max:100',
        'allergy_food'            => 'nullable|string|max:150',
        'reaction'                => 'nullable|string|max:255',

        'medications'             => 'nullable|string',
        'supplements'             => 'nullable|string',
        'physical_exam'           => 'nullable|string',

        'reason'                  => 'nullable|string',
        'symptoms'                => 'nullable|array',
        'referral_source'         => 'nullable|array',
        'referral_other'          => 'nullable|string|max:255',

        'iv_type'                 => 'nullable|string|max:255',
    ]);

    // Corregido: comparar el string exacto para evitar que "0" sea truthy
    $data['pregnant']             = $request->input('pregnant') === '1' ? 1 : 0;
    $data['vitamins_intolerance'] = $request->input('vitamins_intolerance') === '1' ? 1 : 0;
    $data['minerals_intolerance'] = $request->input('minerals_intolerance') === '1' ? 1 : 0;

    // Symptoms: si no viene ninguno marcado, guardar null
    $data['symptoms'] = $request->has('symptoms')
        ? implode(',', $request->symptoms)
        : null;

    // Referral: igual
    $data['referral_source'] = $request->has('referral_source')
        ? implode(',', $request->referral_source)
        : null;

    $eventFmgPatient->update($data);

    return redirect()
        ->route('event-fmg.show', $eventFmgPatient->id)
        ->with('success', 'Participant updated successfully.');
}
    /**
     * Eliminar participante
     */
    public function destroy(EventFmgPatient $eventFmgPatient)
    {
        $eventFmgPatient->delete();

        return redirect()
            ->route('event-fmg.index')
            ->with('success','Participant deleted successfully.');
    }

    /**
     * Convertir a paciente
     */
    public function convert(EventFmgPatient $eventFmgPatient)
{
    // Buscar si ya existe
    $patient = Patient::where('name', $eventFmgPatient->name)
        ->where('last_name', $eventFmgPatient->last_name)
        ->where('date_of_birth', $eventFmgPatient->date_of_birth)
        ->first();

    if ($patient) {
        return redirect()
            ->route('patients.index')
            ->with('warning', 'This participant already exists as a patient.');
    }

    // Crear paciente
    $patient = Patient::create([
        'name' => $eventFmgPatient->name,
        'last_name' => $eventFmgPatient->last_name,
        'date_of_birth' => $eventFmgPatient->date_of_birth,
        'phone' => $eventFmgPatient->phone,
        'email' => $eventFmgPatient->email,
        'address' => $eventFmgPatient->address,
    ]);

    // Crear primera consulta
    Consultation::create([
        'patient_id' => $patient->id,

        'registration_date' => now('America/Cancun'),

        'name' => $eventFmgPatient->name,
        'last_name' => $eventFmgPatient->last_name,
        'date_of_birth' => $eventFmgPatient->date_of_birth,

        'phone' => $eventFmgPatient->phone,
        'email' => $eventFmgPatient->email,
        'address' => $eventFmgPatient->address,

        'emergency_name' => $eventFmgPatient->emergency_name,
        'emergency_relationship' => $eventFmgPatient->emergency_relationship,
        'emergency_phone' => $eventFmgPatient->emergency_phone,

        'pregnant' => $eventFmgPatient->pregnant,
        'vitamins_intolerance' => $eventFmgPatient->vitamins_intolerance,
        'minerals_intolerance' => $eventFmgPatient->minerals_intolerance,

        'allergy_medicine' => $eventFmgPatient->allergy_medicine,
        'allergy_food' => $eventFmgPatient->allergy_food,
        'reaction' => $eventFmgPatient->reaction,

        'medications' => $eventFmgPatient->medications,
        'supplements' => $eventFmgPatient->supplements,
        'physical_exam' => $eventFmgPatient->physical_exam,

        'reason' => $eventFmgPatient->reason,
        'symptoms' => $eventFmgPatient->symptoms,

        'referral_source' => $eventFmgPatient->referral_source,
        'referral_other' => $eventFmgPatient->referral_other,

        'iv_type' => $eventFmgPatient->iv_type,
    ]);

    return redirect()
        ->route('pacientes.index')
        ->with('success', 'Participant successfully converted to patient.');
}

}