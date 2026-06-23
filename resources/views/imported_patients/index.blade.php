@extends('adminlte::page')

@section('title', 'Import Patients')

@section('content_header')
    <h1>List of Imported Patients</h1>
@stop

@section('content')
    {{-- Mensaje de éxito --}}
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Formulario para subir archivo Excel --}}
    <div class="card mb-4">
        <div class="card-header">Import Excel file</div>
        <div class="card-body">
            <form action="{{ route('imported_patients.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <input type="file" name="file" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary mt-2">Import</button>
            </form>
            <form action="{{ route('imported_patients.destroyAll') }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger mt-2"
                    onclick="return confirm('Are you sure you want to delete all imported patients?')">
                    Delate all
                </button>
            </form>

        </div>
    </div>

    {{-- Tabla de pacientes importados --}}

    <div class="card mt-4">
        <div class="card-header">
            Imported Files
        </div>

        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>File</th>
                        <th>Date</th>
                         <!--<th>Patients</th>-->
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($files as $file)
                        <tr>
                            <td>{{ $file->original_name }}</td>
                            <td>{{ $file->created_at->format('d/m/Y H:i') }}</td>
                             <!--<td>{{ $file->patients_count }}</td>-->
                            <td>
                                <a href="{{ route('imports.download', $file->id) }}" class="btn btn-sm btn-success">
                                    Download
                                </a>

                                <form action="{{ route('imports.destroy', $file) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')

                                    <button type="button" class="btn btn-sm btn-danger"
                                        onclick="deleteFile(event, this.form)">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">
                                No files imported
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

@stop

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    function deleteFile(event, form) {
        event.preventDefault(); // 🔥 DETIENE EL SUBMIT INMEDIATO

        Swal.fire({
            title: 'Delete file?',
            text: "This action will permanently delete the file",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit(); // 🔥 SOLO AQUÍ SE ENVÍA
            }
        });
    }
</script>
