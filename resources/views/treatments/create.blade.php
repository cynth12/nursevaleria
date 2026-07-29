@extends('adminlte::page')

@section('title', 'New Treatment')

@section('content_header')

    <div class="d-flex justify-content-between align-items-center flex-wrap">

        <div>

            <h1 class="mb-0">
                New Treatment
            </h1>

            <small class="text-muted">
                Add a new treatment to the clinic catalog
            </small>

        </div>

        <a href="{{ route('treatments.index') }}"
           class="btn btn-outline-secondary mt-2 mt-md-0">

            <i class="fas fa-arrow-left mr-1"></i>
            Back to Treatments

        </a>

    </div>

@stop

@section('content')

    {{-- VALIDATION ERRORS --}}
    @if ($errors->any())

        <div class="alert alert-danger alert-dismissible fade show">

            <div class="d-flex align-items-start">

                <i class="fas fa-exclamation-triangle mr-2 mt-1"></i>

                <div>

                    <strong>
                        Please review the following information:
                    </strong>

                    <ul class="mb-0 mt-2 pl-3">

                        @foreach ($errors->all() as $error)

                            <li>
                                {{ $error }}
                            </li>

                        @endforeach

                    </ul>

                </div>

            </div>

            <button type="button"
                    class="close"
                    data-dismiss="alert"
                    aria-label="Close">

                <span aria-hidden="true">&times;</span>

            </button>

        </div>

    @endif

    <div class="row">

        {{-- FORM --}}
        <div class="col-lg-8">

            <form action="{{ route('treatments.store') }}"
                  method="POST"
                  id="treatment-form">

                @csrf

                {{-- GENERAL INFORMATION --}}
                <div class="card treatment-form-card">

                    <div class="card-header border-0">

                        <h3 class="card-title font-weight-bold">

                            <i class="fas fa-capsules text-info mr-2"></i>

                            Treatment Information

                        </h3>

                        <div class="mt-1">

                            <small class="text-muted">
                                Enter the treatment name and description
                            </small>

                        </div>

                    </div>

                    <div class="card-body">

                        {{-- NAME --}}
                        <div class="form-group">

                            <label for="name">

                                Treatment Name

                                <span class="text-danger">*</span>

                            </label>

                            <div class="input-group">

                                <div class="input-group-prepend">

                                    <span class="input-group-text">

                                        <i class="fas fa-syringe"></i>

                                    </span>

                                </div>

                                <input type="text"
                                       name="name"
                                       id="name"
                                       class="form-control @error('name') is-invalid @enderror"
                                       value="{{ old('name') }}"
                                       placeholder="Enter treatment name"
                                       maxlength="255"
                                       required
                                       autofocus>

                                @error('name')

                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>

                                @enderror

                            </div>

                            <small class="form-text text-muted">

                                Use a clear and recognizable name for the treatment.

                            </small>

                        </div>

                        {{-- DESCRIPTION --}}
                        <div class="form-group mb-0">

                            <label for="description">
                                Description
                            </label>

                            <div class="input-group">

                                <div class="input-group-prepend">

                                    <span class="input-group-text textarea-icon">

                                        <i class="fas fa-align-left"></i>

                                    </span>

                                </div>

                                <textarea name="description"
                                          id="description"
                                          rows="4"
                                          class="form-control @error('description') is-invalid @enderror"
                                          placeholder="Describe the treatment, purpose or indications">{{ old('description') }}</textarea>

                                @error('description')

                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>

                                @enderror

                            </div>

                            <div class="field-counter">

                                <small class="text-muted">
                                    Optional treatment description
                                </small>

                                <small class="text-muted"
                                       id="description-counter">
                                    0 characters
                                </small>

                            </div>

                        </div>

                    </div>

                </div>

                {{-- FORMULA --}}
                <div class="card formula-card">

                    <div class="card-header border-0">

                        <h3 class="card-title font-weight-bold">

                            <i class="fas fa-flask text-success mr-2"></i>

                            Treatment Formula

                        </h3>

                        <div class="mt-1">

                            <small class="text-muted">
                                Add ingredients, quantities and preparation details
                            </small>

                        </div>

                    </div>

                    <div class="card-body">

                        <div class="form-group mb-0">

                            <label for="formula">

                                Formula

                                <span class="text-danger">*</span>

                            </label>

                            <textarea name="formula"
                                      id="formula"
                                      rows="12"
                                      class="form-control formula-textarea @error('formula') is-invalid @enderror"
                                      placeholder="Example:

