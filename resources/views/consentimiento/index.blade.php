@extends('adminlte::page')

@section('title', 'Consent Forms')

@section('content_header')

    <div class="d-flex justify-content-between align-items-center flex-wrap">

        <div>
            <h1 class="mb-0">
                Consent Forms
            </h1>

            <small class="text-muted">
                Review and manage patient consent records
            </small>
        </div>

        <div class="header-badge mt-2 mt-md-0">

            <i class="fas fa-file-signature mr-2"></i>

            {{ $consentimientos->total() }}

            {{ $consentimientos->total() === 1 ? 'Consent' : 'Consents' }}

        </div>

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
                        {{ $consentimientos->total() }}
                    </h3>

                    <p>Total Consent Forms</p>

                </div>

                <div class="icon">
                    <i class="fas fa-file-signature"></i>
                </div>

            </div>

        </div>

        <div class="col-md-4">

            <div class="small-box bg-primary">

                <div class="inner">

                    <h3>
                        {{ $consentimientos->count() }}
                    </h3>

                    <p>Consents on This Page</p>

                </div>

                <div class="icon">
                    <i class="fas fa-clipboard-check"></i>
                </div>

            </div>

        </div>

        <div class="col-md-4">

            <div class="small-box bg-success">

                <div class="inner">

                    <h3>
                        {{ $consentimientos->currentPage() }}
                    </h3>

                    <p>Current Page</p>

                </div>

                <div class="icon">
                    <i class="fas fa-folder-open"></i>
                </div>

            </div>

        </div>

    </div>

    {{-- CONSENTS CARD --}}
    <div class="card consent-card">

        <div class="card-header border-0">

            <div class="d-flex justify-content-between align-items-center flex-wrap">

                <div>

                    <h3 class="card-title font-weight-bold">

                        <i class="fas fa-file-medical text-info mr-2"></i>

                        Registered Consent Forms

                    </h3>

                    <div class="mt-1">

                        <small class="text-muted">
                            Patient authorization and treatment consent history
                        </small>

                    </div>

                </div>

                <span class="badge badge-light consent-count-badge mt-2 mt-sm-0">

                    <i class="fas fa-list mr-1"></i>

                    {{ $consentimientos->total() }}

                    {{ $consentimientos->total() === 1 ? 'record' : 'records' }}

                </span>

            </div>

        </div>

        <div class="card-body p-0">

            @if ($consentimientos->count() > 0)

                <div class="table-responsive">

                    <table class="table table-hover consent-table mb-0">

                        <thead>

                            <tr>

                                <th class="text-center">
                                    #
                                </th>

                                <th>
                                    Patient
                                </th>

                                <th>
                                    Authorized Procedure
                                </th>

                                <th>
                                    Consent Date
                                </th>

                                <th class="text-center actions-column">
                                    Actions
                                </th>

                            </tr>

                        </thead>

                        <tbody>

                            @foreach ($consentimientos as $consentimiento)

                                <tr>

                                    {{-- NUMBER --}}
                                    <td class="text-center align-middle">

                                        <span class="consent-number">

                                            {{ $consentimientos->firstItem() + $loop->index }}

                                        </span>

                                    </td>

                                    {{-- PATIENT --}}
                                    <td class="align-middle">

                                        <div class="patient-profile">

                                            <div class="patient-avatar">

                                                {{ strtoupper(
                                                    substr(
                                                        $consentimiento->patient->name ?? 'P',
                                                        0,
                                                        1
                                                    )
                                                ) }}

                                                @if (!empty($consentimiento->patient->last_name))

                                                    {{ strtoupper(
                                                        substr(
                                                            $consentimiento->patient->last_name,
                                                            0,
                                                            1
                                                        )
                                                    ) }}

                                                @endif

                                            </div>

                                            <div class="patient-information">

                                                <strong>

                                                    {{ $consentimiento->patient->name }}

                                                    {{ $consentimiento->patient->last_name }}

                                                </strong>

                                                <small>

                                                    <i class="fas fa-id-card mr-1"></i>

                                                    Patient ID:
                                                    {{ $consentimiento->patient->id }}

                                                </small>

                                            </div>

                                        </div>

                                    </td>

                                    {{-- PROCEDURE --}}
                                    <td class="align-middle">

                                        @if ($consentimiento->authorized_procedure)

                                            <div class="procedure-information">

                                                <div class="procedure-icon">

                                                    <i class="fas fa-syringe"></i>

                                                </div>

                                                <div>

                                                    <small>
                                                        Treatment
                                                    </small>

                                                    <strong>

                                                        {{ $consentimiento->authorized_procedure }}

                                                    </strong>

                                                </div>

                                            </div>

                                        @else

                                            <span class="not-registered">

                                                <i class="fas fa-minus-circle mr-1"></i>

                                                Not registered

                                            </span>

                                        @endif

                                    </td>

                                    {{-- DATE --}}
                                    <td class="align-middle">

                                        @if ($consentimiento->consent_date)

                                            <div class="consent-date">

                                                <div class="date-icon">

                                                    <i class="fas fa-calendar-check"></i>

                                                </div>

                                                <div>

                                                    <strong>

                                                        {{ \Carbon\Carbon::parse(
                                                            $consentimiento->consent_date
                                                        )->format('M d, Y') }}

                                                    </strong>

                                                    <small>
                                                        Consent accepted
                                                    </small>

                                                </div>

                                            </div>

                                        @else

                                            <span class="not-registered">

                                                <i class="fas fa-calendar-times mr-1"></i>

                                                No date registered

                                            </span>

                                        @endif

                                    </td>

                                    {{-- ACTIONS --}}
                                    <td class="text-center align-middle">

                                        <div class="consent-actions">

                                            <a href="{{ route(
                                                    'consentimiento.show',
                                                    $consentimiento->id
                                                ) }}"
                                               class="btn btn-info btn-sm"
                                               title="View consent form">

                                                <i class="fas fa-eye mr-1"></i>

                                                View

                                            </a>

                                            <form action="{{ route(
                                                    'consentimiento.destroy',
                                                    $consentimiento->id
                                                ) }}"
                                                  method="POST"
                                                  class="d-inline">

                                                @csrf
                                                @method('DELETE')

                                                <button type="button"
                                                        class="btn btn-outline-danger btn-sm"
                                                        onclick="deleteConsent(
                                                            this.form,
                                                            '{{ addslashes(
                                                                ($consentimiento->patient->name ?? '') .
                                                                ' ' .
                                                                ($consentimiento->patient->last_name ?? '')
                                                            ) }}',
                                                            '{{ addslashes(
                                                                $consentimiento->authorized_procedure
                                                                ?? 'this procedure'
                                                            ) }}'
                                                        )"
                                                        title="Delete consent">

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

                        <i class="fas fa-file-circle-xmark"></i>

                    </div>

                    <h4>
                        No Consent Forms Registered
                    </h4>

                    <p>
                        There are currently no patient consent forms available.
                        Consent forms will appear here after they are completed
                        from a consultation.
                    </p>

                </div>

            @endif

        </div>

        {{-- PAGINATION --}}
        @if ($consentimientos->hasPages())

            <div class="card-footer">

                <div class="pagination-container">

                    <div class="pagination-summary">

                        Showing

                        <strong>
                            {{ $consentimientos->firstItem() }}
                        </strong>

                        to

                        <strong>
                            {{ $consentimientos->lastItem() }}
                        </strong>

                        of

                        <strong>
                            {{ $consentimientos->total() }}
                        </strong>

                        consent forms

                    </div>

                    <div>

                        {{ $consentimientos
                            ->appends(request()->query())
                            ->links() }}

                    </div>

                </div>

            </div>

        @endif

    </div>

