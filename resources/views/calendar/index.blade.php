@extends('adminlte::page')

@section('title', 'Calendar')

@section('content_header')

    <div class="d-flex justify-content-between align-items-center flex-wrap">

        <div>

            <h1 class="mb-0">
                Patient Calendar
            </h1>

            <small class="text-muted">
                Review patient registrations organized by month
            </small>

        </div>

        <div class="calendar-year-badge mt-2 mt-md-0">

            <i class="far fa-calendar-alt mr-1"></i>

            {{ $year }}

        </div>

    </div>

@stop

@section('content')

    @php

        $totalPatientsYear = collect($months)->sum('patients');

        $monthsWithPatients = collect($months)
            ->filter(function ($month) {
                return $month['patients'] > 0;
            })
            ->count();

        $highestMonth = collect($months)
            ->sortByDesc('patients')
            ->first();

    @endphp

    {{-- SUMMARY CARDS --}}
    <div class="row">

        <div class="col-xl-4 col-md-6">

            <div class="info-box calendar-stat-box">

                <span class="info-box-icon bg-info">

                    <i class="fas fa-users"></i>

                </span>

                <div class="info-box-content">

                    <span class="info-box-text">
                        Patients in {{ $year }}
                    </span>

                    <span class="info-box-number">
                        {{ $totalPatientsYear }}
                    </span>

                    <small class="text-muted">
                        Total registrations during the selected year
                    </small>

                </div>

            </div>

        </div>

        <div class="col-xl-4 col-md-6">

            <div class="info-box calendar-stat-box">

                <span class="info-box-icon bg-success">

                    <i class="fas fa-calendar-check"></i>

                </span>

                <div class="info-box-content">

                    <span class="info-box-text">
                        Active Months
                    </span>

                    <span class="info-box-number">
                        {{ $monthsWithPatients }}
                    </span>

                    <small class="text-muted">
                        Months containing patient registrations
                    </small>

                </div>

            </div>

        </div>

        <div class="col-xl-4 col-md-12">

            <div class="info-box calendar-stat-box">

                <span class="info-box-icon bg-primary">

                    <i class="fas fa-chart-line"></i>

                </span>

                <div class="info-box-content">

                    <span class="info-box-text">
                        Highest Activity
                    </span>

                    <span class="info-box-number highest-month-number">

                        @if ($highestMonth && $highestMonth['patients'] > 0)

                            {{ $highestMonth['name'] }}

                        @else

                            No activity

                        @endif

                    </span>

                    <small class="text-muted">

                        @if ($highestMonth && $highestMonth['patients'] > 0)

                            {{ $highestMonth['patients'] }}
                            {{ $highestMonth['patients'] === 1 ? 'patient' : 'patients' }}

                        @else

                            No patient registrations yet

                        @endif

                    </small>

                </div>

            </div>

        </div>

    </div>

    {{-- YEAR FILTER --}}
    <div class="card year-filter-card">

        <div class="card-header border-0">

            <div class="d-flex justify-content-between align-items-center flex-wrap">

                <div>

                    <h3 class="card-title font-weight-bold">

                        <i class="fas fa-filter text-info mr-2"></i>

                        Calendar Year

                    </h3><br>

                    <div class="mt-1">

                        <small class="text-muted">
                            Select the year you want to review
                        </small>

                    </div>

                </div>

                <span class="badge badge-light selected-year-badge mt-2 mt-sm-0">

                    Selected year:
                    <strong>{{ $year }}</strong>

                </span>

            </div>

        </div>

        <div class="card-body">

           <form method="GET"
      id="calendar-year-form">

    <div class="row align-items-end">

        <div class="col-md-4 col-lg-3">

            <div class="form-group mb-md-0">

                <label for="year">
                    Year
                </label>

                <div class="input-group">

                    <div class="input-group-prepend">

                        <span class="input-group-text">
                            <i class="far fa-calendar-alt"></i>
                        </span>

                    </div>

                    <select name="year"
                            id="year"
                            class="form-control"
                            onchange="this.form.submit()">

                        @for ($y = 2026; $y <= date('Y') + 10; $y++)

                            <option value="{{ $y }}"
                                {{ (int) $year === $y ? 'selected' : '' }}>

                                {{ $y }}

                            </option>

                        @endfor

                    </select>

                </div>

            </div>

        </div>

        <div class="col-md-8 col-lg-9">

            <div class="year-filter-help">

                <i class="fas fa-info-circle"></i>

                <span>
                    The calendar updates automatically when you select another year.
                </span>

            </div>

        </div>

    </div>

