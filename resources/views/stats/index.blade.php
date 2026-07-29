@extends('adminlte::page')

@section('title', 'Statistics')

@section('content_header')

    <div class="d-flex justify-content-between align-items-center flex-wrap">

        <div>

            <h1 class="mb-0">
                Statistics Dashboard
            </h1>

            <small class="text-muted">
                Monthly clinic activity and patient growth
            </small>

        </div>

        <div class="statistics-period mt-2 mt-md-0">

            <i class="far fa-calendar-alt mr-1"></i>

            {{ now()->format('Y') }}

        </div>

    </div>

@endsection

@section('content')

    @php

        $totalConsultasAnio = collect($consultasPorMes)->sum();
        $totalPacientesAnio = collect($pacientesPorMes)->sum();

        $promedioConsultas = $totalConsultasAnio > 0
            ? round($totalConsultasAnio / 12, 1)
            : 0;

        $promedioPacientes = $totalPacientesAnio > 0
            ? round($totalPacientesAnio / 12, 1)
            : 0;

    @endphp

    {{-- KPI CARDS --}}
    <div class="row">

        {{-- CONSULTATIONS THIS MONTH --}}
        <div class="col-xl-3 col-md-6">

            <div class="info-box statistics-box">

                <span class="info-box-icon bg-info">

                    <i class="fas fa-stethoscope"></i>

                </span>

                <div class="info-box-content">

                    <span class="info-box-text">
                        Consultations This Month
                    </span>

                    <span class="info-box-number">
                        {{ $consultasMesActual }}
                    </span>

                    <small class="text-muted">
                        Registered during {{ now()->format('F') }}
                    </small>

                </div>

            </div>

        </div>

        {{-- NEW PATIENTS THIS MONTH --}}
        <div class="col-xl-3 col-md-6">

            <div class="info-box statistics-box">

                <span class="info-box-icon bg-success">

                    <i class="fas fa-user-plus"></i>

                </span>

                <div class="info-box-content">

                    <span class="info-box-text">
                        New Patients This Month
                    </span>

                    <span class="info-box-number">
                        {{ $pacientesMesActual }}
                    </span>

                    <small class="text-muted">
                        Registered during {{ now()->format('F') }}
                    </small>

                </div>

            </div>

        </div>

        {{-- TOTAL CONSULTATIONS --}}
        <div class="col-xl-3 col-md-6">

            <div class="info-box statistics-box">

                <span class="info-box-icon bg-primary">

                    <i class="fas fa-notes-medical"></i>

                </span>

                <div class="info-box-content">

                    <span class="info-box-text">
                        Consultations This Year
                    </span>

                    <span class="info-box-number">
                        {{ $totalConsultasAnio }}
                    </span>

                    <small class="text-muted">
                        Average: {{ $promedioConsultas }} per month
                    </small>

                </div>

            </div>

        </div>

        {{-- TOTAL PATIENTS --}}
        <div class="col-xl-3 col-md-6">

            <div class="info-box statistics-box">

                <span class="info-box-icon bg-warning">

                    <i class="fas fa-users"></i>

                </span>

                <div class="info-box-content">

                    <span class="info-box-text">
                        New Patients This Year
                    </span>

                    <span class="info-box-number">
                        {{ $totalPacientesAnio }}
                    </span>

                    <small class="text-muted">
                        Average: {{ $promedioPacientes }} per month
                    </small>

                </div>

            </div>

        </div>

    </div>

    {{-- MAIN CHART --}}
    <div class="row">

        <div class="col-lg-8">

            <div class="card chart-card">

                <div class="card-header border-0">

                    <div class="d-flex justify-content-between align-items-center flex-wrap">

                        <div>

                            <h3 class="card-title font-weight-bold">

                                <i class="fas fa-chart-bar text-info mr-2"></i>

                                Monthly Activity

                            </h3>

                            <div class="mt-1">

                                <small class="text-muted">
                                    Consultations and new patients by month
                                </small>

                            </div>

                        </div>

                        <div class="chart-legend-custom mt-2 mt-sm-0">

                            <span>

                                <i class="legend-dot consultations-dot"></i>

                                Consultations

                            </span>

                            <span>

                                <i class="legend-dot patients-dot"></i>

                                Patients

                            </span>

                        </div>

                    </div>

                </div>

                <div class="card-body">

                    <div class="chart-container">

                        <canvas id="monthlyChart"></canvas>

                    </div>

                </div>

            </div>

        </div>

        {{-- ACTIVITY SUMMARY --}}
        <div class="col-lg-4">

            <div class="card summary-card">

                <div class="card-header border-0">

                    <h3 class="card-title font-weight-bold">

                        <i class="fas fa-clipboard-list text-primary mr-2"></i>

                        Activity Summary

                    </h3>

                </div>

                <div class="card-body">

                    <div class="summary-main-icon">

                        <i class="fas fa-chart-line"></i>

                    </div>

                    <div class="summary-stat">

                        <div class="summary-stat-icon consultations-summary">

                            <i class="fas fa-stethoscope"></i>

                        </div>

                        <div>

                            <small>
                                Highest Consultation Month
                            </small>

                            <strong id="highest-consultations-month">
                                No data
                            </strong>

                            <span id="highest-consultations-total">
                                0 consultations
                            </span>

                        </div>

                    </div>

                    <div class="summary-stat">

                        <div class="summary-stat-icon patients-summary">

                            <i class="fas fa-user-plus"></i>

                        </div>

                        <div>

                            <small>
                                Highest Patient Month
                            </small>

                            <strong id="highest-patients-month">
                                No data
                            </strong>

                            <span id="highest-patients-total">
                                0 patients
                            </span>

                        </div>

                    </div>

                    <div class="summary-stat">

                        <div class="summary-stat-icon current-summary">

                            <i class="far fa-calendar-check"></i>

                        </div>

                        <div>

                            <small>
                                Current Month
                            </small>

                            <strong>
                                {{ now()->format('F') }}
                            </strong>

                            <span>
                                {{ $consultasMesActual }} consultations ·
                                {{ $pacientesMesActual }} patients
                            </span>

                        </div>

                    </div>

                    <div class="annual-summary">

                        <div>

                            <small>
                                Annual Records
                            </small>

                            <strong>
                                {{ $totalConsultasAnio + $totalPacientesAnio }}
                            </strong>

                        </div>

                        <i class="fas fa-database"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>

    {{-- TREND CHART --}}
    <div class="card trend-card">

        <div class="card-header border-0">

            <h3 class="card-title font-weight-bold">

                <i class="fas fa-chart-line text-success mr-2"></i>

                Annual Trend

            </h3>

            <div class="mt-1">

                <small class="text-muted">
                    Visual comparison of clinic activity throughout the year
                </small>

            </div>

        </div>

        <div class="card-body">

            <div class="trend-chart-container">

                <canvas id="trendChart"></canvas>

            </div>

        </div>

    </div>

