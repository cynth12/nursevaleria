@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')

    <div class="d-flex justify-content-between align-items-center flex-wrap">

        <div>
            <h1 class="mb-0">
                Dashboard
            </h1>

            <small class="text-muted">
                Welcome to your clinic management system
            </small>
        </div>

        <div class="dashboard-date mt-2 mt-md-0">

            <i class="far fa-calendar-alt mr-1"></i>

            {{ now()->format('F d, Y') }}

        </div>

    </div>

@stop

@section('content')

    {{-- STATUS MESSAGE --}}
    @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show">

            <i class="fas fa-check-circle mr-2"></i>

            {{ session('status') }}

            <button type="button" class="close" data-dismiss="alert" aria-label="Close">

                <span aria-hidden="true">&times;</span>

            </button>

        </div>
    @endif

    {{-- HERO --}}
    <div class="card dashboard-hero">

        <div class="card-body">

            <div class="row align-items-center">

                <div class="col-lg-8">

                    <span class="hero-label">

                        <i class="fas fa-heartbeat mr-1"></i>

                        Nurse Valeria

                    </span>

                    <h2>
                        Welcome to your control panel
                    </h2>

                    <p>
                        Manage patients, consultations, treatments,
                        consent forms and clinic activity from one place.
                    </p>

                    <div class="hero-actions">

                        {{-- LISTADO DE PACIENTES --}}
                        <a href="{{ url('/pacientes') }}" class="btn btn-light">

                            <i class="fas fa-users mr-1"></i>

                            View Patients

                        </a>

                        {{-- CREAR PACIENTE --}}
                        <a href="{{ url('/patient/index') }}" class="btn btn-outline-light">

                            <i class="fas fa-user-plus mr-1"></i>

                            New Patient

                        </a>

                    </div>

                </div>

                <div class="col-lg-4 text-center mt-4 mt-lg-0">

                    <div class="hero-logo-wrapper">

                        <img src="{{ asset('img/logo.png') }}" alt="Nurse Valeria" class="hero-logo">

                    </div>

                </div>

            </div>

        </div>

    </div>

    {{-- SECTION TITLE --}}
    <div class="section-heading">

        <div>

            <h3>
                Quick Access
            </h3>

            <small>
                Access the principal areas of the system
            </small>

        </div>

    </div>

    {{-- MODULES --}}
    <div class="row">

        {{-- PATIENTS --}}
        <div class="col-xl-4 col-md-6">

            <a href="{{ url('/pacientes') }}" class="dashboard-module-link">

                <div class="card dashboard-module patients-module">

                    <div class="card-body">

                        <div class="module-top">

                            <div class="module-icon patients-icon">

                                <i class="fas fa-users"></i>

                            </div>

                            <span class="module-number">
                                01
                            </span>

                        </div>

                        <div class="module-content">

                            <h4>
                                Patients
                            </h4>

                            <p>
                                View, search, edit and manage all registered
                                patient records.
                            </p>

                        </div>

                        <div class="module-footer">

                            <span>
                                Open Patients
                            </span>

                            <i class="fas fa-arrow-right"></i>

                        </div>

                    </div>

                </div>

            </a>

        </div>

        {{-- NEW PATIENT --}}
        <div class="col-xl-4 col-md-6">

            <a href="{{ url('/patient/index') }}" class="dashboard-module-link">

                <div class="card dashboard-module new-patient-module">

                    <div class="card-body">

                        <div class="module-top">

                            <div class="module-icon new-patient-icon">

                                <i class="fas fa-user-plus"></i>

                            </div>

                            <span class="module-number">
                                02
                            </span>

                        </div>

                        <div class="module-content">

                            <h4>
                                New Patient
                            </h4>

                            <p>
                                Register a new patient and begin their
                                clinical record.
                            </p>

                        </div>

                        <div class="module-footer">

                            <span>
                                Register Patient
                            </span>

                            <i class="fas fa-arrow-right"></i>

                        </div>

                    </div>

                </div>

            </a>

        </div>

        {{-- CONSENT FORMS --}}
        <div class="col-xl-4 col-md-6">

            <a href="{{ url('/consentimientos') }}" class="dashboard-module-link">

                <div class="card dashboard-module consent-module">

                    <div class="card-body">

                        <div class="module-top">

                            <div class="module-icon consent-icon">

                                <i class="fas fa-file-signature"></i>

                            </div>

                            <span class="module-number">
                                03
                            </span>

                        </div>

                        <div class="module-content">

                            <h4>
                                Consent Forms
                            </h4>

                            <p>
                                Review and manage patient consent forms
                                and digital signatures.
                            </p>

                        </div>

                        <div class="module-footer">

                            <span>
                                Open Consent Forms
                            </span>

                            <i class="fas fa-arrow-right"></i>

                        </div>

                    </div>

                </div>

            </a>

        </div>

        {{-- TREATMENTS --}}
        <div class="col-xl-4 col-md-6">

            <a href="{{ url('/treatments') }}" class="dashboard-module-link">

                <div class="card dashboard-module treatments-module">

                    <div class="card-body">

                        <div class="module-top">

                            <div class="module-icon treatments-icon">

                                <i class="fas fa-syringe"></i>

                            </div>

                            <span class="module-number">
                                04
                            </span>

                        </div>

                        <div class="module-content">

                            <h4>
                                Treatments
                            </h4>

                            <p>
                                Manage treatment names, descriptions
                                and clinical formulas.
                            </p>

                        </div>

                        <div class="module-footer">

                            <span>
                                Open Treatments
                            </span>

                            <i class="fas fa-arrow-right"></i>

                        </div>

                    </div>

                </div>

            </a>

        </div>

        {{-- STATISTICS --}}
        <div class="col-xl-4 col-md-6">

            <a href="{{ url('/estadisticas') }}" class="dashboard-module-link">

                <div class="card dashboard-module statistics-module">

                    <div class="card-body">

                        <div class="module-top">

                            <div class="module-icon statistics-icon">

                                <i class="fas fa-chart-bar"></i>

                            </div>

                            <span class="module-number">
                                05
                            </span>

                        </div>

                        <div class="module-content">

                            <h4>
                                Statistics
                            </h4>

                            <p>
                                Review monthly consultations, new patients
                                and annual clinic activity.
                            </p>

                        </div>

                        <div class="module-footer">

                            <span>
                                View Statistics
                            </span>

                            <i class="fas fa-arrow-right"></i>

                        </div>

                    </div>

                </div>

            </a>

        </div>

         {{-- PUBLIC PATIENT FORM --}}
    <div class="col-xl-4 col-md-6">

        <a href="{{ url('/patient/form') }}" class="dashboard-module-link" target="_blank">

            <div class="card dashboard-module statistics-module">

                <div class="card-body">

                    <div class="module-top">

                        <div class="module-icon public-form-icon">

                            <i class="fas fa-globe-americas"></i>

                        </div>

                        <span class="module-number">
                            08
                        </span>

                    </div>

                    <div class="module-content">

                        <h4>
                            Public Patient Form
                        </h4>

                        <p>
                            Open the public registration form that patients complete before their appointment.
                        </p>

                    </div>

                    <div class="module-footer">

                        <span>
                            Open Public Form
                        </span>

                        <i class="fas fa-external-link-alt"></i>

                    </div>

                </div>

            </div>

        </a>

    </div>

        {{-- CALENDAR --}}
        <div class="col-xl-4 col-md-6">

            <a href="{{ url('/calendar') }}" class="dashboard-module-link">

                <div class="card dashboard-module calendar-module">

                    <div class="card-body">

                        <div class="module-top">

                            <div class="module-icon calendar-icon">

                                <i class="fas fa-calendar-alt"></i>

                            </div>

                            <span class="module-number">
                                06
                            </span>

                        </div>

                        <div class="module-content">

                            <h4>
                                Calendar
                            </h4>

                            <p>
                                Review registered patients organized
                                by year and month.
                            </p>

                        </div>

                        <div class="module-footer">

                            <span>
                                Open Calendar
                            </span>

                            <i class="fas fa-arrow-right"></i>

                        </div>

                    </div>

                </div>

            </a>

        </div>

        {{-- IMPORTED FILES --}}
        <div class="col-xl-4 col-md-6">

            <a href="{{ url('/imported_patients') }}" class="dashboard-module-link">

                <div class="card dashboard-module imports-module">

                    <div class="card-body">

                        <div class="module-top">

                            <div class="module-icon imports-icon">

                                <i class="fas fa-file-excel"></i>

                            </div>

                            <span class="module-number">
                                07
                            </span>

                        </div>

                        <div class="module-content">

                            <h4>
                                Imported Files
                            </h4>

                            <p>
                                Upload patient files and review previous
                                import history.
                            </p>

                        </div>

                        <div class="module-footer">

                            <span>
                                Open Imports
                            </span>

                            <i class="fas fa-arrow-right"></i>

                        </div>

                    </div>

                </div>

            </a>

        </div>

    </div>


    {{-- CLINIC INFORMATION --}}
    <div class="row mt-2">

        <div class="col-lg-8">

            <div class="card information-card">

                <div class="card-header border-0">

                    <h3 class="card-title font-weight-bold">

                        <i class="fas fa-clinic-medical text-info mr-2"></i>

                        Clinic Management

                    </h3>

                    <div class="mt-1">

                        <small class="text-muted">
                            Everything your clinic needs in one system
                        </small>

                    </div>

                </div>

                <div class="card-body">

                    <div class="row">

                        <div class="col-md-4">

                            <div class="information-item">

                                <div class="information-icon">

                                    <i class="fas fa-user-shield"></i>

                                </div>

                                <div>

                                    <strong>
                                        Patient Records
                                    </strong>

                                    <small>
                                        Centralized clinical information
                                    </small>

                                </div>

                            </div>

                        </div>

                        <div class="col-md-4">

                            <div class="information-item">

                                <div class="information-icon">

                                    <i class="fas fa-notes-medical"></i>

                                </div>

                                <div>

                                    <strong>
                                        Clinical History
                                    </strong>

                                    <small>
                                        Consultations and treatments
                                    </small>

                                </div>

                            </div>

                        </div>

                        <div class="col-md-4">

                            <div class="information-item">

                                <div class="information-icon">

                                    <i class="fas fa-chart-line"></i>

                                </div>

                                <div>

                                    <strong>
                                        Activity Tracking
                                    </strong>

                                    <small>
                                        Statistics and monthly reports
                                    </small>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <div class="col-lg-4">

            <div class="card help-card">

                <div class="card-body">

                    <div class="help-icon">

                        <i class="fas fa-lightbulb"></i>

                    </div>

                    <div>

                        <strong>
                            Quick Tip
                        </strong>

                        <p>
                            To create a new consultation, first open the
                            patient list and select the corresponding patient.
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>

