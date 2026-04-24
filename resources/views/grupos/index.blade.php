@extends('adminlte::page')

@section('title', 'Patient list')

@section('content_header')
    <h1>Listado de Grupos</h1>
@endsection

@section('content')


    <div class="container">

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Place</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($groups as $group)
                    <tr>
                        <td>{{ $group->id }}</td>
                        <td>{{ $group->place }}</td>
                        <td>{{ $group->date }}</td>
                        <td>
                            <a href="{{ route('grupos.show', $group->id) }}" class="btn btn-info">See group</a>
                            <form action="{{ route('grupos.destroy', $group->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('¿Seguro que deseas borrar este grupo?')">
                                    Delate
                                </button>
                            </form>
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
