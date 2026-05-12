<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Consentimiento;

class PacientesController extends Controller
{
    public function index()
{
    $patients = Patient::paginate(2);

    return view('pacientes.index', compact('patients'));
}
}
