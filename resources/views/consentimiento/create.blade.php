@extends('adminlte::page')

@section('title', 'Informed Consent')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center flex-wrap">

        <div>
            <h1 class="mb-0">
                Informed Consent
            </h1>

            <small class="text-muted">
                IM/IV medication administration authorization
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

    {{-- VALIDATION ERRORS --}}
    @if ($errors->any())

        <div class="alert alert-danger alert-dismissible fade show">

            <h5>
                <i class="fas fa-exclamation-triangle mr-1"></i>
                The consent could not be saved
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
                aria-label="Close"
            >
                <span aria-hidden="true">&times;</span>
            </button>

        </div>

    @endif

    <form
        id="consent-form"
        action="{{ route('consentimiento.store', $consultation->id) }}"
        method="POST"
    >
        @csrf

        <div class="row">

            {{-- MAIN COLUMN --}}
            <div class="col-lg-8">

                {{-- DOCUMENT HEADER --}}
                <div class="card card-primary">

                    <div class="card-header">

                        <h3 class="card-title">
                            <i class="fas fa-file-medical mr-1"></i>
                            Nurse Valeria IV Therapy
                        </h3>

                    </div>

                    <div class="card-body text-center py-4">

                        <div class="mb-3">
                            <i class="fas fa-notes-medical fa-3x text-primary"></i>
                        </div>

                        <h3 class="mb-2">
                            Informed Consent
                        </h3>

                        <p class="text-muted mb-0">
                            For the Application of Intramuscular and/or
                            Intravenous Medications
                        </p>

                    </div>

                </div>

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

                            <div class="col-md-6 mb-3">

                                <strong>
                                    Full Name
                                </strong>

                                <p class="text-muted mb-0">
                                    {{ $patient->name }}
                                    {{ $patient->last_name }}
                                </p>

                            </div>

                            <div class="col-md-6 mb-3">

                                <strong>
                                    Patient Registration Date
                                </strong>

                                <p class="text-muted mb-0">
                                    {{ $patient->registration_date
                                        ? \Carbon\Carbon::parse($patient->registration_date)->format('F d, Y')
                                        : 'Not registered' }}
                                </p>

                            </div>

                            <div class="col-md-6">

                                <strong>
                                    Consultation Number
                                </strong>

                                <p class="text-muted mb-0">
                                    #{{ $consultation->id }}
                                </p>

                            </div>

                            <div class="col-md-6">

                                <strong>
                                    Consent Date
                                </strong>

                                <p class="text-muted mb-0">
                                    {{ now()->format('F d, Y') }}
                                </p>

                            </div>

                        </div>

                    </div>

                </div>

                {{-- LEGAL DOCUMENT --}}
                <div class="card card-outline card-primary">

                    <div class="card-header">

                        <h3 class="card-title">
                            <i class="fas fa-balance-scale mr-1"></i>
                            Consent Declaration
                        </h3>

                    </div>

                    <div class="card-body consent-document">

                        <div class="alert alert-light border mb-4">

                            <i class="fas fa-info-circle text-info mr-1"></i>

                            Please read the entire document carefully before
                            providing your signature.

                        </div>

                        <p>
                            I,
                            <strong>
                                {{ $patient->name }}
                                {{ $patient->last_name }}
                            </strong>,
                            in full use of my mental faculties and in the
                            exercise of my legal capacity, declare the
                            following:
                        </p>

                        <ol class="consent-list">

                            <li>
                                I express my free will to receive the
                                administration of
                                <strong>
                                    intravenous and/or intramuscular
                                    medications and solutions.
                                </strong>
                            </li>

                            <li>
                                The nurse identified below has provided me
                                with complete information regarding my
                                current condition.

                                This information has been provided in a
                                clear, simple, precise and understandable
                                manner, including available options,
                                possible risks and potential complications.
                            </li>

                        </ol>

                        <div class="card bg-light border mt-4 mb-4">

                            <div class="card-body">

                                <h5 class="mb-3">
                                    <i class="fas fa-user-nurse mr-1"></i>
                                    Attending Nurse
                                </h5>

                                <div class="row">

                                    <div class="col-md-6">

                                        <div class="form-group mb-md-0">

                                            <label for="nurse_name">
                                                Nurse Name
                                                <span class="text-danger">*</span>
                                            </label>

                                            <input
                                                type="text"
                                                id="nurse_name"
                                                name="nurse_name"
                                                class="form-control
                                                    @error('nurse_name')
                                                        is-invalid
                                                    @enderror"
                                                value="{{ old('nurse_name') }}"
                                                placeholder="Enter the nurse's full name"
                                                required
                                            >

                                            @error('nurse_name')
                                                <span class="invalid-feedback">
                                                    {{ $message }}
                                                </span>
                                            @enderror

                                        </div>

                                    </div>

                                    <div class="col-md-6">

                                        <div class="form-group mb-0">

                                            <label for="nurse_id">
                                                Professional License
                                                <span class="text-danger">*</span>
                                            </label>

                                            <input
                                                type="text"
                                                id="nurse_id"
                                                name="nurse_id"
                                                class="form-control
                                                    @error('nurse_id')
                                                        is-invalid
                                                    @enderror"
                                                value="{{ old('nurse_id') }}"
                                                placeholder="Professional license number"
                                                required
                                            >

                                            @error('nurse_id')
                                                <span class="invalid-feedback">
                                                    {{ $message }}
                                                </span>
                                            @enderror

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                        <p>
                            The nurse is complying with the applicable
                            hygiene and protection measures to reduce the
                            risk of spreading infectious diseases,
                            including COVID-19.
                        </p>

                        <p>
                            I am aware and understand that, if additional
                            medical attention is required, whether from a
                            physician or medical institution, it is my
                            responsibility and decision to follow those
                            recommendations.
                        </p>

                        <p>
                            I acknowledge that the procedures to be
                            performed by the medical team have been
                            explained to me. Once their expected benefits,
                            possible complications, reactions and results
                            have been explained, I authorize the procedure
                            and assume the consequences of my informed
                            decision.
                        </p>

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
                                Procedure Authorized by the Patient
                                <span class="text-danger">*</span>
                            </label>

                            <textarea
                                id="authorized_procedure"
                                name="authorized_procedure"
                                class="form-control
                                    @error('authorized_procedure')
                                        is-invalid
                                    @enderror"
                                rows="4"
                                placeholder="Describe the medication, solution or procedure authorized by the patient"
                                required
                            >{{ old(
                                'authorized_procedure',
                                $consultation->authorized_procedure
                            ) }}</textarea>

                            @error('authorized_procedure')
                                <span class="invalid-feedback">
                                    {{ $message }}
                                </span>
                            @enderror

                            <small class="form-text text-muted">
                                Clearly describe the treatment or procedure
                                that will be administered.
                            </small>

                        </div>

                    </div>

                </div>

                {{-- ACCEPTANCE --}}
                <div class="card card-success">

                    <div class="card-header">

                        <h3 class="card-title">
                            <i class="fas fa-check-circle mr-1"></i>
                            Patient Acceptance
                        </h3>

                    </div>

                    <div class="card-body">

                        <div class="alert alert-light border">

                            By selecting the acceptance box, the patient
                            confirms that the document has been read,
                            understood and voluntarily accepted.

                        </div>

                        <div class="custom-control custom-checkbox">

                            <input
                                type="checkbox"
                                id="consent_accepted"
                                name="consent_accepted"
                                value="1"
                                class="custom-control-input
                                    @error('consent_accepted')
                                        is-invalid
                                    @enderror"
                                {{ old('consent_accepted') ? 'checked' : '' }}
                                required
                            >

                            <label
                                class="custom-control-label"
                                for="consent_accepted"
                            >
                                I have read and understood the information
                                provided. I voluntarily accept the
                                authorized procedure.
                            </label>

                            @error('consent_accepted')
                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                    </div>

                </div>

                {{-- DIGITAL SIGNATURE --}}
                <div class="card card-dark">

                    <div class="card-header">

                        <h3 class="card-title">
                            <i class="fas fa-signature mr-1"></i>
                            Patient Digital Signature
                        </h3>

                    </div>

                    <div class="card-body">

                        <div class="alert alert-light border">

                            <i class="fas fa-pen text-primary mr-1"></i>

                            Sign inside the box using your finger, mouse or
                            digital pen.

                        </div>

                        <div
                            id="signature-container"
                            class="signature-container
                                @error('digital_signature')
                                    signature-error
                                @enderror"
                        >

                            <canvas
                                id="consent-signature-pad"
                                aria-label="Digital signature area"
                            ></canvas>

                            <div
                                id="signature-placeholder"
                                class="signature-placeholder"
                            >
                                Sign here
                            </div>

                        </div>

                        <input
                            type="hidden"
                            name="digital_signature"
                            id="consent_signature"
                            value="{{ old('digital_signature') }}"
                        >

                        @error('digital_signature')
                            <div class="text-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror

                        <div
                            id="signature-error-message"
                            class="alert alert-danger mt-3 d-none"
                        >
                            <i class="fas fa-exclamation-triangle mr-1"></i>
                            The patient's digital signature is required.
                        </div>

                        <div class="d-flex justify-content-between align-items-center flex-wrap mt-3">

                            <small class="text-muted">
                                The signature will be securely associated
                                with this consent record.
                            </small>

                            <button
                                type="button"
                                id="clear-consent-signature"
                                class="btn btn-outline-warning mt-2 mt-md-0"
                            >
                                <i class="fas fa-eraser mr-1"></i>
                                Clear Signature
                            </button>

                        </div>

                    </div>

                </div>

            </div>

            {{-- SIDE COLUMN --}}
            <div class="col-lg-4">

                {{-- PATIENT SUMMARY --}}
                <div class="card">

                    <div class="card-header">

                        <h3 class="card-title">
                            <i class="fas fa-user-check mr-1"></i>
                            Consent Summary
                        </h3>

                    </div>

                    <div class="card-body">

                        <div class="info-box bg-light">

                            <span class="info-box-icon">
                                <i class="fas fa-user"></i>
                            </span>

                            <div class="info-box-content">

                                <span class="info-box-text">
                                    Patient
                                </span>

                                <span class="info-box-number patient-name">
                                    {{ $patient->name }}
                                    {{ $patient->last_name }}
                                </span>

                            </div>

                        </div>

                        <div class="info-box bg-light">

                            <span class="info-box-icon">
                                <i class="fas fa-clipboard-list"></i>
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
                                <i class="fas fa-calendar-alt"></i>
                            </span>

                            <div class="info-box-content">

                                <span class="info-box-text">
                                    Date
                                </span>

                                <span class="info-box-number">
                                    {{ now()->format('M d, Y') }}
                                </span>

                            </div>

                        </div>

                    </div>

                </div>

                {{-- CONSENT DATE --}}
                <div class="card card-outline card-primary">

                    <div class="card-header">

                        <h3 class="card-title">
                            <i class="fas fa-calendar-check mr-1"></i>
                            Consent Date
                        </h3>

                    </div>

                    <div class="card-body">

                        <div class="form-group mb-0">

                            <label for="consent_date">
                                Date of Consent
                                <span class="text-danger">*</span>
                            </label>

                            <input
                                type="date"
                                id="consent_date"
                                name="consent_date"
                                class="form-control
                                    @error('consent_date')
                                        is-invalid
                                    @enderror"
                                value="{{ old(
                                    'consent_date',
                                    now()->toDateString()
                                ) }}"
                                required
                            >

                            @error('consent_date')
                                <span class="invalid-feedback">
                                    {{ $message }}
                                </span>
                            @enderror

                        </div>

                    </div>

                </div>

                {{-- IMPORTANT INFORMATION --}}
                <div class="card card-outline card-info">

                    <div class="card-header">

                        <h3 class="card-title">
                            <i class="fas fa-shield-alt mr-1"></i>
                            Important
                        </h3>

                    </div>

                    <div class="card-body">

                        <p>
                            Before submitting this consent, verify that:
                        </p>

                        <ul class="pl-4 mb-0">

                            <li class="mb-2">
                                The patient has read the full document.
                            </li>

                            <li class="mb-2">
                                The procedure has been clearly explained.
                            </li>

                            <li class="mb-2">
                                All questions have been answered.
                            </li>

                            <li>
                                The digital signature belongs to the
                                patient.
                            </li>

                        </ul>

                    </div>

                </div>

                {{-- ACTIONS --}}
                <div class="card">

                    <div class="card-header">

                        <h3 class="card-title">
                            <i class="fas fa-file-signature mr-1"></i>
                            Complete Consent
                        </h3>

                    </div>

                    <div class="card-body">

                        <button
                            type="submit"
                            id="submit-consent"
                            class="btn btn-success btn-lg btn-block"
                        >
                            <i class="fas fa-check-circle mr-1"></i>
                            Accept and Sign Consent
                        </button>

                        <a
                            href="{{ route(
                                'consultas.index',
                                $consultation->patient_id
                            ) }}"
                            class="btn btn-secondary btn-block"
                        >
                            <i class="fas fa-times mr-1"></i>
                            Cancel
                        </a>

                    </div>

                </div>

            </div>

        </div>

    </form>

