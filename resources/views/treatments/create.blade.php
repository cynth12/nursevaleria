@extends('adminlte::page')

@section('title','Nuevo Tratamiento')

@section('content')

<div class="card">

<div class="card-header">
New Tratment
</div>

<div class="card-body">

<form action="{{ route('treatments.store') }}" method="POST">

@csrf

<div class="form-group mb-3">

<label>Name</label>

<input
type="text"
name="name"
class="form-control"
required>

</div>

<div class="form-group mb-3">

<label>Description</label>

<input
type="text"
name="description"
class="form-control">

</div>

<div class="form-group">

<label>Fórmula</label>

<textarea
name="formula"
rows="15"
class="form-control"
required></textarea>

</div>

<br>

<button class="btn btn-success">

Save

</button>

</form>

</div>

</div>

@stop