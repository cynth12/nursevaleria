<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Consentimiento;

class PacientesController extends Controller
{
    public function index()
    {
        $patients = Patient::all();
        return view('pacientes.index', compact('patients')); // tu tabla está en pacientes/index.blade.php
    }
}