@stop

@section('css')
    <style>
        .consent-document {
            font-size: 16px;
            line-height: 1.8;
        }

        .consent-document p {
            margin-bottom: 1.25rem;
            text-align: justify;
        }

        .consent-list {
            padding-left: 1.4rem;
        }

        .consent-list li {
            margin-bottom: 1.25rem;
            padding-left: .5rem;
        }

        .signature-container {
            position: relative;
            width: 100%;
            height: 260px;
            overflow: hidden;
            background-color: #ffffff;
            border: 2px dashed #adb5bd;
            border-radius: 6px;
            touch-action: none;
        }

        .signature-container.signature-active {
            border-color: #28a745;
            border-style: solid;
        }

        .signature-container.signature-error {
            border-color: #dc3545;
        }

        #consent-signature-pad {
            display: block;
            width: 100%;
            height: 100%;
            cursor: crosshair;
            touch-action: none;
        }

        .signature-placeholder {
            position: absolute;
            top: 50%;
            left: 50%;
            z-index: 0;
            color: #adb5bd;
            font-size: 22px;
            pointer-events: none;
            transform: translate(-50%, -50%);
        }

        .patient-name {
            white-space: normal;
        }

        @media (max-width: 767.98px) {
            .consent-document {
                font-size: 15px;
                line-height: 1.65;
            }

            .consent-document p {
                text-align: left;
            }

            .signature-container {
                height: 220px;
            }
        }
    </style>
