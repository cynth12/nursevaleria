
@extends('adminlte::page')

@section('title', 'Listado de Consentimientos')

@section('content_header')
    <h1>List of Consents</h1>
@endsection

@section('content')
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Patient</th>
                <th>Procedure</th>
                <th>Date</th>
                <th>Actions</th>
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
                            <button type="submit" class="btn btn-danger btn-sm">Delate</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">There are no registered consents.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
