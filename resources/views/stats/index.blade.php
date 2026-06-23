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

{{-- GRÁFICA --}}
<div class="card mt-4">
    <div class="card-body">
        <canvas id="chart"></canvas>
    </div>
</div>

@endsection


@section('js')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
/**
 * 📊 Datos reales desde Laravel
 */
const consultas = @json($consultasPorMes);
const pacientes = @json($pacientesPorMes);

/**
 * 📅 Meses en español
 */
const meses = [
    "January","February","March","April","May","June",
    "July","August","September","October","November","December"
];

/**
 * 🔁 Convierte datos {mes: total} → array de 12 posiciones
 */
function mapMeses(data) {
    let result = [];

    for (let i = 1; i <= 12; i++) {
        result.push(data[i] ?? 0);
    }

    return result;
}

const ctx = document.getElementById('chart');

new Chart(ctx, {
    type: 'bar',
    data: {
        labels: meses,
        datasets: [
            {
                label: 'Consultations',
                data: mapMeses(consultas),
                backgroundColor: 'rgba(54, 162, 235, 0.6)'
            },
            {
                label: 'Patients',
                data: mapMeses(pacientes),
                backgroundColor: 'rgba(75, 192, 192, 0.6)'
            }
        ]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: 'top'
            }
        }
    }
});
</script>

@endsection