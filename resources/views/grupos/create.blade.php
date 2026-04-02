@extends('adminlte::page')

@section('title', 'Pacientes')

@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Crear Grupo</h2>

    <form action="{{ route('groups.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="place">Lugar del grupo</label>
            <input type="text" name="place" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success mt-2">Guardar grupo</button>
    </form>
</div>
@endsection