@extends('adminlte::page')

@section('title', 'Consultations')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center flex-wrap">

        <div>
            <h1 class="mb-0">
                Consultations
            </h1>

            <small class="text-muted">
                Clinical history and consultation records
            </small>
        </div>

        <a href="{{ route('consultas.create', $patient->id) }}"
           class="btn btn-success mt-2 mt-md-0">

            <i class="fas fa-plus-circle mr-1"></i>
            New Consultation
        </a>

    </div>
@endsection

@section('content')

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

    {{-- ERROR MESSAGE --}}
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show">

            <i class="fas fa-exclamation-circle mr-1"></i>
            {{ session('error') }}

            <button type="button"
                    class="close"
                    data-dismiss="alert"
                    aria-label="Close">

                <span aria-hidden="true">&times;</span>
            </button>

        </div>
    @endif

    {{-- PATIENT SUMMARY --}}
    <div class="card patient-summary-card">

        <div class="card-body">

            <div class="row align-items-center">

                <div class="col-lg-7">

                    <div class="patient-profile">

                        <div class="patient-avatar">

                            {{ strtoupper(substr($patient->name ?? 'P', 0, 1)) }}

                            @if (!empty($patient->last_name))
                                {{ strtoupper(substr($patient->last_name, 0, 1)) }}
                            @endif

                        </div>

                        <div class="patient-main-information">

                            <span class="patient-label">
                                Patient
                            </span>

                            <h3>
                                {{ $patient->name }}
                                {{ $patient->last_name }}
                            </h3>

                            <div class="patient-meta">

                                <span>
                                    <i class="fas fa-id-card"></i>
                                    ID: {{ $patient->id }}
                                </span>

                                @if ($patient->date_of_birth)
                                    <span>
                                        <i class="fas fa-birthday-cake"></i>
                                        {{ \Carbon\Carbon::parse($patient->date_of_birth)->format('M d, Y') }}
                                    </span>
                                @endif

                            </div>

                        </div>

                    </div>

                </div>

                <div class="col-lg-5 mt-4 mt-lg-0">

                    <div class="patient-contact-grid">

                        <div class="patient-contact-item">

                            <div class="contact-icon">
                                <i class="fas fa-phone-alt"></i>
                            </div>

                            <div>
                                <small>Phone</small>

                                <strong>
                                    {{ $patient->phone ?: 'Not registered' }}
                                </strong>
                            </div>

                        </div>

                        <div class="patient-contact-item">

                            <div class="contact-icon">
                                <i class="fas fa-envelope"></i>
                            </div>

                            <div>
                                <small>Email</small>

                                <strong title="{{ $patient->email }}">
                                    {{ $patient->email ?: 'Not registered' }}
                                </strong>
                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    {{-- SUMMARY BOXES --}}
    <div class="row">

        <div class="col-md-4">

            <div class="small-box bg-info">

                <div class="inner">

                    <h3>
                        {{ $consultations->total() }}
                    </h3>

                    <p>Total Consultations</p>

                </div>

                <div class="icon">
                    <i class="fas fa-notes-medical"></i>
                </div>

            </div>

        </div>

        <div class="col-md-4">

            <div class="small-box bg-primary">

                <div class="inner">

                    <h3>
                        {{ $consultations->count() }}
                    </h3>

                    <p>Consultations on This Page</p>

                </div>

                <div class="icon">
                    <i class="fas fa-clipboard-list"></i>
                </div>

            </div>

        </div>

        <div class="col-md-4">

            <div class="small-box bg-success">

                <div class="inner">

                    <h3>
                        {{ $consultations->whereNotNull('consentimiento')->count() }}
                    </h3>

                    <p>Consent Forms Available</p>

                </div>

                <div class="icon">
                    <i class="fas fa-file-signature"></i>
                </div>

            </div>

        </div>

    </div>

    {{-- CONSULTATIONS --}}
    <div class="card">

        <div class="card-header border-0">

            <div class="d-flex justify-content-between align-items-center flex-wrap">

                <div>

                    <h3 class="card-title font-weight-bold">
                        <i class="fas fa-stethoscope text-info mr-1"></i>
                        Consultation History
                    </h3>

                    <div class="mt-1">
                        <small class="text-muted">
                            Review, edit and manage the patient's consultations
                        </small>
                    </div>

                </div>

                <a href="{{ route('consultas.create', $patient->id) }}"
                   class="btn btn-success btn-sm mt-2 mt-sm-0">

                    <i class="fas fa-plus mr-1"></i>
                    Add Consultation
                </a>

            </div>

        </div>

        <div class="card-body p-0">

            @if ($consultations->count() > 0)

                <div class="table-responsive">

                    <table class="table table-hover consultation-table mb-0">

                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Consultation Date</th>
                                <th>Patient</th>
                                <th>Contact</th>
                                <th>Consent Status</th>
                                <th class="text-center actions-column">
                                    Actions
                                </th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach ($consultations as $consultation)

                                <tr>

                                    {{-- NUMBER --}}
                                    <td class="text-center align-middle">

                                        <span class="consultation-number">
                                            {{ $consultations->firstItem() + $loop->index }}
                                        </span>

                                    </td>

                                    {{-- CONSULTATION DATE --}}
                                    <td class="align-middle">

                                        @if ($consultation->registration_date)

                                            <div class="consultation-date">

                                                <div class="date-icon">
                                                    <i class="fas fa-calendar-check"></i>
                                                </div>

                                                <div>

                                                    <strong>
                                                        {{ \Carbon\Carbon::parse($consultation->registration_date)->format('M d, Y') }}
                                                    </strong>

                                                    <small>
                                                        {{ \Carbon\Carbon::parse($consultation->registration_date)->format('h:i A') }}
                                                    </small>

                                                </div>

                                            </div>

                                        @else

                                            <span class="text-muted">
                                                No date registered
                                            </span>

                                        @endif

                                    </td>

                                    {{-- PATIENT --}}
                                    <td class="align-middle">

                                        <div class="patient-name-cell">

                                            <strong>
                                                {{ $consultation->patient->name }}
                                                {{ $consultation->patient->last_name }}
                                            </strong>

                                            @if ($consultation->patient->date_of_birth)

                                                <small>
                                                    <i class="fas fa-birthday-cake mr-1"></i>

                                                    {{ \Carbon\Carbon::parse($consultation->patient->date_of_birth)->format('M d, Y') }}
                                                </small>

                                            @endif

                                        </div>

                                    </td>

                                    {{-- CONTACT --}}
                                    <td class="align-middle">

                                        <div class="contact-cell">

                                            @if ($consultation->patient->phone)

                                                <div>
                                                    <i class="fas fa-phone-alt"></i>
                                                    {{ $consultation->patient->phone }}
                                                </div>

                                            @endif

                                            @if ($consultation->patient->email)

                                                <div title="{{ $consultation->patient->email }}">
                                                    <i class="fas fa-envelope"></i>

                                                    <span>
                                                        {{ $consultation->patient->email }}
                                                    </span>
                                                </div>

                                            @endif

                                            @if (
                                                !$consultation->patient->phone &&
                                                !$consultation->patient->email
                                            )

                                                <span class="text-muted">
                                                    No contact information
                                                </span>

                                            @endif

                                        </div>

                                    </td>

                                    {{-- CONSENT STATUS --}}
                                    <td class="align-middle">

                                        @if ($consultation->consentimiento)

                                            <span class="badge badge-success consent-badge">
                                                <i class="fas fa-check-circle mr-1"></i>
                                                Completed
                                            </span>

                                        @else

                                            <span class="badge badge-warning consent-badge">
                                                <i class="fas fa-clock mr-1"></i>
                                                Pending
                                            </span>

                                        @endif

                                    </td>

                                    {{-- ACTIONS --}}
                                    <td class="text-center align-middle">

                                        <div class="consultation-actions">

                                            <a href="{{ route('consultas.show', $consultation->id) }}"
                                               class="btn btn-primary btn-sm"
                                               title="View consultation">

                                                <i class="fas fa-eye mr-1"></i>
                                                View
                                            </a>

                                            <a href="{{ route('consultas.edit', $consultation->id) }}"
                                               class="btn btn-outline-success btn-sm"
                                               title="Edit consultation">

                                                <i class="fas fa-edit mr-1"></i>
                                                Edit
                                            </a>

                                            @if ($consultation->consentimiento)

                                                <a href="{{ route('consentimiento.show', $consultation->consentimiento->id) }}"
                                                   class="btn btn-info btn-sm"
                                                   title="View consent">

                                                    <i class="fas fa-file-signature mr-1"></i>
                                                    Consent
                                                </a>

                                            @else

                                                <a href="{{ route('consentimiento.create', $consultation->id) }}"
                                                   class="btn btn-warning btn-sm"
                                                   title="Create signature and consent">

                                                    <i class="fas fa-signature mr-1"></i>
                                                    Signature
                                                </a>

                                            @endif
                                                 @if (!auth()->user()->is_shift_nurse)
                                            <form action="{{ route('consultas.destroy', $consultation->id) }}"
                                                  method="POST"
                                                  class="d-inline">

                                                @csrf
                                                @method('DELETE')

                                                <button type="button"
                                                        class="btn btn-outline-danger btn-sm"
                                                        onclick="deleteConsultation(
                                                            this.form,
                                                            '{{ $consultation->registration_date
                                                                ? \Carbon\Carbon::parse($consultation->registration_date)->format('M d, Y')
                                                                : 'this consultation' }}'
                                                        )"
                                                        title="Delete consultation">

                                                    <i class="fas fa-trash-alt mr-1"></i>
                                                    Delete
                                                </button>

                                            </form>
                                            @endif

                                        </div>

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            @else

                {{-- EMPTY STATE --}}
                <div class="empty-state">

                    <div class="empty-state-icon">
                        <i class="fas fa-notes-medical"></i>
                    </div>

                    <h4>
                        No Consultations Yet
                    </h4>

                    <p>
                        This patient does not have any registered consultations.
                        Create the first consultation to begin the clinical record.
                    </p>

                    <a href="{{ route('consultas.create', $patient->id) }}"
                       class="btn btn-success">

                        <i class="fas fa-plus-circle mr-1"></i>
                        Create First Consultation
                    </a>

                </div>

            @endif

        </div>

        {{-- PAGINATION --}}
        @if ($consultations->hasPages())

            <div class="card-footer">

                <div class="pagination-container">

                    <div class="pagination-summary">

                        Showing

                        <strong>
                            {{ $consultations->firstItem() }}
                        </strong>

                        to

                        <strong>
                            {{ $consultations->lastItem() }}
                        </strong>

                        of

                        <strong>
                            {{ $consultations->total() }}
                        </strong>

                        consultations

                    </div>

                    <div>
                        {{ $consultations->appends(request()->query())->links() }}
                    </div>

                </div>

            </div>

        @endif

    </div>

