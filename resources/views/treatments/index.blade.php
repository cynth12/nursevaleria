@extends('adminlte::page')

@section('title', 'Treatments')

@section('content_header')

    <div class="d-flex justify-content-between align-items-center flex-wrap">

        <div>
            <h1 class="mb-0">
                Treatments
            </h1>

            <small class="text-muted">
                Manage treatment names, descriptions and clinical information
            </small>
        </div>

        <a href="{{ route('treatments.create') }}"
           class="btn btn-success mt-2 mt-md-0">

            <i class="fas fa-plus-circle mr-1"></i>
            New Treatment

        </a>

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

    {{-- ERROR MESSAGE --}}
    @if (session('error'))

        <div class="alert alert-danger alert-dismissible fade show">

            <i class="fas fa-exclamation-circle mr-2"></i>

            {{ session('error') }}

            <button type="button"
                    class="close"
                    data-dismiss="alert"
                    aria-label="Close">

                <span aria-hidden="true">&times;</span>

            </button>

        </div>

    @endif

    {{-- SUMMARY --}}
    <div class="row">

        <div class="col-md-4">

            <div class="small-box bg-info">

                <div class="inner">

                    <h3>
                        {{ $treatments->count() }}
                    </h3>

                    <p>
                        Total Treatments
                    </p>

                </div>

                <div class="icon">
                    <i class="fas fa-syringe"></i>
                </div>

            </div>

        </div>

        <div class="col-md-4">

            <div class="small-box bg-primary">

                <div class="inner">

                    <h3>
                        {{ $treatments->whereNotNull('description')->count() }}
                    </h3>

                    <p>
                        With Description
                    </p>

                </div>

                <div class="icon">
                    <i class="fas fa-file-medical-alt"></i>
                </div>

            </div>

        </div>

        <div class="col-md-4">

            <div class="small-box bg-success">

                <div class="inner">

                    <h3>
                        {{ $treatments->whereNotNull('formula')->count() }}
                    </h3>

                    <p>
                        With Formula
                    </p>

                </div>

                <div class="icon">
                    <i class="fas fa-flask"></i>
                </div>

            </div>

        </div>

    </div>

    {{-- TREATMENTS TABLE --}}
    <div class="card treatments-card">

        <div class="card-header border-0">

            <div class="d-flex justify-content-between align-items-center flex-wrap">

                <div>

                    <h3 class="card-title font-weight-bold">

                        <i class="fas fa-capsules text-info mr-2"></i>

                        Treatment Catalog

                    </h3><br>

                    <div class="mt-1">

                        <small class="text-muted">
                            View, edit or remove available treatments
                        </small>

                    </div>

                </div>

                <span class="badge badge-light treatment-count-badge mt-2 mt-sm-0">

                    <i class="fas fa-list mr-1"></i>

                    {{ $treatments->count() }}

                    {{ $treatments->count() === 1 ? 'treatment' : 'treatments' }}

                </span>

            </div>

        </div>

        <div class="card-body p-0">

            @if ($treatments->count() > 0)

                <div class="table-responsive">

                    <table class="table table-hover treatments-table mb-0">

                        <thead>

                            <tr>

                                <th class="text-center">
                                    #
                                </th>

                                <th>
                                    Treatment
                                </th>

                                <th>
                                    Description
                                </th>

                                <th>
                                    Formula
                                </th>

                                <th class="text-center actions-column">
                                    Actions
                                </th>

                            </tr>

                        </thead>

                        <tbody>

                            @foreach ($treatments as $treatment)

                                <tr>

                                    {{-- NUMBER --}}
                                    <td class="text-center align-middle">

                                        <span class="treatment-number">
                                            {{ $loop->iteration }}
                                        </span>

                                    </td>

                                    {{-- NAME --}}
                                    <td class="align-middle">

                                        <div class="treatment-profile">

                                            <div class="treatment-icon">

                                                <i class="fas fa-syringe"></i>

                                            </div>

                                            <div class="treatment-name">

                                                <strong>
                                                    {{ $treatment->name }}
                                                </strong>

                                                <small>
                                                    Treatment ID: {{ $treatment->id }}
                                                </small>

                                            </div>

                                        </div>

                                    </td>

                                    {{-- DESCRIPTION --}}
                                    <td class="align-middle">

                                        @if ($treatment->description)

                                            <div class="treatment-description"
                                                 title="{{ $treatment->description }}">

                                                {{ $treatment->description }}

                                            </div>

                                        @else

                                            <span class="not-registered">

                                                <i class="fas fa-minus-circle mr-1"></i>

                                                No description

                                            </span>

                                        @endif

                                    </td>

                                    {{-- FORMULA --}}
                                    <td class="align-middle">

                                        @if ($treatment->formula)

                                            <div class="formula-badge">

                                                <i class="fas fa-flask mr-1"></i>

                                                <span title="{{ $treatment->formula }}">
                                                    {{ $treatment->formula }}
                                                </span>

                                            </div>

                                        @else

                                            <span class="not-registered">

                                                <i class="fas fa-minus-circle mr-1"></i>

                                                No formula

                                            </span>

                                        @endif

                                    </td>

                                    {{-- ACTIONS --}}
                                    <td class="text-center align-middle">

                                        <div class="treatment-actions">

                                            <a href="{{ route('treatments.show', $treatment) }}"
                                               class="btn btn-info btn-sm"
                                               title="View treatment">

                                                <i class="fas fa-eye mr-1"></i>

                                                View

                                            </a>

                                            <a href="{{ route('treatments.edit', $treatment) }}"
                                               class="btn btn-warning btn-sm"
                                               title="Edit treatment">

                                                <i class="fas fa-edit mr-1"></i>

                                                Edit

                                            </a>

                                            <form action="{{ route('treatments.destroy', $treatment) }}"
                                                  method="POST"
                                                  class="d-inline">

                                                @csrf
                                                @method('DELETE')

                                                <button type="button"
                                                        class="btn btn-outline-danger btn-sm"
                                                        onclick="deleteTreatment(
                                                            this.form,
                                                            '{{ addslashes($treatment->name) }}'
                                                        )"
                                                        title="Delete treatment">

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

                        <i class="fas fa-syringe"></i>

                    </div>

                    <h4>
                        No Treatments Registered
                    </h4>

                    <p>
                        Create your first treatment to begin building the
                        clinic treatment catalog.
                    </p>

                    <a href="{{ route('treatments.create') }}"
                       class="btn btn-success">

                        <i class="fas fa-plus-circle mr-1"></i>

                        Create First Treatment

                    </a>

                </div>

            @endif

        </div>

    </div>

