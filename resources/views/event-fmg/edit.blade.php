@extends('adminlte::page')

@section('title', 'Edit Participant')

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

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show">
            <h5>
                <i class="fas fa-exclamation-triangle mr-1"></i>
                The participant could not be updated
            </h5>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
        </div>
    @endif

    <form action="{{ route('event-fmg.update', $eventFmgPatient->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">

            {{-- MAIN COLUMN --}}
            <div class="col-lg-8">

                {{-- Patient Information --}}
                <div class="card card-primary">

                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-user mr-1"></i>
                            Patient Information
                        </h3>
                    </div>

                    <div class="card-body">

                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">First Name <span class="text-danger">*</span></label>
                                    <input
                                        type="text"
                                        id="name"
                                        name="name"
                                        class="form-control @error('name') is-invalid @enderror"
                                        value="{{ old('name', $eventFmgPatient->name) }}"
                                        required
                                    >
                                    @error('name')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="last_name">Last Name <span class="text-danger">*</span></label>
                                    <input
                                        type="text"
                                        id="last_name"
                                        name="last_name"
                                        class="form-control @error('last_name') is-invalid @enderror"
                                        value="{{ old('last_name', $eventFmgPatient->last_name) }}"
                                        required
                                    >
                                    @error('last_name')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="date_of_birth">Date of Birth <span class="text-danger">*</span></label>
                                    <input
                                        type="date"
                                        id="date_of_birth"
                                        name="date_of_birth"
                                        class="form-control @error('date_of_birth') is-invalid @enderror"
                                        value="{{ old('date_of_birth', $eventFmgPatient->date_of_birth ? \Carbon\Carbon::parse($eventFmgPatient->date_of_birth)->format('Y-m-d') : '') }}"
                                        required
                                    >
                                    @error('date_of_birth')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="phone">Phone</label>
                                    <input
                                        type="text"
                                        id="phone"
                                        name="phone"
                                        class="form-control @error('phone') is-invalid @enderror"
                                        value="{{ old('phone', $eventFmgPatient->phone) }}"
                                    >
                                    @error('phone')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input
                                        type="email"
                                        id="email"
                                        name="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        value="{{ old('email', $eventFmgPatient->email) }}"
                                    >
                                    @error('email')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group mb-0">
                                    <label for="address">Address</label>
                                    <textarea
                                        id="address"
                                        name="address"
                                        class="form-control @error('address') is-invalid @enderror"
                                        rows="2"
                                    >{{ old('address', $eventFmgPatient->address) }}</textarea>
                                    @error('address')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                        </div>

                    </div>
                </div>

                {{-- Reason for Consultation --}}
                <div class="card card-info">

                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-notes-medical mr-1"></i>
                            Reason for Consultation
                        </h3>
                    </div>

                    <div class="card-body">

                        <div class="form-group">
                            <label for="reason">Reason for Visit</label>
                            <textarea
                                id="reason"
                                name="reason"
                                class="form-control"
                                rows="3"
                            >{{ old('reason', $eventFmgPatient->reason) }}</textarea>
                        </div>

                        {{-- CORRECCIÓN symptoms: null-safe antes del explode --}}
                        @php
                            $selectedSymptoms = old(
                                'symptoms',
                                $eventFmgPatient->symptoms
                                    ? array_filter(array_map('trim', explode(',', $eventFmgPatient->symptoms)))
                                    : []
                            );
                        @endphp

                        <label>Symptoms</label>
                        <div class="row">
                            @foreach ([
                                'Dolor abdominal' => 'Abdominal Pain',
                                'Fiebre'          => 'Fever',
                                'Vómito'          => 'Vomiting',
                                'Diarrea'         => 'Diarrhea',
                                'Ninguno'         => 'None of the Above',
                            ] as $symptomValue => $symptomLabel)
                                <div class="col-md-6">
                                    <div class="custom-control custom-checkbox mb-2">
                                        <input
                                            type="checkbox"
                                            class="custom-control-input"
                                            id="symptom_{{ $loop->index }}"
                                            name="symptoms[]"
                                            value="{{ $symptomValue }}"
                                            {{ in_array($symptomValue, (array) $selectedSymptoms) ? 'checked' : '' }}
                                        >
                                        <label class="custom-control-label" for="symptom_{{ $loop->index }}">
                                            {{ $symptomLabel }}
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="row mt-3">

                            <div class="col-md-6">
                                <div class="form-group mb-0">
                                    <label for="iv_type">Requested IV Treatment</label>
                                    <select id="iv_type" name="iv_type" class="form-control custom-select">
                                        <option value="">Select an option</option>
                                        @foreach ([
                                            'Custom IV'           => 'Custom IV',
                                            'Wellness Duo'        => 'IV Wellness Duo',
                                            'Energy Boost'        => 'IV Energy Boost',
                                            'Beauty Glow'         => 'IV Beauty Glow',
                                            'Hangover'            => 'IV Hangover',
                                            'Immune Boost'        => 'IV Immune Boost',
                                            'Immune master Boost' => 'IV Immune Master Boost',
                                            'Superdetox'          => 'IV Superdetox',
                                            'Sportpower'          => 'IV Sportpower',
                                            'Post op'             => 'IV Post-Op',
                                            'NAD'                 => 'IV NAD',
                                        ] as $ivValue => $ivLabel)
                                            <option
                                                value="{{ $ivValue }}"
                                                {{ old('iv_type', $eventFmgPatient->iv_type) === $ivValue ? 'selected' : '' }}
                                            >
                                                {{ $ivLabel }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">

                                {{-- CORRECCIÓN referral_source: null-safe antes del explode --}}
                                @php
                                    $selectedReferralSources = old(
                                        'referral_source',
                                        $eventFmgPatient->referral_source
                                            ? array_filter(array_map('trim', explode(',', $eventFmgPatient->referral_source)))
                                            : []
                                    );
                                @endphp

                                <label>How Did You Hear About Us?</label>
                                <div class="custom-control custom-checkbox mb-2">
                                    <input
                                        type="checkbox"
                                        class="custom-control-input"
                                        id="referral_instagram"
                                        name="referral_source[]"
                                        value="instagram"
                                        {{ in_array('instagram', (array) $selectedReferralSources) ? 'checked' : '' }}
                                    >
                                    <label class="custom-control-label" for="referral_instagram">Instagram</label>
                                </div>
                                <div class="custom-control custom-checkbox mb-2">
                                    <input
                                        type="checkbox"
                                        class="custom-control-input"
                                        id="referral_facebook"
                                        name="referral_source[]"
                                        value="facebook"
                                        {{ in_array('facebook', (array) $selectedReferralSources) ? 'checked' : '' }}
                                    >
                                    <label class="custom-control-label" for="referral_facebook">Facebook</label>
                                </div>
                                <div class="form-group mb-0 mt-2">
                                    <label for="referral_other">Other</label>
                                    <input
                                        type="text"
                                        id="referral_other"
                                        name="referral_other"
                                        class="form-control"
                                        value="{{ old('referral_other', $eventFmgPatient->referral_other) }}"
                                    >
                                </div>

                            </div>

                        </div>

                    </div>
                </div>

                {{-- Emergency Contact --}}
                <div class="card card-warning">

                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-phone-alt mr-1"></i>
                            Emergency Contact
                        </h3>
                    </div>

                    <div class="card-body">
                        <div class="row">

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="emergency_name">Name</label>
                                    <input
                                        type="text"
                                        id="emergency_name"
                                        name="emergency_name"
                                        class="form-control"
                                        value="{{ old('emergency_name', $eventFmgPatient->emergency_name) }}"
                                    >
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="emergency_relationship">Relationship</label>
                                    <input
                                        type="text"
                                        id="emergency_relationship"
                                        name="emergency_relationship"
                                        class="form-control"
                                        value="{{ old('emergency_relationship', $eventFmgPatient->emergency_relationship) }}"
                                    >
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="emergency_phone">Phone Number</label>
                                    <input
                                        type="text"
                                        id="emergency_phone"
                                        name="emergency_phone"
                                        class="form-control"
                                        value="{{ old('emergency_phone', $eventFmgPatient->emergency_phone) }}"
                                    >
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                {{-- Medical History --}}
                <div class="card card-danger">

                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-heartbeat mr-1"></i>
                            Medical History
                        </h3>
                    </div>

                    <div class="card-body">

                        <div class="row">

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="pregnant">Pregnant?</label>
                                    <select id="pregnant" name="pregnant" class="form-control">
                                        <option value="0" {{ (string) old('pregnant', $eventFmgPatient->pregnant) === '0' ? 'selected' : '' }}>No</option>
                                        <option value="1" {{ (string) old('pregnant', $eventFmgPatient->pregnant) === '1' ? 'selected' : '' }}>Yes</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="vitamins_intolerance">Vitamin Intolerance?</label>
                                    <select id="vitamins_intolerance" name="vitamins_intolerance" class="form-control">
                                        <option value="0" {{ (string) old('vitamins_intolerance', $eventFmgPatient->vitamins_intolerance) === '0' ? 'selected' : '' }}>No</option>
                                        <option value="1" {{ (string) old('vitamins_intolerance', $eventFmgPatient->vitamins_intolerance) === '1' ? 'selected' : '' }}>Yes</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="minerals_intolerance">Mineral Intolerance?</label>
                                    <select id="minerals_intolerance" name="minerals_intolerance" class="form-control">
                                        <option value="0" {{ (string) old('minerals_intolerance', $eventFmgPatient->minerals_intolerance) === '0' ? 'selected' : '' }}>No</option>
                                        <option value="1" {{ (string) old('minerals_intolerance', $eventFmgPatient->minerals_intolerance) === '1' ? 'selected' : '' }}>Yes</option>
                                    </select>
                                </div>
                            </div>

                        </div>

                        <hr>

                        <h5 class="mb-3">
                            <i class="fas fa-allergies mr-1"></i>
                            Allergies
                        </h5>

                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="allergy_medicine">Medication Allergies</label>
                                    <input
                                        type="text"
                                        id="allergy_medicine"
                                        name="allergy_medicine"
                                        class="form-control"
                                        value="{{ old('allergy_medicine', $eventFmgPatient->allergy_medicine) }}"
                                    >
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="allergy_food">Food Allergies</label>
                                    <input
                                        type="text"
                                        id="allergy_food"
                                        name="allergy_food"
                                        class="form-control"
                                        value="{{ old('allergy_food', $eventFmgPatient->allergy_food) }}"
                                    >
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="reaction">Allergic Reaction</label>
                                    <textarea
                                        id="reaction"
                                        name="reaction"
                                        class="form-control"
                                        rows="2"
                                    >{{ old('reaction', $eventFmgPatient->reaction) }}</textarea>
                                </div>
                            </div>

                        </div>

                        <hr>

                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group mb-md-0">
                                    <label for="medications">Current Medications</label>
                                    <textarea
                                        id="medications"
                                        name="medications"
                                        class="form-control"
                                        rows="4"
                                    >{{ old('medications', $eventFmgPatient->medications) }}</textarea>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group mb-0">
                                    <label for="supplements">Supplements</label>
                                    <textarea
                                        id="supplements"
                                        name="supplements"
                                        class="form-control"
                                        rows="4"
                                    >{{ old('supplements', $eventFmgPatient->supplements) }}</textarea>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>

            </div>

            {{-- SIDEBAR --}}
            <div class="col-lg-4">

                {{-- Participant Summary --}}
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
                                <span class="info-box-text">Participant Number</span>
                                <span class="info-box-number">#{{ $eventFmgPatient->id }}</span>
                            </div>
                        </div>

                        <div class="info-box bg-light">
                            <span class="info-box-icon">
                                <i class="fas fa-calendar-alt"></i>
                            </span>
                            <div class="info-box-content">
                                <span class="info-box-text">Registration Date</span>
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
                                <span class="info-box-text">Patient</span>
                                <span class="info-box-number">
                                    {{ $eventFmgPatient->name }} {{ $eventFmgPatient->last_name }}
                                </span>
                            </div>
                        </div>

                    </div>
                </div>

                {{-- Actions --}}
                <div class="card">

                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-save mr-1"></i>
                            Actions
                        </h3>
                    </div>

                    <div class="card-body">

                        <button type="submit" class="btn btn-primary btn-lg btn-block">
                            <i class="fas fa-save mr-1"></i>
                            Save Changes
                        </button>

                        <a
                            href="{{ route('event-fmg.show', $eventFmgPatient->id) }}"
                            class="btn btn-secondary btn-block"
                        >
                            <i class="fas fa-eye mr-1"></i>
                            View Participant
                        </a>

                        <a
                            href="{{ route('event-fmg.index') }}"
                            class="btn btn-secondary btn-block"
                        >
                            <i class="fas fa-list mr-1"></i>
                            Back to Participants
                        </a>

                    </div>
                </div>

            </div>

        </div>

    </form>

@stop