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
        return view('groups.index', compact('groups'));
    }

    // Formulario para crear grupo
    public function create()
    {
        return view('groups.create');
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

        return redirect()->route('groups.index')
                         ->with('success', 'Grupo creado correctamente ✅');
    }

    // Mostrar un grupo y sus pacientes
    public function show($id)
    {
        $group = Group::findOrFail($id);

        // Relación con pacientes de grupo
        $patients = $group->patients; 

        return view('groups.show', compact('group', 'patients'));
    }
}
