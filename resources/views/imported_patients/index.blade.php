@extends('adminlte::page')

@section('title', 'Import Patients')

@section('content_header')
    <h1>List of Imported Patients</h1>
@stop

@section('content')
    {{-- Mensaje de éxito --}}
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Formulario para subir archivo Excel --}}
    <div class="card mb-4">
        <div class="card-header">Import Excel file</div>
        <div class="card-body">
            <form action="{{ route('imported_patients.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <input type="file" name="file" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary mt-2">Import</button>
            </form>
            <form action="{{ route('imported_patients.destroyAll') }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger mt-2"
                    onclick="return confirm('¿Seguro que quieres borrar todos los pacientes importados?')">
                    Delate all
                </button>
            </form>

        </div>
    </div>

    {{-- Tabla de pacientes importados --}}
    <div class="card">
        <div class="card-header">List</div>
        <div class="card-body">
            
        </div>
    </div>
@stop
