@extends('adminlte::page')

@section('title','Calendar')

@section('content_header')
<h1>Calendar</h1>
@stop

@section('content')

<div class="card">

    <div class="card-header">

        <form method="GET">

            <div class="row">

                <div class="col-md-3">

                    <label>Year</label>

                    <select
                        name="year"
                        class="form-control"
                        onchange="this.form.submit()">

                       @for($y = 2026; $y <= date('Y')+10; $y++)

                            <option
                                value="{{ $y }}"
                                {{ $year==$y?'selected':'' }}>

                                {{ $y }}

                            </option>

                        @endfor

                    </select>

                </div>

            </div>

        </form>

    </div>

</div>


<div class="row">

@foreach($months as $month)

<div class="col-md-3">

<div class="small-box bg-info">

<div class="inner">

<h4>{{ $month['name'] }}</h4>

<p>{{ $month['patients'] }} Patients</p>

</div>

<div class="icon">

<i class="fas fa-calendar"></i>

</div>

<a
href="{{ route('calendario',[$year,$month['number']]) }}"
class="small-box-footer">

Open
<i class="fas fa-arrow-circle-right"></i>

</a>

</div>

</div>

@endforeach

</div>

@stop