</form>
        </div>

    </div>

    {{-- MONTHS --}}
    <div class="card months-card">

        <div class="card-header border-0">

            <div class="d-flex justify-content-between align-items-center flex-wrap">

                <div>

                    <h3 class="card-title font-weight-bold">

                        <i class="fas fa-calendar-alt text-primary mr-2"></i>

                        Monthly Calendar

                    </h3><br>

                    <div class="mt-1">

                        <small class="text-muted">
                            Open a month to review its registered patients
                        </small>

                    </div>

                </div>

                <span class="badge badge-light months-count-badge mt-2 mt-sm-0">

                    <i class="fas fa-th mr-1"></i>
                    {{ count($months) }} months

                </span>

            </div>

        </div>

        <div class="card-body">

            <div class="row">

                @foreach ($months as $month)

                    <div class="col-xl-3 col-lg-4 col-md-6">

                        <div class="month-card
                            {{ $month['patients'] > 0 ? 'month-active' : 'month-empty' }}">

                            <div class="month-card-header">

                                <div class="month-icon">

                                    <i class="far fa-calendar"></i>

                                </div>

                                <span class="month-number">
                                    {{ str_pad($month['number'], 2, '0', STR_PAD_LEFT) }}
                                </span>

                            </div>

                            <div class="month-card-body">

                                <small>
                                    {{ $year }}
                                </small>

                                <h4>
                                    {{ $month['name'] }}
                                </h4>

                                <div class="patient-count">

                                    <strong>
                                        {{ $month['patients'] }}
                                    </strong>

                                    <span>
                                        {{ $month['patients'] === 1 ? 'Patient' : 'Patients' }}
                                    </span>

                                </div>

                                @if ($month['patients'] > 0)

                                    <div class="month-status month-status-active">

                                        <i class="fas fa-circle"></i>

                                        Activity registered

                                    </div>

                                @else

                                    <div class="month-status month-status-empty">

                                        <i class="far fa-circle"></i>

                                        No registrations

                                    </div>

                                @endif

                            </div>

                            <a href="{{ route('calendario', [$year, $month['number']]) }}"
                               class="month-card-footer">

                                <span>
                                    Open Month
                                </span>

                                <i class="fas fa-arrow-right"></i>

                            </a>

                        </div>

                    </div>

                @endforeach

            </div>

        </div>

    </div>

@stop

