@extends('adminlte::page')

@section('title', 'Detalle del Paciente')

@section('content_header')
    <h1>Detalle del Paciente</h1>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <h4 class="mb-3">Datos Personales</h4>
        <p><strong>Nombre:</strong> {{ $patient->name }}</p>
        <p><strong>Fecha de nacimiento:</strong> {{ $patient->date_of_birth }}</p>
        <p><strong>Teléfono:</strong> {{ $patient->phone }}</p>
        <p><strong>Email:</strong> {{ $patient->email }}</p>

        <h4 class="mt-4">Contacto de Emergencia</h4>
        <p><strong>Nombre:</strong> {{ $patient->emergency_name }}</p>
        <p><strong>Relación:</strong> {{ $patient->emergency_relationship }}</p>
        <p><strong>Teléfono:</strong> {{ $patient->emergency_phone }}</p>

        <h4 class="mt-4">Historial Médico</h4>
        <p><strong>¿Embarazada?:</strong> {{ $patient->pregnant ? 'Sí' : 'No' }}</p>
        <p><strong>Intolerancia a vitaminas:</strong> {{ $patient->vitamins_intolerance ? 'Sí' : 'No' }}</p>
        <p><strong>Intolerancia a minerales:</strong> {{ $patient->minerals_intolerance ? 'Sí' : 'No' }}</p>

        <h4 class="mt-4">Alergias</h4>
        <p><strong>Medicamentos:</strong> {{ $patient->allergy_medicine }}</p>
        <p><strong>Alimentos:</strong> {{ $patient->allergy_food }}</p>
        <p><strong>Reacción:</strong> {{ $patient->reaction }}</p>

        <h4 class="mt-4">Medicamentos</h4>
        <p>{{ $patient->medications }}</p>

        <h4 class="mt-4">Suplementos</h4>
        <p>{{ $patient->supplements }}</p>

        <h4 class="mt-4">Examen físico</h4>
        <p>{{ $patient->physical_exam }}</p>

        <h4 class="mt-4">Notas</h4>
        <p>{{ $patient->notes }}</p>

        <h4 class="mt-4">Fecha de registro</h4>
        <p>{{ $patient->registration_date }}</p>
    </div>
</div>

<a href="{{ route('pacientes.index') }}" class="btn btn-secondary mt-3">⬅️ Volver al listado</a>
@endsection
