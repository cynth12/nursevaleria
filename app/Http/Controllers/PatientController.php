<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
     public function index()
    {
        return view('patient.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validación básica
        $request->validate([
            'name' => 'required|string|max:150',
            'date_of_birth' => 'nullable|date',
            'phone' => 'nullable|string|max:20',
            'email' => 'required|email|unique:patients,email',
        ]);

        // Guardar paciente
        Patient::create([
            'name' => $request->name,
            'date_of_birth' => $request->date_of_birth,
            'phone' => $request->phone,
            'email' => $request->email,
            'emergency_name' => $request->emergency_name,
            'emergency_relationship' => $request->emergency_relationship,
            'emergency_phone' => $request->emergency_phone,
            'pregnant' => $request->prenant === 'yes',
            'vitamins_intolerance' => $request->vitamins === 'yes',
            'minerals_intolerance' => $request->minerals === 'yes',
            'allergy_medicine' => $request->allergy_medicine,
            'allergy_food' => $request->allergy_food,
            'reaction' => $request->reaction,
            'medications' => $request->medications,
            'supplements' => $request->supplements,
            'physical_exam' => $request->physical_exam,
            'notes' => $request->notes,
            // registration_date se llena automáticamente por la migración
        ]);

        return redirect()->back()->with('success', 'Paciente registrado correctamente ✅');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
