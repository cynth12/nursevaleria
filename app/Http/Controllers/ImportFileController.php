<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ImportFile;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\PatientsImport;


class ImportFileController extends Controller
{
    // LISTADO
    public function index()
    {
        $files = ImportFile::latest()->get();
        return view('imports.index', compact('files'));
    }

    // SUBIR ARCHIVO
    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls,csv'
        ]);

        $uploaded = $request->file('file');

        $path = $uploaded->store('imports');

        $file = ImportFile::create([
            'file_name' => basename($path),
            'original_name' => $uploaded->getClientOriginalName(),
            'path' => $path
        ]);

        // IMPORTAR PACIENTES (opcional automático)
        Excel::import(new PatientsImport, storage_path('app/' . $path));

        return redirect()->back()->with('success', 'Archivo importado correctamente');
    }

    // DESCARGAR ARCHIVO
    public function download($id)
    {
        $file = ImportFile::findOrFail($id);

        return Storage::download($file->path, $file->original_name);
    }

    // BORRAR ARCHIVO
    public function destroy($id)
    {
        $file = ImportFile::findOrFail($id);

        Storage::delete($file->path);
        $file->delete();

        return redirect()->back()->with('success', 'Archivo eliminado');
    }
}