Vitamin C ............... 1 g
Magnesium ............... 500 mg
Normal saline ........... 500 ml

Administration instructions..."
                                      required>{{ old('formula') }}</textarea>

                            @error('formula')

                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>

                            @enderror

                            <div class="field-counter">

                                <small class="text-muted">

                                    <i class="fas fa-info-circle mr-1"></i>

                                    Include ingredients, dosage and administration instructions.

                                </small>

                                <small class="text-muted"
                                       id="formula-counter">

                                    0 characters

                                </small>

                            </div>

                        </div>

                    </div>

                </div>

                {{-- ACTIONS --}}
                <div class="form-actions">

                    <a href="{{ route('treatments.index') }}"
                       class="btn btn-outline-secondary">

                        <i class="fas fa-times mr-1"></i>
                        Cancel

                    </a>

                    <button type="submit"
                            class="btn btn-success"
                            id="save-treatment-button">

                        <span class="button-content">

                            <i class="fas fa-save mr-1"></i>
                            Save Treatment

                        </span>

                        <span class="button-loading d-none">

                            <span class="spinner-border spinner-border-sm mr-2"
                                  role="status"
                                  aria-hidden="true">
                            </span>

                            Saving...

                        </span>

                    </button>

                </div>

            </form>

        </div>

        {{-- SIDEBAR --}}
        <div class="col-lg-4">

            <div class="card treatment-summary-card">

                <div class="card-header border-0">

                    <h3 class="card-title font-weight-bold">

                        <i class="fas fa-clipboard-check text-info mr-2"></i>

                        Treatment Summary

                    </h3>

                </div>

                <div class="card-body">

                    <div class="summary-icon">

                        <i class="fas fa-syringe"></i>

                    </div>

                    <div class="summary-field">

                        <small>
                            Treatment Name
                        </small>

                        <strong id="summary-name">
                            Not entered
                        </strong>

                    </div>

                    <div class="summary-field">

                        <small>
                            Description
                        </small>

                        <strong id="summary-description">
                            Not entered
                        </strong>

                    </div>

                    <div class="summary-field">

                        <small>
                            Formula
                        </small>

                        <strong id="summary-formula">
                            Not entered
                        </strong>

                    </div>

                    <div class="required-information">

                        <i class="fas fa-asterisk"></i>

                        <div>

                            <strong>
                                Required fields
                            </strong>

                            <p>
                                Treatment name and formula must be completed
                                before saving.
                            </p>

                        </div>

                    </div>

                </div>

            </div>

            <div class="card help-card">

                <div class="card-body">

                    <div class="help-title">

                        <i class="fas fa-lightbulb"></i>

                        <strong>
                            Helpful Tip
                        </strong>

                    </div>

                    <p>
                        Use the same formatting for all treatment formulas.
                        This will make consultation records easier to read
                        and print.
                    </p>

                </div>

            </div>

        </div>

    </div>

@stop

