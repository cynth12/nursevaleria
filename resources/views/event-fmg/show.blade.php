@extends('adminlte::page')

@section('title', 'Participant Details')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center flex-wrap">

        <div>
            <h1 class="mb-0">
                {{ $eventFmgPatient->name }} {{ $eventFmgPatient->last_name }}
            </h1>

            <small class="text-muted">
                Participant #{{ $eventFmgPatient->id }}
            </small>
        </div>

        <div class="mt-2 mt-md-0">

            <a href="{{ route('event-fmg.index') }}" class="btn btn-secondary">
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
                                {{ $eventFmgPatient->name ?: 'Not provided' }}
                            </p>
                        </div>

                        <div class="col-md-6 mb-3">
                            <strong>Last Name</strong>

                            <p class="text-muted mb-0">
                                {{ $eventFmgPatient->last_name ?: 'Not provided' }}
                            </p>
                        </div>

                        <div class="col-md-6 mb-3">
                            <strong>Date of Birth</strong>

                            <p class="text-muted mb-0">
                                {{ $eventFmgPatient->date_of_birth ?: 'Not provided' }}
                            </p>
                        </div>

                        <div class="col-md-6 mb-3">
                            <strong>Phone Number</strong>

                            <p class="text-muted mb-0">
                                {{ $eventFmgPatient->phone ?: 'Not provided' }}
                            </p>
                        </div>

                        <div class="col-md-6 mb-3">
                            <strong>Email Address</strong>

                            <p class="text-muted mb-0">
                                {{ $eventFmgPatient->email ?: 'Not provided' }}
                            </p>
                        </div>

                        <div class="col-md-6 mb-3">
                            <strong>Registration Date</strong>

                            <p class="text-muted mb-0">
                                {{ $eventFmgPatient->registration_date ?: 'Not provided' }}
                            </p>
                        </div>

                        <div class="col-md-12">
                            <strong>Address</strong>

                            <p class="text-muted mb-0">
                                {{ $eventFmgPatient->address ?: 'Not provided' }}
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
                                {{ $eventFmgPatient->reason ?: 'Not provided' }}
                            </p>
                        </div>

                        <div class="col-md-12 mb-3">
                            <strong>Symptoms</strong>

                            <p class="text-muted mb-0" style="white-space: pre-line;">
                                {{ $eventFmgPatient->symptoms ?: 'Not provided' }}
                            </p>
                        </div>

                        <div class="col-md-6 mb-3">
                            <strong>Requested IV Treatment</strong>

                            <p class="text-muted mb-0">
                                {{ $eventFmgPatient->iv_type ?: 'Not provided' }}
                            </p>
                        </div>

                        <div class="col-md-6 mb-3">
                            <strong>How Did You Hear About Us?</strong>

                            <p class="text-muted mb-0">
                                {{ $eventFmgPatient->referral_source ?: 'Not provided' }}
                            </p>
                        </div>

                        @if ($eventFmgPatient->referral_other)
                            <div class="col-md-12">
                                <strong>Other Referral Source</strong>

                                <p class="text-muted mb-0">
                                    {{ $eventFmgPatient->referral_other }}
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
                                {{ $eventFmgPatient->emergency_name ?: 'Not provided' }}
                            </p>
                        </div>

                        <div class="col-md-4 mb-3">
                            <strong>Relationship</strong>

                            <p class="text-muted mb-0">
                                {{ $eventFmgPatient->emergency_relationship ?: 'Not provided' }}
                            </p>
                        </div>

                        <div class="col-md-4 mb-3">
                            <strong>Phone Number</strong>

                            <p class="text-muted mb-0">
                                {{ $eventFmgPatient->emergency_phone ?: 'Not provided' }}
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
                                @if ($eventFmgPatient->pregnant)
                                    <span class="badge badge-warning">Yes</span>
                                @else
                                    <span class="badge badge-success">No</span>
                                @endif
                            </p>
                        </div>

                        <div class="col-md-4 mb-3">
                            <strong>Vitamin Intolerance</strong>

                            <p class="mb-0 mt-1">
                                @if ($eventFmgPatient->vitamins_intolerance)
                                    <span class="badge badge-warning">Yes</span>
                                @else
                                    <span class="badge badge-success">No</span>
                                @endif
                            </p>
                        </div>

                        <div class="col-md-4 mb-3">
                            <strong>Mineral Intolerance</strong>

                            <p class="mb-0 mt-1">
                                @if ($eventFmgPatient->minerals_intolerance)
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
                                {{ $eventFmgPatient->allergy_medicine ?: 'None reported' }}
                            </p>
                        </div>

                        <div class="col-md-6 mb-3">
                            <strong>Food Allergies</strong>

                            <p class="text-muted mb-0" style="white-space: pre-line;">
                                {{ $eventFmgPatient->allergy_food ?: 'None reported' }}
                            </p>
                        </div>

                        <div class="col-md-12 mb-3">
                            <strong>Allergic Reaction</strong>

                            <p class="text-muted mb-0" style="white-space: pre-line;">
                                {{ $eventFmgPatient->reaction ?: 'Not provided' }}
                            </p>
                        </div>

                    </div>

                    <hr>

                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <strong>Current Medications</strong>

                            <p class="text-muted mb-0" style="white-space: pre-line;">
                                {{ $eventFmgPatient->medications ?: 'None reported' }}
                            </p>
                        </div>

                        <div class="col-md-6 mb-3">
                            <strong>Supplements</strong>

                            <p class="text-muted mb-0" style="white-space: pre-line;">
                                {{ $eventFmgPatient->supplements ?: 'None reported' }}
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
                        Participant Summary
                    </h3>
                </div>

                <div class="card-body">

                    <div class="info-box bg-light">
                        <span class="info-box-icon">
                            <i class="fas fa-hashtag"></i>
                        </span>

                        <div class="info-box-content">
                            <span class="info-box-text">
                                Participant Number
                            </span>

                            <span class="info-box-number">
                                #{{ $eventFmgPatient->id }}
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
                                {{ $eventFmgPatient->registration_date ?: 'Not provided' }}
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
                                {{ $eventFmgPatient->name }}
                                {{ $eventFmgPatient->last_name }}
                            </span>
                        </div>
                    </div>

                </div>
            </div>

            {{-- Actions --}}
            <div class="card">

                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-tools mr-1"></i>
                        Actions
                    </h3>
                </div>

                <div class="card-body">

                    <a href="{{ route('event-fmg.edit', $eventFmgPatient->id) }}" class="btn btn-warning btn-block">
                        <i class="fas fa-edit mr-1"></i>
                        Edit Participant
                    </a>
                    <form action="{{ route('event-fmg.convert', $eventFmgPatient->id) }}" method="POST" class="mt-2">
                        @csrf

                        <button type="submit" class="btn btn-success btn-block">
                            <i class="fas fa-user-plus mr-1"></i>
                            Convert to Patient
                        </button>
                    </form><br>

                    <a href="{{ route('event-fmg.index') }}" class="btn btn-secondary btn-block">
                        <i class="fas fa-list mr-1"></i>
                        Back to Participants
                    </a>

                </div>
            </div>

        </div>

    </div>

@stop
