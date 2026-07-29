@extends('adminlte::page')

@section('title', 'Treatment Details')

@section('content_header')

    <div class="d-flex justify-content-between align-items-center flex-wrap">

        <div>

            <h1 class="mb-0">
                Treatment Details
            </h1>

            <small class="text-muted">
                Review the treatment description and clinical formula
            </small>

        </div>

        <div class="d-flex flex-wrap mt-2 mt-md-0">

            <a href="{{ route('treatments.index') }}"
               class="btn btn-outline-secondary mr-2">

                <i class="fas fa-arrow-left mr-1"></i>
                Back to Treatments

            </a>

            <a href="{{ route('treatments.edit', $treatment) }}"
               class="btn btn-warning">

                <i class="fas fa-edit mr-1"></i>
                Edit Treatment

            </a>

        </div>

    </div>

@stop

@section('content')

    {{-- SUCCESS MESSAGE --}}
    @if (session('success'))

        <div class="alert alert-success alert-dismissible fade show">

            <i class="fas fa-check-circle mr-2"></i>

            {{ session('success') }}

            <button type="button"
                    class="close"
                    data-dismiss="alert"
                    aria-label="Close">

                <span aria-hidden="true">&times;</span>

            </button>

        </div>

    @endif

    <div class="row">

        {{-- MAIN INFORMATION --}}
        <div class="col-lg-8">

            {{-- TREATMENT HEADER --}}
            <div class="card treatment-header-card">

                <div class="card-body">

                    <div class="treatment-header">

                        <div class="treatment-main-icon">

                            <i class="fas fa-syringe"></i>

                        </div>

                        <div class="treatment-heading">

                            <span class="treatment-label">
                                Treatment
                            </span>

                            <h2>
                                {{ $treatment->name }}
                            </h2>

                            <div class="treatment-meta">

                                <span>

                                    <i class="fas fa-hashtag"></i>

                                    Treatment ID:
                                    {{ $treatment->id }}

                                </span>

                                @if ($treatment->created_at)

                                    <span>

                                        <i class="fas fa-calendar-plus"></i>

                                        Created:
                                        {{ $treatment->created_at->format('M d, Y') }}

                                    </span>

                                @endif

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            {{-- DESCRIPTION --}}
            <div class="card description-card">

                <div class="card-header border-0">

                    <h3 class="card-title font-weight-bold">

                        <i class="fas fa-align-left text-info mr-2"></i>

                        Description

                    </h3>

                </div>

                <div class="card-body">

                    @if ($treatment->description)

                        <div class="description-content">

                            {!! nl2br(e($treatment->description)) !!}

                        </div>

                    @else

                        <div class="empty-field">

                            <div class="empty-field-icon">

                                <i class="fas fa-file-alt"></i>

                            </div>

                            <div>

                                <strong>
                                    No description registered
                                </strong>

                                <p>
                                    This treatment does not currently have a description.
                                </p>

                            </div>

                        </div>

                    @endif

                </div>

            </div>

            {{-- FORMULA --}}
            <div class="card formula-card">

                <div class="card-header border-0">

                    <div class="d-flex justify-content-between align-items-center flex-wrap">

                        <div>

                            <h3 class="card-title font-weight-bold">

                                <i class="fas fa-flask text-success mr-2"></i>

                                Treatment Formula

                            </h3>

                            <div class="mt-1">

                                <small class="text-muted">
                                    Ingredients, quantities and administration information
                                </small>

                            </div>

                        </div>

                        @if ($treatment->formula)

                            <span class="badge badge-success formula-status mt-2 mt-sm-0">

                                <i class="fas fa-check-circle mr-1"></i>

                                Formula Available

                            </span>

                        @endif

                    </div>

                </div>

                <div class="card-body">

                    @if ($treatment->formula)

                        <div class="formula-container">

                            <div class="formula-toolbar">

                                <span>

                                    <i class="fas fa-prescription-bottle-alt mr-1"></i>

                                    Clinical Formula

                                </span>

                                <button type="button"
                                        class="btn btn-sm btn-outline-secondary"
                                        onclick="copyFormula()"
                                        id="copy-formula-button">

                                    <i class="far fa-copy mr-1"></i>

                                    Copy Formula

                                </button>

                            </div>

                            <pre id="treatment-formula">{{ $treatment->formula }}</pre>

                        </div>

                    @else

                        <div class="empty-field">

                            <div class="empty-field-icon formula-empty-icon">

                                <i class="fas fa-flask"></i>

                            </div>

                            <div>

                                <strong>
                                    No formula registered
                                </strong>

                                <p>
                                    This treatment does not currently include formula information.
                                </p>

                            </div>

                        </div>

                    @endif

                </div>

            </div>

            {{-- ACTIONS --}}
            <div class="page-actions">

                <a href="{{ route('treatments.index') }}"
                   class="btn btn-outline-secondary">

                    <i class="fas fa-arrow-left mr-1"></i>
                    Back

                </a>

                <a href="{{ route('treatments.edit', $treatment) }}"
                   class="btn btn-warning">

                    <i class="fas fa-edit mr-1"></i>
                    Edit Treatment

                </a>

            </div>

        </div>

        {{-- SIDEBAR --}}
        <div class="col-lg-4">

            <div class="card treatment-summary-card">

                <div class="card-header border-0">

                    <h3 class="card-title font-weight-bold">

                        <i class="fas fa-clipboard-list text-info mr-2"></i>

                        Treatment Summary

                    </h3>

                </div>

                <div class="card-body">

                    <div class="summary-icon">

                        <i class="fas fa-capsules"></i>

                    </div>

                    <div class="summary-item">

                        <div class="summary-item-icon">

                            <i class="fas fa-syringe"></i>

                        </div>

                        <div>

                            <small>
                                Treatment Name
                            </small>

                            <strong>
                                {{ $treatment->name }}
                            </strong>

                        </div>

                    </div>

                    <div class="summary-item">

                        <div class="summary-item-icon">

                            <i class="fas fa-file-medical-alt"></i>

                        </div>

                        <div>

                            <small>
                                Description
                            </small>

                            <strong>

                                {{ $treatment->description
                                    ? 'Available'
                                    : 'Not registered' }}

                            </strong>

                        </div>

                    </div>

                    <div class="summary-item">

                        <div class="summary-item-icon">

                            <i class="fas fa-flask"></i>

                        </div>

                        <div>

                            <small>
                                Formula
                            </small>

                            <strong>

                                {{ $treatment->formula
                                    ? 'Available'
                                    : 'Not registered' }}

                            </strong>

                        </div>

                    </div>

                    @if ($treatment->updated_at)

                        <div class="summary-item">

                            <div class="summary-item-icon">

                                <i class="fas fa-clock"></i>

                            </div>

                            <div>

                                <small>
                                    Last Updated
                                </small>

                                <strong>
                                    {{ $treatment->updated_at->format('M d, Y') }}
                                </strong>

                            </div>

                        </div>

                    @endif

                </div>

            </div>

            <div class="card information-card">

                <div class="card-body">

                    <div class="information-title">

                        <i class="fas fa-info-circle"></i>

                        <strong>
                            Treatment Catalog
                        </strong>

                    </div>

                    <p>
                        This treatment can be selected when creating or
                        editing a patient consultation.
                    </p>

                </div>

            </div>

        </div>

    </div>

