<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Group;
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

        Group::create($data);

        return redirect()->route('grupos.index')->with('success', 'Grupo creado correctamente ✅');
    }

    // Mostrar un grupo y sus pacientes
    public function show($id)
    {
        $group = Group::findOrFail($id);

        // Relación con pacientes de grupo
        $patients = $group->patients;

        // Opcional: mapear consentimiento de cada paciente
        foreach ($patients as $patient) {
            $patient->consentimiento = (object) [
                'accepted' => $patient->consent_accepted,
                'signature' => $patient->digital_signature,
                'procedure' => $patient->authorized_procedure,
                'nurse_name' => $patient->nurse_name ?? null,
                'nurse_id' => $patient->nurse_id ?? null,
            ];
        }

        return view('grupos.show', compact('group', 'patients'));
    }

    public function destroy($id)
    {
        $group = Group::findOrFail($id);
        $group->delete();

        return redirect()->route('grupos.index')->with('success', 'Grupo eliminado correctamente ✅');
    }
}
