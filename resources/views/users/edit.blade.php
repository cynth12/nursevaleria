@extends('adminlte::page')

@section('title', 'Edit User')

@section('content_header')
    <h1>Edit User</h1>
@stop

@section('content')

    <div class="card card-warning">

        <div class="card-header">
            <h3 class="card-title">
                Edit Nurse User
            </h3>
        </div>

        <form action="{{ route('users.update', $user->id) }}" method="POST">

            @csrf
            @method('PUT')

            <div class="card-body">

                <div class="form-group">
                    <label>Name</label>

                    <input
                        type="text"
                        name="name"
                        class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name', $user->name) }}"
                        required
                    >

                    @error('name')
                        <span class="invalid-feedback">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Email</label>

                    <input
                        type="email"
                        name="email"
                        class="form-control @error('email') is-invalid @enderror"
                        value="{{ old('email', $user->email) }}"
                        required
                    >

                    @error('email')
                        <span class="invalid-feedback">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <div class="alert alert-info">
                    Leave the password fields empty to keep the current password.
                </div>

                <div class="form-group">
                    <label>New Password</label>

                    <input
                        type="password"
                        name="password"
                        class="form-control @error('password') is-invalid @enderror"
                    >

                    @error('password')
                        <span class="invalid-feedback">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Confirm New Password</label>

                    <input
                        type="password"
                        name="password_confirmation"
                        class="form-control"
                    >
                </div>

            </div>

            <div class="card-footer">

                <button type="submit" class="btn btn-warning">
                    <i class="fas fa-save mr-1"></i>
                    Save Changes
                </button>

                <a
                    href="{{ route('users.index') }}"
                    class="btn btn-secondary"
                >
                    Cancel
                </a>

            </div>

        </form>

    </div>

@stop