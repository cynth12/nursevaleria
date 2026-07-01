@extends('adminlte::page')

@section('title','Tratamiento')

@section('content')

<div class="card">

<div class="card-header">

{{ $treatment->name }}

</div>

<div class="card-body">

<p>

<b>Description</b>

<br>

{{ $treatment->description }}

</p>

<hr>

<pre>{{ $treatment->formula }}</pre>

</div>

</div>

@stop