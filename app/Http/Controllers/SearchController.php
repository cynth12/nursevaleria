<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\GroupPatient;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = strtolower($request->input('q'));

        // Diccionario de meses
        $meses = [
            'enero' => 1, 'febrero' => 2, 'marzo' => 3, 'abril' => 4,
            'mayo' => 5, 'junio' => 6, 'julio' => 7, 'agosto' => 8,
            'septiembre' => 9, 'octubre' => 10, 'noviembre' => 11, 'diciembre' => 12,
        ];

        $patients = collect();
        $groupPatients = collect();

        // Si el texto es un mes
        if (array_key_exists($query, $meses)) {
            $mes = $meses[$query];

            $patients = Patient::whereMonth('created_at', $mes)->get();
            $groupPatients = GroupPatient::whereMonth('created_at', $mes)->get();
        } else {
            // Si es apellido o nombre
            $patients = Patient::where('name', 'like', "%{$query}%")->get();
            $groupPatients = GroupPatient::where('name', 'like', "%{$query}%")->get();
        }

        return view('buscar.resultados', compact('patients', 'groupPatients', 'query'));
    }
}
