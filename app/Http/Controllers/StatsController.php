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

        // 📊 Consultas por mes (si consultas usan created_at está bien)
        $consultasPorMes = Consultation::selectRaw('MONTH(created_at) as mes, COUNT(*) as total')
            ->whereYear('created_at', $year)
            ->groupBy('mes')
            ->orderBy('mes')
            ->pluck('total', 'mes');

        // 👤 Pacientes por mes (CORRECTO: registration_date)
        $pacientesPorMes = Patient::selectRaw('MONTH(registration_date) as mes, COUNT(*) as total')
            ->whereYear('registration_date', $year)
            ->groupBy('mes')
            ->orderBy('mes')
            ->pluck('total', 'mes');

        // 📅 Mes actual - consultas
        $consultasMesActual = Consultation::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', $year)
            ->count();

        // 📅 Mes actual - pacientes (CORRECTO)
        $pacientesMesActual = Patient::whereMonth('registration_date', Carbon::now()->month)
            ->whereYear('registration_date', $year)
            ->count();

        return view('stats.index', compact(
            'consultasPorMes',
            'pacientesPorMes',
            'consultasMesActual',
            'pacientesMesActual'
        ));
    }
}