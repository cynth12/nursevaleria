<?php

namespace App\Http\Controllers;

use App\Models\ImportFile;
use App\Models\Patient;
use App\Imports\ImportedPatientsImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImportedPatientsController extends Controller
{
    // LISTA DE ARCHIVOS
    

    public function index()
    {
        $files = ImportFile::latest()->get();

        return view('imported_patients.index', compact('files'));
    }

    // IMPORTAR ARCHIVO (SOLO GUARDAR + IMPORTAR)
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);

        $file = $request->file('file');

        // guardar archivo
        $path = $file->store('imports');

        ImportFile::create([
            'file_name' => basename($path),
            'original_name' => $file->getClientOriginalName(),
            'path' => $path,
        ]);

        // importar pacientes (contenido del archivo)
        Excel::import(new ImportedPatientsImport(), $file);

        return redirect()->route('imported_patients.index')->with('success', 'File imported successfully.');
    }

    // DESCARGAR ARCHIVO
    public function download($id)
    {
        $file = ImportFile::findOrFail($id);

        return Storage::download($file->path, $file->original_name);
    }

    // ELIMINAR ARCHIVO
    public function destroyFile($id)
    {
        $file = ImportFile::findOrFail($id);

        if (Storage::exists($file->path)) {
            Storage::delete($file->path);
        }

        $file->delete();

        return redirect()->route('imported_patients.index')->with('success', 'File deleted successfully.');
    }
}
