@extends('adminlte::page')

@section('title', 'Listado de Pacientes')

@section('content_header')
    <h1>Listado de Grupos</h1>
@endsection

@section('content')


    <div class="container">

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
                @foreach ($groups as $group)
                    <tr>
                        <td>{{ $group->id }}</td>
                        <td>{{ $group->place }}</td>
                        <td>{{ $group->date }}</td>
                        <td>
                            <a href="{{ route('grupos.show', $group->id) }}" class="btn btn-info">Ver grupo</a>
                            <form action="{{ route('grupos.destroy', $group->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('¿Seguro que deseas borrar este grupo?')">
                                    Borrar
                                </button>
                            </form>
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
