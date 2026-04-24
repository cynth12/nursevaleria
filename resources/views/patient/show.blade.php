@extends('adminlte::page')

@section('title', 'Detalle del Paciente')

@section('content_header')
    <h1>Patient Details</h1>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <h4 class="mb-3"></h4>
        <p><strong>Name:</strong> {{ $patient->name }}</p>
        <p><strong>Last Name:</strong> {{ $patient->last_name }}</p>
        <p><strong>Date of Birth:</strong> {{ $patient->date_of_birth }}</p>
        <p><strong>Phone:</strong> {{ $patient->phone }}</p>
        <p><strong>Email:</strong> {{ $patient->email }}</p>
        <h4 class="mt-4">Address</h4><p>{{ $patient->address }}</p>

        <h4 class="mt-4">How did you hear about us?</h4>
        <p><strong>Referral Source:</strong> {{ $patient->referral_source }}</p>
        <p><strong>Other:</strong> {{ $patient->referral_other }}</p>

             <!-- Motivo y síntomas -->
        <h4 class="mt-4">Reason for Visit</h4>
        <p><strong>Reason:</strong> {{ $patient->reason }}</p>
        <p><strong>Symptoms:</strong> {{ $patient->symptoms }}</p>

            <!-- Solicitud de IV -->
        <h4 class="mt-4">Which Intravenous Route</h4>
        <p><strong>IV Type:</strong> {{ $patient->iv_type }}</p>

        <h4 class="mt-4">Emergency contact</h4>
        <p><strong>Name:</strong> {{ $patient->emergency_name }}</p>
        <p><strong>Relation:</strong> {{ $patient->emergency_relationship }}</p>
        <p><strong>Phone:</strong> {{ $patient->emergency_phone }}</p>

        <h4 class="mt-4">Médical History</h4>
        <p><strong>¿Pregnant?:</strong> {{ $patient->pregnant ? 'Sí' : 'No' }}</p>
        <p><strong>Vitamin intolerance</strong> {{ $patient->vitamins_intolerance ? 'Sí' : 'No' }}</p>
        <p><strong>Minerals intolerance</strong> {{ $patient->minerals_intolerance ? 'Sí' : 'No' }}</p>

        <h4 class="mt-4">Allergies</h4>
        <p><strong>Medications:</strong> {{ $patient->allergy_medicine }}</p>
        <p><strong>Food:</strong> {{ $patient->allergy_food }}</p>
        <p><strong>Reaction:</strong> {{ $patient->reaction }}</p>

        <h4 class="mt-4">Medications</h4>
        <p>{{ $patient->medications }}</p>

        <h4 class="mt-4">Supplements</h4>
        <p>{{ $patient->supplements }}</p>

        <!--<h4 class="mt-4">Examen físico</h4>
        <p>{{ $patient->physical_exam }}</p>-->

        <!-- Consentimiento informado -->
    <h4 class="mt-4">Informed Consent</h4>
    <p><strong>Accepted:</strong> {{ $patient->consent_accepted ? 'Yes' : 'No' }}</p>
    <p><strong>Signature:</strong> {{ $patient->digital_signature }}</p>
    <p><strong>Authorized Procedure:</strong> {{ $patient->authorized_procedure }}</p>

    <!-- Signos vitales -->
    <h4 class="mt-4">Vital signs</h4>
    <div class="row">
        <div class="col-md-3"><strong>Heart Rate:</strong> {{ $patient->heart_rate }}</div>
        <div class="col-md-3"><strong>O₂ Saturation:</strong> {{ $patient->oxigen_saturation }}%</div>
        <div class="col-md-3"><strong>Temperature:</strong> {{ $patient->temperature }} °C</div>
        <div class="col-md-3"><strong>Blood Pressure:</strong> {{ $patient->blood_pressure }}</div>
    </div>

        <h4 class="mt-4">Notes</h4>
        <p>{{ $patient->notes }}</p>

        <h4 class="mt-4">registration date</h4>
        <p>{{ $patient->registration_date }}</p>
    </div>
</div>

<a href="{{ route('pacientes.index') }}" class="btn btn-secondary mt-3">⬅️ Return to list</a>
@endsection
