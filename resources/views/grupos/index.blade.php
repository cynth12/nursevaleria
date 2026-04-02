@extends('adminlte::page')

@section('title', 'Listado de Pacientes')

@section('content_header')
    <h1>Listado de Grupos</h1>
@endsection

@section('content')
<div class="container">
    <h2>Listado de Grupos</h2>
    <a href="{{ route('groups.create') }}" class="btn btn-primary mb-3">Crear grupo</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Lugar</th>
                <th>Fecha</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($groups as $group)
            <tr>
                <td>{{ $group->id }}</td>
                <td>{{ $group->place }}</td>
                <td>{{ $group->date }}</td>
                <td>
                    <a href="{{ route('groups.show', $group->id) }}" class="btn btn-info">Ver grupo</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection