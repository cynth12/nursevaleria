@extends('adminlte::page')

@section('title', 'Patient List')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center flex-wrap">

        <div>
            <h1 class="mb-0">
                {{ $titulo ?? 'Patients' }}
            </h1>

            <small class="text-muted">
                Search, review and manage patient records
            </small>
        </div>

        <a href="{{ route('patient.index') }}"
           class="btn btn-success mt-2 mt-md-0">

            <i class="fas fa-user-plus mr-1"></i>
            New Patient
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

    {{-- SUMMARY CARDS --}}
    <div class="row">

        <div class="col-md-4">
            <div class="small-box bg-info">

                <div class="inner">
                    <h3>
                        {{ $patients->total() }}
                    </h3>

                    <p>Total Patients</p>
                </div>

                <div class="icon">
                    <i class="fas fa-user-injured"></i>
                </div>

            </div>
        </div>

        <div class="col-md-4">
            <div class="small-box bg-primary">

                <div class="inner">
                    <h3>
                        {{ $patients->count() }}
                    </h3>

                    <p>Patients on This Page</p>
                </div>

                <div class="icon">
                    <i class="fas fa-list"></i>
                </div>

            </div>
        </div>

        <div class="col-md-4">
            <div class="small-box bg-secondary">

                <div class="inner">
                    <h3>
                        {{ $patients->currentPage() }}
                    </h3>

                    <p>Current Page</p>
                </div>

                <div class="icon">
                    <i class="fas fa-file-alt"></i>
                </div>

            </div>
        </div>

    </div>

    {{-- SEARCH --}}
    <div class="card card-outline card-info">

        <div class="card-header">

            <h3 class="card-title">
                <i class="fas fa-search mr-1"></i>
                Search Patients
            </h3>

        </div>

        <div class="card-body">

            <form method="GET"
                  action="{{ route('pacientes.index') }}">

                <div class="row align-items-end">

                    <div class="col-lg-7 col-md-8">

                        <div class="form-group mb-md-0">

                            <label for="search">
                                Search by Name, Last Name, Phone or Email
                            </label>

                            <div class="input-group">

                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fas fa-user-search"></i>
                                    </span>
                                </div>

                                <input type="text"
                                       name="search"
                                       id="search"
                                       class="form-control"
                                       placeholder="Enter patient information..."
                                       value="{{ request('search') }}">

                            </div>

                        </div>

                    </div>

                    <div class="col-lg-5 col-md-4 mt-3 mt-md-0">

                        <div class="d-flex flex-wrap">

                            <button type="submit"
                                    class="btn btn-primary mr-2">

                                <i class="fas fa-search mr-1"></i>
                                Search
                            </button>

                            @if (request('search'))
                                <a href="{{ route('pacientes.index') }}"
                                   class="btn btn-outline-secondary">

                                    <i class="fas fa-times mr-1"></i>
                                    Clear
                                </a>
                            @endif

                        </div>

                    </div>

                </div>

            </form>

        </div>
    </div>

    {{-- PATIENT TABLE --}}
    <div class="card">

        <div class="card-header border-0">

            <div class="d-flex justify-content-between align-items-center flex-wrap">

                <div>

                    <h3 class="card-title font-weight-bold">
                        <i class="fas fa-users text-info mr-1"></i>
                        Patient Records
                    </h3>

                    @if (request('search'))
                        <div class="mt-1">

                            <small class="text-muted">
                                Results for:
                            </small>

                            <span class="badge badge-info">
                                {{ request('search') }}
                            </span>

                        </div>
                    @endif

                </div>

                <span class="badge badge-light patient-count-badge">
                    {{ $patients->total() }}
                    {{ $patients->total() === 1 ? 'patient' : 'patients' }}
                </span>

            </div>

        </div>

        <div class="card-body p-0">

            @if ($patients->count() > 0)

                <div class="table-responsive">

                    <table class="table table-hover patient-table mb-0">

                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Patient</th>
                                <th>Date of Birth</th>
                                <th>Contact</th>
                                <th>Registration Date</th>
                                <th class="text-center actions-column">
                                    Actions
                                </th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach ($patients as $patient)

                                <tr>

                                    {{-- CORRECT NUMBER WITH PAGINATION --}}
                                    <td class="text-center align-middle">

                                        <span class="patient-number">
                                            {{ $patients->firstItem() + $loop->index }}
                                        </span>

                                    </td>

                                    {{-- PATIENT --}}
                                    <td class="align-middle">

                                        <div class="patient-profile">

                                            <div class="patient-avatar">

                                                {{ strtoupper(substr($patient->name ?? 'P', 0, 1)) }}

                                                @if (!empty($patient->last_name))
                                                    {{ strtoupper(substr($patient->last_name, 0, 1)) }}
                                                @endif

                                            </div>

                                            <div class="patient-details">

                                                <strong>
                                                    {{ $patient->name }}
                                                    {{ $patient->last_name }}
                                                </strong>

                                                <small>
                                                    Patient ID: {{ $patient->id }}
                                                </small>

                                            </div>

                                        </div>

                                    </td>

                                    {{-- DATE OF BIRTH --}}
                                    <td class="align-middle">

                                        @if ($patient->date_of_birth)

                                            <span class="data-with-icon">
                                                <i class="fas fa-birthday-cake"></i>

                                                {{ \Carbon\Carbon::parse($patient->date_of_birth)->format('M d, Y') }}
                                            </span>

                                        @else

                                            <span class="text-muted">
                                                Not registered
                                            </span>

                                        @endif

                                    </td>

                                    {{-- CONTACT --}}
                                    <td class="align-middle">

                                        <div class="contact-information">

                                            @if ($patient->phone)

                                                <div>
                                                    <i class="fas fa-phone-alt"></i>

                                                    <span>
                                                        {{ $patient->phone }}
                                                    </span>
                                                </div>

                                            @else

                                                <div class="text-muted">
                                                    <i class="fas fa-phone-alt"></i>
                                                    No phone
                                                </div>

                                            @endif

                                            @if ($patient->email)

                                                <div>
                                                    <i class="fas fa-envelope"></i>

                                                    <span class="patient-email">
                                                        {{ $patient->email }}
                                                    </span>
                                                </div>

                                            @else

                                                <div class="text-muted">
                                                    <i class="fas fa-envelope"></i>
                                                    No email
                                                </div>

                                            @endif

                                        </div>

                                    </td>

                                    {{-- REGISTRATION DATE --}}
                                    <td class="align-middle">

                                        @if ($patient->registration_date)

                                            <div class="registration-date">

                                                <i class="fas fa-calendar-alt"></i>

                                                <div>
                                                    <strong>
                                                        {{ \Carbon\Carbon::parse($patient->registration_date)->format('M d, Y') }}
                                                    </strong>

                                                    <small>
                                                        {{ \Carbon\Carbon::parse($patient->registration_date)->format('h:i A') }}
                                                    </small>
                                                </div>

                                            </div>

                                        @else

                                            <span class="text-muted">
                                                Not registered
                                            </span>

                                        @endif

                                    </td>

                                    {{-- ACTIONS --}}
                                    <td class="text-center align-middle">

                                        <div class="patient-actions">

                                            <a href="{{ route('consultas.index', $patient->id) }}"
                                               class="btn btn-primary btn-sm"
                                               title="View consultations">

                                                <i class="fas fa-eye mr-1"></i>
                                                View
                                            </a>

                                            <form action="{{ route('patient.destroy', $patient->id) }}"
                                                  method="POST"
                                                  class="d-inline patient-delete-form">

                                                @csrf
                                                @method('DELETE')

                                                <button type="button"
                                                        class="btn btn-outline-danger btn-sm"
                                                        onclick="deletePatient(this.form, '{{ addslashes($patient->name . ' ' . $patient->last_name) }}')"
                                                        title="Delete patient">

                                                    <i class="fas fa-trash-alt mr-1"></i>
                                                    Delete
                                                </button>

                                            </form>

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
                        <i class="fas fa-user-slash"></i>
                    </div>

                    <h4>
                        No Patients Found
                    </h4>

                    @if (request('search'))

                        <p>
                            No patients match the search
                            <strong>“{{ request('search') }}”</strong>.
                        </p>

                        <a href="{{ route('pacientes.index') }}"
                           class="btn btn-outline-primary">

                            <i class="fas fa-times mr-1"></i>
                            Clear Search
                        </a>

                    @else

                        <p>
                            There are no patient records available yet.
                        </p>

                        <a href="{{ route('patient.index') }}"
                           class="btn btn-success">

                            <i class="fas fa-user-plus mr-1"></i>
                            Create First Patient
                        </a>

                    @endif

                </div>

            @endif

        </div>

        {{-- PAGINATION --}}
        @if ($patients->hasPages())

            <div class="card-footer">

                <div class="pagination-container">

                    <div class="pagination-summary">

                        Showing

                        <strong>
                            {{ $patients->firstItem() }}
                        </strong>

                        to

                        <strong>
                            {{ $patients->lastItem() }}
                        </strong>

                        of

                        <strong>
                            {{ $patients->total() }}
                        </strong>

                        patients

                    </div>

                    <div>
                        {{ $patients->appends(request()->query())->links() }}
                    </div>

                </div>

            </div>

        @endif

    </div>