@stop

@section('js')

    <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const form =
                document.getElementById('consent-form');

            const canvas =
                document.getElementById('consent-signature-pad');

            const signatureContainer =
                document.getElementById('signature-container');

            const hiddenInput =
                document.getElementById('consent_signature');

            const clearButton =
                document.getElementById('clear-consent-signature');

            const placeholder =
                document.getElementById('signature-placeholder');

            const signatureError =
                document.getElementById('signature-error-message');

            const submitButton =
                document.getElementById('submit-consent');

            if (
                !form ||
                !canvas ||
                typeof SignaturePad === 'undefined'
            ) {
                return;
            }

            const signaturePad = new SignaturePad(canvas, {
                minWidth: 0.8,
                maxWidth: 2.5,
                penColor: 'rgb(20, 20, 20)',
                backgroundColor: 'rgb(255, 255, 255)'
            });

            function resizeCanvas() {

                let savedSignature = null;

                if (!signaturePad.isEmpty()) {
                    savedSignature = signaturePad.toData();
                }

                const ratio = Math.max(
                    window.devicePixelRatio || 1,
                    1
                );

                canvas.width =
                    signatureContainer.offsetWidth * ratio;

                canvas.height =
                    signatureContainer.offsetHeight * ratio;

                canvas.getContext('2d').scale(ratio, ratio);

                signaturePad.clear();

                if (savedSignature) {
                    signaturePad.fromData(savedSignature);
                }

            }

            function updateSignatureAppearance() {

                const hasSignature = !signaturePad.isEmpty();

                placeholder.classList.toggle(
                    'd-none',
                    hasSignature
                );

                signatureContainer.classList.toggle(
                    'signature-active',
                    hasSignature
                );

                if (hasSignature) {

                    signatureContainer.classList.remove(
                        'signature-error'
                    );

                    signatureError.classList.add('d-none');

                }

            }

            resizeCanvas();
            updateSignatureAppearance();

            let resizeTimer;

            window.addEventListener('resize', function () {

                clearTimeout(resizeTimer);

                resizeTimer = setTimeout(function () {
                    resizeCanvas();
                    updateSignatureAppearance();
                }, 150);

            });

            signaturePad.addEventListener(
                'beginStroke',
                function () {
                    placeholder.classList.add('d-none');
                }
            );

            signaturePad.addEventListener(
                'endStroke',
                function () {
                    updateSignatureAppearance();
                }
            );

            clearButton.addEventListener('click', function () {

                signaturePad.clear();

                hiddenInput.value = '';

                updateSignatureAppearance();

            });

            form.addEventListener('submit', function (event) {

                if (signaturePad.isEmpty()) {

                    event.preventDefault();

                    signatureContainer.classList.add(
                        'signature-error'
                    );

                    signatureError.classList.remove('d-none');

                    signatureContainer.scrollIntoView({
                        behavior: 'smooth',
                        block: 'center'
                    });

                    return;
                }

                hiddenInput.value = signaturePad.toDataURL(
                    'image/png'
                );

                submitButton.disabled = true;

                submitButton.innerHTML =
                    '<i class="fas fa-spinner fa-spin mr-1"></i>' +
                    'Saving Consent...';

            });

        });
    </script>

@stop