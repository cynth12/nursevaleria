@extends('adminlte::page')

@section('title', 'FMG Event Participants')

@section('content_header')

    <div class="d-flex justify-content-between align-items-center">

        <h1>
            <i class="fas fa-gift text-primary"></i>
            FMG Event Participants
        </h1>

    </div>

@stop

@section('content')

    <div class="card">

        <div class="card-header">

            <h3 class="card-title">

                <i class="fas fa-users"></i>

                Participants

            </h3>

        </div>

        <div class="card-body p-0">

            <table class="table table-hover">

                <thead>

                    <tr>

                        <th>#</th>

                        <th>Name</th>

                        <th>Date of Birth</th>

                        <th>Phone</th>

                        <th>Email</th>

                        <th>Registration Date</th>

                        <th width="180">Actions</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($participants as $participant)
                        <tr>

                            <td>{{ $participant->id }}</td>

                            <td>

                                {{ $participant->name }}

                                {{ $participant->last_name }}

                            </td>

                            <td>

                                {{ \Carbon\Carbon::parse($participant->date_of_birth)->format('Y-m-d') }}

                            </td>

                            <td>

                                {{ $participant->phone }}

                            </td>

                            <td>

                                {{ $participant->email }}

                            </td>

                            <td>

                                {{ \Carbon\Carbon::parse($participant->registration_date)->format('Y-m-d H:i') }}

                            </td>

                            <td>

                                <a href="{{ route('event-fmg.show', $participant->id) }}" class="btn btn-info btn-sm">

                                    <i class="fas fa-eye"></i>

                                </a>

                                <a href="{{ route('event-fmg.edit', $participant->id) }}" class="btn btn-warning btn-sm">

                                    <i class="fas fa-edit"></i>

                                </a>

                                <form action="{{ route('event-fmg.destroy', $participant->id) }}" method="POST"
                                    class="d-inline delete-participant-form">
                                    @csrf
                                    @method('DELETE')

                                    <button type="button" class="btn btn-danger btn-sm btn-delete-participant"
                                        data-name="{{ $participant->name }} {{ $participant->last_name }}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="7" class="text-center text-muted p-5">

                                <i class="fas fa-gift fa-3x mb-3"></i>

                                <br>

                                No participants registered yet.

                            </td>

                        </tr>
                    @endforelse

                </tbody>

            </table>

        </div>

        @if ($participants->count())
            <div class="card-footer">

                {{ $participants->links() }}

            </div>
        @endif

    </div>


    @section('js')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>

document.addEventListener('DOMContentLoaded', function () {

    document.querySelectorAll('.btn-delete-participant').forEach(button => {

        button.addEventListener('click', function () {

            const form = this.closest('form');

            const participant = this.dataset.name;

            Swal.fire({

                title: 'Delete Participant?',

                html:
                    'Are you sure you want to delete <br><br><b>' +
                    participant +
                    '</b>?<br><br>This action cannot be undone.',

                icon: 'warning',

                showCancelButton: true,

                confirmButtonColor: '#d33',

                cancelButtonColor: '#6c757d',

                confirmButtonText: '<i class="fas fa-trash"></i> Yes, delete',

                cancelButtonText: 'Cancel',

                reverseButtons: true

            }).then((result) => {

                if (result.isConfirmed) {

                    form.submit();

                }

            });

        });

    });

});

</script>

@stop

@stop