@endsection

@section('css')
    <style>
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

        .input-group-text {
            min-width: 46px;
            justify-content: center;
            color: #17a2b8;
            background-color: #f4f6f9;
        }

        .patient-count-badge {
            padding: 8px 12px;
            color: #495057;
            font-size: 13px;
            border: 1px solid #dee2e6;
        }

        .patient-table {
            min-width: 1000px;
        }

        .patient-table thead th {
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

        .patient-table tbody td {
            padding: 14px 12px;
            border-top: 1px solid #edf0f2;
        }

        .patient-table tbody tr {
            transition: background-color .2s ease;
        }

        .patient-table tbody tr:hover {
            background-color: #f8fcfd;
        }

        .patient-number {
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

        .patient-profile {
            display: flex;
            align-items: center;
            min-width: 210px;
        }

        .patient-avatar {
            display: flex;
            align-items: center;
            justify-content: center;
            flex: 0 0 44px;
            width: 44px;
            height: 44px;
            margin-right: 12px;
            color: #ffffff;
            font-size: 14px;
            font-weight: 700;
            letter-spacing: .03em;
            background: linear-gradient(135deg, #17a2b8, #007bff);
            border-radius: 50%;
            box-shadow: 0 4px 10px rgba(0, 123, 255, .18);
        }

        .patient-details {
            min-width: 0;
        }

        .patient-details strong,
        .patient-details small {
            display: block;
        }

        .patient-details strong {
            color: #343a40;
            font-size: 14px;
        }

        .patient-details small {
            margin-top: 3px;
            color: #868e96;
            font-size: 11px;
        }

        .data-with-icon {
            display: flex;
            align-items: center;
            white-space: nowrap;
        }

        .data-with-icon i {
            width: 22px;
            margin-right: 6px;
            color: #17a2b8;
            text-align: center;
        }

        .contact-information {
            min-width: 190px;
        }

        .contact-information > div {
            display: flex;
            align-items: center;
            margin-bottom: 5px;
            font-size: 13px;
        }

        .contact-information > div:last-child {
            margin-bottom: 0;
        }

        .contact-information i {
            width: 21px;
            margin-right: 6px;
            color: #17a2b8;
            text-align: center;
        }

        .patient-email {
            display: inline-block;
            max-width: 190px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .registration-date {
            display: flex;
            align-items: center;
            min-width: 135px;
        }

        .registration-date > i {
            margin-right: 9px;
            color: #17a2b8;
            font-size: 19px;
        }

        .registration-date strong,
        .registration-date small {
            display: block;
        }

        .registration-date strong {
            color: #495057;
            font-size: 13px;
        }

        .registration-date small {
            color: #868e96;
            font-size: 11px;
        }

        .actions-column {
            min-width: 190px;
        }

        .patient-actions {
            display: flex;
            justify-content: center;
            gap: 6px;
            white-space: nowrap;
        }

        .patient-actions .btn {
            min-width: 78px;
        }

        .empty-state {
            padding: 65px 20px;
            text-align: center;
        }

        .empty-state-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 85px;
            height: 85px;
            margin: 0 auto 20px;
            color: #17a2b8;
            font-size: 34px;
            background-color: #e8f7fa;
            border-radius: 50%;
        }

        .empty-state h4 {
            margin-bottom: 8px;
            color: #343a40;
            font-weight: 700;
        }

        .empty-state p {
            max-width: 500px;
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

        @media (max-width: 767.98px) {
            .small-box {
                min-height: 105px;
            }

            .small-box .inner h3 {
                font-size: 26px;
            }

            .patient-actions {
                justify-content: flex-start;
            }

            .pagination-container {
                flex-direction: column;
                align-items: flex-start;
            }

            .pagination-summary {
                margin-bottom: 5px;
            }

            .card-header {
                padding: 14px;
            }
        }
    </style>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function deletePatient(form, patientName) {
            Swal.fire({
                title: 'Delete patient?',
                html: `
                    Are you sure you want to delete
                    <strong>${patientName}</strong>?
                    <br><br>
                    <small class="text-muted">
                        The patient will be moved to the trash and will not be
                        permanently deleted.
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