@stop

@section('css')

    <style>

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

        .treatments-card {
            overflow: hidden;
            border: 0;
            border-top: 3px solid #17a2b8;
            border-radius: 9px;
            box-shadow: 0 5px 18px rgba(0, 0, 0, .07);
        }

        .treatment-count-badge {
            padding: 8px 12px;
            color: #495057;
            font-size: 12px;
            font-weight: 600;
            border: 1px solid #dee2e6;
        }

        .treatments-table {
            min-width: 980px;
        }

        .treatments-table thead th {
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

        .treatments-table tbody td {
            padding: 15px 13px;
            border-top: 1px solid #edf0f2;
        }

        .treatments-table tbody tr {
            transition: background-color .2s ease;
        }

        .treatments-table tbody tr:hover {
            background-color: #f8fcfd;
        }

        .treatment-number {
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

        .treatment-profile {
            display: flex;
            align-items: center;
            min-width: 210px;
        }

        .treatment-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            flex: 0 0 46px;
            width: 46px;
            height: 46px;
            margin-right: 12px;
            color: #ffffff;
            font-size: 19px;
            background: linear-gradient(135deg, #17a2b8, #007bff);
            border-radius: 11px;
            box-shadow: 0 4px 11px rgba(0, 123, 255, .18);
        }

        .treatment-name {
            min-width: 0;
        }

        .treatment-name strong,
        .treatment-name small {
            display: block;
        }

        .treatment-name strong {
            color: #343a40;
            font-size: 14px;
        }

        .treatment-name small {
            margin-top: 4px;
            color: #868e96;
            font-size: 11px;
        }

        .treatment-description {
            display: -webkit-box;
            max-width: 360px;
            overflow: hidden;
            color: #495057;
            font-size: 13px;
            line-height: 1.55;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 2;
        }

        .formula-badge {
            display: inline-flex;
            align-items: center;
            max-width: 260px;
            padding: 7px 10px;
            color: #856404;
            font-size: 12px;
            font-weight: 600;
            background-color: #fff8df;
            border: 1px solid #ffeeba;
            border-radius: 7px;
        }

        .formula-badge span {
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .not-registered {
            color: #9aa1a7;
            font-size: 13px;
        }

        .actions-column {
            min-width: 275px;
        }

        .treatment-actions {
            display: flex;
            justify-content: center;
            gap: 7px;
            white-space: nowrap;
        }

        .treatment-actions .btn {
            min-width: 76px;
        }

        .empty-state {
            padding: 72px 20px;
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
            max-width: 520px;
            margin: 0 auto 20px;
            color: #6c757d;
            line-height: 1.65;
        }

        @media (max-width: 767.98px) {

            .small-box {
                min-height: 105px;
            }

            .small-box .inner h3 {
                font-size: 26px;
            }

            .treatment-actions {
                justify-content: flex-start;
            }

        }

    </style>

@stop

@section('js')

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>

        function deleteTreatment(form, treatmentName) {

            Swal.fire({

                title: 'Delete treatment?',

                html: `
                    Are you sure you want to delete
                    <strong>${treatmentName}</strong>?
                    <br><br>

                    <small class="text-muted">
                        This treatment will be removed from the treatment catalog.
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

@stop