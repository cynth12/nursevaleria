@extends('adminlte::page')

@section('title', 'Groups')

@section('content_header')
    <h1>Listado de Grupos</h1>
@endsection

@section('content')

    <div class="container-fluid">

        {{-- Mensaje de éxito --}}
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="card">

            <div class="card-header">
                <h3 class="card-title">Groups</h3>

                <div class="card-tools">
                    <a href="{{ route('grupos.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Create Group
                    </a>
                </div>
            </div>

            <div class="card-body">

                <div class="table-responsive">

                    <table class="table table-bordered table-hover">

                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Place</th>
                                <th>Date</th>
                                <th>Patients</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse ($groups as $group)
                                <tr>

                                    <td>
                                        {{ $group->id }}
                                    </td>

                                    <td>
                                        {{ $group->place }}
                                    </td>

                                    <td>
                                        {{ \Carbon\Carbon::parse($group->date)->format('d/m/Y') }}
                                    </td>

                                    <td>
                                        <span class="badge badge-info">
                                            {{ $group->patients()->count() }}
                                        </span>
                                    </td>

                                    <td>

                                        {{-- Ver grupo --}}
                                        <a href="{{ route('grupos.show', $group->id) }}" class="btn btn-info btn-sm">
                                            <i class="fas fa-eye"></i>
                                            See group
                                        </a>

                                        {{-- Formulario público --}}
                                        <a href="{{ route('group.public.form', $group->public_token) }}" target="_blank"
                                            class="btn btn-success btn-sm">
                                            <i class="fas fa-external-link-alt"></i>
                                            Public Form
                                        </a>

                                        {{-- Copiar link --}}
                                        <button type="button" class="btn btn-secondary btn-sm"
                                            onclick="copyGroupLink('{{ route('group.public.form', $group->public_token) }}')">
                                            <i class="fas fa-copy"></i>
                                            Copy link
                                        </button>

                                        {{-- Eliminar --}}
                                        <form action="{{ route('grupos.destroy', $group->id) }}" method="POST"
                                            style="display:inline;">

                                            @csrf
                                            @method('DELETE')

                                            <button type="button" class="btn btn-danger btn-sm"
                                                onclick="confirmDeleteGroup(this.form)">

                                                <i class="fas fa-trash"></i>
                                                Delete

                                            </button>

                                        </form>

                                    </td>

                                </tr>

                            @empty

                                <tr>
                                    <td colspan="5" class="text-center">
                                        No groups registered.
                                    </td>
                                </tr>
                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>


    {{-- Script para copiar el enlace --}}
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
        function confirmDeleteGroup(form) {

            Swal.fire({
                title: 'Delete group?',
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