@section('css')

    <style>

        .calendar-year-badge {
            padding: 8px 14px;
            color: #495057;
            font-size: 13px;
            font-weight: 700;
            background-color: #ffffff;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, .05);
        }

        .calendar-stat-box {
            min-height: 115px;
            overflow: hidden;
            border: 0;
            border-radius: 10px;
            box-shadow: 0 5px 18px rgba(0, 0, 0, .07);
            transition:
                transform .2s ease,
                box-shadow .2s ease;
        }

        .calendar-stat-box:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 22px rgba(0, 0, 0, .11);
        }

        .calendar-stat-box .info-box-icon {
            width: 82px;
            font-size: 29px;
        }

        .calendar-stat-box .info-box-content {
            padding: 17px 15px;
        }

        .calendar-stat-box .info-box-text {
            color: #6c757d;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: .04em;
            text-transform: uppercase;
            white-space: normal;
        }

        .calendar-stat-box .info-box-number {
            margin: 3px 0;
            color: #343a40;
            font-size: 27px;
            font-weight: 700;
        }

        .calendar-stat-box .highest-month-number {
            overflow: hidden;
            font-size: 21px;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .calendar-stat-box small {
            font-size: 11px;
        }

        .year-filter-card,
        .months-card {
            overflow: hidden;
            border: 0;
            border-radius: 10px;
            box-shadow: 0 5px 18px rgba(0, 0, 0, .07);
        }

        .year-filter-card {
            border-top: 3px solid #17a2b8;
        }

        .months-card {
            border-top: 3px solid #007bff;
        }

        .selected-year-badge,
        .months-count-badge {
            padding: 8px 12px;
            color: #495057;
            font-size: 11px;
            border: 1px solid #dee2e6;
        }

        .form-group label {
            color: #343a40;
            font-size: 12px;
            font-weight: 700;
        }

        .input-group-text {
            min-width: 45px;
            justify-content: center;
            color: #17a2b8;
            background-color: #f4f6f9;
        }

        .form-control:focus {
            border-color: #17a2b8;
            box-shadow: 0 0 0 .2rem rgba(23, 162, 184, .12);
        }

        .year-filter-help {
            display: flex;
            align-items: center;
            min-height: 38px;
            padding: 9px 12px;
            color: #6c757d;
            font-size: 12px;
            background-color: #f8f9fa;
            border-radius: 7px;
        }

        .year-filter-help i {
            margin-right: 8px;
            color: #17a2b8;
        }

        .month-card {
            position: relative;
            overflow: hidden;
            margin-bottom: 24px;
            background-color: #ffffff;
            border: 1px solid #e3e7ea;
            border-radius: 12px;
            box-shadow: 0 4px 14px rgba(0, 0, 0, .05);
            transition:
                transform .22s ease,
                box-shadow .22s ease,
                border-color .22s ease;
        }

        .month-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 24px rgba(0, 0, 0, .11);
        }

        .month-active:hover {
            border-color: rgba(23, 162, 184, .45);
        }

        .month-empty {
            opacity: .84;
        }

        .month-card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 17px 18px 8px;
        }

        .month-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 47px;
            height: 47px;
            color: #ffffff;
            font-size: 19px;
            background: linear-gradient(
                135deg,
                #17a2b8,
                #007bff
            );
            border-radius: 11px;
            box-shadow: 0 5px 13px rgba(0, 123, 255, .2);
        }

        .month-empty .month-icon {
            color: #6c757d;
            background: #e9ecef;
            box-shadow: none;
        }

        .month-number {
            color: #ced4da;
            font-size: 25px;
            font-weight: 800;
            letter-spacing: .03em;
        }

        .month-card-body {
            padding: 8px 18px 18px;
        }

        .month-card-body > small {
            display: block;
            margin-bottom: 2px;
            color: #868e96;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: .08em;
            text-transform: uppercase;
        }

        .month-card-body h4 {
            margin: 0 0 18px;
            color: #343a40;
            font-size: 21px;
            font-weight: 700;
        }

        .patient-count {
            display: flex;
            align-items: baseline;
            gap: 7px;
            margin-bottom: 13px;
        }

        .patient-count strong {
            color: #138496;
            font-size: 29px;
            line-height: 1;
        }

        .month-empty .patient-count strong {
            color: #868e96;
        }

        .patient-count span {
            color: #6c757d;
            font-size: 12px;
            font-weight: 600;
        }

        .month-status {
            display: inline-flex;
            align-items: center;
            padding: 5px 8px;
            font-size: 10px;
            font-weight: 700;
            border-radius: 6px;
        }

        .month-status i {
            margin-right: 5px;
            font-size: 6px;
        }

        .month-status-active {
            color: #218838;
            background-color: #eaf7ed;
        }

        .month-status-empty {
            color: #6c757d;
            background-color: #f1f3f5;
        }

        .month-card-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 18px;
            color: #138496;
            font-size: 12px;
            font-weight: 700;
            background-color: #f8fcfd;
            border-top: 1px solid #edf0f2;
            transition:
                color .2s ease,
                background-color .2s ease;
        }

        .month-card-footer:hover {
            color: #ffffff;
            text-decoration: none;
            background-color: #17a2b8;
        }

        .month-card-footer i {
            transition: transform .2s ease;
        }

        .month-card-footer:hover i {
            transform: translateX(4px);
        }

        @media (max-width: 767.98px) {

            .calendar-stat-box .info-box-icon {
                width: 70px;
            }

            .year-filter-help {
                margin-top: 12px;
            }

            .month-card {
                margin-bottom: 18px;
            }

        }

    </style>

@stop

@section('js')

    <script>

        function submitCalendarYear() {

            const form =
                document.getElementById('calendar-year-form');

            const yearSelect =
                document.getElementById('year');

            yearSelect.disabled = true;

            form.submit();

        }

    </script>

@stop