@section('css')

    <style>

        .treatment-form-card,
        .formula-card,
        .treatment-summary-card,
        .help-card {
            overflow: hidden;
            border: 0;
            border-radius: 9px;
            box-shadow: 0 5px 18px rgba(0, 0, 0, .07);
        }

        .treatment-form-card {
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

        .help-card {
            border-left: 4px solid #ffc107;
        }

        .form-group label {
            color: #343a40;
            font-size: 13px;
            font-weight: 700;
        }

        .input-group-text {
            min-width: 47px;
            justify-content: center;
            color: #17a2b8;
            background-color: #f4f6f9;
        }

        .textarea-icon {
            align-items: flex-start;
            padding-top: 12px;
        }

        .form-control {
            border-color: #d7dde1;
        }

        .form-control:focus {
            border-color: #17a2b8;
            box-shadow: 0 0 0 .2rem rgba(23, 162, 184, .12);
        }

        textarea.form-control {
            resize: vertical;
        }

        .formula-textarea {
            min-height: 280px;
            padding: 18px;
            font-family:
                SFMono-Regular,
                Menlo,
                Monaco,
                Consolas,
                "Liberation Mono",
                "Courier New",
                monospace;
            font-size: 13px;
            line-height: 1.65;
            background-color: #fbfcfd;
        }

        .field-counter {
            display: flex;
            justify-content: space-between;
            gap: 12px;
            margin-top: 7px;
        }

        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 9px;
            margin-bottom: 25px;
        }

        .form-actions .btn {
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

        .summary-field {
            padding: 12px 0;
            border-bottom: 1px solid #edf0f2;
        }

        .summary-field:last-of-type {
            border-bottom: 0;
        }

        .summary-field small,
        .summary-field strong {
            display: block;
        }

        .summary-field small {
            margin-bottom: 4px;
            color: #868e96;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: .06em;
            text-transform: uppercase;
        }

        .summary-field strong {
            display: -webkit-box;
            overflow: hidden;
            color: #343a40;
            font-size: 13px;
            line-height: 1.5;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 3;
        }

        .required-information {
            display: flex;
            align-items: flex-start;
            margin-top: 20px;
            padding: 13px;
            color: #856404;
            background-color: #fff8df;
            border: 1px solid #ffeeba;
            border-radius: 8px;
        }

        .required-information > i {
            margin-top: 4px;
            margin-right: 10px;
            font-size: 11px;
        }

        .required-information strong,
        .required-information p {
            display: block;
        }

        .required-information strong {
            font-size: 12px;
        }

        .required-information p {
            margin: 3px 0 0;
            font-size: 11px;
            line-height: 1.45;
        }

        .help-title {
            display: flex;
            align-items: center;
            margin-bottom: 8px;
            color: #856404;
        }

        .help-title i {
            margin-right: 8px;
        }

        .help-card p {
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

            .field-counter {
                flex-direction: column;
                gap: 3px;
            }

            .form-actions {
                flex-direction: column-reverse;
            }

            .form-actions .btn {
                width: 100%;
            }

            .formula-textarea {
                min-height: 240px;
            }

        }

    </style>

@stop

@section('js')

    <script>

        document.addEventListener('DOMContentLoaded', function () {

            const treatmentForm =
                document.getElementById('treatment-form');

            const nameInput =
                document.getElementById('name');

            const descriptionInput =
                document.getElementById('description');

            const formulaInput =
                document.getElementById('formula');

            const summaryName =
                document.getElementById('summary-name');

            const summaryDescription =
                document.getElementById('summary-description');

            const summaryFormula =
                document.getElementById('summary-formula');

            const descriptionCounter =
                document.getElementById('description-counter');

            const formulaCounter =
                document.getElementById('formula-counter');

            const saveButton =
                document.getElementById('save-treatment-button');

            function updateSummary() {

                summaryName.textContent =
                    nameInput.value.trim() || 'Not entered';

                summaryDescription.textContent =
                    descriptionInput.value.trim() || 'Not entered';

                summaryFormula.textContent =
                    formulaInput.value.trim() || 'Not entered';

            }

            function updateCounters() {

                descriptionCounter.textContent =
                    descriptionInput.value.length + ' characters';

                formulaCounter.textContent =
                    formulaInput.value.length + ' characters';

            }

            [
                nameInput,
                descriptionInput,
                formulaInput
            ].forEach(function (input) {

                input.addEventListener('input', function () {

                    updateSummary();
                    updateCounters();

                });

            });

            treatmentForm.addEventListener('submit', function () {

                saveButton.disabled = true;

                saveButton
                    .querySelector('.button-content')
                    .classList
                    .add('d-none');

                saveButton
                    .querySelector('.button-loading')
                    .classList
                    .remove('d-none');

            });

            updateSummary();
            updateCounters();

        });

    </script>

@stop