@endsection

@section('css')

    <style>

        .statistics-period {
            padding: 8px 14px;
            color: #495057;
            font-size: 13px;
            font-weight: 600;
            background-color: #ffffff;
            border: 1px solid #dee2e6;
            border-radius: 7px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, .04);
        }

        .statistics-box {
            min-height: 115px;
            overflow: hidden;
            border: 0;
            border-radius: 10px;
            box-shadow: 0 5px 18px rgba(0, 0, 0, .07);
            transition:
                transform .2s ease,
                box-shadow .2s ease;
        }

        .statistics-box:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 22px rgba(0, 0, 0, .11);
        }

        .statistics-box .info-box-icon {
            width: 82px;
            font-size: 30px;
        }

        .statistics-box .info-box-content {
            padding: 17px 15px;
        }

        .statistics-box .info-box-text {
            color: #6c757d;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: .04em;
            text-transform: uppercase;
            white-space: normal;
        }

        .statistics-box .info-box-number {
            margin: 3px 0;
            color: #343a40;
            font-size: 27px;
            font-weight: 700;
        }

        .statistics-box small {
            font-size: 11px;
        }

        .chart-card,
        .summary-card,
        .trend-card {
            overflow: hidden;
            border: 0;
            border-radius: 10px;
            box-shadow: 0 5px 18px rgba(0, 0, 0, .07);
        }

        .chart-card {
            border-top: 3px solid #17a2b8;
        }

        .summary-card {
            border-top: 3px solid #007bff;
        }

        .trend-card {
            border-top: 3px solid #28a745;
        }

        .chart-container {
            position: relative;
            min-height: 390px;
        }

        .trend-chart-container {
            position: relative;
            min-height: 310px;
        }

        .chart-legend-custom {
            display: flex;
            align-items: center;
            gap: 17px;
            color: #6c757d;
            font-size: 11px;
            font-weight: 600;
        }

        .chart-legend-custom span {
            display: inline-flex;
            align-items: center;
        }

        .legend-dot {
            display: inline-block;
            width: 10px;
            height: 10px;
            margin-right: 6px;
            border-radius: 50%;
        }

        .consultations-dot {
            background-color: rgba(54, 162, 235, .85);
        }

        .patients-dot {
            background-color: rgba(75, 192, 192, .85);
        }

        .summary-main-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 75px;
            height: 75px;
            margin: 5px auto 21px;
            color: #ffffff;
            font-size: 28px;
            background: linear-gradient(
                135deg,
                #17a2b8,
                #007bff
            );
            border-radius: 50%;
            box-shadow: 0 7px 17px rgba(0, 123, 255, .22);
        }

        .summary-stat {
            display: flex;
            align-items: center;
            padding: 14px 0;
            border-bottom: 1px solid #edf0f2;
        }

        .summary-stat-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            flex: 0 0 45px;
            width: 45px;
            height: 45px;
            margin-right: 12px;
            font-size: 17px;
            border-radius: 10px;
        }

        .consultations-summary {
            color: #138496;
            background-color: #e8f7fa;
        }

        .patients-summary {
            color: #218838;
            background-color: #eaf7ed;
        }

        .current-summary {
            color: #d39e00;
            background-color: #fff8df;
        }

        .summary-stat > div:last-child {
            min-width: 0;
        }

        .summary-stat small,
        .summary-stat strong,
        .summary-stat span {
            display: block;
        }

        .summary-stat small {
            color: #868e96;
            font-size: 9px;
            font-weight: 700;
            letter-spacing: .05em;
            text-transform: uppercase;
        }

        .summary-stat strong {
            margin-top: 2px;
            color: #343a40;
            font-size: 14px;
        }

        .summary-stat span {
            margin-top: 2px;
            color: #6c757d;
            font-size: 11px;
        }

        .annual-summary {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 19px;
            padding: 16px;
            color: #ffffff;
            background: linear-gradient(
                135deg,
                #007bff,
                #17a2b8
            );
            border-radius: 9px;
        }

        .annual-summary small,
        .annual-summary strong {
            display: block;
        }

        .annual-summary small {
            font-size: 10px;
            font-weight: 600;
            letter-spacing: .05em;
            text-transform: uppercase;
            opacity: .85;
        }

        .annual-summary strong {
            margin-top: 2px;
            font-size: 25px;
        }

        .annual-summary > i {
            font-size: 31px;
            opacity: .35;
        }

        @media (max-width: 991.98px) {

            .chart-container {
                min-height: 340px;
            }

            .summary-card {
                margin-top: 15px;
            }

        }

        @media (max-width: 767.98px) {

            .statistics-box .info-box-icon {
                width: 70px;
            }

            .chart-container {
                min-height: 300px;
            }

            .trend-chart-container {
                min-height: 280px;
            }

            .chart-legend-custom {
                width: 100%;
                justify-content: flex-start;
            }

        }

    </style>

