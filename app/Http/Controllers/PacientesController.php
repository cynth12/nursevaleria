<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Consentimiento;

class PacientesController extends Controller
{
    public function index(Request $request)
{
    $search = $request->search;

    $patients = Patient::when($search, function ($query) use ($search) {

        $query->whereRaw("CONCAT(name, ' ', last_name) LIKE ?", ["%{$search}%"]);

    })
    ->orderBy('registration_date', 'desc')
    ->paginate(10);

    return view('pacientes.index', compact('patients'));
}
}