@stop

@section('css')

    <style>

        .treatment-header-card,
        .description-card,
        .formula-card,
        .treatment-summary-card,
        .information-card {
            overflow: hidden;
            border: 0;
            border-radius: 9px;
            box-shadow: 0 5px 18px rgba(0, 0, 0, .07);
        }

        .treatment-header-card {
            border-left: 4px solid #17a2b8;
        }

        .description-card {
            border-top: 3px solid #17a2b8;
        }

        .formula-card {
            border-top: 3px solid #28a745;
        }

        .treatment-summary-card {
            position: sticky;
            top: 75px;
            border-top: 3px solid #007bff;
        }

        .information-card {
            border-left: 4px solid #17a2b8;
        }

        .treatment-header {
            display: flex;
            align-items: center;
        }

        .treatment-main-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            flex: 0 0 82px;
            width: 82px;
            height: 82px;
            margin-right: 19px;
            color: #ffffff;
            font-size: 31px;
            background:
                linear-gradient(
                    135deg,
                    #17a2b8,
                    #007bff
                );
            border-radius: 18px;
            box-shadow: 0 7px 18px rgba(0, 123, 255, .22);
        }

        .treatment-heading {
            min-width: 0;
        }

        .treatment-label {
            display: inline-block;
            margin-bottom: 4px;
            color: #17a2b8;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: .08em;
            text-transform: uppercase;
        }

        .treatment-heading h2 {
            margin: 0 0 9px;
            color: #343a40;
            font-size: 25px;
            font-weight: 700;
        }

        .treatment-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 8px 17px;
            color: #6c757d;
            font-size: 12px;
        }

        .treatment-meta i {
            width: 17px;
            margin-right: 4px;
            color: #17a2b8;
            text-align: center;
        }

        .description-content {
            min-height: 90px;
            padding: 18px;
            color: #495057;
            font-size: 14px;
            line-height: 1.75;
            background-color: #fbfcfd;
            border: 1px solid #e6eaed;
            border-radius: 8px;
        }

        .formula-status {
            padding: 7px 11px;
            font-size: 11px;
        }

        .formula-container {
            overflow: hidden;
            border: 1px solid #dfe5e8;
            border-radius: 9px;
        }

        .formula-toolbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            padding: 11px 14px;
            color: #495057;
            font-size: 12px;
            font-weight: 700;
            background-color: #f4f6f9;
            border-bottom: 1px solid #dfe5e8;
        }

        .formula-container pre {
            min-height: 300px;
            max-height: 650px;
            overflow: auto;
            margin: 0;
            padding: 22px;
            color: #343a40;
            font-family:
                SFMono-Regular,
                Menlo,
                Monaco,
                Consolas,
                "Liberation Mono",
                "Courier New",
                monospace;
            font-size: 13px;
            line-height: 1.75;
            white-space: pre-wrap;
            word-break: break-word;
            background-color: #fbfcfd;
            border: 0;
        }

        .empty-field {
            display: flex;
            align-items: center;
            min-height: 115px;
            padding: 18px;
            background-color: #f8f9fa;
            border: 1px dashed #ced4da;
            border-radius: 8px;
        }

        .empty-field-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            flex: 0 0 52px;
            width: 52px;
            height: 52px;
            margin-right: 14px;
            color: #17a2b8;
            font-size: 20px;
            background-color: #e8f7fa;
            border-radius: 50%;
        }

        .formula-empty-icon {
            color: #28a745;
            background-color: #eaf7ed;
        }

        .empty-field strong,
        .empty-field p {
            display: block;
        }

        .empty-field strong {
            color: #495057;
            font-size: 13px;
        }

        .empty-field p {
            margin: 4px 0 0;
            color: #868e96;
            font-size: 12px;
        }

        .page-actions {
            display: flex;
            justify-content: flex-end;
            gap: 9px;
            margin-bottom: 25px;
        }

        .page-actions .btn {
            min-width: 130px;
        }

        .summary-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 78px;
            height: 78px;
            margin: 5px auto 24px;
            color: #ffffff;
            font-size: 30px;
            background:
                linear-gradient(
                    135deg,
                    #17a2b8,
                    #007bff
                );
            border-radius: 50%;
            box-shadow: 0 7px 17px rgba(0, 123, 255, .22);
        }

        .summary-item {
            display: flex;
            align-items: center;
            padding: 13px 0;
            border-bottom: 1px solid #edf0f2;
        }

        .summary-item:last-child {
            border-bottom: 0;
        }

        .summary-item-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            flex: 0 0 40px;
            width: 40px;
            height: 40px;
            margin-right: 11px;
            color: #17a2b8;
            background-color: #e8f7fa;
            border-radius: 9px;
        }

        .summary-item > div:last-child {
            min-width: 0;
        }

        .summary-item small,
        .summary-item strong {
            display: block;
        }

        .summary-item small {
            color: #868e96;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: .05em;
            text-transform: uppercase;
        }

        .summary-item strong {
            margin-top: 3px;
            overflow: hidden;
            color: #343a40;
            font-size: 13px;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .information-title {
            display: flex;
            align-items: center;
            margin-bottom: 8px;
            color: #138496;
        }

        .information-title i {
            margin-right: 8px;
        }

        .information-card p {
            margin: 0;
            color: #6c757d;
            font-size: 12px;
            line-height: 1.6;
        }

        @media (max-width: 991.98px) {

            .treatment-summary-card {
                position: static;
            }

        }

        @media (max-width: 767.98px) {

            .treatment-header {
                align-items: flex-start;
            }

            .treatment-main-icon {
                flex-basis: 64px;
                width: 64px;
                height: 64px;
                margin-right: 14px;
                font-size: 24px;
                border-radius: 14px;
            }

            .treatment-heading h2 {
                font-size: 20px;
            }

            .treatment-meta {
                display: block;
            }

            .treatment-meta span {
                display: block;
                margin-top: 4px;
            }

            .formula-toolbar {
                flex-direction: column;
                align-items: flex-start;
            }

            .formula-toolbar .btn {
                width: 100%;
            }

            .formula-container pre {
                min-height: 240px;
                padding: 16px;
            }

            .page-actions {
                flex-direction: column-reverse;
            }

            .page-actions .btn {
                width: 100%;
            }

        }

    </style>

@stop

@section('js')

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>

        function copyFormula() {

            const formulaElement =
                document.getElementById('treatment-formula');

            const copyButton =
                document.getElementById('copy-formula-button');

            if (!formulaElement) {
                return;
            }

            const formulaText =
                formulaElement.textContent;

            navigator.clipboard
                .writeText(formulaText)
                .then(function () {

                    copyButton.innerHTML =
                        '<i class="fas fa-check mr-1"></i> Copied';

                    copyButton.classList.remove(
                        'btn-outline-secondary'
                    );

                    copyButton.classList.add(
                        'btn-success'
                    );

                    setTimeout(function () {

                        copyButton.innerHTML =
                            '<i class="far fa-copy mr-1"></i> Copy Formula';

                        copyButton.classList.remove(
                            'btn-success'
                        );

                        copyButton.classList.add(
                            'btn-outline-secondary'
                        );

                    }, 2000);

                })
                .catch(function () {

                    Swal.fire({
                        title: 'Unable to copy',
                        text: 'Please select and copy the formula manually.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });

                });

        }

    </script>

@stop