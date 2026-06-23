<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Consultation;
use App\Models\Patient;
use Carbon\Carbon;

class StatsController extends Controller
{
    public function index()
    {
        $year = Carbon::now()->year;

        // 📊 Consultas por mes
        $consultasPorMes = Consultation::selectRaw('MONTH(created_at) as mes, COUNT(*) as total')
            ->whereYear('created_at', $year)
            ->groupBy('mes')
            ->orderBy('mes')
            ->pluck('total', 'mes');

        // 👤 Pacientes por mes
        $pacientesPorMes = Patient::selectRaw('MONTH(created_at) as mes, COUNT(*) as total')
            ->whereYear('created_at', $year)
            ->groupBy('mes')
            ->orderBy('mes')
            ->pluck('total', 'mes');

        // 📅 Mes actual
        $consultasMesActual = Consultation::whereMonth('created_at', Carbon::now()->month)->count();
        $pacientesMesActual = Patient::whereMonth('created_at', Carbon::now()->month)->count();

        return view('stats.index', compact(
            'consultasPorMes',
            'pacientesPorMes',
            'consultasMesActual',
            'pacientesMesActual'
        ));
    }
}