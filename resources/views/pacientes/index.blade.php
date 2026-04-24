@extends('adminlte::page')

@section('title', 'Listado de Pacientes')

@section('content_header')
    <h1>patient list</h1>
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
                <th>Date</th>
                <th>Actions</th>
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
                    <td>{{ $patient->registration_date }}</td> 
                    <td>
                        <a href="{{ route('patient.show', $patient->id) }}" class="btn btn-primary btn-sm">see</a>
                        <a href="{{ route('consentimiento.create', $patient->id) }}" class="btn btn-warning btn-sm">
                            singature
                        </a>

                        @if ($patient->consentimientos && $patient->consentimientos->count() > 0)
                            <a href="{{ route('consentimiento.show', $patient->consentimientos->first()->id) }}"
                                class="btn btn-info btn-sm">
                                see
                            </a>
                        @endif
                        <!-- Editar -->
                        <a href="{{ route('patient.edit', $patient->id) }}" class="btn btn-success btn-sm">Edit</a>
                        <form action="{{ route('patient.destroy', $patient->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
