@extends('adminlte::page')

@section('title', 'Create Group')

@section('content_header')
    <h1>Create group</h1>
@endsection

@section('content')
<div class="container">
    

    <form action="{{ route('grupos.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="place">Place</label>
            <input type="text" name="place" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success mt-2">Save group</button>
    </form>
</div>
@endsection