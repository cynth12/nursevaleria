@extends('adminlte::page')

@section('title', 'Detalle del Paciente del Grupo')

@section('content_header')
    <h1>Detalle del Paciente del Grupo</h1>
@endsection

@section('content')
<div class="container">
    <h2>{{ $patient->name }}</h2>
    <p><strong>Fecha de nacimiento:</strong> {{ $patient->date_of_birth }}</p>
    <p><strong>Teléfono:</strong> {{ $patient->phone }}</p>
    <p><strong>Email:</strong> {{ $patient->email }}</p>
    <p><strong>Dirección:</strong> {{ $patient->address }}</p>

    <hr>
    <h4>Historial médico</h4>
    <p><strong>¿Embarazada?:</strong> {{ $patient->pregnant ? 'Sí' : 'No' }}</p>
    <p><strong>Intolerancia a vitaminas:</strong> {{ $patient->vitamins_intolerance ? 'Sí' : 'No' }}</p>
    <p><strong>Intolerancia a minerales:</strong> {{ $patient->minerals_intolerance ? 'Sí' : 'No' }}</p>

    <hr>
    <h4>Alergias</h4>
    <p><strong>Medicamentos:</strong> {{ $patient->allergy_medicine }}</p>
    <p><strong>Alimentos:</strong> {{ $patient->allergy_food }}</p>
    <p><strong>Reacción:</strong> {{ $patient->reaction }}</p>

    <hr>
    <h4>Consentimiento</h4>
    <p><strong>Aceptado:</strong> {{ $patient->consent_accepted ? 'Sí' : 'No' }}</p>
    <p><strong>Firma digital:</strong> {{ $patient->digital_signature }}</p>
    <p><strong>Procedimiento autorizado:</strong> {{ $patient->authorized_procedure }}</p>

    <hr>
    <h4>Signos vitales</h4>
    <p><strong>Frecuencia cardíaca:</strong> {{ $patient->heart_rate }}</p>
    <p><strong>Saturación de oxígeno:</strong> {{ $patient->oxygen_saturation }}</p>
    <p><strong>Temperatura:</strong> {{ $patient->temperature }}</p>
    <p><strong>Presión arterial:</strong> {{ $patient->blood_pressure }}</p>

    <hr>
    <h4>Notas</h4>
    <p>{{ $patient->notes }}</p>
</div>
<a href="{{ route('grupos.index') }}" class="btn btn-secondary mt-3">⬅️ Volver al listado</a>
@endsection