@stop

@section('css')

    <style>
        .dashboard-date {
            padding: 8px 14px;
            color: #495057;
            font-size: 13px;
            font-weight: 600;
            background-color: #ffffff;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, .05);
        }

       .dashboard-hero {
    overflow: hidden;
    color: #ffffff;
    border: 0;
    border-radius: 15px;

    background: linear-gradient(
        135deg,
        #2F4E78 0%,
        #4E678C 45%,
        #7E93B3 100%
    );

    box-shadow: 0 12px 30px rgba(47,78,120,.25);
}

        .dashboard-hero .card-body {
            position: relative;
            padding: 40px 45px;
        }

        .dashboard-hero .card-body::before {
            position: absolute;
            top: -100px;
            right: -80px;
            width: 280px;
            height: 280px;
            content: '';
            background: rgba(200,167,122,.12);
            border-radius: 50%;
        }

        .dashboard-hero .card-body::after {
            position: absolute;
            right: 230px;
            bottom: -130px;
            width: 260px;
            height: 260px;
            content: '';
            background: rgba(255,255,255,.06);
            border-radius: 50%;
        }

        .hero-label{
    background: rgba(200,167,122,.20);
    color:#fff;
    border:1px solid rgba(200,167,122,.35);
}

        .dashboard-hero h2 {
            position: relative;
            z-index: 2;
            margin-bottom: 12px;
            font-size: 32px;
            font-weight: 700;
        }

        .dashboard-hero p {
            position: relative;
            z-index: 2;
            max-width: 680px;
            margin-bottom: 23px;
            font-size: 14px;
            line-height: 1.7;
            opacity: .92;
        }

       .hero-actions .btn-light{
    background:#F7F3EC;
    color:#2F4E78;
    border:none;
}
        .hero-actions .btn {
            min-width: 145px;
            padding: 9px 15px;
            font-size: 12px;
            font-weight: 700;
            border-radius: 8px;
        }

        .hero-logo-wrapper {
            position: relative;
            z-index: 2;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 205px;
            height: 205px;
            padding: 13px;
            background-color: rgba(255, 255, 255, .18);
            border-radius: 50%;
            box-shadow: 0 9px 26px rgba(0, 0, 0, .16);
        }

        .hero-logo {
            width: 100%;
            height: 100%;
            object-fit: cover;
            background-color: #ffffff;
            border: 7px solid rgba(255, 255, 255, .92);
            border-radius: 50%;
        }

        

        .section-heading {
            margin: 29px 0 15px;
        }

        .section-heading h3 {
            margin: 0;
            color: #343a40;
            font-size: 20px;
            font-weight: 700;
        }

        .section-heading small {
            color: #868e96;
            font-size: 12px;
        }

        .dashboard-module-link {
            color: inherit;
        }

        .dashboard-module-link:hover {
            color: inherit;
            text-decoration: none;
        }

        .dashboard-module {
            min-height: 225px;
            overflow: hidden;
            border: 0;
            border-radius: 12px;
            box-shadow: 0 5px 18px rgba(0, 0, 0, .07);
            transition:
                transform .22s ease,
                box-shadow .22s ease;
        }

        .dashboard-module:hover {
            transform: translateY(-5px);
            box-shadow: 0 11px 27px rgba(0, 0, 0, .12);
        }

        .dashboard-module .card-body {
            position: relative;
            display: flex;
            flex-direction: column;
            height: 100%;
            min-height: 225px;
            padding: 21px;
        }

        .module-top {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 17px;
        }

        .module-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 55px;
            height: 55px;
            font-size: 21px;
            border-radius: 14px;
        }

        .module-number {
            color: #e1e5e8;
            font-size: 25px;
            font-weight: 800;
        }

        .patients-icon {
            color: #007bff;
            background-color: #e9f3ff;
        }

        .new-patient-icon {
            color: #28a745;
            background-color: #eaf7ed;
        }

        .consent-icon {
            color: #6f42c1;
            background-color: #f1ebfb;
        }

        .treatments-icon {
            color: #17a2b8;
            background-color: #e8f7fa;
        }

        .statistics-icon {
            color: #fd7e14;
            background-color: #fff0e5;
        }

        .calendar-icon {
            color: #d63384;
            background-color: #fceaf3;
        }

        .imports-icon {
            color: #218838;
            background-color: #eaf7ed;
        }

        .module-content {
            flex: 1;
        }

        .module-content h4 {
            margin-bottom: 8px;
            color: #343a40;
            font-size: 17px;
            font-weight: 700;
        }

        .module-content p {
            margin: 0;
            color: #6c757d;
            font-size: 12px;
            line-height: 1.65;
        }

        .module-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 18px;
            padding-top: 13px;
            color: #6c757d;
            font-size: 11px;
            font-weight: 700;
            border-top: 1px solid #edf0f2;
        }

        .module-footer i {
            color: #ced4da;
            transition:
                color .2s ease,
                transform .2s ease;
        }

        .dashboard-module:hover .module-footer i {
            color: #17a2b8;
            transform: translateX(5px);
        }

        .patients-module {
            border-top: 3px solid #007bff;
        }

        .new-patient-module {
            border-top: 3px solid #28a745;
        }

        .consent-module {
            border-top: 3px solid #6f42c1;
        }

        .treatments-module {
            border-top: 3px solid #17a2b8;
        }

        .statistics-module {
            border-top: 3px solid #fd7e14;
        }

        .calendar-module {
            border-top: 3px solid #d63384;
        }

        .imports-module {
            border-top: 3px solid #218838;
        }

        .information-card,
        .help-card {
            overflow: hidden;
            border: 0;
            border-radius: 11px;
            box-shadow: 0 5px 18px rgba(0, 0, 0, .07);
        }

        .information-card {
            border-top: 3px solid #17a2b8;
        }

        .help-card {
            border-left: 4px solid #ffc107;
        }

        .information-item {
            display: flex;
            align-items: center;
            padding: 12px 0;
        }

        .information-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            flex: 0 0 44px;
            width: 44px;
            height: 44px;
            margin-right: 11px;
            color: #17a2b8;
            font-size: 17px;
            background-color: #e8f7fa;
            border-radius: 10px;
        }

        .information-item strong,
        .information-item small {
            display: block;
        }

        .information-item strong {
            color: #343a40;
            font-size: 12px;
        }

        .information-item small {
            margin-top: 2px;
            color: #868e96;
            font-size: 10px;
        }

        .help-card .card-body {
            display: flex;
            align-items: flex-start;
            min-height: 130px;
        }

        .help-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            flex: 0 0 48px;
            width: 48px;
            height: 48px;
            margin-right: 13px;
            color: #d39e00;
            font-size: 19px;
            background-color: #fff8df;
            border-radius: 10px;
        }

        .help-card strong {
            color: #856404;
            font-size: 13px;
        }

        .help-card p {
            margin: 5px 0 0;
            color: #6c757d;
            font-size: 11px;
            line-height: 1.65;
        }

        @media (max-width: 991.98px) {

            .dashboard-hero .card-body {
                padding: 31px;
            }

            .hero-logo-wrapper {
                width: 175px;
                height: 175px;
            }

        }

        @media (max-width: 767.98px) {

            .dashboard-hero .card-body {
                padding: 26px 22px;
                text-align: center;
            }

            .dashboard-hero h2 {
                font-size: 25px;
            }

            .dashboard-hero p {
                font-size: 13px;
            }

            .hero-actions {
                justify-content: center;
            }

            .hero-actions .btn {
                width: 100%;
            }

            .hero-logo-wrapper {
                width: 145px;
                height: 145px;
            }

            .dashboard-module {
                min-height: auto;
            }

            .dashboard-module .card-body {
                min-height: 215px;
            }

            .public-form-module {
                border-top: 3px solid #20c997;
            }

            .public-form-icon {
                color: #20c997;
                background-color: #e8faf5;
            }

        }
    </style>

@stop
