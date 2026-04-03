@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Resultados de búsqueda: "{{ $query }}"</h2>

    <h3>Pacientes individuales</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Fecha de nacimiento</th>
                <th>Teléfono</th>
                <th>Email</th>
                <th>Fecha de registro</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($patients as $patient)
                <tr>
                    <td>{{ $patient->id }}</td>
                    <td>{{ $patient->name }}</td>
                    <td>{{ $patient->date_of_birth }}</td>
                    <td>{{ $patient->phone }}</td>
                    <td>{{ $patient->email }}</td>
                    <td>{{ $patient->created_at }}</td>
                    <td>
                        <a href="{{ route('pacientes.show', $patient->id) }}" class="btn btn-info">Ver</a>
                        <a href="{{ route('pacientes.edit', $patient->id) }}" class="btn btn-success">Editar</a>
                        <form action="{{ route('pacientes.destroy', $patient->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Borrar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="7">No se encontraron pacientes individuales.</td></tr>
            @endforelse
        </tbody>
    </table>

    <h3>Pacientes de grupo</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Teléfono</th>
                <th>Email</th>
                <th>Fecha de registro</th>
            </tr>
        </thead>
        <tbody>
            @forelse($groupPatients as $gp)
                <tr>
                    <td>{{ $gp->id }}</td>
                    <td>{{ $gp->name }}</td>
                    <td>{{ $gp->phone }}</td>
                    <td>{{ $gp->email }}</td>
                    <td>{{ $gp->created_at }}</td>
                </tr>
            @empty
                <tr><td colspan="5">No se encontraron pacientes de grupo.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

