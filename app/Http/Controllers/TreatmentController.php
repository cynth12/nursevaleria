<?php

namespace App\Http\Controllers;

use App\Models\Treatment;
use Illuminate\Http\Request;

class TreatmentController extends Controller
{
    public function index()
    {
        $treatments = Treatment::orderBy('name')->paginate(15);

        return view('treatments.index', compact('treatments'));
    }

    public function create()
    {
        return view('treatments.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|max:150',
            'description' => 'nullable|max:255',
            'formula' => 'required'
        ]);

        Treatment::create($data);

        return redirect()->route('treatments.index')
            ->with('success','Tratamiento creado correctamente.');
    }

    public function show(Treatment $treatment)
    {
        return view('treatments.show', compact('treatment'));
    }

    public function edit(Treatment $treatment)
    {
        return view('treatments.edit', compact('treatment'));
    }

    public function update(Request $request, Treatment $treatment)
    {
        $data = $request->validate([
            'name' => 'required|max:150',
            'description' => 'nullable|max:255',
            'formula' => 'required'
        ]);

        $treatment->update($data);

        return redirect()->route('treatments.index')
            ->with('success','Tratamiento actualizado correctamente.');
    }

    public function destroy(Treatment $treatment)
    {
        $treatment->delete();

        return redirect()->route('treatments.index')
            ->with('success','Tratamiento eliminado.');
    }
}