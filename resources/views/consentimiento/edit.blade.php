@extends('adminlte::page')

@section('title', 'Editar Consentimiento')

@section('content_header')
    <h1>Edit Consent</h1>
@endsection

@section('content')

<form action="{{ route('consentimiento.update', $consentimiento->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="card">
        <div class="card-body">

            <div class="form-group mb-3">
                <label>Patient</label>
                <input type="text"
                       class="form-control"
                       value="{{ $consentimiento->patient->name }} {{ $consentimiento->patient->last_name }}"
                       readonly>
            </div>

            <div class="form-group mb-3">
                <label>Nurse Name</label>
                <input type="text"
                       name="nurse_name"
                       class="form-control"
                       value="{{ old('nurse_name', $consentimiento->nurse_name) }}">
            </div>

            <div class="form-group mb-3">
                <label>Nurse Professional ID</label>
                <input type="text"
                       name="nurse_id"
                       class="form-control"
                       value="{{ old('nurse_id', $consentimiento->nurse_id) }}">
            </div>

            <div class="form-group mb-3">
                <label>Authorized Procedure</label>
                <input type="text"
                       name="authorized_procedure"
                       class="form-control"
                       value="{{ old('authorized_procedure', $consentimiento->authorized_procedure) }}">
            </div>

            <div class="form-group mb-3">
                <label>Consent Accepted</label>

                <select name="consent_accepted" class="form-control">
                    <option value="1"
                        {{ $consentimiento->consent_accepted == 1 ? 'selected' : '' }}>
                        Yes
                    </option>

                    <option value="0"
                        {{ $consentimiento->consent_accepted == 0 ? 'selected' : '' }}>
                        No
                    </option>
                </select>
            </div>

            <div class="form-group mb-3">
                <label>Consent Date</label>

                <input type="date"
                       name="consent_date"
                       class="form-control"
                       value="{{ old('consent_date', $consentimiento->consent_date) }}">
            </div>

            <div class="form-group mb-3">
                <label>Current Signature</label><br>

                @if($consentimiento->digital_signature)
                    <img src="{{ $consentimiento->digital_signature }}"
                         width="300"
                         class="mb-2">
                @else
                    <p>No signature available</p>
                @endif
            </div>
        </div>

        <div class="card-footer">

            <button type="submit" class="btn btn-success">
                Save Changes
            </button>

            <a href="{{ route('consentimiento.show', $consentimiento->id) }}"
               class="btn btn-secondary">
                Cancel
            </a>

        </div>
    </div>

</form>

<script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {

    const canvas = document.getElementById('signature-pad');

    const signaturePad = new SignaturePad(canvas);

    document.querySelector('form').addEventListener('submit', function() {

        if (!signaturePad.isEmpty()) {

            document.getElementById('digital_signature').value =
                signaturePad.toDataURL();
        }
    });

    document.getElementById('clear-signature')
        .addEventListener('click', function() {

            signaturePad.clear();
        });

});
</script>

@endsection