@endsection

@section('js')

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>

        document.addEventListener('DOMContentLoaded', function () {

            /*
             * Real data from Laravel
             */
            const consultas = @json($consultasPorMes);
            const pacientes = @json($pacientesPorMes);

            /*
             * Month labels
             */
            const meses = [
                'January',
                'February',
                'March',
                'April',
                'May',
                'June',
                'July',
                'August',
                'September',
                'October',
                'November',
                'December'
            ];

            /*
             * Convert {month: total} into an array
             * containing 12 positions.
             */
            function mapMeses(data) {

                const result = [];

                for (let month = 1; month <= 12; month++) {

                    result.push(
                        Number(data[month] ?? data[String(month)] ?? 0)
                    );

                }

                return result;

            }

            const consultasData = mapMeses(consultas);
            const pacientesData = mapMeses(pacientes);

            /*
             * Get the month with the highest value.
             */
            function getHighestMonth(data) {

                const highestValue = Math.max(...data);

                if (highestValue <= 0) {

                    return {
                        month: 'No data',
                        value: 0
                    };

                }

                const highestIndex = data.indexOf(highestValue);

                return {
                    month: meses[highestIndex],
                    value: highestValue
                };

            }

            const highestConsultations =
                getHighestMonth(consultasData);

            const highestPatients =
                getHighestMonth(pacientesData);

            document.getElementById(
                'highest-consultations-month'
            ).textContent = highestConsultations.month;

            document.getElementById(
                'highest-consultations-total'
            ).textContent =
                highestConsultations.value +
                (
                    highestConsultations.value === 1
                        ? ' consultation'
                        : ' consultations'
                );

            document.getElementById(
                'highest-patients-month'
            ).textContent = highestPatients.month;

            document.getElementById(
                'highest-patients-total'
            ).textContent =
                highestPatients.value +
                (
                    highestPatients.value === 1
                        ? ' patient'
                        : ' patients'
                );

            /*
             * Monthly bar chart
             */
            const monthlyChartCanvas =
                document.getElementById('monthlyChart');

            new Chart(monthlyChartCanvas, {

                type: 'bar',

                data: {

                    labels: meses,

                    datasets: [

                        {
                            label: 'Consultations',
                            data: consultasData,
                            backgroundColor:
                                'rgba(54, 162, 235, 0.75)',
                            borderColor:
                                'rgba(54, 162, 235, 1)',
                            borderWidth: 1,
                            borderRadius: 7,
                            borderSkipped: false,
                            maxBarThickness: 28
                        },

                        {
                            label: 'Patients',
                            data: pacientesData,
                            backgroundColor:
                                'rgba(75, 192, 192, 0.75)',
                            borderColor:
                                'rgba(75, 192, 192, 1)',
                            borderWidth: 1,
                            borderRadius: 7,
                            borderSkipped: false,
                            maxBarThickness: 28
                        }

                    ]

                },

                options: {

                    responsive: true,

                    maintainAspectRatio: false,

                    interaction: {
                        mode: 'index',
                        intersect: false
                    },

                    animation: {
                        duration: 900,
                        easing: 'easeOutQuart'
                    },

                    plugins: {

                        legend: {
                            display: false
                        },

                        tooltip: {

                            backgroundColor:
                                'rgba(33, 37, 41, 0.95)',

                            titleFont: {
                                size: 13,
                                weight: 'bold'
                            },

                            bodyFont: {
                                size: 12
                            },

                            padding: 12,

                            cornerRadius: 7,

                            displayColors: true,

                            callbacks: {

                                label: function (context) {

                                    const value =
                                        context.parsed.y;

                                    return (
                                        ' ' +
                                        context.dataset.label +
                                        ': ' +
                                        value
                                    );

                                }

                            }

                        }

                    },

                    scales: {

                        x: {

                            grid: {
                                display: false
                            },

                            border: {
                                display: false
                            },

                            ticks: {
                                color: '#6c757d',
                                font: {
                                    size: 10
                                }
                            }

                        },

                        y: {

                            beginAtZero: true,

                            ticks: {

                                precision: 0,

                                color: '#6c757d',

                                font: {
                                    size: 10
                                }

                            },

                            grid: {
                                color: 'rgba(0, 0, 0, 0.05)'
                            },

                            border: {
                                display: false
                            }

                        }

                    }

                }

            });

            /*
             * Annual trend line chart
             */
            const trendChartCanvas =
                document.getElementById('trendChart');

            new Chart(trendChartCanvas, {

                type: 'line',

                data: {

                    labels: meses,

                    datasets: [

                        {
                            label: 'Consultations',
                            data: consultasData,
                            borderColor:
                                'rgba(54, 162, 235, 1)',
                            backgroundColor:
                                'rgba(54, 162, 235, 0.10)',
                            borderWidth: 3,
                            pointRadius: 4,
                            pointHoverRadius: 6,
                            pointBackgroundColor:
                                'rgba(54, 162, 235, 1)',
                            tension: 0.35,
                            fill: true
                        },

                        {
                            label: 'Patients',
                            data: pacientesData,
                            borderColor:
                                'rgba(75, 192, 192, 1)',
                            backgroundColor:
                                'rgba(75, 192, 192, 0.08)',
                            borderWidth: 3,
                            pointRadius: 4,
                            pointHoverRadius: 6,
                            pointBackgroundColor:
                                'rgba(75, 192, 192, 1)',
                            tension: 0.35,
                            fill: true
                        }

                    ]

                },

                options: {

                    responsive: true,

                    maintainAspectRatio: false,

                    interaction: {
                        mode: 'index',
                        intersect: false
                    },

                    animation: {
                        duration: 1000,
                        easing: 'easeOutQuart'
                    },

                    plugins: {

                        legend: {

                            position: 'top',

                            align: 'end',

                            labels: {

                                usePointStyle: true,

                                pointStyle: 'circle',

                                boxWidth: 8,

                                boxHeight: 8,

                                padding: 18,

                                color: '#6c757d',

                                font: {
                                    size: 11,
                                    weight: '600'
                                }

                            }

                        },

                        tooltip: {

                            backgroundColor:
                                'rgba(33, 37, 41, 0.95)',

                            padding: 12,

                            cornerRadius: 7

                        }

                    },

                    scales: {

                        x: {

                            grid: {
                                display: false
                            },

                            border: {
                                display: false
                            },

                            ticks: {
                                color: '#6c757d',
                                font: {
                                    size: 10
                                }
                            }

                        },

                        y: {

                            beginAtZero: true,

                            ticks: {
                                precision: 0,
                                color: '#6c757d',
                                font: {
                                    size: 10
                                }
                            },

                            grid: {
                                color: 'rgba(0, 0, 0, 0.05)'
                            },

                            border: {
                                display: false
                            }

                        }

                    }

                }

            });

        });

    </script>

@endsection