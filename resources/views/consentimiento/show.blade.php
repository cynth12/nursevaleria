@extends('adminlte::page')

@section('title', 'Signed Consent')

@section('content_header')

    <div class="d-flex justify-content-between align-items-center flex-wrap">

        <div>
            <h1 class="mb-0">
                Signed Informed Consent
            </h1>

            <small class="text-muted">
                IM/IV medication administration authorization
            </small>
        </div>

        <div class="mt-2 mt-md-0">

            <a
                href="{{ route('consentimiento.edit', $consentimiento->id) }}"
                class="btn btn-warning"
            >
                <i class="fas fa-edit mr-1"></i>
                Edit Consent
            </a>

            @if ($consentimiento->consultation)
                <a
                    href="{{ route('consultas.show', $consentimiento->consultation->id) }}"
                    class="btn btn-secondary"
                >
                    <i class="fas fa-arrow-left mr-1"></i>
                    Return to Consultation
                </a>
            @endif

        </div>

    </div>

@stop

@section('content')

    @if (session('success'))

        <div class="alert alert-success alert-dismissible fade show">

            <i class="fas fa-check-circle mr-1"></i>
            {{ session('success') }}

            <button
                type="button"
                class="close"
                data-dismiss="alert"
            >
                <span>&times;</span>
            </button>

        </div>

    @endif

    <div class="row">

        {{-- MAIN COLUMN --}}
        <div class="col-lg-8">

            {{-- DOCUMENT HEADER --}}
            <div class="card card-primary">

                <div class="card-header">

                    <h3 class="card-title">
                        <i class="fas fa-file-signature mr-1"></i>
                        Nurse Valeria IV Therapy
                    </h3>

                </div>

                <div class="card-body text-center py-4">

                    <div class="mb-3">
                        <i class="fas fa-file-medical-alt fa-3x text-primary"></i>
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
                                {{ $consentimiento->patient->name }}
                                {{ $consentimiento->patient->last_name }}
                            </p>

                        </div>

                        <div class="col-md-6 mb-3">

                            <strong>
                                Registration Date
                            </strong>

                            <p class="text-muted mb-0">
                                {{ $consentimiento->patient->registration_date
                                    ? \Carbon\Carbon::parse(
                                        $consentimiento->patient->registration_date
                                    )->format('F d, Y')
                                    : 'Not registered' }}
                            </p>

                        </div>

                        <div class="col-md-6">

                            <strong>
                                Consent Date
                            </strong>

                            <p class="text-muted mb-0">
                                {{ $consentimiento->consent_date
                                    ? \Carbon\Carbon::parse(
                                        $consentimiento->consent_date
                                    )->format('F d, Y')
                                    : 'Not registered' }}
                            </p>

                        </div>

                        <div class="col-md-6">

                            <strong>
                                Consent Status
                            </strong>

                            <p class="mb-0 mt-1">

                                @if ($consentimiento->consent_accepted)

                                    <span class="badge badge-success">
                                        <i class="fas fa-check mr-1"></i>
                                        Accepted
                                    </span>

                                @else

                                    <span class="badge badge-danger">
                                        <i class="fas fa-times mr-1"></i>
                                        Not Accepted
                                    </span>

                                @endif

                            </p>

                        </div>

                    </div>

                </div>

            </div>

            {{-- CONSENT DOCUMENT --}}
            <div class="card card-outline card-primary">

                <div class="card-header">

                    <h3 class="card-title">
                        <i class="fas fa-balance-scale mr-1"></i>
                        Consent Declaration
                    </h3>

                </div>

                <div class="card-body consent-document">

                    <p>
                        I,
                        <strong>
                            {{ $consentimiento->patient->name }}
                            {{ $consentimiento->patient->last_name }}
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
                            The nurse
                            <strong>
                                {{ $consentimiento->nurse_name }}
                            </strong>,
                            with professional license
                            <strong>
                                {{ $consentimiento->nurse_id }}
                            </strong>,
                            has provided me with complete information
                            regarding my current condition.

                            This information was provided in a clear,
                            simple, precise and understandable manner,
                            including available options, possible risks
                            and potential complications.
                        </li>

                    </ol>

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

                    <p class="mb-0 procedure-text">
                        {{ $consentimiento->authorized_procedure
                            ?: 'No procedure was registered.' }}
                    </p>

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

                    @if ($consentimiento->digital_signature)

                        <div class="signature-display">

                            <img
                                src="{{ $consentimiento->digital_signature }}"
                                alt="Patient digital signature"
                            >

                        </div>

                        <div class="text-center mt-3">

                            <span class="badge badge-success">
                                <i class="fas fa-check-circle mr-1"></i>
                                Digitally signed
                            </span>

                        </div>

                    @else

                        <div class="alert alert-warning mb-0">

                            <i class="fas fa-exclamation-triangle mr-1"></i>
                            No digital signature is available for this
                            consent.

                        </div>

                    @endif

                </div>

            </div>

        </div>

        {{-- SIDE COLUMN --}}
        <div class="col-lg-4">

            {{-- SUMMARY --}}
            <div class="card">

                <div class="card-header">

                    <h3 class="card-title">
                        <i class="fas fa-clipboard-check mr-1"></i>
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

                            <span class="info-box-number summary-name">
                                {{ $consentimiento->patient->name }}
                                {{ $consentimiento->patient->last_name }}
                            </span>

                        </div>

                    </div>

                    <div class="info-box bg-light">

                        <span class="info-box-icon">
                            <i class="fas fa-user-nurse"></i>
                        </span>

                        <div class="info-box-content">

                            <span class="info-box-text">
                                Nurse
                            </span>

                            <span class="info-box-number summary-name">
                                {{ $consentimiento->nurse_name }}
                            </span>

                        </div>

                    </div>

                    <div class="info-box bg-light">

                        <span class="info-box-icon">
                            <i class="fas fa-id-card"></i>
                        </span>

                        <div class="info-box-content">

                            <span class="info-box-text">
                                Professional License
                            </span>

                            <span class="info-box-number">
                                {{ $consentimiento->nurse_id }}
                            </span>

                        </div>

                    </div>

                    <div class="info-box bg-light">

                        <span class="info-box-icon">
                            <i class="fas fa-calendar-check"></i>
                        </span>

                        <div class="info-box-content">

                            <span class="info-box-text">
                                Consent Date
                            </span>

                            <span class="info-box-number">
                                {{ $consentimiento->consent_date
                                    ? \Carbon\Carbon::parse(
                                        $consentimiento->consent_date
                                    )->format('M d, Y')
                                    : 'Not registered' }}
                            </span>

                        </div>

                    </div>

                </div>

            </div>

            {{-- VALIDATION STATUS --}}
            <div class="card card-outline card-success">

                <div class="card-header">

                    <h3 class="card-title">
                        <i class="fas fa-shield-alt mr-1"></i>
                        Document Status
                    </h3>

                </div>

                <div class="card-body">

                    <div class="d-flex align-items-center mb-3">

                        <i class="fas fa-check-circle text-success fa-2x mr-3"></i>

                        <div>
                            <strong>
                                Consent registered
                            </strong>

                            <p class="text-muted mb-0">
                                This document has been saved in the
                                patient's record.
                            </p>
                        </div>

                    </div>

                    <div class="d-flex align-items-center mb-3">

                        @if ($consentimiento->digital_signature)

                            <i class="fas fa-check-circle text-success fa-2x mr-3"></i>

                            <div>
                                <strong>
                                    Signature registered
                                </strong>

                                <p class="text-muted mb-0">
                                    A digital signature is associated with
                                    this document.
                                </p>
                            </div>

                        @else

                            <i class="fas fa-times-circle text-danger fa-2x mr-3"></i>

                            <div>
                                <strong>
                                    Signature missing
                                </strong>

                                <p class="text-muted mb-0">
                                    This document does not contain a
                                    digital signature.
                                </p>
                            </div>

                        @endif

                    </div>

                    <div class="d-flex align-items-center">

                        @if ($consentimiento->consent_accepted)

                            <i class="fas fa-check-circle text-success fa-2x mr-3"></i>

                            <div>
                                <strong>
                                    Procedure accepted
                                </strong>

                                <p class="text-muted mb-0">
                                    The patient accepted the informed
                                    consent.
                                </p>
                            </div>

                        @else

                            <i class="fas fa-times-circle text-danger fa-2x mr-3"></i>

                            <div>
                                <strong>
                                    Procedure not accepted
                                </strong>

                                <p class="text-muted mb-0">
                                    The patient did not accept the
                                    informed consent.
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

                    <a
                        href="{{ route(
                            'consentimiento.edit',
                            $consentimiento->id
                        ) }}"
                        class="btn btn-warning btn-block"
                    >
                        <i class="fas fa-edit mr-1"></i>
                        Edit Consent
                    </a>

                    @if (
                        $consentimiento->consultation &&
                        Route::has('consultas.show')
                    )

                        <a
                            href="{{ route(
                                'consultas.show',
                                $consentimiento->consultation->id
                            ) }}"
                            class="btn btn-secondary btn-block"
                        >
                            <i class="fas fa-arrow-left mr-1"></i>
                            Return to Consultation
                        </a>

                    @endif

                    @if (
                        $consentimiento->patient &&
                        Route::has('consultas.index')
                    )

                        <a
                            href="{{ route(
                                'consultas.index',
                                $consentimiento->patient->id
                            ) }}"
                            class="btn btn-info btn-block"
                        >
                            <i class="fas fa-list mr-1"></i>
                            Consultation History
                        </a>

                    @endif

                </div>

            </div>

        </div>

    </div>

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

        .procedure-text {
            font-size: 16px;
            line-height: 1.7;
            white-space: pre-line;
        }

        .signature-display {
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

        .signature-display img {
            display: block;
            width: auto;
            max-width: 100%;
            max-height: 210px;
            object-fit: contain;
        }

        .summary-name {
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

            .signature-display {
                min-height: 190px;
            }

            .signature-display img {
                max-height: 170px;
            }
        }

        @media print {
            .main-header,
            .main-sidebar,
            .content-header .btn,
            .card:last-child {
                display: none !important;
            }

            .content-wrapper {
                margin-left: 0 !important;
            }

            .card {
                break-inside: avoid;
                box-shadow: none !important;
            }
        }
    </style>

@stop