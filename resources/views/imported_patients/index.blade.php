@extends('adminlte::page')

@section('title', 'Pacientes Importados')

@section('content_header')
    <h1>Listado de Pacientes Importados</h1>
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
        <div class="card-header">Importar archivo Excel</div>
        <div class="card-body">
            <form action="{{ route('imported_patients.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <input type="file" name="file" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary mt-2">Importar</button>
            </form>
            <form action="{{ route('imported_patients.destroyAll') }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger mt-2"
                    onclick="return confirm('¿Seguro que quieres borrar todos los pacientes importados?')">
                    Borrar todo
                </button>
            </form>

        </div>
    </div>

    {{-- Tabla de pacientes importados --}}
    <div class="card">
        <div class="card-header">Listado</div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Teléfono</th>
                        <th>Email</th>
                        <th>Fecha</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($patients as $patient)
                        <tr>
                            <td>{{ $patient->id }}</td>
                            <td>{{ $patient->name }}</td>
                            <td>{{ $patient->phone ?? '—' }}</td>
                            <td>{{ $patient->email ?? '—' }}</td>
                            <td>{{ $patient->date ?? '—' }}</td>
                            <td>
                                <a href="#" class="btn btn-info btn-sm">Ver</a>
                                <a href="#" class="btn btn-warning btn-sm">Editar</a>
                                <a href="#" class="btn btn-danger btn-sm">Borrar</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7">No hay pacientes importados aún.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@stop
