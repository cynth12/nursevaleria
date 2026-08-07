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

    }

}