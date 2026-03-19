@extends('adminlte::page')

@section('title', 'Listado de Pacientes')

@section('content_header')
    <h1>Listado de Pacientes</h1>
@endsection

@section('content')
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Date of Birth</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($patients as $patient)
                <tr>
                    <td>{{ $patient->id }}</td>
                    <td>{{ $patient->name }}</td>
                    <td>{{ $patient->date_of_birth }}</td>
                    <td>{{ $patient->phone }}</td>
                    <td>{{ $patient->email }}</td>
                    <td>
                        <a href="{{ route('patient.show', $patient->id) }}" class="btn btn-primary btn-sm">Ver</a>
                        <a href="{{ route('consentimiento.create', $patient->id) }}" class="btn btn-warning btn-sm">
                            Firmar Consentimiento
                        </a>

                        @if ($patient->consentimientos && $patient->consentimientos->count() > 0)
                            <a href="{{ route('consentimiento.show', $patient->consentimientos->first()->id) }}"
                                class="btn btn-info btn-sm">
                                Ver Consentimiento
                            </a>
                        @endif
                        <form action="{{ route('patient.destroy', $patient->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Borrar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
