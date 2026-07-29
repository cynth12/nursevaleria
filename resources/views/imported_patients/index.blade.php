@extends('adminlte::page')

@section('title', 'Import Patients')

@section('content_header')

    <div class="d-flex justify-content-between align-items-center flex-wrap">

        <div>

            <h1 class="mb-0">
                Import Patients
            </h1>

            <small class="text-muted">
                Upload patient records from Excel, CSV or spreadsheet files
            </small>

        </div>

        <div class="header-badge mt-2 mt-md-0">

            <i class="fas fa-file-excel mr-2"></i>

            {{ $files->count() }}

            {{ $files->count() === 1 ? 'Imported File' : 'Imported Files' }}

        </div>

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

    {{-- VALIDATION ERRORS --}}
    @if ($errors->any())

        <div class="alert alert-danger">

            <div class="d-flex align-items-start">

                <i class="fas fa-exclamation-triangle mr-2 mt-1"></i>

                <div>

                    <strong>
                        The file could not be imported.
                    </strong>

                    <ul class="mb-0 mt-2 pl-3">

                        @foreach ($errors->all() as $error)

                            <li>
                                {{ $error }}
                            </li>

                        @endforeach

                    </ul>

                </div>

            </div>

        </div>

    @endif

    <div class="row">

        {{-- IMPORT PANEL --}}
        <div class="col-lg-8">

            <div class="card import-card">

                <div class="card-header border-0">

                    <h3 class="card-title font-weight-bold">

                        <i class="fas fa-cloud-upload-alt text-info mr-2"></i>

                        Upload Patient File

                    </h3>

                    <div class="mt-1">

                        <small class="text-muted">
                            Select a supported spreadsheet file to import patient data
                        </small>

                    </div>

                </div>

                <div class="card-body">

                    <form action="{{ route('imported_patients.import') }}"
                          method="POST"
                          enctype="multipart/form-data"
                          id="import-patients-form">

                        @csrf

                        <div class="upload-zone"
                             id="upload-zone">

                            <input type="file"
                                   name="file"
                                   id="file"
                                   class="file-input"
                                   accept=".xlsx,.xls,.csv"
                                   required>

                            <label for="file"
                                   class="upload-label">

                                <div class="upload-icon">

                                    <i class="fas fa-file-upload"></i>

                                </div>

                                <h4>
                                    Choose a file to import
                                </h4>

                                <p>
                                    Click here to browse your computer
                                </p>

                                <span class="supported-files">
                                    XLSX, XLS or CSV
                                </span>

                            </label>

                        </div>

                        <div class="selected-file"
                             id="selected-file"
                             style="display: none;">

                            <div class="selected-file-icon">

                                <i class="fas fa-file-excel"></i>

                            </div>

                            <div class="selected-file-details">

                                <small>
                                    Selected file
                                </small>

                                <strong id="selected-file-name">
                                    No file selected
                                </strong>

                                <span id="selected-file-size"></span>

                            </div>

                            <button type="button"
                                    class="btn btn-sm btn-outline-danger"
                                    id="remove-file-button"
                                    title="Remove selected file">

                                <i class="fas fa-times"></i>

                            </button>

                        </div>

                        <div class="import-actions">

                            <button type="submit"
                                    class="btn btn-primary"
                                    id="import-button">

                                <span class="button-content">

                                    <i class="fas fa-file-import mr-1"></i>

                                    Import Patients

                                </span>

                                <span class="button-loading d-none">

                                    <span class="spinner-border spinner-border-sm mr-2"
                                          role="status"
                                          aria-hidden="true">
                                    </span>

                                    Importing...

                                </span>

                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

        {{-- INFORMATION PANEL --}}
        <div class="col-lg-4">

            <div class="card information-card">

                <div class="card-header border-0">

                    <h3 class="card-title font-weight-bold">

                        <i class="fas fa-info-circle text-info mr-2"></i>

                        Import Information

                    </h3>

                </div>

                <div class="card-body">

                    <div class="information-item">

                        <div class="information-icon">

                            <i class="fas fa-file-excel"></i>

                        </div>

                        <div>

                            <strong>
                                Supported Files
                            </strong>

                            <small>
                                XLSX, XLS and CSV formats
                            </small>

                        </div>

                    </div>

                    <div class="information-item">

                        <div class="information-icon">

                            <i class="fas fa-table"></i>

                        </div>

                        <div>

                            <strong>
                                Column Headers
                            </strong>

                            <small>
                                Make sure your file includes the expected patient columns
                            </small>

                        </div>

                    </div>

                    <div class="information-item">

                        <div class="information-icon">

                            <i class="fas fa-database"></i>

                        </div>

                        <div>

                            <strong>
                                Patient Records
                            </strong>

                            <small>
                                Imported records will be added to your patient database
                            </small>

                        </div>

                    </div>

                    <div class="import-warning">

                        <i class="fas fa-exclamation-triangle"></i>

                        <div>

                            <strong>
                                Before importing
                            </strong>

                            <p>
                                Verify that names, dates and contact information
                                are correctly formatted.
                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    {{-- IMPORTED FILES --}}
    <div class="card files-card">

        <div class="card-header border-0">

            <div class="d-flex justify-content-between align-items-center flex-wrap">

                <div>

                    <h3 class="card-title font-weight-bold">

                        <i class="fas fa-folder-open text-info mr-2"></i>

                        Imported Files

                    </h3>

                    <div class="mt-1">

                        <small class="text-muted">
                            Download or remove previously imported files
                        </small>

                    </div>

                </div>

                @if ($files->count() > 0)

                    <button type="button"
                            class="btn btn-outline-danger btn-sm mt-2 mt-sm-0"
                            onclick="deleteAllImportedPatients(
                                document.getElementById('delete-all-form')
                            )">

                        <i class="fas fa-trash-alt mr-1"></i>

                        Delete All Imported Patients

                    </button>

                @endif

            </div>

        </div>

        <div class="card-body p-0">

            @if ($files->count() > 0)

                <div class="table-responsive">

                    <table class="table table-hover imported-files-table mb-0">

                        <thead>

                            <tr>

                                <th>
                                    File
                                </th>

                                <th>
                                    Import Date
                                </th>

                                {{-- Activate when patients_count is available --}}
                                {{--
                                <th class="text-center">
                                    Patients
                                </th>
                                --}}

                                <th class="text-center actions-column">
                                    Actions
                                </th>

                            </tr>

                        </thead>

                        <tbody>

                            @foreach ($files as $file)

                                <tr>

                                    {{-- FILE --}}
                                    <td class="align-middle">

                                        <div class="file-information">

                                            <div class="file-icon">

                                                <i class="fas fa-file-excel"></i>

                                            </div>

                                            <div class="file-details">

                                                <strong title="{{ $file->original_name }}">

                                                    {{ $file->original_name }}

                                                </strong>

                                                <small>

                                                    <i class="fas fa-hashtag mr-1"></i>

                                                    File ID: {{ $file->id }}

                                                </small>

                                            </div>

                                        </div>

                                    </td>

                                    {{-- DATE --}}
                                    <td class="align-middle">

                                        <div class="import-date">

                                            <div class="date-icon">

                                                <i class="fas fa-calendar-check"></i>

                                            </div>

                                            <div>

                                                <strong>

                                                    {{ $file->created_at->format('M d, Y') }}

                                                </strong>

                                                <small>

                                                    {{ $file->created_at->format('h:i A') }}

                                                </small>

                                            </div>

                                        </div>

                                    </td>

                                    {{-- PATIENT COUNT --}}
                                    {{--
                                    <td class="text-center align-middle">

                                        <span class="patients-count">

                                            {{ $file->patients_count ?? 0 }}

                                        </span>

                                    </td>
                                    --}}

                                    {{-- ACTIONS --}}
                                    <td class="text-center align-middle">

                                        <div class="file-actions">

                                            <a href="{{ route('imports.download', $file->id) }}"
                                               class="btn btn-success btn-sm"
                                               title="Download file">

                                                <i class="fas fa-download mr-1"></i>

                                                Download

                                            </a>

                                            <form action="{{ route('imports.destroy', $file) }}"
                                                  method="POST"
                                                  class="d-inline">

                                                @csrf
                                                @method('DELETE')

                                                <button type="button"
                                                        class="btn btn-outline-danger btn-sm"
                                                        onclick="deleteFile(
                                                            this.form,
                                                            '{{ addslashes($file->original_name) }}'
                                                        )"
                                                        title="Delete file">

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

                        <i class="fas fa-folder-open"></i>

                    </div>

                    <h4>
                        No Imported Files
                    </h4>

                    <p>
                        Files that you import will appear here so you can
                        download or remove them later.
                    </p>

                </div>

            @endif

        </div>

    </div>

    {{-- DELETE ALL FORM --}}
    <form action="{{ route('imported_patients.destroyAll') }}"
          method="POST"
          id="delete-all-form"
          class="d-none">

        @csrf
        @method('DELETE')

    </form>

@stop

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

        .import-card,
        .information-card,
        .files-card {
            overflow: hidden;
            border: 0;
            border-radius: 9px;
            box-shadow: 0 5px 18px rgba(0, 0, 0, .07);
        }

        .import-card {
            border-top: 3px solid #17a2b8;
        }

        .information-card {
            border-top: 3px solid #007bff;
        }

        .files-card {
            border-top: 3px solid #28a745;
        }

        .upload-zone {
            position: relative;
            overflow: hidden;
            border: 2px dashed #c8d5dc;
            border-radius: 12px;
            transition:
                border-color .2s ease,
                background-color .2s ease,
                transform .2s ease;
        }

        .upload-zone:hover,
        .upload-zone.dragover {
            background-color: #f3fbfd;
            border-color: #17a2b8;
            transform: translateY(-1px);
        }

        .file-input {
            position: absolute;
            width: 1px;
            height: 1px;
            overflow: hidden;
            opacity: 0;
            pointer-events: none;
        }

        .upload-label {
            display: block;
            margin: 0;
            padding: 50px 25px;
            text-align: center;
            cursor: pointer;
        }

        .upload-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 82px;
            height: 82px;
            margin: 0 auto 18px;
            color: #17a2b8;
            font-size: 34px;
            background-color: #e8f7fa;
            border-radius: 50%;
        }

        .upload-label h4 {
            margin-bottom: 7px;
            color: #343a40;
            font-size: 18px;
            font-weight: 700;
        }

        .upload-label p {
            margin-bottom: 14px;
            color: #6c757d;
            font-size: 14px;
        }

        .supported-files {
            display: inline-flex;
            padding: 6px 12px;
            color: #138496;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: .04em;
            background-color: #e8f7fa;
            border-radius: 20px;
        }

        .selected-file {
            display: flex;
            align-items: center;
            margin-top: 15px;
            padding: 14px;
            background-color: #f8f9fa;
            border: 1px solid #e1e6e9;
            border-radius: 9px;
        }

        .selected-file-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            flex: 0 0 44px;
            width: 44px;
            height: 44px;
            margin-right: 12px;
            color: #28a745;
            font-size: 21px;
            background-color: #eaf7ed;
            border-radius: 9px;
        }

        .selected-file-details {
            flex: 1;
            min-width: 0;
        }

        .selected-file-details small,
        .selected-file-details strong,
        .selected-file-details span {
            display: block;
        }

        .selected-file-details small {
            color: #868e96;
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: .05em;
        }

        .selected-file-details strong {
            overflow: hidden;
            margin-top: 2px;
            color: #343a40;
            font-size: 13px;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .selected-file-details span {
            margin-top: 2px;
            color: #868e96;
            font-size: 11px;
        }

        .import-actions {
            display: flex;
            justify-content: flex-end;
            margin-top: 18px;
        }

        .import-actions .btn {
            min-width: 175px;
        }

        .information-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 18px;
        }

        .information-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            flex: 0 0 42px;
            width: 42px;
            height: 42px;
            margin-right: 12px;
            color: #17a2b8;
            background-color: #e8f7fa;
            border-radius: 10px;
        }

        .information-item strong,
        .information-item small {
            display: block;
        }

        .information-item strong {
            color: #343a40;
            font-size: 13px;
        }

        .information-item small {
            margin-top: 3px;
            color: #6c757d;
            font-size: 12px;
            line-height: 1.45;
        }

        .import-warning {
            display: flex;
            align-items: flex-start;
            margin-top: 5px;
            padding: 13px;
            color: #856404;
            background-color: #fff8df;
            border: 1px solid #ffeeba;
            border-radius: 8px;
        }

        .import-warning > i {
            margin-top: 3px;
            margin-right: 10px;
        }

        .import-warning strong,
        .import-warning p {
            display: block;
        }

        .import-warning strong {
            font-size: 12px;
        }

        .import-warning p {
            margin: 3px 0 0;
            font-size: 11px;
            line-height: 1.45;
        }

        .imported-files-table {
            min-width: 760px;
        }

        .imported-files-table thead th {
            padding: 15px 14px;
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

        .imported-files-table tbody td {
            padding: 15px 14px;
            border-top: 1px solid #edf0f2;
        }

        .imported-files-table tbody tr {
            transition: background-color .2s ease;
        }

        .imported-files-table tbody tr:hover {
            background-color: #f8fcfd;
        }

        .file-information {
            display: flex;
            align-items: center;
            min-width: 260px;
        }

        .file-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            flex: 0 0 46px;
            width: 46px;
            height: 46px;
            margin-right: 12px;
            color: #28a745;
            font-size: 21px;
            background-color: #eaf7ed;
            border-radius: 10px;
        }

        .file-details {
            min-width: 0;
        }

        .file-details strong,
        .file-details small {
            display: block;
        }

        .file-details strong {
            max-width: 330px;
            overflow: hidden;
            color: #343a40;
            font-size: 14px;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .file-details small {
            margin-top: 4px;
            color: #868e96;
            font-size: 11px;
        }

        .import-date {
            display: flex;
            align-items: center;
            min-width: 155px;
        }

        .date-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            flex: 0 0 40px;
            width: 40px;
            height: 40px;
            margin-right: 10px;
            color: #17a2b8;
            background-color: #e8f7fa;
            border-radius: 9px;
        }

        .import-date strong,
        .import-date small {
            display: block;
        }

        .import-date strong {
            color: #343a40;
            font-size: 13px;
        }

        .import-date small {
            margin-top: 2px;
            color: #868e96;
            font-size: 11px;
        }

        .actions-column {
            min-width: 210px;
        }

        .file-actions {
            display: flex;
            justify-content: center;
            gap: 7px;
            white-space: nowrap;
        }

        .file-actions .btn {
            min-width: 90px;
        }

        .empty-state {
            padding: 70px 20px;
            text-align: center;
        }

        .empty-state-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 90px;
            height: 90px;
            margin: 0 auto 20px;
            color: #17a2b8;
            font-size: 37px;
            background-color: #e8f7fa;
            border-radius: 50%;
        }

        .empty-state h4 {
            margin-bottom: 8px;
            color: #343a40;
            font-weight: 700;
        }

        .empty-state p {
            max-width: 500px;
            margin: 0 auto;
            color: #6c757d;
            line-height: 1.6;
        }

        @media (max-width: 767.98px) {

            .upload-label {
                padding: 40px 18px;
            }

            .upload-icon {
                width: 70px;
                height: 70px;
                font-size: 29px;
            }

            .import-actions {
                justify-content: stretch;
            }

            .import-actions .btn {
                width: 100%;
            }

            .file-actions {
                justify-content: flex-start;
            }

        }

    </style>

@stop

@section('js')

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>

        document.addEventListener('DOMContentLoaded', function () {

            const fileInput = document.getElementById('file');
            const uploadZone = document.getElementById('upload-zone');
            const selectedFile = document.getElementById('selected-file');
            const selectedFileName = document.getElementById('selected-file-name');
            const selectedFileSize = document.getElementById('selected-file-size');
            const removeFileButton = document.getElementById('remove-file-button');
            const importForm = document.getElementById('import-patients-form');
            const importButton = document.getElementById('import-button');

            function showSelectedFile(file) {

                if (!file) {
                    return;
                }

                selectedFileName.textContent = file.name;
                selectedFileSize.textContent = formatFileSize(file.size);

                selectedFile.style.display = 'flex';

            }

            function clearSelectedFile() {

                fileInput.value = '';

                selectedFile.style.display = 'none';

                selectedFileName.textContent = 'No file selected';
                selectedFileSize.textContent = '';

            }

            function formatFileSize(bytes) {

                if (bytes === 0) {
                    return '0 Bytes';
                }

                const units = ['Bytes', 'KB', 'MB', 'GB'];
                const unitIndex = Math.floor(Math.log(bytes) / Math.log(1024));
                const size = bytes / Math.pow(1024, unitIndex);

                return size.toFixed(unitIndex === 0 ? 0 : 2) + ' ' + units[unitIndex];

            }

            fileInput.addEventListener('change', function () {

                if (this.files && this.files[0]) {
                    showSelectedFile(this.files[0]);
                }

            });

            removeFileButton.addEventListener('click', function () {
                clearSelectedFile();
            });

            ['dragenter', 'dragover'].forEach(function (eventName) {

                uploadZone.addEventListener(eventName, function (event) {

                    event.preventDefault();
                    event.stopPropagation();

                    uploadZone.classList.add('dragover');

                });

            });

            ['dragleave', 'drop'].forEach(function (eventName) {

                uploadZone.addEventListener(eventName, function (event) {

                    event.preventDefault();
                    event.stopPropagation();

                    uploadZone.classList.remove('dragover');

                });

            });

            uploadZone.addEventListener('drop', function (event) {

                const droppedFiles = event.dataTransfer.files;

                if (!droppedFiles || !droppedFiles.length) {
                    return;
                }

                const dataTransfer = new DataTransfer();

                dataTransfer.items.add(droppedFiles[0]);

                fileInput.files = dataTransfer.files;

                showSelectedFile(droppedFiles[0]);

            });

            importForm.addEventListener('submit', function () {

                if (!fileInput.files.length) {
                    return;
                }

                importButton.disabled = true;

                importButton
                    .querySelector('.button-content')
                    .classList
                    .add('d-none');

                importButton
                    .querySelector('.button-loading')
                    .classList
                    .remove('d-none');

            });

        });

        function deleteFile(form, fileName) {

            Swal.fire({

                title: 'Delete file?',

                html: `
                    Are you sure you want to permanently delete
                    <strong>${fileName}</strong>?
                    <br><br>

                    <small class="text-muted">
                        This action cannot be undone.
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

        function deleteAllImportedPatients(form) {

            Swal.fire({

                title: 'Delete all imported patients?',

                html: `
                    This will delete all patients stored in the imported
                    patients section.
                    <br><br>

                    <strong class="text-danger">
                        This action may affect multiple patient records.
                    </strong>
                `,

                icon: 'warning',

                showCancelButton: true,

                confirmButtonColor: '#dc3545',

                cancelButtonColor: '#6c757d',

                confirmButtonText:
                    '<i class="fas fa-trash-alt mr-1"></i> Yes, delete all',

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