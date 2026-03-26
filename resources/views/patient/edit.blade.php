@extends('adminlte::page')

@section('title', 'Editar Paciente')

@section('content_header')
    <h1>Editar Paciente</h1>
@endsection

@section('content')
<form action="{{ route('patient.update', $patient->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="card">
        <div class="card-body">
            <h4 class="mb-3">Datos Personales</h4>
            <div class="form-group">
                <label>Nombre:</label>
                <input type="text" name="name" class="form-control" value="{{ $patient->name }}" required>
            </div>
            <div class="form-group">
                <label>Fecha de nacimiento:</label>
                <input type="date" name="date_of_birth" class="form-control" value="{{ $patient->date_of_birth }}" required>
            </div>
            <div class="form-group">
                <label>Teléfono:</label>
                <input type="text" name="phone" class="form-control" value="{{ $patient->phone }}">
            </div>
            <div class="form-group">
                <label>Email:</label>
                <input type="email" name="email" class="form-control" value="{{ $patient->email }}">
            </div>

            <h4 class="mt-4">Contacto de Emergencia</h4>
            <div class="form-group">
                <label>Nombre:</label>
                <input type="text" name="emergency_name" class="form-control" value="{{ $patient->emergency_name }}">
            </div>
            <div class="form-group">
                <label>Relación:</label>
                <input type="text" name="emergency_relationship" class="form-control" value="{{ $patient->emergency_relationship }}">
            </div>
            <div class="form-group">
                <label>Teléfono:</label>
                <input type="text" name="emergency_phone" class="form-control" value="{{ $patient->emergency_phone }}">
            </div>
            <div class="form-group">
                <label>Address:</label>
                <input type="address" name="address" class="form-control" value="{{ $patient->address }}">
            </div>

            <h4 class="mt-4">Historial Médico</h4>
            <div class="form-group">
                <label>¿Embarazada?:</label>
                <select name="pregnant" class="form-control">
                    <option value="1" {{ $patient->pregnant ? 'selected' : '' }}>Sí</option>
                    <option value="0" {{ !$patient->pregnant ? 'selected' : '' }}>No</option>
                </select>
            </div>
            <div class="form-group">
                <label>Intolerancia a vitaminas:</label>
                <select name="vitamins_intolerance" class="form-control">
                    <option value="1" {{ $patient->vitamins_intolerance ? 'selected' : '' }}>Sí</option>
                    <option value="0" {{ !$patient->vitamins_intolerance ? 'selected' : '' }}>No</option>
                </select>
            </div>
            <div class="form-group">
                <label>Intolerancia a minerales:</label>
                <select name="minerals_intolerance" class="form-control">
                    <option value="1" {{ $patient->minerals_intolerance ? 'selected' : '' }}>Sí</option>
                    <option value="0" {{ !$patient->minerals_intolerance ? 'selected' : '' }}>No</option>
                </select>
            </div>

            <h4 class="mt-4">Alergias</h4>
            <div class="form-group">
                <label>Medicamentos:</label>
                <input type="text" name="allergy_medicine" class="form-control" value="{{ $patient->allergy_medicine }}">
            </div>
            <div class="form-group">
                <label>Alimentos:</label>
                <input type="text" name="allergy_food" class="form-control" value="{{ $patient->allergy_food }}">
            </div>
            <div class="form-group">
                <label>Reacción:</label>
                <input type="text" name="reaction" class="form-control" value="{{ $patient->reaction }}">
            </div>

            <h4 class="mt-4">Medicamentos</h4>
            <textarea name="medications" class="form-control">{{ $patient->medications }}</textarea>

            <h4 class="mt-4">Suplementos</h4>
            <textarea name="supplements" class="form-control">{{ $patient->supplements }}</textarea>

            <h4 class="mt-4">Examen físico</h4>
            <textarea name="physical_exam" class="form-control">{{ $patient->physical_exam }}</textarea>

            <h4 class="mt-4">Informed Consent</h4>
            <div class="form-group">
                <label>Accepted:</label>
                <select name="consent_accepted" class="form-control">
                    <option value="1" {{ $patient->consent_accepted ? 'selected' : '' }}>Yes</option>
                    <option value="0" {{ !$patient->consent_accepted ? 'selected' : '' }}>No</option>
                </select>
            </div>
            <div class="form-group">
                <label>Signature:</label>
                <input type="text" name="digital_signature" class="form-control" value="{{ $patient->digital_signature }}">
            </div>
            <div class="form-group">
                <label>Authorized Procedure:</label>
                <input type="text" name="authorized_procedure" class="form-control" value="{{ $patient->authorized_procedure }}">
            </div>

            <h4 class="mt-4">Signos Vitales</h4>
            <div class="row">
                <div class="col-md-3">
                    <label>Heart Rate:</label>
                    <input type="number" name="heart_rate" class="form-control" value="{{ $patient->heart_rate }}">
                </div>
                <div class="col-md-3">
                    <label>O₂ Saturation (%):</label>
                    <input type="number" name="oxygen_saturation" class="form-control" value="{{ $patient->oxygen_saturation }}">
                </div>
                <div class="col-md-3">
                    <label>Temperature (°C):</label>
                    <input type="number" step="0.1" name="temperature" class="form-control" value="{{ $patient->temperature }}">
                </div>
                <div class="col-md-3">
                    <label>Blood Pressure:</label>
                    <input type="text" name="blood_pressure" class="form-control" value="{{ $patient->blood_pressure }}">
                </div>
            </div>

            <h4 class="mt-4">Notes</h4>
            <textarea name="notes" class="form-control">{{ $patient->notes }}</textarea>

            <h4 class="mt-4">Registration Date</h4>
            <p>{{ $patient->registration_date }}</p>
        </div>
    </div>

    <button type="submit" class="btn btn-primary mt-3">Guardar cambios</button>
    <a href="{{ route('pacientes.index') }}" class="btn btn-secondary mt-3">⬅️ Volver al listado</a>
</form>
@endsection
