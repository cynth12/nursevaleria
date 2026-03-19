
@extends('adminlte::page')

@section('title', 'Pacientes')

@section('content')




<h1>Consentimiento Informado</h1>
<p>Listado de pacientes y su estado de consentimiento.</p>

<table class="table table-striped">
    <thead>
        <tr>
            <th>Paciente</th>
            <th>Consentimiento</th>
            <th>Procedimiento</th>
            <th>Fecha</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($consentimientos as $consentimiento)
        <tr>
            <td>{{ $patient->name }}</td>
            <td>{{ $patient->consent_accepted ? '✅ Sí' : '❌ No' }}</td>
            <td>{{ $patient->authorized_procedure ?? '—' }}</td>
            <td>{{ $patient->consent_date ?? '—' }}</td>
            <td>
                <a href="{{ route('patient.show', $patient->id) }}" class="btn btn-info btn-sm">Ver ficha</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection