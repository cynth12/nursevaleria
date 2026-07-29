@extends('adminlte::page')

@section('title', 'Edit Consultation')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center flex-wrap">

        <div>
            <h1 class="mb-0">Edit Consultation</h1>

            <small class="text-muted">
                {{ $consultation->name }} {{ $consultation->last_name }}
                · Consultation #{{ $consultation->id }}
            </small>
        </div>

        <a
            href="{{ route('consultas.index', $consultation->patient_id) }}"
            class="btn btn-secondary mt-2 mt-md-0"
        >
            <i class="fas fa-arrow-left mr-1"></i>
            Return to consultations
        </a>

    </div>
@stop

@section('content')

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show">

            <h5>
                <i class="fas fa-exclamation-triangle mr-1"></i>
                The consultation could not be updated
            </h5>

            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>

            <button
                type="button"
                class="close"
                data-dismiss="alert"
            >
                <span>&times;</span>
            </button>

        </div>
    @endif

    <form
        action="{{ route('consultas.update', $consultation->id) }}"
        method="POST"
    >
        @csrf
        @method('PUT')

        <div class="row">

            {{-- MAIN COLUMN --}}
            <div class="col-lg-8">

                {{-- PATIENT INFORMATION --}}
                <div class="card card-primary">

                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-user-injured mr-1"></i>
                            Patient Information
                        </h3>
                    </div>

                    <div class="card-body">

                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">

                                    <label for="name">
                                        First Name <span class="text-danger">*</span>
                                    </label>

                                    <input
                                        type="text"
                                        id="name"
                                        name="name"
                                        class="form-control @error('name') is-invalid @enderror"
                                        value="{{ old('name', $consultation->name) }}"
                                        required
                                    >

                                    @error('name')
                                        <span class="invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror

                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">

                                    <label for="last_name">
                                        Last Name <span class="text-danger">*</span>
                                    </label>

                                    <input
                                        type="text"
                                        id="last_name"
                                        name="last_name"
                                        class="form-control @error('last_name') is-invalid @enderror"
                                        value="{{ old('last_name', $consultation->last_name) }}"
                                        required
                                    >

                                    @error('last_name')
                                        <span class="invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror

                                </div>
                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-4">
                                <div class="form-group">

                                    <label for="date_of_birth">
                                        Date of Birth <span class="text-danger">*</span>
                                    </label>

                                    <input
                                        type="date"
                                        id="date_of_birth"
                                        name="date_of_birth"
                                        class="form-control @error('date_of_birth') is-invalid @enderror"
                                        value="{{ old('date_of_birth', $consultation->date_of_birth) }}"
                                        required
                                    >

                                    @error('date_of_birth')
                                        <span class="invalid-feedback">
                                            {{ $message }}
                                        </span>
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
                                        value="{{ old('phone', $consultation->phone) }}"
                                    >

                                    @error('phone')
                                        <span class="invalid-feedback">
                                            {{ $message }}
                                        </span>
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
                                        value="{{ old('email', $consultation->email) }}"
                                    >

                                    @error('email')
                                        <span class="invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror

                                </div>
                            </div>

                        </div>

                        <div class="form-group mb-0">

                            <label for="address">Address</label>

                            <textarea
                                id="address"
                                name="address"
                                class="form-control @error('address') is-invalid @enderror"
                                rows="2"
                            >{{ old('address', $consultation->address) }}</textarea>

                            @error('address')
                                <span class="invalid-feedback">
                                    {{ $message }}
                                </span>
                            @enderror

                        </div>

                    </div>
                </div>

                {{-- EMERGENCY CONTACT --}}
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

                                    <label for="emergency_name">
                                        Contact Name
                                    </label>

                                    <input
                                        type="text"
                                        id="emergency_name"
                                        name="emergency_name"
                                        class="form-control"
                                        value="{{ old('emergency_name', $consultation->emergency_name) }}"
                                    >

                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">

                                    <label for="emergency_relationship">
                                        Relationship
                                    </label>

                                    <input
                                        type="text"
                                        id="emergency_relationship"
                                        name="emergency_relationship"
                                        class="form-control"
                                        value="{{ old('emergency_relationship', $consultation->emergency_relationship) }}"
                                    >

                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">

                                    <label for="emergency_phone">
                                        Phone
                                    </label>

                                    <input
                                        type="text"
                                        id="emergency_phone"
                                        name="emergency_phone"
                                        class="form-control"
                                        value="{{ old('emergency_phone', $consultation->emergency_phone) }}"
                                    >

                                </div>
                            </div>

                        </div>

                    </div>
                </div>

                {{-- REASON FOR VISIT --}}
                <div class="card card-info">

                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-notes-medical mr-1"></i>
                            Reason for Visit
                        </h3>
                    </div>

                    <div class="card-body">

                        <div class="form-group">

                            <label for="reason">
                                Reason for Visit
                            </label>

                            <textarea
                                id="reason"
                                name="reason"
                                class="form-control"
                                rows="3"
                            >{{ old('reason', $consultation->reason) }}</textarea>

                        </div>

                        @php
                            $selectedSymptoms = old(
                                'symptoms',
                                array_filter(
                                    array_map(
                                        'trim',
                                        explode(',', (string) $consultation->symptoms)
                                    )
                                )
                            );
                        @endphp

                        <label>Symptoms</label>

                        <div class="row">

                            @foreach ([
                                'Dolor abdominal' => 'Abdominal Pain',
                                'Fiebre' => 'Fever',
                                'Vómito' => 'Vomiting',
                                'Diarrea' => 'Diarrhea',
                                'Ninguno' => 'None of the Above'
                            ] as $symptomValue => $symptomLabel)

                                <div class="col-md-6">

                                    <div class="custom-control custom-checkbox mb-2">

                                        <input
                                            type="checkbox"
                                            class="custom-control-input"
                                            id="symptom_{{ $loop->index }}"
                                            name="symptoms[]"
                                            value="{{ $symptomValue }}"
                                            {{ in_array($symptomValue, $selectedSymptoms) ? 'checked' : '' }}
                                        >

                                        <label
                                            class="custom-control-label"
                                            for="symptom_{{ $loop->index }}"
                                        >
                                            {{ $symptomLabel }}
                                        </label>

                                    </div>

                                </div>

                            @endforeach

                        </div>

                    </div>
                </div>

                {{-- REFERRAL SOURCE --}}
                <div class="card card-outline card-info">

                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-bullhorn mr-1"></i>
                            How Did the Patient Hear About Us?
                        </h3>
                    </div>

                    <div class="card-body">

                        @php
                            $referralValue = (string) old(
                                'referral_source_text',
                                $consultation->referral_source
                            );

                            $selectedReferralSources = old(
                                'referral_source',
                                array_filter(
                                    array_map(
                                        'trim',
                                        explode(',', $referralValue)
                                    )
                                )
                            );
                        @endphp

                        <div class="row">

                            <div class="col-md-3">

                                <div class="custom-control custom-checkbox mb-3">

                                    <input
                                        type="checkbox"
                                        class="custom-control-input"
                                        id="referral_instagram"
                                        name="referral_source[]"
                                        value="instagram"
                                        {{ in_array('instagram', $selectedReferralSources) ? 'checked' : '' }}
                                    >

                                    <label
                                        class="custom-control-label"
                                        for="referral_instagram"
                                    >
                                        Instagram
                                    </label>

                                </div>

                            </div>

                            <div class="col-md-3">

                                <div class="custom-control custom-checkbox mb-3">

                                    <input
                                        type="checkbox"
                                        class="custom-control-input"
                                        id="referral_facebook"
                                        name="referral_source[]"
                                        value="facebook"
                                        {{ in_array('facebook', $selectedReferralSources) ? 'checked' : '' }}
                                    >

                                    <label
                                        class="custom-control-label"
                                        for="referral_facebook"
                                    >
                                        Facebook
                                    </label>

                                </div>

                            </div>

                            <div class="col-md-6">

                                <div class="form-group mb-0">

                                    <label for="referral_other">
                                        Other
                                    </label>

                                    <input
                                        type="text"
                                        id="referral_other"
                                        name="referral_other"
                                        class="form-control"
                                        value="{{ old('referral_other', $consultation->referral_other) }}"
                                    >

                                </div>

                            </div>

                        </div>

                    </div>
                </div>

                {{-- IV REQUEST --}}
                <div class="card card-primary">

                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-prescription-bottle-alt mr-1"></i>
                            Requested IV Therapy
                        </h3>
                    </div>

                    <div class="card-body">

                        <div class="alert alert-light border">

                            <i class="fas fa-info-circle text-info mr-1"></i>

                            The requested IV therapy may be adjusted after the
                            professional nursing evaluation.

                        </div>

                        <div class="form-group mb-0">

                            <label for="iv_type">
                                IV Therapy
                            </label>

                            <select
                                id="iv_type"
                                name="iv_type"
                                class="form-control custom-select"
                            >
                                <option value="">Select an option</option>

                                @foreach ([
                                    'Custom IV' => 'Custom IV',
                                    'Wellness Duo' => 'IV Wellness Duo',
                                    'Energy Boost' => 'IV Energy Boost',
                                    'Beauty Glow' => 'IV Beauty Glow',
                                    'Hangover' => 'IV Hangover',
                                    'Immune Boost' => 'IV Immune Boost',
                                    'Immune master Boost' => 'IV Immune Master Boost',
                                    'Superdetox' => 'IV Superdetox',
                                    'Sportpower' => 'IV Sportpower',
                                    'Post op' => 'IV Post-Op',
                                    'NAD' => 'IV NAD'
                                ] as $ivValue => $ivLabel)

                                    <option
                                        value="{{ $ivValue }}"
                                        {{ old('iv_type', $consultation->iv_type) === $ivValue ? 'selected' : '' }}
                                    >
                                        {{ $ivLabel }}
                                    </option>

                                @endforeach
                            </select>

                        </div>

                    </div>
                </div>

                {{-- MEDICAL HISTORY --}}
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

                                    <label for="pregnant">
                                        Pregnant or Possibly Pregnant?
                                    </label>

                                    <select
                                        id="pregnant"
                                        name="pregnant"
                                        class="form-control"
                                    >
                                        <option
                                            value="0"
                                            {{ (string) old('pregnant', $consultation->pregnant) === '0' ? 'selected' : '' }}
                                        >
                                            No
                                        </option>

                                        <option
                                            value="1"
                                            {{ (string) old('pregnant', $consultation->pregnant) === '1' ? 'selected' : '' }}
                                        >
                                            Yes
                                        </option>
                                    </select>

                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">

                                    <label for="vitamins_intolerance">
                                        Vitamin Intolerance?
                                    </label>

                                    <select
                                        id="vitamins_intolerance"
                                        name="vitamins_intolerance"
                                        class="form-control"
                                    >
                                        <option
                                            value="0"
                                            {{ (string) old('vitamins_intolerance', $consultation->vitamins_intolerance) === '0' ? 'selected' : '' }}
                                        >
                                            No
                                        </option>

                                        <option
                                            value="1"
                                            {{ (string) old('vitamins_intolerance', $consultation->vitamins_intolerance) === '1' ? 'selected' : '' }}
                                        >
                                            Yes
                                        </option>
                                    </select>

                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">

                                    <label for="minerals_intolerance">
                                        Mineral Intolerance?
                                    </label>

                                    <select
                                        id="minerals_intolerance"
                                        name="minerals_intolerance"
                                        class="form-control"
                                    >
                                        <option
                                            value="0"
                                            {{ (string) old('minerals_intolerance', $consultation->minerals_intolerance) === '0' ? 'selected' : '' }}
                                        >
                                            No
                                        </option>

                                        <option
                                            value="1"
                                            {{ (string) old('minerals_intolerance', $consultation->minerals_intolerance) === '1' ? 'selected' : '' }}
                                        >
                                            Yes
                                        </option>
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

                                    <label for="allergy_medicine">
                                        Medication Allergies
                                    </label>

                                    <input
                                        type="text"
                                        id="allergy_medicine"
                                        name="allergy_medicine"
                                        class="form-control"
                                        value="{{ old('allergy_medicine', $consultation->allergy_medicine) }}"
                                    >

                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">

                                    <label for="allergy_food">
                                        Food Allergies
                                    </label>

                                    <input
                                        type="text"
                                        id="allergy_food"
                                        name="allergy_food"
                                        class="form-control"
                                        value="{{ old('allergy_food', $consultation->allergy_food) }}"
                                    >

                                </div>
                            </div>

                        </div>

                        <div class="form-group">

                            <label for="reaction">
                                Allergic Reaction
                            </label>

                            <textarea
                                id="reaction"
                                name="reaction"
                                class="form-control"
                                rows="2"
                            >{{ old('reaction', $consultation->reaction) }}</textarea>

                        </div>

                        <hr>

                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group mb-md-0">

                                    <label for="medications">
                                        Current Medications
                                    </label>

                                    <textarea
                                        id="medications"
                                        name="medications"
                                        class="form-control"
                                        rows="4"
                                    >{{ old('medications', $consultation->medications) }}</textarea>

                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group mb-0">

                                    <label for="supplements">
                                        Current Supplements
                                    </label>

                                    <textarea
                                        id="supplements"
                                        name="supplements"
                                        class="form-control"
                                        rows="4"
                                    >{{ old('supplements', $consultation->supplements) }}</textarea>

                                </div>
                            </div>

                        </div>

                    </div>
                </div>

                {{-- VITAL SIGNS --}}
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
                                <div class="form-group">

                                    <label for="pre_heart_rate">
                                        Heart Rate
                                    </label>

                                    <div class="input-group">

                                        <input
                                            type="number"
                                            id="pre_heart_rate"
                                            name="pre_heart_rate"
                                            class="form-control"
                                            value="{{ old('pre_heart_rate', $consultation->pre_heart_rate) }}"
                                        >

                                        <div class="input-group-append">
                                            <span class="input-group-text">bpm</span>
                                        </div>

                                    </div>

                                </div>
                            </div>

                            <div class="col-md-6 col-xl-3">
                                <div class="form-group">

                                    <label for="pre_oxygen_saturation">
                                        O₂ Saturation
                                    </label>

                                    <div class="input-group">

                                        <input
                                            type="number"
                                            id="pre_oxygen_saturation"
                                            name="pre_oxygen_saturation"
                                            class="form-control"
                                            value="{{ old('pre_oxygen_saturation', $consultation->pre_oxygen_saturation) }}"
                                        >

                                        <div class="input-group-append">
                                            <span class="input-group-text">%</span>
                                        </div>

                                    </div>

                                </div>
                            </div>

                            <div class="col-md-6 col-xl-3">
                                <div class="form-group">

                                    <label for="pre_temperature">
                                        Temperature
                                    </label>

                                    <div class="input-group">

                                        <input
                                            type="number"
                                            step="0.1"
                                            id="pre_temperature"
                                            name="pre_temperature"
                                            class="form-control"
                                            value="{{ old('pre_temperature', $consultation->pre_temperature) }}"
                                        >

                                        <div class="input-group-append">
                                            <span class="input-group-text">°C</span>
                                        </div>

                                    </div>

                                </div>
                            </div>

                            <div class="col-md-6 col-xl-3">
                                <div class="form-group">

                                    <label for="pre_blood_pressure">
                                        Blood Pressure
                                    </label>

                                    <input
                                        type="text"
                                        id="pre_blood_pressure"
                                        name="pre_blood_pressure"
                                        class="form-control"
                                        placeholder="120/80"
                                        value="{{ old('pre_blood_pressure', $consultation->pre_blood_pressure) }}"
                                    >

                                </div>
                            </div>

                        </div>

                        <hr>

                        <h5 class="mb-3">
                            After the Procedure
                        </h5>

                        <div class="row">

                            <div class="col-md-6 col-xl-3">
                                <div class="form-group">

                                    <label for="heart_rate">
                                        Heart Rate
                                    </label>

                                    <div class="input-group">

                                        <input
                                            type="number"
                                            id="heart_rate"
                                            name="heart_rate"
                                            class="form-control"
                                            value="{{ old('heart_rate', $consultation->heart_rate) }}"
                                        >

                                        <div class="input-group-append">
                                            <span class="input-group-text">bpm</span>
                                        </div>

                                    </div>

                                </div>
                            </div>

                            <div class="col-md-6 col-xl-3">
                                <div class="form-group">

                                    <label for="oxygen_saturation">
                                        O₂ Saturation
                                    </label>

                                    <div class="input-group">

                                        <input
                                            type="number"
                                            id="oxygen_saturation"
                                            name="oxygen_saturation"
                                            class="form-control"
                                            value="{{ old('oxygen_saturation', $consultation->oxygen_saturation) }}"
                                        >

                                        <div class="input-group-append">
                                            <span class="input-group-text">%</span>
                                        </div>

                                    </div>

                                </div>
                            </div>

                            <div class="col-md-6 col-xl-3">
                                <div class="form-group">

                                    <label for="temperature">
                                        Temperature
                                    </label>

                                    <div class="input-group">

                                        <input
                                            type="number"
                                            step="0.1"
                                            id="temperature"
                                            name="temperature"
                                            class="form-control"
                                            value="{{ old('temperature', $consultation->temperature) }}"
                                        >

                                        <div class="input-group-append">
                                            <span class="input-group-text">°C</span>
                                        </div>

                                    </div>

                                </div>
                            </div>

                            <div class="col-md-6 col-xl-3">
                                <div class="form-group">

                                    <label for="blood_pressure">
                                        Blood Pressure
                                    </label>

                                    <input
                                        type="text"
                                        id="blood_pressure"
                                        name="blood_pressure"
                                        class="form-control"
                                        placeholder="120/80"
                                        value="{{ old('blood_pressure', $consultation->blood_pressure) }}"
                                    >

                                </div>
                            </div>

                        </div>

                    </div>
                </div>

                {{-- TREATMENT --}}
                <div class="card card-primary">

                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-syringe mr-1"></i>
                            Treatment
                        </h3>
                    </div>

                    <div class="card-body">

                        <div class="form-group">

                            <label for="treatment_id">
                                Treatment
                            </label>

                            <select
                                id="treatment_id"
                                name="treatment_id"
                                class="form-control"
                            >
                                <option value="">Select a treatment</option>

                                @foreach ($treatments as $treatment)

                                    <option
                                        value="{{ $treatment->id }}"
                                        data-description="{{ $treatment->description }}"
                                        data-formula="{{ $treatment->formula }}"
                                        {{ (string) old('treatment_id', $consultation->treatment_id) === (string) $treatment->id ? 'selected' : '' }}
                                    >
                                        {{ $treatment->name }}
                                    </option>

                                @endforeach
                            </select>

                        </div>

                        <div class="form-group">

                            <label for="treatment_description">
                                Treatment Description
                            </label>

                            <textarea
                                id="treatment_description"
                                name="treatment_description"
                                class="form-control"
                                rows="4"
                            >{{ old('treatment_description', $consultation->treatment_description) }}</textarea>

                        </div>

                        <div class="form-group mb-0">

                            <label for="treatment_formula">
                                Treatment Formula
                            </label>

                            <textarea
                                id="treatment_formula"
                                name="treatment_formula"
                                class="form-control"
                                rows="7"
                            >{{ old('treatment_formula', $consultation->treatment_formula) }}</textarea>

                        </div>

                    </div>
                </div>

                {{-- NOTES --}}
                <div class="card card-secondary">

                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-clipboard mr-1"></i>
                            Clinical Notes
                        </h3>
                    </div>

                    <div class="card-body">

                        <textarea
                            id="notes"
                            name="notes"
                            class="form-control"
                            rows="7"
                            placeholder="Write clinical observations, procedure details or follow-up recommendations..."
                        >{{ old('notes', $consultation->notes) }}</textarea>

                    </div>
                </div>

            </div>

            {{-- SIDE COLUMN --}}
            <div class="col-lg-4">

                {{-- CONSULTATION SUMMARY --}}
                <div class="card">

                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-clipboard-list mr-1"></i>
                            Consultation Summary
                        </h3>
                    </div>

                    <div class="card-body">

                        <div class="info-box bg-light">

                            <span class="info-box-icon">
                                <i class="fas fa-hashtag"></i>
                            </span>

                            <div class="info-box-content">

                                <span class="info-box-text">
                                    Consultation
                                </span>

                                <span class="info-box-number">
                                    #{{ $consultation->id }}
                                </span>

                            </div>
                        </div>

                        <div class="info-box bg-light">

                            <span class="info-box-icon">
                                <i class="fas fa-user"></i>
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

                {{-- REGISTRATION --}}
                <div class="card card-outline card-primary">

                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-calendar-alt mr-1"></i>
                            Registration
                        </h3>
                    </div>

                    <div class="card-body">

                        <div class="form-group">

                            <label for="registration_date">
                                Registration Date
                            </label>

                            <input
                                type="datetime-local"
                                id="registration_date"
                                name="registration_date"
                                class="form-control"
                                value="{{ old(
                                    'registration_date',
                                    $consultation->registration_date
                                        ? \Carbon\Carbon::parse($consultation->registration_date)->format('Y-m-d\TH:i')
                                        : ''
                                ) }}"
                            >

                        </div>

                        <div class="form-group mb-0">

                            <label for="group_id">
                                Patient Group
                            </label>

                            <select
                                id="group_id"
                                name="group_id"
                                class="form-control"
                            >
                                <option value="">No group</option>

                                @foreach ($groups as $group)

                                    <option
                                        value="{{ $group->id }}"
                                        {{ (string) old('group_id', $patient->group_id ?? '') === (string) $group->id ? 'selected' : '' }}
                                    >
                                        {{ $group->place }}
                                    </option>

                                @endforeach
                            </select>

                        </div>

                    </div>
                </div>

                {{-- CONSENT --}}
                <div class="card card-outline card-secondary">

                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-file-signature mr-1"></i>
                            Informed Consent
                        </h3>
                    </div>

                    <div class="card-body">

                        <div class="form-group">

                            <label for="consent_accepted">
                                Consent Status
                            </label>

                            <select
                                id="consent_accepted"
                                name="consent_accepted"
                                class="form-control"
                            >
                                <option
                                    value="1"
                                    {{ (string) old('consent_accepted', $consultation->consent_accepted) === '1' ? 'selected' : '' }}
                                >
                                    Accepted
                                </option>

                                <option
                                    value="0"
                                    {{ (string) old('consent_accepted', $consultation->consent_accepted) === '0' ? 'selected' : '' }}
                                >
                                    Not Accepted
                                </option>
                            </select>

                        </div>

                        <div class="form-group mb-0">

                            <label for="authorized_procedure">
                                Authorized Procedure
                            </label>

                            <textarea
                                id="authorized_procedure"
                                name="authorized_procedure"
                                class="form-control"
                                rows="4"
                            >{{ old('authorized_procedure', $consultation->authorized_procedure) }}</textarea>

                        </div>

                    </div>
                </div>

                {{-- ACTIONS --}}
                <div class="card">

                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-save mr-1"></i>
                            Actions
                        </h3>
                    </div>

                    <div class="card-body">

                        <button
                            type="submit"
                            class="btn btn-primary btn-lg btn-block"
                        >
                            <i class="fas fa-save mr-1"></i>
                            Save Changes
                        </button>

                        <a
                            href="{{ route('consultas.index', $consultation->patient_id) }}"
                            class="btn btn-secondary btn-block"
                        >
                            <i class="fas fa-list mr-1"></i>
                            Consultation History
                        </a>

                        @if (
                            $consultation->patient &&
                            $consultation->patient->group
                        )

                            <a
                                href="{{ route(
                                    'grupos.show',
                                    $consultation->patient->group->id
                                ) }}"
                                class="btn btn-info btn-block"
                            >
                                <i class="fas fa-users mr-1"></i>
                                Return to Group
                            </a>

                        @endif

                    </div>
                </div>

            </div>

        </div>

    </form>

@stop

@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const treatmentSelect =
                document.getElementById('treatment_id');

            const descriptionField =
                document.getElementById('treatment_description');

            const formulaField =
                document.getElementById('treatment_formula');

            if (
                !treatmentSelect ||
                !descriptionField ||
                !formulaField
            ) {
                return;
            }

            treatmentSelect.addEventListener('change', function () {

                const selectedOption =
                    treatmentSelect.options[
                        treatmentSelect.selectedIndex
                    ];

                if (!treatmentSelect.value) {
                    return;
                }

                descriptionField.value =
                    selectedOption.dataset.description || '';

                formulaField.value =
                    selectedOption.dataset.formula || '';

            });

        });
    </script>
@stop