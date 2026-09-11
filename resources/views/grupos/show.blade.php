@extends('adminlte::page')

@section('title', 'Group details')

@section('content_header')
    <h1>Group Details</h1>
@endsection

@section('content')

    <div class="container-fluid">

        {{-- =========================
        GROUP INFORMATION
    ========================== --}}
        <div class="card">

            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-layer-group mr-2"></i>
                    Group: {{ $group->place }}
                </h3>

                <div class="card-tools">

                    {{-- Back to groups --}}
                    <a href="{{ route('grupos.index') }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left"></i>
                        Back to Groups
                    </a>

                    {{-- Public form --}}
                    <a href="{{ route('group.public.form', $group->public_token) }}" target="_blank"
                        class="btn btn-success btn-sm">
                        <i class="fas fa-external-link-alt"></i>
                        Public Form
                    </a>

                    {{-- Copy link --}}
                    <button type="button" class="btn btn-primary btn-sm"
                        onclick="copyGroupLink('{{ route('group.public.form', $group->public_token) }}')">
                        <i class="fas fa-copy"></i>
                        Copy Link
                    </button>

                </div>
            </div>


            {{-- =========================
            GROUP SUMMARY
        ========================== --}}
            <div class="card-body">

                <div class="row">

                    {{-- Place --}}
                    <div class="col-md-4">

                        <div class="info-box">

                            <span class="info-box-icon bg-primary">
                                <i class="fas fa-map-marker-alt"></i>
                            </span>

                            <div class="info-box-content">

                                <span class="info-box-text">
                                    Place
                                </span>

                                <span class="info-box-number">
                                    {{ $group->place }}
                                </span>

                            </div>

                        </div>

                    </div>


                    {{-- Date --}}
                    <div class="col-md-4">

                        <div class="info-box">

                            <span class="info-box-icon bg-info">
                                <i class="fas fa-calendar-alt"></i>
                            </span>

                            <div class="info-box-content">

                                <span class="info-box-text">
                                    Creation date
                                </span>

                                <span class="info-box-number">
                                    {{ \Carbon\Carbon::parse($group->date)->format('d/m/Y') }}
                                </span>

                            </div>

                        </div>

                    </div>


                    {{-- Patients --}}
                    <div class="col-md-4">

                        <div class="info-box">

                            <span class="info-box-icon bg-success">
                                <i class="fas fa-users"></i>
                            </span>

                            <div class="info-box-content">

                                <span class="info-box-text">
                                    Group patients
                                </span>

                                <span class="info-box-number">
                                    {{ $patients->count() }}
                                </span>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- =========================
        PATIENTS
    ========================== --}}
        <div class="card">

            <div class="card-header">

                <h3 class="card-title">
                    <i class="fas fa-users mr-2"></i>
                    Group Patients
                </h3>

            </div>


            <div class="card-body">

                <div class="table-responsive">

                    <table class="table table-bordered table-hover">

                        <thead>

                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Date of birth</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th width="320">Actions</th>
                            </tr>

                        </thead>


                        <tbody>

                            @forelse($patients as $patient)

                                @php
                                    $consultation = $patient->consultations()->latest('registration_date')->first();
                                @endphp

                                <tr>

                                    <td>
                                        {{ $patient->id }}
                                    </td>

                                    <td>
                                        <strong>
                                            {{ $patient->name }} {{ $patient->last_name }}
                                        </strong>
                                    </td>

                                    <td>
                                        {{ \Carbon\Carbon::parse($patient->date_of_birth)->format('d/m/Y') }}
                                    </td>

                                    <td>
                                        {{ $patient->phone }}
                                    </td>

                                    <td>
                                        {{ $patient->email }}
                                    </td>

                                    <td>

                                        @if ($consultation)
                                            {{-- View --}}
                                            <a href="{{ route('consultas.show', $consultation->id) }}"
                                                class="btn btn-primary btn-sm">
                                                <i class="fas fa-eye"></i>
                                                View
                                            </a>


                                            {{-- Edit --}}
                                            <a href="{{ route('consultas.edit', $consultation->id) }}"
                                                class="btn btn-success btn-sm">
                                                <i class="fas fa-edit"></i>
                                                Edit
                                            </a>


                                            {{-- Consent --}}
                                            @if ($consultation->consentimiento)
                                                <a href="{{ route('consentimiento.show', $consultation->consentimiento->id) }}"
                                                    class="btn btn-info btn-sm">
                                                    <i class="fas fa-file-signature"></i>
                                                    Consent
                                                </a>
                                            @endif


                                            {{-- Delete --}}
                                            <button type="button" class="btn btn-danger btn-sm"
                                                onclick="confirmDeleteConsultation(this.form)">

                                                <i class="fas fa-trash"></i>
                                                Delete

                                            </button>
                                        @else
                                            <span class="text-muted">
                                                <i class="fas fa-info-circle"></i>
                                                No consultations
                                            </span>
                                        @endif

                                    </td>

                                </tr>


                            @empty

                                <tr>

                                    <td colspan="6" class="text-center py-4">

                                        <i class="fas fa-users fa-2x text-muted mb-2"></i>

                                        <p class="mb-0">
                                            No patients assigned to this group.
                                        </p>

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>


    {{-- =========================
    COPY PUBLIC LINK
========================== --}}
    <script>
        function copyGroupLink(link) {

            navigator.clipboard.writeText(link)
                .then(function() {

                    alert('Public form link copied!');

                })
                .catch(function() {

                    alert('Could not copy the link.');

                });

        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function confirmDeleteConsultation(form) {

            Swal.fire({
                title: 'Delete consultation?',
                text: 'This action cannot be undone.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it',
                cancelButtonText: 'Cancel',
                reverseButtons: true
            }).then((result) => {

                if (result.isConfirmed) {
                    form.submit();
                }

            });

        }
    </script>

@endsection