@endsection

@section('css')

    <style>

        .header-badge {
            display: inline-flex;
            align-items: center;
            padding: 10px 16px;
            color: #138496;
            font-size: 13px;
            font-weight: 700;
            background-color: #e8f7fa;
            border: 1px solid #bee5eb;
            border-radius: 30px;
        }

        .small-box {
            min-height: 120px;
            overflow: hidden;
            border-radius: 9px;
            box-shadow: 0 4px 13px rgba(0, 0, 0, .08);
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

        .consent-card {
            overflow: hidden;
            border: 0;
            border-top: 3px solid #17a2b8;
            border-radius: 8px;
            box-shadow: 0 5px 18px rgba(0, 0, 0, .07);
        }

        .consent-count-badge {
            padding: 8px 12px;
            color: #495057;
            font-size: 12px;
            font-weight: 600;
            border: 1px solid #dee2e6;
        }

        .consent-table {
            min-width: 960px;
        }

        .consent-table thead th {
            padding: 15px 13px;
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

        .consent-table tbody td {
            padding: 15px 13px;
            border-top: 1px solid #edf0f2;
        }

        .consent-table tbody tr {
            transition:
                background-color .2s ease,
                box-shadow .2s ease;
        }

        .consent-table tbody tr:hover {
            background-color: #f8fcfd;
        }

        .consent-number {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 35px;
            height: 35px;
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
            min-width: 225px;
        }

        .patient-avatar {
            display: flex;
            align-items: center;
            justify-content: center;
            flex: 0 0 45px;
            width: 45px;
            height: 45px;
            margin-right: 12px;
            color: #ffffff;
            font-size: 14px;
            font-weight: 700;
            letter-spacing: .03em;
            background:
                linear-gradient(
                    135deg,
                    #17a2b8,
                    #007bff
                );
            border-radius: 50%;
            box-shadow:
                0 4px 10px rgba(0, 123, 255, .18);
        }

        .patient-information {
            min-width: 0;
        }

        .patient-information strong,
        .patient-information small {
            display: block;
        }

        .patient-information strong {
            color: #343a40;
            font-size: 14px;
        }

        .patient-information small {
            margin-top: 4px;
            color: #868e96;
            font-size: 11px;
        }

        .procedure-information {
            display: flex;
            align-items: center;
            min-width: 210px;
        }

        .procedure-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            flex: 0 0 42px;
            width: 42px;
            height: 42px;
            margin-right: 11px;
            color: #28a745;
            background-color: #eaf7ed;
            border-radius: 10px;
        }

        .procedure-information small,
        .procedure-information strong {
            display: block;
        }

        .procedure-information small {
            color: #868e96;
            font-size: 11px;
        }

        .procedure-information strong {
            max-width: 210px;
            overflow: hidden;
            color: #343a40;
            font-size: 13px;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .consent-date {
            display: flex;
            align-items: center;
            min-width: 165px;
        }

        .date-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            flex: 0 0 42px;
            width: 42px;
            height: 42px;
            margin-right: 11px;
            color: #17a2b8;
            background-color: #e8f7fa;
            border-radius: 10px;
        }

        .consent-date strong,
        .consent-date small {
            display: block;
        }

        .consent-date strong {
            color: #343a40;
            font-size: 13px;
        }

        .consent-date small {
            margin-top: 2px;
            color: #868e96;
            font-size: 11px;
        }

        .not-registered {
            color: #9aa1a7;
            font-size: 13px;
        }

        .actions-column {
            min-width: 185px;
        }

        .consent-actions {
            display: flex;
            justify-content: center;
            gap: 7px;
            white-space: nowrap;
        }

        .consent-actions .btn {
            min-width: 76px;
        }

        .empty-state {
            padding: 75px 20px;
            text-align: center;
        }

        .empty-state-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 92px;
            height: 92px;
            margin: 0 auto 21px;
            color: #17a2b8;
            font-size: 38px;
            background-color: #e8f7fa;
            border-radius: 50%;
        }

        .empty-state h4 {
            margin-bottom: 9px;
            color: #343a40;
            font-weight: 700;
        }

        .empty-state p {
            max-width: 560px;
            margin: 0 auto;
            color: #6c757d;
            line-height: 1.65;
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

            .consent-actions {
                justify-content: flex-start;
            }

            .pagination-container {
                flex-direction: column;
                align-items: flex-start;
            }

            .pagination-summary {
                margin-bottom: 5px;
            }

            .empty-state {
                padding: 55px 18px;
            }

        }

    </style>

@endsection

@section('js')

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>

        function deleteConsent(form, patientName, procedure) {

            Swal.fire({

                title: 'Delete consent form?',

                html: `
                    Are you sure you want to delete the consent form for
                    <strong>${patientName}</strong>?
                    <br><br>

                    <div class="text-left bg-light p-3 rounded">
                        <small class="text-muted d-block">
                            Authorized procedure
                        </small>

                        <strong>
                            ${procedure}
                        </strong>
                    </div>

                    <br>

                    <small class="text-muted">
                        This action will remove this consent record.
                    </small>
                `,

                icon: 'warning',

                showCancelButton: true,

                confirmButtonColor: '#dc3545',

                cancelButtonColor: '#6c757d',

                confirmButtonText:
                    '<i class="fas fa-trash-alt mr-1"></i> Yes, delete',

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