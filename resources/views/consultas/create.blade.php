@extends('adminlte::page')

@section('title', 'New Consultation')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center flex-wrap">
        <div>
            <h1 class="mb-0">New Consultation</h1>
            <small class="text-muted">
                Create a new clinical consultation for
                {{ $patient->name }} {{ $patient->last_name }}
            </small>
        </div>

        <a href="{{ route('consultas.index', $patient->id) }}"
           class="btn btn-secondary mt-2 mt-md-0">
            <i class="fas fa-arrow-left mr-1"></i>
            Return to Consultation List
        </a>
    </div>
@endsection

@section('content')

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show">
            <h5>
                <i class="fas fa-exclamation-triangle mr-1"></i>
                Please correct the following errors:
            </h5>

            <ul class="mb-0 pl-3">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>

            <button type="button"
                    class="close"
                    data-dismiss="alert">
                <span>&times;</span>
            </button>
        </div>
    @endif

    <form action="{{ route('consultas.store', $patient->id) }}"
          method="POST">

        @csrf

        <div class="row">

            {{-- MAIN COLUMN --}}
            <div class="col-lg-9">

                {{-- PATIENT INFORMATION --}}
                <div class="card card-info">
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
                                        Name
                                        <span class="text-danger">*</span>
                                    </label>

                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-user"></i>
                                            </span>
                                        </div>

                                        <input type="text"
                                               id="name"
                                               name="name"
                                               class="form-control @error('name') is-invalid @enderror"
                                               value="{{ old('name', $patient->name) }}"
                                               required>

                                        @error('name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="last_name">
                                        Last Name
                                        <span class="text-danger">*</span>
                                    </label>

                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-user"></i>
                                            </span>
                                        </div>

                                        <input type="text"
                                               id="last_name"
                                               name="last_name"
                                               class="form-control @error('last_name') is-invalid @enderror"
                                               value="{{ old('last_name', $patient->last_name) }}"
                                               required>

                                        @error('last_name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="date_of_birth">
                                        Date of Birth
                                        <span class="text-danger">*</span>
                                    </label>

                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-birthday-cake"></i>
                                            </span>
                                        </div>

                                        <input type="date"
                                               id="date_of_birth"
                                               name="date_of_birth"
                                               class="form-control @error('date_of_birth') is-invalid @enderror"
                                               value="{{ old('date_of_birth', $patient->date_of_birth) }}"
                                               required>

                                        @error('date_of_birth')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="phone">Phone</label>

                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-phone"></i>
                                            </span>
                                        </div>

                                        <input type="text"
                                               id="phone"
                                               name="phone"
                                               class="form-control @error('phone') is-invalid @enderror"
                                               value="{{ old('phone', $patient->phone) }}">

                                        @error('phone')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="email">Email</label>

                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-envelope"></i>
                                            </span>
                                        </div>

                                        <input type="email"
                                               id="email"
                                               name="email"
                                               class="form-control @error('email') is-invalid @enderror"
                                               value="{{ old('email', $patient->email) }}">

                                        @error('email')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                {{-- EMERGENCY CONTACT --}}
                <div class="card card-danger">
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

                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-user-friends"></i>
                                            </span>
                                        </div>

                                        <input type="text"
                                               id="emergency_name"
                                               name="emergency_name"
                                               class="form-control"
                                               value="{{ old('emergency_name', $patient->emergency_name) }}">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="emergency_relationship">
                                        Relationship
                                    </label>

                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-users"></i>
                                            </span>
                                        </div>

                                        <input type="text"
                                               id="emergency_relationship"
                                               name="emergency_relationship"
                                               class="form-control"
                                               value="{{ old('emergency_relationship', $patient->emergency_relationship) }}">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="emergency_phone">
                                        Contact Phone
                                    </label>

                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-phone"></i>
                                            </span>
                                        </div>

                                        <input type="text"
                                               id="emergency_phone"
                                               name="emergency_phone"
                                               class="form-control"
                                               value="{{ old('emergency_phone', $patient->emergency_phone) }}">
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group mb-0">
                                    <label for="address">Address</label>

                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-map-marker-alt"></i>
                                            </span>
                                        </div>

                                        <input type="address"
                                               id="address"
                                               name="address"
                                               class="form-control"
                                               value="{{ old('address', $patient->address) }}">
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                {{-- REFERRAL SOURCE --}}
                <div class="card card-secondary">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-bullhorn mr-1"></i>
                            How Did You Hear About Us?
                        </h3>
                    </div>

                    <div class="card-body">
                        <div class="row align-items-end">

                            <div class="col-md-5">
                                <label class="checkbox-card">
                                    <input type="checkbox"
                                           name="referral_source[]"
                                           value="instagram"
                                           {{ str_contains($patient->referral_source, 'instagram') ? 'checked' : '' }}>

                                    <span class="checkbox-icon">
                                        <i class="fab fa-instagram"></i>
                                    </span>

                                    <span>Instagram</span>
                                </label>
                            </div>

                            <div class="col-md-5">
                                <label class="checkbox-card">
                                    <input type="checkbox"
                                           name="referral_source[]"
                                           value="facebook"
                                           {{ str_contains($patient->referral_source, 'facebook') ? 'checked' : '' }}>

                                    <span class="checkbox-icon">
                                        <i class="fab fa-facebook-f"></i>
                                    </span>

                                    <span>Facebook</span>
                                </label>
                            </div>

                            <div class="col-md-12 mt-3">
                                <div class="form-group mb-0">
                                    <label for="referral_other">
                                        Other Referral Source
                                    </label>

                                    <input type="text"
                                           id="referral_other"
                                           name="referral_other"
                                           class="form-control"
                                           value="{{ old('referral_other', $patient->referral_other) }}">
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                {{-- REASON AND SYMPTOMS --}}
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-notes-medical mr-1"></i>
                            Reason for Visit and Symptoms
                        </h3>
                    </div>

                    <div class="card-body">

                        <div class="form-group">
                            <label for="reason">Reason for Visit</label>

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fas fa-comment-medical"></i>
                                    </span>
                                </div>

                                <input type="text"
                                       id="reason"
                                       name="reason"
                                       class="form-control"
                                       value="{{ old('reason', $patient->reason) }}">
                            </div>
                        </div>

                        <label class="mb-3">Symptoms</label>

                        <div class="row">

                            <div class="col-md-6 col-xl-4">
                                <label class="checkbox-card">
                                    <input type="checkbox"
                                           name="symptoms[]"
                                           value="Dolor abdominal"
                                           {{ str_contains($patient->symptoms, 'Dolor abdominal') ? 'checked' : '' }}>

                                    <span class="checkbox-icon">
                                        <i class="fas fa-stomach"></i>
                                    </span>

                                    <span>Abdominal Pains</span>
                                </label>
                            </div>

                            <div class="col-md-6 col-xl-4">
                                <label class="checkbox-card">
                                    <input type="checkbox"
                                           name="symptoms[]"
                                           value="Fiebre"
                                           {{ str_contains($patient->symptoms, 'Fiebre') ? 'checked' : '' }}>

                                    <span class="checkbox-icon">
                                        <i class="fas fa-thermometer-three-quarters"></i>
                                    </span>

                                    <span>Fever</span>
                                </label>
                            </div>

                            <div class="col-md-6 col-xl-4">
                                <label class="checkbox-card">
                                    <input type="checkbox"
                                           name="symptoms[]"
                                           value="Vómito"
                                           {{ str_contains($patient->symptoms, 'Vómito') ? 'checked' : '' }}>

                                    <span class="checkbox-icon">
                                        <i class="fas fa-head-side-cough"></i>
                                    </span>

                                    <span>Vomiting</span>
                                </label>
                            </div>

                            <div class="col-md-6 col-xl-4">
                                <label class="checkbox-card">
                                    <input type="checkbox"
                                           name="symptoms[]"
                                           value="Diarrea"
                                           {{ str_contains($patient->symptoms, 'Diarrea') ? 'checked' : '' }}>

                                    <span class="checkbox-icon">
                                        <i class="fas fa-procedures"></i>
                                    </span>

                                    <span>Diarrhea</span>
                                </label>
                            </div>

                            <div class="col-md-6 col-xl-4">
                                <label class="checkbox-card">
                                    <input type="checkbox"
                                           name="symptoms[]"
                                           value="Ninguno"
                                           {{ str_contains($patient->symptoms, 'Ninguno') ? 'checked' : '' }}>

                                    <span class="checkbox-icon">
                                        <i class="fas fa-check"></i>
                                    </span>

                                    <span>None of the Above</span>
                                </label>
                            </div>

                        </div>
                    </div>
                </div>

                {{-- REQUESTED IV --}}
                <div class="card card-warning">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-syringe mr-1"></i>
                            Requested IV Therapy
                        </h3>
                    </div>

                    <div class="card-body">

                        <div class="alert alert-info">
                            <i class="fas fa-info-circle mr-1"></i>

                            Nurse Valeria will perform a professional evaluation.
                            Based on that evaluation, the patient may not receive
                            the IV therapy initially requested.
                        </div>

                        <div class="form-group mb-0">
                            <label for="iv_type">
                                Which IV Would You Like to Request?
                            </label>

                            <select id="iv_type"
                                    name="iv_type"
                                    class="form-control custom-select">

                                <option value="">Select...</option>

                                <option value="Custom IV"
                                    {{ $patient->iv_type == 'Custom IV' ? 'selected' : '' }}>
                                    Custom IV
                                </option>

                                <option value="Wellness Duo"
                                    {{ $patient->iv_type == 'Wellness Duo' ? 'selected' : '' }}>
                                    IV Wellness Duo
                                </option>

                                <option value="Energy Boost"
                                    {{ $patient->iv_type == 'Energy Boost' ? 'selected' : '' }}>
                                    IV Energy Boost
                                </option>

                                <option value="Beauty Glow"
                                    {{ $patient->iv_type == 'Beauty Glow' ? 'selected' : '' }}>
                                    IV Beauty Glow
                                </option>

                                <option value="Hangover"
                                    {{ $patient->iv_type == 'Hangover' ? 'selected' : '' }}>
                                    IV Hangover
                                </option>

                                <option value="Immune Boost"
                                    {{ $patient->iv_type == 'Immune Boost' ? 'selected' : '' }}>
                                    IV Immune Boost
                                </option>

                                <option value="Immune master Boost"
                                    {{ $patient->iv_type == 'Immune master Boost' ? 'selected' : '' }}>
                                    IV Immune Master Boost
                                </option>

                                <option value="Superdetox"
                                    {{ $patient->iv_type == 'Superdetox' ? 'selected' : '' }}>
                                    IV Superdetox
                                </option>

                                <option value="Sportpower"
                                    {{ $patient->iv_type == 'Sportpower' ? 'selected' : '' }}>
                                    IV Sportpower
                                </option>

                                <option value="Post op"
                                    {{ $patient->iv_type == 'Post op' ? 'selected' : '' }}>
                                    IV Post Op
                                </option>

                                <option value="NAD"
                                    {{ $patient->iv_type == 'NAD' ? 'selected' : '' }}>
                                    IV NAD
                                </option>

                            </select>
                        </div>

                    </div>
                </div>

                {{-- MEDICAL HISTORY --}}
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-file-medical mr-1"></i>
                            Medical History
                        </h3>
                    </div>

                    <div class="card-body">
                        <div class="row">

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="pregnant">
                                        Are you, or could you be pregnant?
                                    </label>

                                    <select id="pregnant"
                                            name="pregnant"
                                            class="form-control">

                                        <option value="1"
                                            {{ $patient->pregnant ? 'selected' : '' }}>
                                            Yes
                                        </option>

                                        <option value="0"
                                            {{ !$patient->pregnant ? 'selected' : '' }}>
                                            No
                                        </option>

                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="vitamins_intolerance">
                                        Intolerance to vitamins?
                                    </label>

                                    <select id="vitamins_intolerance"
                                            name="vitamins_intolerance"
                                            class="form-control">

                                        <option value="1"
                                            {{ $patient->vitamins_intolerance ? 'selected' : '' }}>
                                            Yes
                                        </option>

                                        <option value="0"
                                            {{ !$patient->vitamins_intolerance ? 'selected' : '' }}>
                                            No
                                        </option>

                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="minerals_intolerance">
                                        Intolerance to minerals?
                                    </label>

                                    <select id="minerals_intolerance"
                                            name="minerals_intolerance"
                                            class="form-control">

                                        <option value="1"
                                            {{ $patient->minerals_intolerance ? 'selected' : '' }}>
                                            Yes
                                        </option>

                                        <option value="0"
                                            {{ !$patient->minerals_intolerance ? 'selected' : '' }}>
                                            No
                                        </option>

                                    </select>
                                </div>
                            </div>

                        </div>

                        <hr>

                        <h5 class="section-subtitle">
                            <i class="fas fa-allergies mr-1"></i>
                            Allergies
                        </h5>

                        <div class="row">

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="allergy_medicine">
                                        Medications
                                    </label>

                                    <input type="text"
                                           id="allergy_medicine"
                                           name="allergy_medicine"
                                           class="form-control"
                                           value="{{ old('allergy_medicine', $patient->allergy_medicine) }}">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="allergy_food">Food</label>

                                    <input type="text"
                                           id="allergy_food"
                                           name="allergy_food"
                                           class="form-control"
                                           value="{{ old('allergy_food', $patient->allergy_food) }}">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="reaction">Reaction</label>

                                    <input type="text"
                                           id="reaction"
                                           name="reaction"
                                           class="form-control"
                                           value="{{ old('reaction', $patient->reaction) }}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="medications">
                                        Current Medications
                                    </label>

                                    <textarea id="medications"
                                              name="medications"
                                              class="form-control"
                                              rows="4">{{ old('medications', $patient->medications) }}</textarea>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="supplements">
                                        Current Supplements
                                    </label>

                                    <textarea id="supplements"
                                              name="supplements"
                                              class="form-control"
                                              rows="4">{{ old('supplements', $patient->supplements) }}</textarea>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                {{-- INFORMED CONSENT --}}
                <div class="card card-secondary">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-file-signature mr-1"></i>
                            Informed Consent
                        </h3>
                    </div>

                    <div class="card-body">
                        <div class="row">

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="consent_accepted">
                                        Consent Accepted
                                    </label>

                                    <select id="consent_accepted"
                                            name="consent_accepted"
                                            class="form-control">

                                        <option value="1"
                                            {{ $patient->consent_accepted ? 'selected' : '' }}>
                                            Yes
                                        </option>

                                        <option value="0"
                                            {{ !$patient->consent_accepted ? 'selected' : '' }}>
                                            No
                                        </option>

                                    </select>
                                </div>
                            </div>

                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="digital_signature">
                                        Signature
                                    </label>

                                    <input type="text"
                                           id="digital_signature"
                                           name="digital_signature"
                                           class="form-control"
                                           value="{{ old('digital_signature', $patient->digital_signature) }}">
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group mb-0">
                                    <label for="authorized_procedure">
                                        Authorized Procedure
                                    </label>

                                    <input type="text"
                                           id="authorized_procedure"
                                           name="authorized_procedure"
                                           class="form-control"
                                           value="{{ old('authorized_procedure', $patient->authorized_procedure) }}">
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                {{-- VITAL SIGNS --}}
                <div class="card card-danger">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-heartbeat mr-1"></i>
                            Vital Signs
                        </h3>
                    </div>

                    <div class="card-body">
                        <div class="row">

                            <div class="col-sm-6 col-xl-3">
                                <div class="form-group">
                                    <label for="heart_rate">
                                        Heart Rate
                                    </label>

                                    <div class="input-group">
                                        <input type="number"
                                               id="heart_rate"
                                               name="heart_rate"
                                               class="form-control"
                                               value="{{ old('heart_rate', $patient->heart_rate) }}">

                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                bpm
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-xl-3">
                                <div class="form-group">
                                    <label for="oxygen_saturation">
                                        O₂ Saturation
                                    </label>

                                    <div class="input-group">
                                        <input type="number"
                                               id="oxygen_saturation"
                                               name="oxygen_saturation"
                                               class="form-control"
                                               value="{{ old('oxygen_saturation', $patient->oxygen_saturation) }}">

                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                %
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-xl-3">
                                <div class="form-group">
                                    <label for="temperature">
                                        Temperature
                                    </label>

                                    <div class="input-group">
                                        <input type="number"
                                               step="0.1"
                                               id="temperature"
                                               name="temperature"
                                               class="form-control"
                                               value="{{ old('temperature', $patient->temperature) }}">

                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                °C
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-xl-3">
                                <div class="form-group">
                                    <label for="blood_pressure">
                                        Blood Pressure
                                    </label>

                                    <div class="input-group">
                                        <input type="text"
                                               id="blood_pressure"
                                               name="blood_pressure"
                                               class="form-control"
                                               value="{{ old('blood_pressure', $patient->blood_pressure) }}">

                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                mmHg
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                {{-- NOTES AND REGISTRATION --}}
                <div class="card card-dark">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-clipboard mr-1"></i>
                            Notes and Registration
                        </h3>
                    </div>

                    <div class="card-body">

                        <div class="form-group">
                            <label for="notes">Clinical Notes</label>

                            <textarea id="notes"
                                      name="notes"
                                      class="form-control"
                                      rows="5">{{ old('notes', $patient->notes) }}</textarea>
                        </div>

                        <div class="form-group mb-0">
                            <label for="registration_date">
                                Registration Date
                            </label>

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fas fa-calendar-alt"></i>
                                    </span>
                                </div>

                                <input type="datetime-local"
                                       id="registration_date"
                                       name="registration_date"
                                       class="form-control"
                                       value="{{ old('registration_date', \Carbon\Carbon::parse($patient->registration_date)->format('Y-m-d\TH:i')) }}">
                            </div>
                        </div>

                    </div>
                </div>

            </div>

            {{-- SIDEBAR --}}
            <div class="col-lg-3">

                <div class="card patient-summary-card">
                    <div class="card-body text-center">

                        <div class="patient-avatar">
                            <i class="fas fa-user-injured"></i>
                        </div>

                        <h4 class="mt-3 mb-1">
                            {{ $patient->name }}
                            {{ $patient->last_name }}
                        </h4>

                        <p class="text-muted mb-3">
                            New Clinical Consultation
                        </p>

                        <div class="text-left">

                            <div class="summary-row">
                                <i class="fas fa-birthday-cake"></i>

                                <div>
                                    <small>Date of Birth</small>
                                    <strong>
                                        {{ $patient->date_of_birth }}
                                    </strong>
                                </div>
                            </div>

                            <div class="summary-row">
                                <i class="fas fa-phone"></i>

                                <div>
                                    <small>Phone</small>
                                    <strong>
                                        {{ $patient->phone ?: 'Not registered' }}
                                    </strong>
                                </div>
                            </div>

                            <div class="summary-row">
                                <i class="fas fa-envelope"></i>

                                <div>
                                    <small>Email</small>
                                    <strong>
                                        {{ $patient->email ?: 'Not registered' }}
                                    </strong>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>

                <div class="card card-outline card-info">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-info-circle mr-1"></i>
                            Consultation Information
                        </h3>
                    </div>

                    <div class="card-body">

                        <div class="sidebar-status">
                            <i class="fas fa-user-check text-success"></i>

                            <div>
                                <strong>Existing Patient</strong>
                                <p class="text-muted mb-0">
                                    This consultation will be linked to the
                                    selected patient.
                                </p>
                            </div>
                        </div>

                        <div class="sidebar-status mb-0">
                            <i class="fas fa-file-medical text-primary"></i>

                            <div>
                                <strong>New Consultation</strong>
                                <p class="text-muted mb-0">
                                    A new clinical record will be created.
                                </p>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="card sticky-actions">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-tools mr-1"></i>
                            Actions
                        </h3>
                    </div>

                    <div class="card-body">

                        <button type="submit"
                                class="btn btn-success btn-lg btn-block">
                            <i class="fas fa-save mr-1"></i>
                            Save New Consultation
                        </button>

                        <a href="{{ route('consultas.index', $patient->id) }}"
                           class="btn btn-secondary btn-block">
                            <i class="fas fa-times mr-1"></i>
                            Cancel
                        </a>

                    </div>
                </div>

            </div>

        </div>

    </form>

@endsection

@section('css')
    <style>
        .form-group label {
            font-weight: 600;
            color: #343a40;
        }

        .input-group-text {
            min-width: 45px;
            justify-content: center;
            background-color: #f4f6f9;
        }

        .section-subtitle {
            margin-bottom: 18px;
            font-weight: 600;
            color: #495057;
        }

        .checkbox-card {
            display: flex;
            align-items: center;
            width: 100%;
            min-height: 58px;
            padding: 12px 15px;
            margin-bottom: 12px;
            cursor: pointer;
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 6px;
            transition: all .2s ease;
        }

        .checkbox-card:hover {
            background-color: #eef5ff;
            border-color: #80bdff;
        }

        .checkbox-card input {
            margin-right: 12px;
            transform: scale(1.15);
        }

        .checkbox-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 34px;
            height: 34px;
            margin-right: 10px;
            color: #007bff;
            background-color: #eaf3ff;
            border-radius: 50%;
        }

        .patient-summary-card {
            overflow: hidden;
            border-top: 3px solid #17a2b8;
        }

        .patient-avatar {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 85px;
            height: 85px;
            margin: 0 auto;
            color: #ffffff;
            font-size: 36px;
            background: linear-gradient(135deg, #17a2b8, #007bff);
            border-radius: 50%;
            box-shadow: 0 5px 15px rgba(0, 123, 255, .2);
        }

        .summary-row {
            display: flex;
            align-items: flex-start;
            padding: 12px 0;
            border-bottom: 1px solid #e9ecef;
        }

        .summary-row:last-child {
            border-bottom: 0;
        }

        .summary-row > i {
            width: 26px;
            margin-top: 3px;
            margin-right: 9px;
            color: #17a2b8;
            text-align: center;
        }

        .summary-row small,
        .summary-row strong {
            display: block;
        }

        .summary-row strong {
            overflow-wrap: anywhere;
            font-size: 14px;
        }

        .sidebar-status {
            display: flex;
            align-items: flex-start;
            margin-bottom: 20px;
        }

        .sidebar-status > i {
            flex-shrink: 0;
            margin-right: 12px;
            font-size: 25px;
        }

        .sticky-actions {
            position: sticky;
            top: 70px;
        }

        textarea.form-control {
            resize: vertical;
        }

        @media (max-width: 991.98px) {
            .sticky-actions {
                position: static;
            }
        }

        @media (max-width: 767.98px) {
            .card-body {
                padding: 1rem;
            }

            .checkbox-card {
                min-height: 52px;
            }
        }
    </style>
@endsection