@endsection

@section('css')
    <style>
        .patient-summary-card {
            overflow: hidden;
            border: 0;
            border-left: 4px solid #17a2b8;
            box-shadow: 0 5px 16px rgba(0, 0, 0, .07);
        }

        .patient-profile {
            display: flex;
            align-items: center;
        }

        .patient-avatar {
            display: flex;
            align-items: center;
            justify-content: center;
            flex: 0 0 78px;
            width: 78px;
            height: 78px;
            margin-right: 18px;
            color: #ffffff;
            font-size: 23px;
            font-weight: 700;
            letter-spacing: .04em;
            background: linear-gradient(135deg, #17a2b8, #007bff);
            border-radius: 50%;
            box-shadow: 0 6px 16px rgba(0, 123, 255, .22);
        }

        .patient-main-information {
            min-width: 0;
        }

        .patient-label {
            display: inline-block;
            margin-bottom: 4px;
            color: #17a2b8;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: .08em;
            text-transform: uppercase;
        }

        .patient-main-information h3 {
            margin: 0 0 8px;
            color: #343a40;
            font-size: 23px;
            font-weight: 700;
        }

        .patient-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 8px 17px;
            color: #6c757d;
            font-size: 13px;
        }

        .patient-meta i {
            width: 17px;
            margin-right: 4px;
            color: #17a2b8;
            text-align: center;
        }

        .patient-contact-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 12px;
        }

        .patient-contact-item {
            display: flex;
            align-items: center;
            min-width: 0;
            padding: 13px;
            background-color: #f8f9fa;
            border: 1px solid #e4e8eb;
            border-radius: 8px;
        }

        .contact-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            flex: 0 0 38px;
            width: 38px;
            height: 38px;
            margin-right: 10px;
            color: #17a2b8;
            background-color: #e8f7fa;
            border-radius: 50%;
        }

        .patient-contact-item > div:last-child {
            min-width: 0;
        }

        .patient-contact-item small,
        .patient-contact-item strong {
            display: block;
        }

        .patient-contact-item small {
            color: #868e96;
            font-size: 11px;
        }

        .patient-contact-item strong {
            max-width: 180px;
            overflow: hidden;
            color: #495057;
            font-size: 13px;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .small-box {
            min-height: 120px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, .08);
        }

        .small-box .inner h3 {
            font-size: 30px;
        }

        .small-box .icon {
            top: 8px;
        }

        .small-box .icon > i {
            font-size: 58px;
        }

        .consultation-table {
            min-width: 1120px;
        }

        .consultation-table thead th {
            padding: 14px 12px;
            color: #495057;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: .04em;
            text-transform: uppercase;
            background-color: #f4f6f9;
            border-top: 0;
            border-bottom: 2px solid #dee2e6;
            white-space: nowrap;
        }

        .consultation-table tbody td {
            padding: 14px 12px;
            border-top: 1px solid #edf0f2;
        }

        .consultation-table tbody tr {
            transition: background-color .2s ease;
        }

        .consultation-table tbody tr:hover {
            background-color: #f8fcfd;
        }

        .consultation-number {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 34px;
            height: 34px;
            padding: 0 8px;
            color: #138496;
            font-size: 13px;
            font-weight: 700;
            background-color: #e8f7fa;
            border-radius: 50%;
        }

        .consultation-date {
            display: flex;
            align-items: center;
            min-width: 150px;
        }

        .date-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            flex: 0 0 39px;
            width: 39px;
            height: 39px;
            margin-right: 10px;
            color: #17a2b8;
            background-color: #e8f7fa;
            border-radius: 50%;
        }

        .consultation-date strong,
        .consultation-date small {
            display: block;
        }

        .consultation-date strong {
            color: #343a40;
            font-size: 13px;
        }

        .consultation-date small {
            color: #868e96;
            font-size: 11px;
        }

        .patient-name-cell {
            min-width: 180px;
        }

        .patient-name-cell strong,
        .patient-name-cell small {
            display: block;
        }

        .patient-name-cell strong {
            color: #343a40;
            font-size: 14px;
        }

        .patient-name-cell small {
            margin-top: 4px;
            color: #868e96;
            font-size: 12px;
        }

        .contact-cell {
            min-width: 200px;
        }

        .contact-cell > div {
            display: flex;
            align-items: center;
            margin-bottom: 5px;
            font-size: 13px;
        }

        .contact-cell > div:last-child {
            margin-bottom: 0;
        }

        .contact-cell i {
            width: 21px;
            margin-right: 6px;
            color: #17a2b8;
            text-align: center;
        }

        .contact-cell span {
            display: inline-block;
            max-width: 180px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .consent-badge {
            min-width: 95px;
            padding: 7px 10px;
            font-size: 11px;
        }

        .actions-column {
            min-width: 420px;
        }

        .consultation-actions {
            display: flex;
            justify-content: center;
            gap: 6px;
            white-space: nowrap;
        }

        .consultation-actions .btn {
            min-width: 75px;
        }

        .empty-state {
            padding: 65px 20px;
            text-align: center;
        }

        .empty-state-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 88px;
            height: 88px;
            margin: 0 auto 20px;
            color: #17a2b8;
            font-size: 36px;
            background-color: #e8f7fa;
            border-radius: 50%;
        }

        .empty-state h4 {
            margin-bottom: 8px;
            color: #343a40;
            font-weight: 700;
        }

        .empty-state p {
            max-width: 550px;
            margin: 0 auto 20px;
            color: #6c757d;
        }

        .pagination-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
        }

        .pagination-summary {
            color: #6c757d;
            font-size: 13px;
        }

        .pagination {
            margin-bottom: 0;
        }

        @media (max-width: 991.98px) {
            .patient-contact-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 767.98px) {
            .patient-profile {
                align-items: flex-start;
            }

            .patient-avatar {
                flex-basis: 60px;
                width: 60px;
                height: 60px;
                margin-right: 13px;
                font-size: 18px;
            }

            .patient-main-information h3 {
                font-size: 19px;
            }

            .patient-meta {
                display: block;
            }

            .patient-meta span {
                display: block;
                margin-top: 4px;
            }

            .patient-contact-grid {
                grid-template-columns: 1fr;
            }

            .consultation-actions {
                justify-content: flex-start;
            }

            .pagination-container {
                flex-direction: column;
                align-items: flex-start;
            }
        }
    </style>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function deleteConsultation(form, consultationDate) {
            Swal.fire({
                title: 'Delete consultation?',
                html: `
                    Are you sure you want to delete the consultation from
                    <strong>${consultationDate}</strong>?
                    <br><br>
                    <small class="text-muted">
                        This action cannot be undone from this screen.
                    </small>
                `,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: '<i class="fas fa-trash-alt mr-1"></i> Yes, delete',
                cancelButtonText: 'Cancel',
                reverseButtons: true,
                focusCancel: true
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        }
    </script>
@endsection