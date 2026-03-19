
@extends('adminlte::page')

@section('title', 'Pacientes')

@section('content')
<h1>Listado de Consentimientos</h1>

<table class="table">
    <thead>
        <tr>
            <th>Paciente</th>
            <th>Procedimiento</th>
            <th>Fecha</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @forelse($consentimientos as $consentimiento)
        <tr>
            <td>{{ $consentimiento->patient->name }}</td>
            <td>{{ $consentimiento->authorized_procedure ?? '-' }}</td>
            <td>{{ $consentimiento->consent_date ?? '-' }}</td>
            <td>{{ $consentimiento->consent_accepted ? '✅ Sí' : '❌ No' }}</td>
            <td>
                <a href="{{ route('consentimiento.show', $consentimiento->id) }}" class="btn btn-info btn-sm">Ver</a>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="5">No hay consentimientos registrados.</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection
