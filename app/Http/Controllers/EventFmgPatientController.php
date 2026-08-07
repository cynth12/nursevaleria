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