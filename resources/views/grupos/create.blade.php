@extends('adminlte::page')

@section('title', 'Create Group')

@section('content_header')
    <h1>Create Group</h1>
@endsection

@section('content')

<div class="container-fluid">

    <div class="row justify-content-center">

        <div class="col-md-8 col-lg-6">

            <div class="card card-primary">

                {{-- Header --}}
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-layer-group mr-2"></i>
                        Create New Group
                    </h3>
                </div>

                {{-- Form --}}
                <form action="{{ route('grupos.store') }}" method="POST">

                    @csrf

                    <div class="card-body">

                        {{-- Information --}}
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle mr-2"></i>

                            Create a group by entering its place or name.
                            A unique public form link will be generated automatically.
                        </div>


                        {{-- Place --}}
                        <div class="form-group">

                            <label for="place">
                                <i class="fas fa-map-marker-alt mr-1"></i>
                                Place / Group name
                            </label>

                            <input
                                type="text"
                                name="place"
                                id="place"
                                class="form-control @error('place') is-invalid @enderror"
                                value="{{ old('place') }}"
                                placeholder="Example: Casa Arka Tulum"
                                maxlength="150"
                                required
                                autofocus
                            >

                            @error('place')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        {{-- Public form information --}}
                        <div class="form-group mt-4">

                            <label>
                                <i class="fas fa-link mr-1"></i>
                                Public Form
                            </label>

                            <div class="input-group">

                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fas fa-lock"></i>
                                    </span>
                                </div>

                                <input
                                    type="text"
                                    class="form-control"
                                    value="Generated automatically after creating the group"
                                    disabled
                                >

                            </div>

                            <small class="form-text text-muted">
                                The public form will be automatically linked to this group.
                                You can copy the link from the Groups section after creation.
                            </small>

                        </div>

                    </div>


                    {{-- Footer --}}
                    <div class="card-footer d-flex justify-content-between">

                        <a href="{{ route('grupos.index') }}"
                           class="btn btn-secondary">

                            <i class="fas fa-arrow-left mr-1"></i>
                            Cancel

                        </a>

                        <button type="submit"
                                class="btn btn-success">

                            <i class="fas fa-plus-circle mr-1"></i>
                            Create Group

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

@endsection