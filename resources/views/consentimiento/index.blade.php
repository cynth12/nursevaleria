
@extends('adminlte::page')

@section('title', 'Listado de Consentimientos')

@section('content_header')
    <h1>Listado de Consentimientos</h1>
@endsection

@section('content')
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Paciente</th>
                <th>Procedimiento</th>
                <th>Fecha</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($consentimientos as $consentimiento)
                <tr>
                    <td>{{ $consentimiento->patient->name }}</td>
                    <td>{{ $consentimiento->authorized_procedure }}</td>
                    <td>{{ $consentimiento->consent_date }}</td>
                    <td>
                        <!-- Botón Ver -->
                        <a href="{{ route('consentimiento.show', $consentimiento->id) }}" class="btn btn-info btn-sm">
                            Ver
                        </a>

                        <!-- Botón Eliminar -->
                        <form action="{{ route('consentimiento.destroy', $consentimiento->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">No hay consentimientos registrados.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
