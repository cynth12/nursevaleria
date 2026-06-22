<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ImportedPatient;
use App\Imports\ImportedPatientsImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\ImportFile;
use Illuminate\Support\Facades\Storage;

class ImportedPatientsController extends Controller
{
    // Mostrar la lista de pacientes importados
    public function index()
    {
        $patients = ImportedPatient::all();
         $files = \App\Models\ImportFile::latest()->get();
        return view('imported_patients.index', compact('patients', 'files'));
    }

    // Importar archivo Excel
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv'
        ]);

        $file = $request->file('file');
        Excel::import(new ImportedPatientsImport, $file);

        return redirect()->route('imported_patients.index')
            ->with('success', 'Pacientes importados correctamente.');
    }
    

    public function destroyAll()
{
    ImportedPatient::truncate(); // Borra todos los registros de la tabla
    return redirect()->route('imported_patients.index')
        ->with('success', 'Todos los pacientes importados fueron eliminados.');
}

}

