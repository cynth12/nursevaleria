@extends('adminlte::page')

@section('title', 'Consulta detalle')

@section('content_header')
    <h1>Consulta detalle</h1>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <h4 class="mb-3">Consulta #{{ $consultation->id }}</h4>

        <p><strong>Name:</strong> {{ $consultation->patient->name }}</p>
        <p><strong>Last Name:</strong> {{ $consultation->patient->last_name }}</p>
        <p><strong>Date of Birth:</strong> {{ $consultation->patient->date_of_birth }}</p>
        <p><strong>Phone:</strong> {{ $consultation->patient->phone }}</p>
        <p><strong>Email:</strong> {{ $consultation->patient->email }}</p>

        <h4 class="mt-4">Address</h4>
        <p>{{ $consultation->patient->address }}</p>

        <h4 class="mt-4">How did you hear about us?</h4>
        <p><strong>Referral Source:</strong> {{ $consultation->patient->referral_source }}</p>
        <p><strong>Other:</strong> {{ $consultation->patient->referral_other }}</p>

        <h4 class="mt-4">Reason for Visit</h4>
        <p><strong>Reason:</strong> {{ $consultation->patient->reason }}</p>
        <p><strong>Symptoms:</strong> {{ $consultation->patient->symptoms }}</p>

        <h4 class="mt-4">Which IV would you like to request?</h4>
        <p><strong>IV Type:</strong> {{ $consultation->patient->iv_type }}</p>

        <h4 class="mt-4">Emergency contact</h4>
        <p><strong>Name:</strong> {{ $consultation->patient->emergency_name }}</p>
        <p><strong>Relation:</strong> {{ $consultation->patient->emergency_relationship }}</p>
        <p><strong>Phone:</strong> {{ $consultation->patient->emergency_phone }}</p>

        <h4 class="mt-4">Medical History</h4>
        <p><strong>Pregnant?:</strong> {{ $consultation->patient->pregnant ? 'Sí' : 'No' }}</p>
        <p><strong>Vitamin intolerance:</strong> {{ $consultation->patient->vitamins_intolerance ? 'Sí' : 'No' }}</p>
        <p><strong>Minerals intolerance:</strong> {{ $consultation->patient->minerals_intolerance ? 'Sí' : 'No' }}</p>

        <h4 class="mt-4">Allergies</h4>
        <p><strong>Medications:</strong> {{ $consultation->patient->allergy_medicine }}</p>
        <p><strong>Food:</strong> {{ $consultation->patient->allergy_food }}</p>
        <p><strong>Reaction:</strong> {{ $consultation->patient->reaction }}</p>

        <h4 class="mt-4">Medications</h4>
        <p>{{ $consultation->patient->medications }}</p>

        <h4 class="mt-4">Supplements</h4>
        <p>{{ $consultation->patient->supplements }}</p>

        <h4 class="mt-4">Informed Consent</h4>
        <p><strong>Accepted:</strong> {{ $consultation->patient->consent_accepted ? 'Yes' : 'No' }}</p>
        <p><strong>Signature:</strong> {{ $consultation->patient->digital_signature }}</p>
        <p><strong>Authorized Procedure:</strong> {{ $consultation->patient->authorized_procedure }}</p>

        <h4 class="mt-4">Vital signs</h4>
        <div class="row">
            <div class="col-md-3"><strong>Heart Rate:</strong> {{ $consultation->patient->heart_rate }}</div>
            <div class="col-md-3"><strong>O₂ Saturation:</strong> {{ $consultation->patient->oxygen_saturation }}%</div>
            <div class="col-md-3"><strong>Temperature:</strong> {{ $consultation->patient->temperature }} °C</div>
            <div class="col-md-3"><strong>Blood Pressure:</strong> {{ $consultation->patient->blood_pressure }}</div>
        </div>

        <h4 class="mt-4">Notes</h4>
        <p>{{ $consultation->patient->notes }}</p>

        <h4 class="mt-4">Registration date</h4>
        <p>{{ $consultation->registration_date }}</p>
    </div>
</div>

<a href="{{ route('consultas.index', $consultation->patient->id) }}" class="btn btn-secondary mt-3">⬅️ Return to list</a>
@endsection
