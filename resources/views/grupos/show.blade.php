@extends('adminlte::page')

@section('title', 'Patient details')

@section('content_header')
    
@endsection

@section('content')
<div class="container">
    <h2>Group: {{ $group->place }}</h2>
    <p><strong>Creation date:</strong> {{ $group->date }}</p>

    <hr>

    <!-- Formulario para agregar pacientes -->
    <h4>Add patient to group</h4>
    <form action="{{ route('groupPatients.store') }}" method="POST">
        @csrf
        <input type="hidden" name="group_id" value="{{ $group->id }}">

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        

        <div class="form-group">
            <label for="date_of_birth">Date of birth</label>
            <input type="date" name="date_of_birth" class="form-control">
        </div>

        <div class="form-group">
            <label for="phone">Phone</label>
            <input type="text" name="phone" class="form-control">
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control">
        </div>

        <!-- Aquí puedes seguir replicando todos los demás campos igual que en create patient -->

        <button type="submit" class="btn btn-success mt-2">Save patient</button>

    </form>

    <hr>

    <!-- Listado de pacientes del grupo -->
    <h4>Pacientes del grupo</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Fecha de nacimiento</th>
                <th>Teléfono</th>
                <th>Email</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($patients as $patient)
            <tr>
                <td>{{ $patient->id }}</td>
                <td>{{ $patient->name }}</td>
                <td>{{ $patient->date_of_birth }}</td>
                <td>{{ $patient->phone }}</td>
                <td>{{ $patient->email }}</td>
                <td>
                    <!-- Botón para ver detalle completo del paciente -->
                    <a href="{{ route('groupPatients.show', $patient->id) }}" class="btn btn-info">Ver</a>
                    <a href="{{ route('groupPatients.edit', $patient->id) }}" class="btn btn-success">Editar</a>
                    <form action="{{ route('groupPatients.destroy', $patient->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Borrar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection