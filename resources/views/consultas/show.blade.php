@extends('adminlte::page')

@section('title', 'Detalle de consulta')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center flex-wrap">

        <div>
            <h1 class="mb-0">
                {{ $consultation->name }} {{ $consultation->last_name }}
            </h1>

            <small class="text-muted">
                Consulta #{{ $consultation->id }}
            </small>
        </div>

        <div class="mt-2 mt-md-0">

            <a
                href="{{ route('consultas.pdf', $consultation->id) }}"
                class="btn btn-info"
                target="_blank"
            >
                <i class="fas fa-file-pdf mr-1"></i>
                Imprimir resumen
            </a>

            <a
                href="{{ route('consultas.index', $consultation->patient_id) }}"
                class="btn btn-secondary"
            >
                <i class="fas fa-arrow-left mr-1"></i>
                Regresar
            </a>

        </div>
    </div>
@stop

@section('content')

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="fas fa-check-circle mr-1"></i>
            {{ session('success') }}

            <button type="button" class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
        </div>
    @endif

    <div class="row">

        {{-- COLUMNA PRINCIPAL --}}
        <div class="col-lg-8">

            {{-- Datos personales --}}
            <div class="card card-primary">

                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-user mr-1"></i>
                        Datos del paciente
                    </h3>
                </div>

                <div class="card-body">

                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <strong>Nombre</strong>

                            <p class="text-muted mb-0">
                                {{ $consultation->name ?: 'Sin registrar' }}
                            </p>
                        </div>

                        <div class="col-md-6 mb-3">
                            <strong>Apellidos</strong>

                            <p class="text-muted mb-0">
                                {{ $consultation->last_name ?: 'Sin registrar' }}
                            </p>
                        </div>

                        <div class="col-md-6 mb-3">
                            <strong>Fecha de nacimiento</strong>

                            <p class="text-muted mb-0">
                                {{ $consultation->date_of_birth ?: 'Sin registrar' }}
                            </p>
                        </div>

                        <div class="col-md-6 mb-3">
                            <strong>Teléfono</strong>

                            <p class="text-muted mb-0">
                                {{ $consultation->phone ?: 'Sin registrar' }}
                            </p>
                        </div>

                        <div class="col-md-6 mb-3">
                            <strong>Correo electrónico</strong>

                            <p class="text-muted mb-0">
                                {{ $consultation->email ?: 'Sin registrar' }}
                            </p>
                        </div>

                        <div class="col-md-6 mb-3">
                            <strong>Fecha de registro</strong>

                            <p class="text-muted mb-0">
                                {{ $consultation->registration_date ?: 'Sin registrar' }}
                            </p>
                        </div>

                        <div class="col-md-12">
                            <strong>Dirección</strong>

                            <p class="text-muted mb-0">
                                {{ $consultation->address ?: 'Sin registrar' }}
                            </p>
                        </div>

                    </div>

                </div>
            </div>

            {{-- Motivo de consulta --}}
            <div class="card card-info">

                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-notes-medical mr-1"></i>
                        Motivo de la consulta
                    </h3>
                </div>

                <div class="card-body">

                    <div class="row">

                        <div class="col-md-12 mb-3">
                            <strong>Motivo de la visita</strong>

                            <p class="text-muted mb-0" style="white-space: pre-line;">
                                {{ $consultation->reason ?: 'Sin registrar' }}
                            </p>
                        </div>

                        <div class="col-md-12 mb-3">
                            <strong>Síntomas</strong>

                            <p class="text-muted mb-0" style="white-space: pre-line;">
                                {{ $consultation->symptoms ?: 'Sin registrar' }}
                            </p>
                        </div>

                        <div class="col-md-6 mb-3">
                            <strong>Tipo de suero solicitado</strong>

                            <p class="text-muted mb-0">
                                {{ $consultation->iv_type ?: 'Sin registrar' }}
                            </p>
                        </div>

                        <div class="col-md-6 mb-3">
                            <strong>¿Cómo conoció el servicio?</strong>

                            <p class="text-muted mb-0">
                                {{ $consultation->referral_source ?: 'Sin registrar' }}
                            </p>
                        </div>

                        @if ($consultation->referral_other)
                            <div class="col-md-12">
                                <strong>Otro medio de referencia</strong>

                                <p class="text-muted mb-0">
                                    {{ $consultation->referral_other }}
                                </p>
                            </div>
                        @endif

                    </div>

                </div>
            </div>

            {{-- Contacto de emergencia --}}
            <div class="card card-warning">

                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-phone-alt mr-1"></i>
                        Contacto de emergencia
                    </h3>
                </div>

                <div class="card-body">

                    <div class="row">

                        <div class="col-md-4 mb-3">
                            <strong>Nombre</strong>

                            <p class="text-muted mb-0">
                                {{ $consultation->emergency_name ?: 'Sin registrar' }}
                            </p>
                        </div>

                        <div class="col-md-4 mb-3">
                            <strong>Relación</strong>

                            <p class="text-muted mb-0">
                                {{ $consultation->emergency_relationship ?: 'Sin registrar' }}
                            </p>
                        </div>

                        <div class="col-md-4 mb-3">
                            <strong>Teléfono</strong>

                            <p class="text-muted mb-0">
                                {{ $consultation->emergency_phone ?: 'Sin registrar' }}
                            </p>
                        </div>

                    </div>

                </div>
            </div>

            {{-- Historia médica --}}
            <div class="card card-danger">

                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-heartbeat mr-1"></i>
                        Historia médica
                    </h3>
                </div>

                <div class="card-body">

                    <div class="row">

                        <div class="col-md-4 mb-3">
                            <strong>¿Embarazo?</strong>

                            <p class="mb-0 mt-1">
                                @if ($consultation->pregnant)
                                    <span class="badge badge-warning">Sí</span>
                                @else
                                    <span class="badge badge-success">No</span>
                                @endif
                            </p>
                        </div>

                        <div class="col-md-4 mb-3">
                            <strong>Intolerancia a vitaminas</strong>

                            <p class="mb-0 mt-1">
                                @if ($consultation->vitamins_intolerance)
                                    <span class="badge badge-warning">Sí</span>
                                @else
                                    <span class="badge badge-success">No</span>
                                @endif
                            </p>
                        </div>

                        <div class="col-md-4 mb-3">
                            <strong>Intolerancia a minerales</strong>

                            <p class="mb-0 mt-1">
                                @if ($consultation->minerals_intolerance)
                                    <span class="badge badge-warning">Sí</span>
                                @else
                                    <span class="badge badge-success">No</span>
                                @endif
                            </p>
                        </div>

                    </div>

                    <hr>

                    <h5 class="mb-3">
                        <i class="fas fa-allergies mr-1"></i>
                        Alergias
                    </h5>

                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <strong>Alergia a medicamentos</strong>

                            <p class="text-muted mb-0" style="white-space: pre-line;">
                                {{ $consultation->allergy_medicine ?: 'Ninguna registrada' }}
                            </p>
                        </div>

                        <div class="col-md-6 mb-3">
                            <strong>Alergia a alimentos</strong>

                            <p class="text-muted mb-0" style="white-space: pre-line;">
                                {{ $consultation->allergy_food ?: 'Ninguna registrada' }}
                            </p>
                        </div>

                        <div class="col-md-12 mb-3">
                            <strong>Reacción</strong>

                            <p class="text-muted mb-0" style="white-space: pre-line;">
                                {{ $consultation->reaction ?: 'Sin registrar' }}
                            </p>
                        </div>

                    </div>

                    <hr>

                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <strong>Medicamentos actuales</strong>

                            <p class="text-muted mb-0" style="white-space: pre-line;">
                                {{ $consultation->medications ?: 'Ninguno registrado' }}
                            </p>
                        </div>

                        <div class="col-md-6 mb-3">
                            <strong>Suplementos</strong>

                            <p class="text-muted mb-0" style="white-space: pre-line;">
                                {{ $consultation->supplements ?: 'Ninguno registrado' }}
                            </p>
                        </div>

                    </div>

                </div>
            </div>

            {{-- Signos vitales --}}
            <div class="card card-success">

                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-stethoscope mr-1"></i>
                        Signos vitales
                    </h3>
                </div>

                <div class="card-body">

                    <h5 class="mb-3">
                        Antes del procedimiento
                    </h5>

                    <div class="row">

                        <div class="col-md-6 col-xl-3">
                            <div class="info-box bg-light">
                                <span class="info-box-icon">
                                    <i class="fas fa-heartbeat"></i>
                                </span>

                                <div class="info-box-content">
                                    <span class="info-box-text">
                                        Frecuencia cardiaca
                                    </span>

                                    <span class="info-box-number">
                                        {{ $consultation->pre_heart_rate ?: '--' }}
                                        <small>lpm</small>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-xl-3">
                            <div class="info-box bg-light">
                                <span class="info-box-icon">
                                    <i class="fas fa-lungs"></i>
                                </span>

                                <div class="info-box-content">
                                    <span class="info-box-text">
                                        Saturación O₂
                                    </span>

                                    <span class="info-box-number">
                                        {{ $consultation->pre_oxygen_saturation ?: '--' }}
                                        <small>%</small>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-xl-3">
                            <div class="info-box bg-light">
                                <span class="info-box-icon">
                                    <i class="fas fa-thermometer-half"></i>
                                </span>

                                <div class="info-box-content">
                                    <span class="info-box-text">
                                        Temperatura
                                    </span>

                                    <span class="info-box-number">
                                        {{ $consultation->pre_temperature ?: '--' }}
                                        <small>°C</small>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-xl-3">
                            <div class="info-box bg-light">
                                <span class="info-box-icon">
                                    <i class="fas fa-tachometer-alt"></i>
                                </span>

                                <div class="info-box-content">
                                    <span class="info-box-text">
                                        Presión arterial
                                    </span>

                                    <span class="info-box-number">
                                        {{ $consultation->pre_blood_pressure ?: '--' }}
                                    </span>
                                </div>
                            </div>
                        </div>

                    </div>

                    <hr>

                    <h5 class="mb-3">
                        Después del procedimiento
                    </h5>

                    <div class="row">

                        <div class="col-md-6 col-xl-3">
                            <div class="info-box bg-light">
                                <span class="info-box-icon">
                                    <i class="fas fa-heartbeat"></i>
                                </span>

                                <div class="info-box-content">
                                    <span class="info-box-text">
                                        Frecuencia cardiaca
                                    </span>

                                    <span class="info-box-number">
                                        {{ $consultation->heart_rate ?: '--' }}
                                        <small>lpm</small>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-xl-3">
                            <div class="info-box bg-light">
                                <span class="info-box-icon">
                                    <i class="fas fa-lungs"></i>
                                </span>

                                <div class="info-box-content">
                                    <span class="info-box-text">
                                        Saturación O₂
                                    </span>

                                    <span class="info-box-number">
                                        {{ $consultation->oxygen_saturation ?: '--' }}
                                        <small>%</small>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-xl-3">
                            <div class="info-box bg-light">
                                <span class="info-box-icon">
                                    <i class="fas fa-thermometer-half"></i>
                                </span>

                                <div class="info-box-content">
                                    <span class="info-box-text">
                                        Temperatura
                                    </span>

                                    <span class="info-box-number">
                                        {{ $consultation->temperature ?: '--' }}
                                        <small>°C</small>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-xl-3">
                            <div class="info-box bg-light">
                                <span class="info-box-icon">
                                    <i class="fas fa-tachometer-alt"></i>
                                </span>

                                <div class="info-box-content">
                                    <span class="info-box-text">
                                        Presión arterial
                                    </span>

                                    <span class="info-box-number">
                                        {{ $consultation->blood_pressure ?: '--' }}
                                    </span>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>

            {{-- Tratamiento --}}
            @if (
                $consultation->treatment ||
                $consultation->treatment_description ||
                $consultation->treatment_formula
            )

                <div class="card card-primary">

                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-syringe mr-1"></i>
                            Tratamiento
                        </h3>
                    </div>

                    <div class="card-body">

                        <h4 class="mb-3">
                            {{ $consultation->treatment->name ?? 'Tratamiento registrado' }}
                        </h4>

                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <strong>Descripción</strong>

                                <p class="text-muted mb-0" style="white-space: pre-line;">
                                    {{ $consultation->treatment_description ?: 'Sin descripción' }}
                                </p>
                            </div>

                            <div class="col-md-6 mb-3">
                                <strong>Fórmula</strong>

                                <p class="text-muted mb-0" style="white-space: pre-line;">
                                    {{ $consultation->treatment_formula ?: 'Sin fórmula registrada' }}
                                </p>
                            </div>

                        </div>

                    </div>
                </div>

            @endif

            {{-- Notas --}}
            <div class="card card-secondary">

                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-clipboard mr-1"></i>
                        Notas clínicas
                    </h3>
                </div>

                <div class="card-body">

                    <p class="mb-0" style="white-space: pre-line;">
                        {{ $consultation->notes ?: 'No se registraron notas para esta consulta.' }}
                    </p>

                </div>
            </div>

            {{-- Consentimiento --}}
            <div class="card card-dark">

                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-file-signature mr-1"></i>
                        Consentimiento informado
                    </h3>
                </div>

                <div class="card-body">

                    <div class="row">

                        <div class="col-md-4 mb-3">
                            <strong>Consentimiento aceptado</strong>

                            <p class="mb-0 mt-1">
                                @if ($consultation->consent_accepted)
                                    <span class="badge badge-success">
                                        Sí, aceptado
                                    </span>
                                @else
                                    <span class="badge badge-danger">
                                        No aceptado
                                    </span>
                                @endif
                            </p>
                        </div>

                        <div class="col-md-8 mb-3">
                            <strong>Procedimiento autorizado</strong>

                            <p class="text-muted mb-0" style="white-space: pre-line;">
                                {{ $consultation->authorized_procedure ?: 'Sin registrar' }}
                            </p>
                        </div>

                    </div>

                </div>
            </div>

        </div>

        {{-- COLUMNA LATERAL --}}
        <div class="col-lg-4">

            {{-- Resumen --}}
            <div class="card">

                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-clipboard-list mr-1"></i>
                        Resumen
                    </h3>
                </div>

                <div class="card-body">

                    <div class="info-box bg-light">
                        <span class="info-box-icon">
                            <i class="fas fa-hashtag"></i>
                        </span>

                        <div class="info-box-content">
                            <span class="info-box-text">
                                Número de consulta
                            </span>

                            <span class="info-box-number">
                                #{{ $consultation->id }}
                            </span>
                        </div>
                    </div>

                    <div class="info-box bg-light">
                        <span class="info-box-icon">
                            <i class="fas fa-calendar-alt"></i>
                        </span>

                        <div class="info-box-content">
                            <span class="info-box-text">
                                Fecha de registro
                            </span>

                            <span class="info-box-number">
                                {{ $consultation->registration_date ?: 'Sin registrar' }}
                            </span>
                        </div>
                    </div>

                    <div class="info-box bg-light">
                        <span class="info-box-icon">
                            <i class="fas fa-user-injured"></i>
                        </span>

                        <div class="info-box-content">
                            <span class="info-box-text">
                                Paciente
                            </span>

                            <span class="info-box-number">
                                {{ $consultation->name }}
                                {{ $consultation->last_name }}
                            </span>
                        </div>
                    </div>

                </div>
            </div>

            {{-- Grupo --}}
            @if ($consultation->patient && $consultation->patient->group)

                <div class="card card-info">

                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-users mr-1"></i>
                            Grupo del paciente
                        </h3>
                    </div>

                    <div class="card-body">

                        <p class="mb-3">
                            Este paciente pertenece al grupo:
                        </p>

                        <h5>
                            {{ $consultation->patient->group->place }}
                        </h5>

                        <a
                            href="{{ route('grupos.show', $consultation->patient->group->id) }}"
                            class="btn btn-info btn-block"
                        >
                            <i class="fas fa-users mr-1"></i>
                            Ver grupo
                        </a>

                    </div>
                </div>

            @endif

            {{-- Acciones --}}
            <div class="card">

                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-tools mr-1"></i>
                        Acciones
                    </h3>
                </div>

                <div class="card-body">

                    <a
                        href="{{ route('consultas.pdf', $consultation->id) }}"
                        class="btn btn-info btn-block"
                        target="_blank"
                    >
                        <i class="fas fa-file-pdf mr-1"></i>
                        Imprimir resumen
                    </a>

                    @if (Route::has('consultas.edit'))
                        <a
                            href="{{ route('consultas.edit', $consultation->id) }}"
                            class="btn btn-warning btn-block"
                        >
                            <i class="fas fa-edit mr-1"></i>
                            Editar consulta
                        </a>
                    @endif

                    @if ($consultation->patient && $consultation->patient->group)
                        <a
                            href="{{ route('grupos.show', $consultation->patient->group->id) }}"
                            class="btn btn-secondary btn-block"
                        >
                            <i class="fas fa-arrow-left mr-1"></i>
                            Regresar al grupo
                        </a>
                    @endif

                    <a
                        href="{{ route('consultas.index', $consultation->patient_id) }}"
                        class="btn btn-secondary btn-block"
                    >
                        <i class="fas fa-list mr-1"></i>
                        Historial de consultas
                    </a>

                </div>
            </div>

        </div>

    </div>

@stop