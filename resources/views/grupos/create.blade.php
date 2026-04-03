@extends('adminlte::page')

@section('title', 'Crear Grupo')

@section('content_header')
    <h1>Crear grupo</h1>
@endsection

@section('content')
<div class="container">
    

    <form action="{{ route('grupos.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="place">Lugar del grupo</label>
            <input type="text" name="place" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success mt-2">Guardar grupo</button>
    </form>
</div>
@endsection