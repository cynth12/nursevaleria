@extends('adminlte::page')

@section('title', 'Create Patient')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center flex-wrap">
        <div>
            <h1 class="mb-0">Create Patient</h1>

            <small class="text-muted">
                Basic evaluation for IV therapy
            </small>
        </div>
    </div>
@endsection

@section('content')

    {{-- VALIDATION ERRORS --}}
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show">
            <h5>
                <i class="fas fa-exclamation-triangle mr-1"></i>
                Please correct the following information:
            </h5>

            <ul class="mb-0 pl-3">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>

            <button type="button"
                    class="close"
                    data-dismiss="alert"
                    aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    {{-- SUCCESS MESSAGE --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="fas fa-check-circle mr-1"></i>
            {{ session('success') }}

            <button type="button"
                    class="close"
                    data-dismiss="alert"
                    aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <form action="{{ route('patient.index.store') }}"
          method="POST"
          id="patient-form">

        @csrf

        <div class="row">

            {{-- MAIN CONTENT --}}
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
                                               name="name"
                                               id="name"
                                               class="form-control @error('name') is-invalid @enderror"
                                               value="{{ old('name') }}"
                                               placeholder="Patient's first name"
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
                                               name="last_name"
                                               id="last_name"
                                               class="form-control @error('last_name') is-invalid @enderror"
                                               value="{{ old('last_name') }}"
                                               placeholder="Patient's last name"
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
                                    </label>

                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-birthday-cake"></i>
                                            </span>
                                        </div>

                                        <input type="date"
                                               name="date_of_birth"
                                               id="date_of_birth"
                                               class="form-control @error('date_of_birth') is-invalid @enderror"
                                               value="{{ old('date_of_birth') }}">

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
                                    <label for="phone">
                                        Phone (WhatsApp)
                                    </label>

                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fab fa-whatsapp"></i>
                                            </span>
                                        </div>

                                        <input type="text"
                                               name="phone"
                                               id="phone"
                                               class="form-control @error('phone') is-invalid @enderror"
                                               value="{{ old('phone') }}"
                                               placeholder="Phone number">

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
                                    <label for="email">
                                        Email
                                    </label>

                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-envelope"></i>
                                            </span>
                                        </div>

                                        <input type="email"
                                               name="email"
                                               id="email"
                                               class="form-control @error('email') is-invalid @enderror"
                                               value="{{ old('email') }}"
                                               placeholder="patient@email.com">

                                        @error('email')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group mb-0">
                                    <label for="address">
                                        Address
                                    </label>

                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-map-marker-alt"></i>
                                            </span>
                                        </div>

                                        <input type="text"
                                               name="address"
                                               id="address"
                                               class="form-control @error('address') is-invalid @enderror"
                                               value="{{ old('address') }}"
                                               placeholder="Patient's address">

                                        @error('address')
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

                {{-- REFERRAL SOURCE --}}
                <div class="card card-secondary">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-bullhorn mr-1"></i>
                            How Did You Hear About Us?
                        </h3>
                    </div>

                    <div class="card-body">
                        <div class="row">

                            <div class="col-md-6">
                                <label class="selection-card">
                                    <input type="checkbox"
                                           name="symptoms[]"
                                           value="instagram"
                                           {{ in_array('instagram', old('symptoms', [])) ? 'checked' : '' }}>

                                    <span class="selection-icon">
                                        <i class="fab fa-instagram"></i>
                                    </span>

                                    <span>
                                        <strong>Instagram</strong>
                                        <small>Social media referral</small>
                                    </span>
                                </label>
                            </div>

                            <div class="col-md-6">
                                <label class="selection-card">
                                    <input type="checkbox"
                                           name="symptoms[]"
                                           value="facebook"
                                           {{ in_array('facebook', old('symptoms', [])) ? 'checked' : '' }}>

                                    <span class="selection-icon">
                                        <i class="fab fa-facebook-f"></i>
                                    </span>

                                    <span>
                                        <strong>Facebook</strong>
                                        <small>Social media referral</small>
                                    </span>
                                </label>
                            </div>

                            <div class="col-12 mt-2">
                                <div class="form-group mb-0">
                                    <label for="other">
                                        Other Referral Source
                                    </label>

                                    <input type="text"
                                           name="other"
                                           id="other"
                                           class="form-control"
                                           value="{{ old('other') }}"
                                           placeholder="Please specify">
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                {{-- REASON FOR VISIT --}}
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-notes-medical mr-1"></i>
                            Reason for Visit and Symptoms
                        </h3>
                    </div>

                    <div class="card-body">

                        <div class="form-group">
                            <label for="reason">
                                Reason for Visit
                            </label>

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fas fa-comment-medical"></i>
                                    </span>
                                </div>

                                <input type="text"
                                       name="reason"
                                       id="reason"
                                       class="form-control"
                                       value="{{ old('reason') }}"
                                       placeholder="Describe the reason for the visit">
                            </div>
                        </div>

                        <label class="mb-3">
                            Current Symptoms
                        </label>

                        <div class="row">

                            <div class="col-md-6 col-xl-4">
                                <label class="selection-card">
                                    <input type="checkbox"
                                           name="symptoms[]"
                                           value="Dolor abdominal"
                                           {{ in_array('Dolor abdominal', old('symptoms', [])) ? 'checked' : '' }}>

                                    <span class="selection-icon">
                                        <i class="fas fa-procedures"></i>
                                    </span>

                                    <span>
                                        <strong>Abdominal Pains</strong>
                                    </span>
                                </label>
                            </div>

                            <div class="col-md-6 col-xl-4">
                                <label class="selection-card">
                                    <input type="checkbox"
                                           name="symptoms[]"
                                           value="Fiebre"
                                           {{ in_array('Fiebre', old('symptoms', [])) ? 'checked' : '' }}>

                                    <span class="selection-icon">
                                        <i class="fas fa-thermometer-three-quarters"></i>
                                    </span>

                                    <span>
                                        <strong>Fever</strong>
                                    </span>
                                </label>
                            </div>

                            <div class="col-md-6 col-xl-4">
                                <label class="selection-card">
                                    <input type="checkbox"
                                           name="symptoms[]"
                                           value="Vómito"
                                           {{ in_array('Vómito', old('symptoms', [])) ? 'checked' : '' }}>

                                    <span class="selection-icon">
                                        <i class="fas fa-head-side-cough"></i>
                                    </span>

                                    <span>
                                        <strong>Vomiting</strong>
                                    </span>
                                </label>
                            </div>

                            <div class="col-md-6 col-xl-4">
                                <label class="selection-card">
                                    <input type="checkbox"
                                           name="symptoms[]"
                                           value="Diarrea"
                                           {{ in_array('Diarrea', old('symptoms', [])) ? 'checked' : '' }}>

                                    <span class="selection-icon">
                                        <i class="fas fa-clinic-medical"></i>
                                    </span>

                                    <span>
                                        <strong>Diarrhea</strong>
                                    </span>
                                </label>
                            </div>

                            <div class="col-md-6 col-xl-4">
                                <label class="selection-card">
                                    <input type="checkbox"
                                           name="symptoms[]"
                                           value="Ninguno"
                                           {{ in_array('Ninguno', old('symptoms', [])) ? 'checked' : '' }}>

                                    <span class="selection-icon">
                                        <i class="fas fa-check"></i>
                                    </span>

                                    <span>
                                        <strong>None of the Above</strong>
                                    </span>
                                </label>
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
                                               name="emergency_name"
                                               id="emergency_name"
                                               class="form-control"
                                               value="{{ old('emergency_name') }}"
                                               placeholder="Full name">
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
                                               name="emergency_relationship"
                                               id="emergency_relationship"
                                               class="form-control"
                                               value="{{ old('emergency_relationship') }}"
                                               placeholder="Relationship to patient">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="emergency_phone">
                                        Phone
                                    </label>

                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-phone"></i>
                                            </span>
                                        </div>

                                        <input type="text"
                                               name="emergency_phone"
                                               id="emergency_phone"
                                               class="form-control"
                                               value="{{ old('emergency_phone') }}"
                                               placeholder="Emergency phone number">
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                {{-- IV THERAPY --}}
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

                            <select name="iv_type"
                                    id="iv_type"
                                    class="form-control custom-select">

                                <option value="">Select...</option>

                                <option value="Custom IV"
                                    {{ old('iv_type') == 'Custom IV' ? 'selected' : '' }}>
                                    Custom IV
                                </option>

                                <option value="Wellness Duo"
                                    {{ old('iv_type') == 'Wellness Duo' ? 'selected' : '' }}>
                                    IV Wellness Duo
                                </option>

                                <option value="Energy Boost"
                                    {{ old('iv_type') == 'Energy Boost' ? 'selected' : '' }}>
                                    IV Energy Boost
                                </option>

                                <option value="Beauty Glow"
                                    {{ old('iv_type') == 'Beauty Glow' ? 'selected' : '' }}>
                                    IV Beauty Glow
                                </option>

                                <option value="Hangover"
                                    {{ old('iv_type') == 'Hangover' ? 'selected' : '' }}>
                                    IV Hangover
                                </option>

                                <option value="Immune Boost"
                                    {{ old('iv_type') == 'Immune Boost' ? 'selected' : '' }}>
                                    IV Immune Boost
                                </option>

                                <option value="Immune master Boost"
                                    {{ old('iv_type') == 'Immune master Boost' ? 'selected' : '' }}>
                                    IV Immune Master Boost
                                </option>

                                <option value="Superdetox"
                                    {{ old('iv_type') == 'Superdetox' ? 'selected' : '' }}>
                                    IV Superdetox
                                </option>

                                <option value="Sportpower"
                                    {{ old('iv_type') == 'Sportpower' ? 'selected' : '' }}>
                                    IV Sportpower
                                </option>

                                <option value="Post op"
                                    {{ old('iv_type') == 'Post op' ? 'selected' : '' }}>
                                    IV Post Op
                                </option>

                                <option value="NAD"
                                    {{ old('iv_type') == 'NAD' ? 'selected' : '' }}>
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
                            Medical and Surgical History
                        </h3>
                    </div>

                    <div class="card-body">
                        <div class="row">

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="pregnant">
                                        Are you, or could you be pregnant?
                                    </label>

                                    <select name="pregnant"
                                            id="pregnant"
                                            class="form-control">

                                        <option value="">Select...</option>

                                        <option value="yes"
                                            {{ old('pregnant') == 'yes' ? 'selected' : '' }}>
                                            Yes
                                        </option>

                                        <option value="no"
                                            {{ old('pregnant') == 'no' ? 'selected' : '' }}>
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

                                    <select name="vitamins_intolerance"
                                            id="vitamins_intolerance"
                                            class="form-control">

                                        <option value="" disabled
                                            {{ old('vitamins_intolerance') === null ? 'selected' : '' }}>
                                            Select
                                        </option>

                                        <option value="yes"
                                            {{ old('vitamins_intolerance') == 'yes' ? 'selected' : '' }}>
                                            Yes
                                        </option>

                                        <option value="no"
                                            {{ old('vitamins_intolerance') == 'no' ? 'selected' : '' }}>
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

                                    <select name="minerals_intolerance"
                                            id="minerals_intolerance"
                                            class="form-control">

                                        <option value="" disabled
                                            {{ old('minerals_intolerance') === null ? 'selected' : '' }}>
                                            Select
                                        </option>

                                        <option value="yes"
                                            {{ old('minerals_intolerance') == 'yes' ? 'selected' : '' }}>
                                            Yes
                                        </option>

                                        <option value="no"
                                            {{ old('minerals_intolerance') == 'no' ? 'selected' : '' }}>
                                            No
                                        </option>

                                    </select>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                {{-- ALLERGIES --}}
                <div class="card card-danger">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-allergies mr-1"></i>
                            Food and Drug Allergies
                        </h3>
                    </div>

                    <div class="card-body">
                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="allergy_food">
                                        Food Allergies
                                    </label>

                                    <textarea name="allergy_food"
                                              id="allergy_food"
                                              class="form-control"
                                              rows="4"
                                              placeholder="Describe food allergies">{{ old('allergy_food') }}</textarea>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="allergy_medicine">
                                        Medicine Allergy
                                    </label>

                                    <select name="allergy_medicine"
                                            id="allergy_medicine"
                                            class="form-control">

                                        <option value="" disabled
                                            {{ old('allergy_medicine') === null ? 'selected' : '' }}>
                                            Select medicine
                                        </option>

                                        <option value="No"
                                            {{ old('allergy_medicine') == 'No' ? 'selected' : '' }}>
                                            No
                                        </option>

                                        <option value="penicillin"
                                            {{ old('allergy_medicine') == 'penicillin' ? 'selected' : '' }}>
                                            Penicillin
                                        </option>

                                        <option value="aspirin"
                                            {{ old('allergy_medicine') == 'aspirin' ? 'selected' : '' }}>
                                            Aspirin
                                        </option>

                                        <option value="ibuprofen"
                                            {{ old('allergy_medicine') == 'ibuprofen' ? 'selected' : '' }}>
                                            Ibuprofen
                                        </option>

                                        <option value="morphine"
                                            {{ old('allergy_medicine') == 'morphine' ? 'selected' : '' }}>
                                            Morphine
                                        </option>

                                        <option value="other"
                                            {{ old('allergy_medicine') == 'other' ? 'selected' : '' }}>
                                            Other
                                        </option>

                                    </select>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group mb-0">
                                    <label for="reaction">
                                        Reaction to the Allergy
                                    </label>

                                    <textarea name="reaction"
                                              id="reaction"
                                              class="form-control"
                                              rows="4"
                                              placeholder="Describe the patient's allergic reaction">{{ old('reaction') }}</textarea>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                {{-- MEDICATIONS AND SUPPLEMENTS --}}
                <div class="card card-secondary">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-pills mr-1"></i>
                            Medications and Supplements
                        </h3>
                    </div>

                    <div class="card-body">

                        <div class="alert alert-light border">
                            <i class="fas fa-info-circle text-info mr-1"></i>
                            Include the name, dose and frequency of each medication
                            or supplement.
                        </div>

                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group mb-md-0">
                                    <label for="medications">
                                        Medications
                                    </label>

                                    <textarea name="medications"
                                              id="medications"
                                              class="form-control"
                                              rows="5"
                                              placeholder="Medication name, dose and frequency">{{ old('medications') }}</textarea>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group mb-0">
                                    <label for="supplements">
                                        Supplements
                                    </label>

                                    <textarea name="supplements"
                                              id="supplements"
                                              class="form-control"
                                              rows="5"
                                              placeholder="Supplement name, dose and frequency">{{ old('supplements') }}</textarea>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                {{-- VITAL SIGNS --}}
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-heartbeat mr-1"></i>
                            Vital Signs
                        </h3>
                    </div>

                    <div class="card-body">
                        <div class="row">

                            <div class="col-sm-6 col-xl-3">
                                <div class="vital-field">
                                    <div class="vital-icon">
                                        <i class="fas fa-heartbeat"></i>
                                    </div>

                                    <div class="form-group mb-0">
                                        <label for="heart_rate">
                                            Heart Rate
                                        </label>

                                        <div class="input-group">
                                            <input type="number"
                                                   name="heart_rate"
                                                   id="heart_rate"
                                                   class="form-control"
                                                   value="{{ old('heart_rate') }}"
                                                   placeholder="78">

                                            <div class="input-group-append">
                                                <span class="input-group-text">
                                                    bpm
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-xl-3">
                                <div class="vital-field">
                                    <div class="vital-icon">
                                        <i class="fas fa-lungs"></i>
                                    </div>

                                    <div class="form-group mb-0">
                                        <label for="oxigen_saturation">
                                            O₂ Saturation
                                        </label>

                                        <div class="input-group">
                                            <input type="number"
                                                   name="oxigen_saturation"
                                                   id="oxigen_saturation"
                                                   class="form-control"
                                                   value="{{ old('oxigen_saturation') }}"
                                                   placeholder="97">

                                            <div class="input-group-append">
                                                <span class="input-group-text">
                                                    %
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-xl-3">
                                <div class="vital-field">
                                    <div class="vital-icon">
                                        <i class="fas fa-thermometer-half"></i>
                                    </div>

                                    <div class="form-group mb-0">
                                        <label for="temperature">
                                            Temperature
                                        </label>

                                        <div class="input-group">
                                            <input type="number"
                                                   step="0.1"
                                                   name="temperature"
                                                   id="temperature"
                                                   class="form-control"
                                                   value="{{ old('temperature') }}"
                                                   placeholder="36.7">

                                            <div class="input-group-append">
                                                <span class="input-group-text">
                                                    °C
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-xl-3">
                                <div class="vital-field">
                                    <div class="vital-icon">
                                        <i class="fas fa-stethoscope"></i>
                                    </div>

                                    <div class="form-group mb-0">
                                        <label for="blood_pressure">
                                            Blood Pressure
                                        </label>

                                        <div class="input-group">
                                            <input type="text"
                                                   name="blood_pressure"
                                                   id="blood_pressure"
                                                   class="form-control"
                                                   value="{{ old('blood_pressure') }}"
                                                   placeholder="120/80">

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
                </div>

                {{-- NOTES --}}
                <div class="card card-dark">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-clipboard mr-1"></i>
                            Clinical Notes
                        </h3>
                    </div>

                    <div class="card-body">
                        <div class="form-group mb-0">
                            <label for="notes">
                                Notes
                            </label>

                            <textarea name="notes"
                                      id="notes"
                                      class="form-control"
                                      rows="6"
                                      placeholder="Write any additional clinical observations">{{ old('notes') }}</textarea>
                        </div>
                    </div>
                </div>

            </div>

            {{-- SIDEBAR --}}
            <div class="col-lg-3">

                <div class="card patient-registration-card">
                    <div class="card-body text-center">

                        <div class="patient-avatar">
                            <i class="fas fa-user-plus"></i>
                        </div>

                        <h4 class="mt-3 mb-1">
                            New Patient
                        </h4>

                        <p class="text-muted mb-0">
                            IV Therapy Evaluation
                        </p>

                    </div>
                </div>

                <div class="card card-outline card-info">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-clipboard-check mr-1"></i>
                            Evaluation Information
                        </h3>
                    </div>

                    <div class="card-body">

                        <div class="information-item">
                            <i class="fas fa-user-injured text-info"></i>

                            <div>
                                <strong>Patient Record</strong>

                                <p class="text-muted mb-0">
                                    Personal and contact information.
                                </p>
                            </div>
                        </div>

                        <div class="information-item">
                            <i class="fas fa-file-medical text-success"></i>

                            <div>
                                <strong>Medical History</strong>

                                <p class="text-muted mb-0">
                                    Allergies, medications and supplements.
                                </p>
                            </div>
                        </div>

                        <div class="information-item mb-0">
                            <i class="fas fa-heartbeat text-danger"></i>

                            <div>
                                <strong>Vital Signs</strong>

                                <p class="text-muted mb-0">
                                    Initial clinical measurements.
                                </p>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="card card-outline card-warning">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-shield-alt mr-1"></i>
                            Important
                        </h3>
                    </div>

                    <div class="card-body">
                        <p class="text-muted mb-0">
                            Verify the patient's personal and medical information
                            before saving the evaluation.
                        </p>
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
                            Save Patient
                        </button>

                    </div>
                </div>

            </div>

        </div>

    </form>

@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">

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

        textarea.form-control {
            resize: vertical;
        }

        .selection-card {
            display: flex;
            align-items: center;
            width: 100%;
            min-height: 68px;
            padding: 12px 15px;
            margin-bottom: 12px;
            cursor: pointer;
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 7px;
            transition: all .2s ease;
        }

        .selection-card:hover {
            background-color: #eef6ff;
            border-color: #80bdff;
            transform: translateY(-1px);
        }

        .selection-card input {
            flex-shrink: 0;
            margin-right: 12px;
            transform: scale(1.15);
        }

        .selection-card > span:last-child {
            display: flex;
            flex-direction: column;
        }

        .selection-card small {
            display: block;
            color: #6c757d;
        }

        .selection-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            width: 38px;
            height: 38px;
            margin-right: 11px;
            color: #007bff;
            background-color: #e7f1ff;
            border-radius: 50%;
        }

        .vital-field {
            height: 100%;
            padding: 16px;
            margin-bottom: 15px;
            background-color: #f8f9fa;
            border: 1px solid #e2e6ea;
            border-radius: 7px;
        }

        .vital-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 42px;
            height: 42px;
            margin-bottom: 12px;
            color: #dc3545;
            background-color: #fdecef;
            border-radius: 50%;
        }

        .patient-registration-card {
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
            font-size: 34px;
            background: linear-gradient(135deg, #17a2b8, #007bff);
            border-radius: 50%;
            box-shadow: 0 5px 15px rgba(0, 123, 255, .2);
        }

        .information-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 20px;
        }

        .information-item > i {
            flex-shrink: 0;
            width: 30px;
            margin-top: 2px;
            margin-right: 10px;
            font-size: 24px;
            text-align: center;
        }

        .sticky-actions {
            position: sticky;
            top: 70px;
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

            .selection-card {
                min-height: 58px;
            }

            .vital-field {
                height: auto;
            }
        }
    </style>
@endsection