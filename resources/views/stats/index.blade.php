@extends('adminlte::page')

@section('title', 'Statistics')

@section('content_header')
    <h1>Monthly Statistics</h1>
@endsection

@section('content')

<div class="row">

    <div class="col-md-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ $consultasMesActual }}</h3>
                <p>Consultations this month</p>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ $pacientesMesActual }}</h3>
                <p>New patients this month</p>
            </div>
        </div>
    </div>

</div>

<canvas id="chart"></canvas>

@endsection

@section('js')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
const ctx = document.getElementById('chart');

const chart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: {!! json_encode(range(1,12)) !!},
        datasets: [
            {
                label: 'Consultations',
                data: {!! json_encode(array_fill(0,12,0)) !!},
                backgroundColor: 'blue'
            }
        ]
    }
});
</script>

@endsection