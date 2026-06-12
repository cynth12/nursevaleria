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

public function mes($mes)
{
    $patients = Patient::whereYear('registration_date', 2026)
    ->whereMonth('registration_date', $mes)
    ->orderBy('registration_date', 'desc')
    ->paginate(10);

    $nombreMes = [
        1 => 'Enero',
        2 => 'Febrero',
        3 => 'Marzo',
        4 => 'Abril',
        5 => 'Mayo',
        6 => 'Junio',
        7 => 'Julio',
        8 => 'Agosto',
        9 => 'Septiembre',
        10 => 'Octubre',
        11 => 'Noviembre',
        12 => 'Diciembre'
    ];

    return view('pacientes.index', [
        'patients' => $patients,
        'titulo' => 'Pacientes registrados en ' . $nombreMes[$mes]
    ]);
}
}
