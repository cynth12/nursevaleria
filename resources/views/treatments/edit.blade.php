@extends('adminlte::page')

@section('title','Editar Tratamiento')

@section('content')

<div class="card">

<div class="card-header">

Editar Treatments

</div>

<div class="card-body">

<form
action="{{ route('treatments.update',$treatment) }}"
method="POST">

@csrf
@method('PUT')

<div class="form-group mb-3">

<label>Name</label>

<input
type="text"
name="name"
value="{{ $treatment->name }}"
class="form-control">

</div>

<div class="form-group mb-3">

<label>Description</label>

<input
type="text"
name="description"
value="{{ $treatment->description }}"
class="form-control">

</div>

<div class="form-group">

<label>Fórmula</label>

<textarea
name="formula"
rows="15"
class="form-control">{{ $treatment->formula }}</textarea>

</div>

<br>

<button class="btn btn-primary">

Save

</button>

</form>

</div>

</div>

@stop