@extends('adminlte::page')

@section('title', 'Consulta detalle')

@section('content_header')
    <h1>Consulta detalle</h1>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <h4 class="mb-3">Consulta #{{ $consultation->id }}</h4>

        <p><strong>Name:</strong> {{ $consultation->name }}</p>
        <p><strong>Last Name:</strong> {{ $consultation->last_name }}</p>
        <p><strong>Date of Birth:</strong> {{ $consultation->date_of_birth }}</p>
        <p><strong>Phone:</strong> {{ $consultation->phone }}</p>
        <p><strong>Email:</strong> {{ $consultation->email }}</p>

        <h4 class="mt-4">Address</h4>
        <p>{{ $consultation->address }}</p>

        <h4 class="mt-4">How did you hear about us?</h4>
        <p><strong>Referral Source:</strong> {{ $consultation->referral_source }}</p>
        <p><strong>Other:</strong> {{ $consultation->referral_other }}</p>

        <h4 class="mt-4">Reason for Visit</h4>
        <p><strong>Reason:</strong> {{ $consultation->reason }}</p>
        <p><strong>Symptoms:</strong> {{ $consultation->symptoms }}</p>

        <h4 class="mt-4">Which IV would you like to request?</h4>
        <p><strong>IV Type:</strong> {{ $consultation->iv_type }}</p>

        <h4 class="mt-4">Emergency contact</h4>
        <p><strong>Name:</strong> {{ $consultation->emergency_name }}</p>
        <p><strong>Relation:</strong> {{ $consultation->emergency_relationship }}</p>
        <p><strong>Phone:</strong> {{ $consultation->emergency_phone }}</p>

        <h4 class="mt-4">Medical History</h4>
        <p><strong>Pregnant?:</strong> {{ $consultation->pregnant ? 'Sí' : 'No' }}</p>
        <p><strong>Vitamin intolerance:</strong> {{ $consultation->vitamins_intolerance ? 'Sí' : 'No' }}</p>
        <p><strong>Minerals intolerance:</strong> {{ $consultation->minerals_intolerance ? 'Sí' : 'No' }}</p>

        <h4 class="mt-4">Allergies</h4>
        <p><strong>Medications:</strong> {{ $consultation->allergy_medicine }}</p>
        <p><strong>Food:</strong> {{ $consultation->allergy_food }}</p>
        <p><strong>Reaction:</strong> {{ $consultation->reaction }}</p>

        <h4 class="mt-4">Medications</h4>
        <p>{{ $consultation->medications }}</p>

        <h4 class="mt-4">Supplements</h4>
        <p>{{ $consultation->supplements }}</p>

        <h4 class="mt-4">Informed Consent</h4>
        <p><strong>Accepted:</strong> {{ $consultation->consent_accepted ? 'Yes' : 'No' }}</p>
        <p><strong>Signature:</strong> {{ $consultation->digital_signature }}</p>
        <p><strong>Authorized Procedure:</strong> {{ $consultation->authorized_procedure }}</p>

        <h4 class="mt-4">Vital signs</h4>
        <div class="row">
            <div class="col-md-3"><strong>Heart Rate:</strong> {{ $consultation->heart_rate }}</div>
            <div class="col-md-3"><strong>O₂ Saturation:</strong> {{ $consultation->oxygen_saturation }}%</div>
            <div class="col-md-3"><strong>Temperature:</strong> {{ $consultation->temperature }} °C</div>
            <div class="col-md-3"><strong>Blood Pressure:</strong> {{ $consultation->blood_pressure }}</div>
        </div>

        <h4 class="mt-4">Notes</h4>
        <p>{{ $consultation->notes }}</p>

        <h4 class="mt-4">Registration date</h4>
        <p>{{ $consultation->registration_date }}</p>
    </div>
</div>

<a href="{{ route('consultas.index', $consultation->id) }}" class="btn btn-secondary mt-3">⬅️ Return to list</a>
@endsection
