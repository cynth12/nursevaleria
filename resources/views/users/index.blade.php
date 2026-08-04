@extends('adminlte::page')

@section('title', 'Users')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Users</h1>

        <a href="{{ route('users.create') }}" class="btn btn-primary">
            <i class="fas fa-user-plus mr-1"></i>
            Create User
        </a>
    </div>
@stop

@section('content')

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="fas fa-check-circle mr-1"></i>

            {{ session('success') }}

            <button type="button" class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
        </div>
    @endif

    <div class="card">

        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-users-cog mr-1"></i>
                Nurse Users
            </h3>
        </div>

        <div class="card-body table-responsive">

            <table class="table table-bordered table-hover">

                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th style="width: 360px;">Actions</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse ($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>

                            <td>{{ $user->email }}</td>

                            <td>
                                @if ($user->is_active)
                                    <span class="badge badge-success">
                                        Active
                                    </span>
                                @else
                                    <span class="badge badge-danger">
                                        Inactive
                                    </span>
                                @endif
                            </td>

                            <td>

                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit mr-1"></i>
                                    Edit
                                </a>

                                <form action="{{ route('users.toggle', $user->id) }}" method="POST"
                                    class="d-inline toggle-user-form">
                                    @csrf
                                    @method('PATCH')

                                    @if ($user->is_active)
                                        <button type="button" class="btn btn-secondary btn-sm btn-toggle-user"
                                            data-action="deactivate" data-user-name="{{ $user->name }}">
                                            <i class="fas fa-user-lock mr-1"></i>
                                            Deactivate
                                        </button>
                                    @else
                                        <button type="button" class="btn btn-success btn-sm btn-toggle-user"
                                            data-action="activate" data-user-name="{{ $user->name }}">
                                            <i class="fas fa-user-check mr-1"></i>
                                            Activate
                                        </button>
                                    @endif
                                </form>

                                <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                    class="d-inline delete-user-form">
                                    @csrf
                                    @method('DELETE')

                                    <button type="button" class="btn btn-danger btn-sm btn-delete-user"
                                        data-user-name="{{ $user->name }}">
                                        <i class="fas fa-trash mr-1"></i>
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>

                    @empty

                        <tr>
                            <td colspan="4" class="text-center text-muted">
                                No nurse users have been created.
                            </td>
                        </tr>
                    @endforelse

                </tbody>

            </table>

        </div>

        @if ($users->hasPages())
            <div class="card-footer">
                {{ $users->links() }}
            </div>
        @endif

    </div>

@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            document.querySelectorAll('.btn-delete-user').forEach(function (button) {
                button.addEventListener('click', function () {

                    const form = this.closest('.delete-user-form');
                    const userName = this.dataset.userName;

                    Swal.fire({
                        title: 'Delete user?',
                        html: `Are you sure you want to permanently delete <strong>${userName}</strong>?`,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, delete',
                        cancelButtonText: 'Cancel',
                        confirmButtonColor: '#dc3545',
                        cancelButtonColor: '#6c757d',
                        reverseButtons: true,
                        focusCancel: true
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });

            document.querySelectorAll('.btn-toggle-user').forEach(function (button) {
                button.addEventListener('click', function () {

                    const form = this.closest('.toggle-user-form');
                    const userName = this.dataset.userName;
                    const action = this.dataset.action;

                    const isActivate = action === 'activate';

                    Swal.fire({
                        title: isActivate ? 'Activate user?' : 'Deactivate user?',
                        html: isActivate
                            ? `Do you want to activate <strong>${userName}</strong>?`
                            : `Do you want to deactivate <strong>${userName}</strong>?`,
                        icon: isActivate ? 'question' : 'warning',
                        showCancelButton: true,
                        confirmButtonText: isActivate ? 'Yes, activate' : 'Yes, deactivate',
                        cancelButtonText: 'Cancel',
                        confirmButtonColor: isActivate ? '#28a745' : '#6c757d',
                        cancelButtonColor: '#adb5bd',
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