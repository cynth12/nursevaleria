@extends('adminlte::page')

@section('title','Tratamientos')

@section('content')

<a
href="{{ route('treatments.create') }}"
class="btn btn-success mb-3">

New Tratment

</a>

<div class="card">

<div class="card-body">

<table class="table table-bordered">

<thead>

<tr>

<th>Name</th>

<th>Description</th>

<th width="250">Actions</th>

</tr>

</thead>

<tbody>

@foreach($treatments as $treatment)

<tr>

<td>

{{ $treatment->name }}

</td>

<td>

{{ $treatment->description }}

</td>

<td>

<a
href="{{ route('treatments.show',$treatment) }}"
class="btn btn-info btn-sm">

View

</a>

<a
href="{{ route('treatments.edit',$treatment) }}"
class="btn btn-warning btn-sm">

Edit

</a>

<form
action="{{ route('treatments.destroy',$treatment) }}"
method="POST"
style="display:inline;">

@csrf

@method('DELETE')

<button
class="btn btn-danger btn-sm"
onclick="return confirm('¿Eliminar tratamiento?')">

Delate

</button>

</form>

</td>

</tr>

@endforeach

</tbody>

</table>

</div>

</div>

@stop