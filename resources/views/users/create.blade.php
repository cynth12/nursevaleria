@extends('adminlte::page')

@section('title', 'Create User')

@section('content_header')
    <h1>Create User</h1>
@stop

@section('content')

    <div class="card card-primary">

        <div class="card-header">
            <h3 class="card-title">
                New Nurse User
            </h3>
        </div>

        <form action="{{ route('users.store') }}" method="POST">

            @csrf

            <div class="card-body">

                <div class="form-group">
                    <label>Name</label>

                    <input
                        type="text"
                        name="name"
                        class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name') }}"
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
                        value="{{ old('email') }}"
                        required
                    >

                    @error('email')
                        <span class="invalid-feedback">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Password</label>

                    <input
                        type="password"
                        name="password"
                        class="form-control @error('password') is-invalid @enderror"
                        required
                    >

                    @error('password')
                        <span class="invalid-feedback">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Confirm Password</label>

                    <input
                        type="password"
                        name="password_confirmation"
                        class="form-control"
                        required
                    >
                </div>

            </div>

            <div class="card-footer">

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save mr-1"></i>
                    Save User
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