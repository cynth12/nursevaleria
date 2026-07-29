@extends('adminlte::page')

@section('title', 'Consultation Details')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center flex-wrap">

        <div>
            <h1 class="mb-0">
                {{ $consultation->name }} {{ $consultation->last_name }}
            </h1>

            <small class="text-muted">
                Consultation #{{ $consultation->id }}
            </small>
        </div>

        <div class="mt-2 mt-md-0">

            <a
                href="{{ route('consultas.pdf', $consultation->id) }}"
                class="btn btn-info"
                target="_blank"
            >
                <i class="fas fa-file-pdf mr-1"></i>
                Print Summary
            </a>

            <a
                href="{{ route('consultas.index', $consultation->patient_id) }}"
                class="btn btn-secondary"
            >
                <i class="fas fa-arrow-left mr-1"></i>
                Back
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

        {{-- MAIN COLUMN --}}
        <div class="col-lg-8">

            {{-- Patient information --}}
            <div class="card card-primary">

                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-user mr-1"></i>
                        Patient Information
                    </h3>
                </div>

                <div class="card-body">

                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <strong>First Name</strong>

                            <p class="text-muted mb-0">
                                {{ $consultation->name ?: 'Not provided' }}
                            </p>
                        </div>

                        <div class="col-md-6 mb-3">
                            <strong>Last Name</strong>

                            <p class="text-muted mb-0">
                                {{ $consultation->last_name ?: 'Not provided' }}
                            </p>
                        </div>

                        <div class="col-md-6 mb-3">
                            <strong>Date of Birth</strong>

                            <p class="text-muted mb-0">
                                {{ $consultation->date_of_birth ?: 'Not provided' }}
                            </p>
                        </div>

                        <div class="col-md-6 mb-3">
                            <strong>Phone Number</strong>

                            <p class="text-muted mb-0">
                                {{ $consultation->phone ?: 'Not provided' }}
                            </p>
                        </div>

                        <div class="col-md-6 mb-3">
                            <strong>Email Address</strong>

                            <p class="text-muted mb-0">
                                {{ $consultation->email ?: 'Not provided' }}
                            </p>
                        </div>

                        <div class="col-md-6 mb-3">
                            <strong>Registration Date</strong>

                            <p class="text-muted mb-0">
                                {{ $consultation->registration_date ?: 'Not provided' }}
                            </p>
                        </div>

                        <div class="col-md-12">
                            <strong>Address</strong>

                            <p class="text-muted mb-0">
                                {{ $consultation->address ?: 'Not provided' }}
                            </p>
                        </div>

                    </div>

                </div>
            </div>

            {{-- Reason for consultation --}}
            <div class="card card-info">

                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-notes-medical mr-1"></i>
                        Reason for Consultation
                    </h3>
                </div>

                <div class="card-body">

                    <div class="row">

                        <div class="col-md-12 mb-3">
                            <strong>Reason for Visit</strong>

                            <p class="text-muted mb-0" style="white-space: pre-line;">
                                {{ $consultation->reason ?: 'Not provided' }}
                            </p>
                        </div>

                        <div class="col-md-12 mb-3">
                            <strong>Symptoms</strong>

                            <p class="text-muted mb-0" style="white-space: pre-line;">
                                {{ $consultation->symptoms ?: 'Not provided' }}
                            </p>
                        </div>

                        <div class="col-md-6 mb-3">
                            <strong>Requested IV Treatment</strong>

                            <p class="text-muted mb-0">
                                {{ $consultation->iv_type ?: 'Not provided' }}
                            </p>
                        </div>

                        <div class="col-md-6 mb-3">
                            <strong>How Did You Hear About Us?</strong>

                            <p class="text-muted mb-0">
                                {{ $consultation->referral_source ?: 'Not provided' }}
                            </p>
                        </div>

                        @if ($consultation->referral_other)
                            <div class="col-md-12">
                                <strong>Other Referral Source</strong>

                                <p class="text-muted mb-0">
                                    {{ $consultation->referral_other }}
                                </p>
                            </div>
                        @endif

                    </div>

                </div>
            </div>

            {{-- Emergency contact --}}
            <div class="card card-warning">

                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-phone-alt mr-1"></i>
                        Emergency Contact
                    </h3>
                </div>

                <div class="card-body">

                    <div class="row">

                        <div class="col-md-4 mb-3">
                            <strong>Name</strong>

                            <p class="text-muted mb-0">
                                {{ $consultation->emergency_name ?: 'Not provided' }}
                            </p>
                        </div>

                        <div class="col-md-4 mb-3">
                            <strong>Relationship</strong>

                            <p class="text-muted mb-0">
                                {{ $consultation->emergency_relationship ?: 'Not provided' }}
                            </p>
                        </div>

                        <div class="col-md-4 mb-3">
                            <strong>Phone Number</strong>

                            <p class="text-muted mb-0">
                                {{ $consultation->emergency_phone ?: 'Not provided' }}
                            </p>
                        </div>

                    </div>

                </div>
            </div>

            {{-- Medical history --}}
            <div class="card card-danger">

                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-heartbeat mr-1"></i>
                        Medical History
                    </h3>
                </div>

                <div class="card-body">

                    <div class="row">

                        <div class="col-md-4 mb-3">
                            <strong>Pregnant?</strong>

                            <p class="mb-0 mt-1">
                                @if ($consultation->pregnant)
                                    <span class="badge badge-warning">Yes</span>
                                @else
                                    <span class="badge badge-success">No</span>
                                @endif
                            </p>
                        </div>

                        <div class="col-md-4 mb-3">
                            <strong>Vitamin Intolerance</strong>

                            <p class="mb-0 mt-1">
                                @if ($consultation->vitamins_intolerance)
                                    <span class="badge badge-warning">Yes</span>
                                @else
                                    <span class="badge badge-success">No</span>
                                @endif
                            </p>
                        </div>

                        <div class="col-md-4 mb-3">
                            <strong>Mineral Intolerance</strong>

                            <p class="mb-0 mt-1">
                                @if ($consultation->minerals_intolerance)
                                    <span class="badge badge-warning">Yes</span>
                                @else
                                    <span class="badge badge-success">No</span>
                                @endif
                            </p>
                        </div>

                    </div>

                    <hr>

                    <h5 class="mb-3">
                        <i class="fas fa-allergies mr-1"></i>
                        Allergies
                    </h5>

                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <strong>Medication Allergies</strong>

                            <p class="text-muted mb-0" style="white-space: pre-line;">
                                {{ $consultation->allergy_medicine ?: 'None reported' }}
                            </p>
                        </div>

                        <div class="col-md-6 mb-3">
                            <strong>Food Allergies</strong>

                            <p class="text-muted mb-0" style="white-space: pre-line;">
                                {{ $consultation->allergy_food ?: 'None reported' }}
                            </p>
                        </div>

                        <div class="col-md-12 mb-3">
                            <strong>Allergic Reaction</strong>

                            <p class="text-muted mb-0" style="white-space: pre-line;">
                                {{ $consultation->reaction ?: 'Not provided' }}
                            </p>
                        </div>

                    </div>

                    <hr>

                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <strong>Current Medications</strong>

                            <p class="text-muted mb-0" style="white-space: pre-line;">
                                {{ $consultation->medications ?: 'None reported' }}
                            </p>
                        </div>

                        <div class="col-md-6 mb-3">
                            <strong>Supplements</strong>

                            <p class="text-muted mb-0" style="white-space: pre-line;">
                                {{ $consultation->supplements ?: 'None reported' }}
                            </p>
                        </div>

                    </div>

                </div>
            </div>

            {{-- Vital signs --}}
            <div class="card card-success">

                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-stethoscope mr-1"></i>
                        Vital Signs
                    </h3>
                </div>

                <div class="card-body">

                    <h5 class="mb-3">
                        Before the Procedure
                    </h5>

                    <div class="row">

                        <div class="col-md-6 col-xl-3">
                            <div class="info-box bg-light">
                                <span class="info-box-icon">
                                    <i class="fas fa-heartbeat"></i>
                                </span>

                                <div class="info-box-content">
                                    <span class="info-box-text">
                                        Heart Rate
                                    </span>

                                    <span class="info-box-number">
                                        {{ $consultation->pre_heart_rate ?: '--' }}
                                        <small>bpm</small>
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
                                        Oxygen Saturation
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
                                        Temperature
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
                                        Blood Pressure
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
                        After the Procedure
                    </h5>

                    <div class="row">

                        <div class="col-md-6 col-xl-3">
                            <div class="info-box bg-light">
                                <span class="info-box-icon">
                                    <i class="fas fa-heartbeat"></i>
                                </span>

                                <div class="info-box-content">
                                    <span class="info-box-text">
                                        Heart Rate
                                    </span>

                                    <span class="info-box-number">
                                        {{ $consultation->heart_rate ?: '--' }}
                                        <small>bpm</small>
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
                                        Oxygen Saturation
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
                                        Temperature
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
                                        Blood Pressure
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

            {{-- Treatment --}}
            @if (
                $consultation->treatment ||
                $consultation->treatment_description ||
                $consultation->treatment_formula
            )

                <div class="card card-primary">

                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-syringe mr-1"></i>
                            Treatment
                        </h3>
                    </div>

                    <div class="card-body">

                        <h4 class="mb-3">
                            {{ $consultation->treatment->name ?? 'Recorded Treatment' }}
                        </h4>

                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <strong>Description</strong>

                                <p class="text-muted mb-0" style="white-space: pre-line;">
                                    {{ $consultation->treatment_description ?: 'No description provided' }}
                                </p>
                            </div>

                            <div class="col-md-6 mb-3">
                                <strong>Formula</strong>

                                <p class="text-muted mb-0" style="white-space: pre-line;">
                                    {{ $consultation->treatment_formula ?: 'No formula provided' }}
                                </p>
                            </div>

                        </div>

                    </div>
                </div>

            @endif

            {{-- Notes --}}
            <div class="card card-secondary">

                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-clipboard mr-1"></i>
                        Clinical Notes
                    </h3>
                </div>

                <div class="card-body">

                    <p class="mb-0" style="white-space: pre-line;">
                        {{ $consultation->notes ?: 'No clinical notes were recorded for this consultation.' }}
                    </p>

                </div>
            </div>

            {{-- Informed consent --}}
            <div class="card card-dark">

                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-file-signature mr-1"></i>
                        Informed Consent
                    </h3>
                </div>

                <div class="card-body">

                    <div class="row">

                        <div class="col-md-4 mb-3">
                            <strong>Consent Accepted</strong>

                            <p class="mb-0 mt-1">
                                @if ($consultation->consent_accepted)
                                    <span class="badge badge-success">
                                        Yes, Accepted
                                    </span>
                                @else
                                    <span class="badge badge-danger">
                                        Not Accepted
                                    </span>
                                @endif
                            </p>
                        </div>

                        <div class="col-md-8 mb-3">
                            <strong>Authorized Procedure</strong>

                            <p class="text-muted mb-0" style="white-space: pre-line;">
                                {{ $consultation->authorized_procedure ?: 'Not provided' }}
                            </p>
                        </div>

                    </div>

                </div>
            </div>

        </div>

        {{-- SIDEBAR --}}
        <div class="col-lg-4">

            {{-- Summary --}}
            <div class="card">

                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-clipboard-list mr-1"></i>
                        Summary
                    </h3>
                </div>

                <div class="card-body">

                    <div class="info-box bg-light">
                        <span class="info-box-icon">
                            <i class="fas fa-hashtag"></i>
                        </span>

                        <div class="info-box-content">
                            <span class="info-box-text">
                                Consultation Number
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
                                Registration Date
                            </span>

                            <span class="info-box-number">
                                {{ $consultation->registration_date ?: 'Not provided' }}
                            </span>
                        </div>
                    </div>

                    <div class="info-box bg-light">
                        <span class="info-box-icon">
                            <i class="fas fa-user-injured"></i>
                        </span>

                        <div class="info-box-content">
                            <span class="info-box-text">
                                Patient
                            </span>

                            <span class="info-box-number">
                                {{ $consultation->name }}
                                {{ $consultation->last_name }}
                            </span>
                        </div>
                    </div>

                </div>
            </div>

            {{-- Patient group --}}
            @if ($consultation->patient && $consultation->patient->group)

                <div class="card card-info">

                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-users mr-1"></i>
                            Patient Group
                        </h3>
                    </div>

                    <div class="card-body">

                        <p class="mb-3">
                            This patient belongs to the following group:
                        </p>

                        <h5>
                            {{ $consultation->patient->group->place }}
                        </h5>

                        <a
                            href="{{ route('grupos.show', $consultation->patient->group->id) }}"
                            class="btn btn-info btn-block"
                        >
                            <i class="fas fa-users mr-1"></i>
                            View Group
                        </a>

                    </div>
                </div>

            @endif

            {{-- Actions --}}
            <div class="card">

                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-tools mr-1"></i>
                        Actions
                    </h3>
                </div>

                <div class="card-body">

                    <a
                        href="{{ route('consultas.pdf', $consultation->id) }}"
                        class="btn btn-info btn-block"
                        target="_blank"
                    >
                        <i class="fas fa-file-pdf mr-1"></i>
                        Print Summary
                    </a>

                    @if (Route::has('consultas.edit'))
                        <a
                            href="{{ route('consultas.edit', $consultation->id) }}"
                            class="btn btn-warning btn-block"
                        >
                            <i class="fas fa-edit mr-1"></i>
                            Edit Consultation
                        </a>
                    @endif

                    @if ($consultation->patient && $consultation->patient->group)
                        <a
                            href="{{ route('grupos.show', $consultation->patient->group->id) }}"
                            class="btn btn-secondary btn-block"
                        >
                            <i class="fas fa-arrow-left mr-1"></i>
                            Return to Group
                        </a>
                    @endif

                    <a
                        href="{{ route('consultas.index', $consultation->patient_id) }}"
                        class="btn btn-secondary btn-block"
                    >
                        <i class="fas fa-list mr-1"></i>
                        Consultation History
                    </a>

                </div>
            </div>

        </div>

    </div>

@stop