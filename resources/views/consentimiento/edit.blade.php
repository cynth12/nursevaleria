@extends('adminlte::page')

@section('title', 'Editar Consentimiento')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center flex-wrap">
        <div>
            <h1 class="mb-0">Edit Informed Consent</h1>
            <small class="text-muted">
                Update patient consent information
            </small>
        </div>

        <a href="{{ route('consentimiento.show', $consentimiento->id) }}"
           class="btn btn-secondary mt-2 mt-md-0">
            <i class="fas fa-arrow-left mr-1"></i>
            Back to Consent
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

    <form action="{{ route('consentimiento.update', $consentimiento->id) }}"
          method="POST">

        @csrf
        @method('PUT')

        <div class="row">

            {{-- MAIN COLUMN --}}
            <div class="col-lg-8">

                {{-- PATIENT INFORMATION --}}
                <div class="card card-info">

                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-user-injured mr-1"></i>
                            Patient Information
                        </h3>
                    </div>

                    <div class="card-body">

                        <div class="form-group mb-0">
                            <label for="patient">
                                Patient
                            </label>

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fas fa-user"></i>
                                    </span>
                                </div>

                                <input type="text"
                                       id="patient"
                                       class="form-control"
                                       value="{{ $consentimiento->patient->name }} {{ $consentimiento->patient->last_name }}"
                                       readonly>
                            </div>

                            <small class="form-text text-muted">
                                The patient associated with this consent cannot be changed.
                            </small>
                        </div>

                    </div>
                </div>

                {{-- NURSE INFORMATION --}}
                <div class="card card-primary">

                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-user-nurse mr-1"></i>
                            Nurse Information
                        </h3>
                    </div>

                    <div class="card-body">

                        <div class="row">

                            <div class="col-md-6">

                                <div class="form-group">
                                    <label for="nurse_name">
                                        Nurse Name
                                    </label>

                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-user-nurse"></i>
                                            </span>
                                        </div>

                                        <input type="text"
                                               id="nurse_name"
                                               name="nurse_name"
                                               class="form-control @error('nurse_name') is-invalid @enderror"
                                               value="{{ old('nurse_name', $consentimiento->nurse_name) }}">

                                        @error('nurse_name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                            </div>

                            <div class="col-md-6">

                                <div class="form-group">
                                    <label for="nurse_id">
                                        Nurse Professional ID
                                    </label>

                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-id-card"></i>
                                            </span>
                                        </div>

                                        <input type="text"
                                               id="nurse_id"
                                               name="nurse_id"
                                               class="form-control @error('nurse_id') is-invalid @enderror"
                                               value="{{ old('nurse_id', $consentimiento->nurse_id) }}">

                                        @error('nurse_id')
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

                {{-- AUTHORIZED PROCEDURE --}}
                <div class="card card-warning">

                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-syringe mr-1"></i>
                            Authorized Procedure
                        </h3>
                    </div>

                    <div class="card-body">

                        <div class="form-group mb-0">
                            <label for="authorized_procedure">
                                Authorized Procedure
                            </label>

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fas fa-notes-medical"></i>
                                    </span>
                                </div>

                                <input type="text"
                                       id="authorized_procedure"
                                       name="authorized_procedure"
                                       class="form-control @error('authorized_procedure') is-invalid @enderror"
                                       value="{{ old('authorized_procedure', $consentimiento->authorized_procedure) }}">

                                @error('authorized_procedure')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                    </div>
                </div>

                {{-- CONSENT INFORMATION --}}
                <div class="card card-success">

                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-clipboard-check mr-1"></i>
                            Consent Information
                        </h3>
                    </div>

                    <div class="card-body">

                        <div class="row">

                            <div class="col-md-6">

                                <div class="form-group">
                                    <label for="consent_accepted">
                                        Consent Accepted
                                    </label>

                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-check-circle"></i>
                                            </span>
                                        </div>

                                        <select id="consent_accepted"
                                                name="consent_accepted"
                                                class="form-control @error('consent_accepted') is-invalid @enderror">

                                            <option value="1"
                                                {{ old('consent_accepted', $consentimiento->consent_accepted) == 1 ? 'selected' : '' }}>
                                                Yes
                                            </option>

                                            <option value="0"
                                                {{ old('consent_accepted', $consentimiento->consent_accepted) == 0 ? 'selected' : '' }}>
                                                No
                                            </option>

                                        </select>

                                        @error('consent_accepted')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                            </div>

                            <div class="col-md-6">

                                <div class="form-group">
                                    <label for="consent_date">
                                        Consent Date
                                    </label>

                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-calendar-alt"></i>
                                            </span>
                                        </div>

                                        <input type="date"
                                               id="consent_date"
                                               name="consent_date"
                                               class="form-control @error('consent_date') is-invalid @enderror"
                                               value="{{ old('consent_date', $consentimiento->consent_date) }}">

                                        @error('consent_date')
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

                {{-- CURRENT SIGNATURE --}}
                <div class="card card-dark">

                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-signature mr-1"></i>
                            Current Digital Signature
                        </h3>
                    </div>

                    <div class="card-body">

                        @if ($consentimiento->digital_signature)

                            <div class="signature-box">
                                <img src="{{ $consentimiento->digital_signature }}"
                                     alt="Patient digital signature">
                            </div>

                            <div class="text-center mt-3">
                                <span class="badge badge-success">
                                    <i class="fas fa-check-circle mr-1"></i>
                                    Signature registered
                                </span>
                            </div>

                        @else

                            <div class="alert alert-warning mb-0">
                                <i class="fas fa-exclamation-triangle mr-1"></i>
                                No signature available
                            </div>

                        @endif

                    </div>
                </div>

            </div>

            {{-- SIDEBAR --}}
            <div class="col-lg-4">

                {{-- CONSENT SUMMARY --}}
                <div class="card">

                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-clipboard-list mr-1"></i>
                            Consent Summary
                        </h3>
                    </div>

                    <div class="card-body">

                        <div class="summary-item">
                            <div class="summary-icon">
                                <i class="fas fa-user"></i>
                            </div>

                            <div>
                                <small class="text-muted d-block">
                                    Patient
                                </small>

                                <strong>
                                    {{ $consentimiento->patient->name }}
                                    {{ $consentimiento->patient->last_name }}
                                </strong>
                            </div>
                        </div>

                        <div class="summary-item">
                            <div class="summary-icon">
                                <i class="fas fa-user-nurse"></i>
                            </div>

                            <div>
                                <small class="text-muted d-block">
                                    Nurse
                                </small>

                                <strong>
                                    {{ $consentimiento->nurse_name }}
                                </strong>
                            </div>
                        </div>

                        <div class="summary-item">
                            <div class="summary-icon">
                                <i class="fas fa-id-card"></i>
                            </div>

                            <div>
                                <small class="text-muted d-block">
                                    Professional ID
                                </small>

                                <strong>
                                    {{ $consentimiento->nurse_id }}
                                </strong>
                            </div>
                        </div>

                        <div class="summary-item mb-0">
                            <div class="summary-icon">
                                <i class="fas fa-calendar-check"></i>
                            </div>

                            <div>
                                <small class="text-muted d-block">
                                    Consent Date
                                </small>

                                <strong>
                                    {{ $consentimiento->consent_date }}
                                </strong>
                            </div>
                        </div>

                    </div>
                </div>

                {{-- DOCUMENT STATUS --}}
                <div class="card card-outline card-success">

                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-shield-alt mr-1"></i>
                            Document Status
                        </h3>
                    </div>

                    <div class="card-body">

                        <div class="status-item">

                            @if ($consentimiento->consent_accepted)

                                <i class="fas fa-check-circle text-success"></i>

                                <div>
                                    <strong>Consent Accepted</strong>

                                    <p class="text-muted mb-0">
                                        The patient accepted the informed consent.
                                    </p>
                                </div>

                            @else

                                <i class="fas fa-times-circle text-danger"></i>

                                <div>
                                    <strong>Consent Not Accepted</strong>

                                    <p class="text-muted mb-0">
                                        The patient did not accept the informed consent.
                                    </p>
                                </div>

                            @endif

                        </div>

                        <div class="status-item mb-0">

                            @if ($consentimiento->digital_signature)

                                <i class="fas fa-check-circle text-success"></i>

                                <div>
                                    <strong>Signature Available</strong>

                                    <p class="text-muted mb-0">
                                        A digital signature is stored with this consent.
                                    </p>
                                </div>

                            @else

                                <i class="fas fa-times-circle text-danger"></i>

                                <div>
                                    <strong>Signature Missing</strong>

                                    <p class="text-muted mb-0">
                                        No digital signature is available.
                                    </p>
                                </div>

                            @endif

                        </div>

                    </div>
                </div>

                {{-- ACTIONS --}}
                <div class="card">

                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-tools mr-1"></i>
                            Actions
                        </h3>
                    </div>

                    <div class="card-body">

                        <button type="submit"
                                class="btn btn-success btn-block">
                            <i class="fas fa-save mr-1"></i>
                            Save Changes
                        </button>

                        <a href="{{ route('consentimiento.show', $consentimiento->id) }}"
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

        .signature-box {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 230px;
            padding: 20px;
            overflow: hidden;
            background-color: #ffffff;
            border: 2px solid #ced4da;
            border-radius: 6px;
        }

        .signature-box img {
            display: block;
            width: auto;
            max-width: 100%;
            max-height: 210px;
            object-fit: contain;
        }

        .summary-item {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .summary-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            width: 42px;
            height: 42px;
            margin-right: 12px;
            color: #007bff;
            background-color: #eaf3ff;
            border-radius: 50%;
        }

        .status-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 20px;
        }

        .status-item > i {
            flex-shrink: 0;
            margin-right: 12px;
            font-size: 27px;
        }

        @media (max-width: 767.98px) {
            .signature-box {
                min-height: 180px;
            }

            .signature-box img {
                max-height: 160px;
            }
        }
    </style>
@endsection