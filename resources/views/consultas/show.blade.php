@extends('adminlte::page')

@section('title', 'Consulta detalle')

@section('content_header')
    <h1>Consulting details</h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <h4 class="mb-3">Consult #{{ $consultation->id }}</h4>

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

            <div class="card mt-4">
                <div class="card-header bg-secondary">
                    <strong>Informed Consent</strong>
                </div>
                <div class="card-body">
                    <p style="white-space: pre-line;"><strong>Accepted:</strong>
                        {{ $consultation->consent_accepted ? 'Yes' : 'No' }}</p>
                    <!-- <p><strong>Signature:</strong> {{ $consultation->digital_signature }}</p>-->
                    <p style="white-space: pre-line;"><strong>Authorized Procedure:</strong>
                        {{ $consultation->authorized_procedure }}</p>
                </div>
            </div>

            <div class="card-header bg-primary">
                <strong>Vital signs</strong>
            </div>
            <div class="card-body">
                <h4 class="mt-4">Vital signs pre</h4>
                <div class="row">
                    <div class="col-md-3"><strong>Heart Rate:</strong> {{ $consultation->pre_heart_rate }}</div>
                    <div class="col-md-3"><strong>O₂ Saturation:</strong> {{ $consultation->pre_oxygen_saturation }}%</div>
                    <div class="col-md-3"><strong>Temperature:</strong> {{ $consultation->pre_temperature }} °C</div>
                    <div class="col-md-3"><strong>Blood Pressure:</strong> {{ $consultation->pre_blood_pressure }}</div>
                </div>

                <h4 class="mt-4">Vital signs post</h4>
                <div class="row">
                    <div class="col-md-3"><strong>Heart Rate:</strong> {{ $consultation->heart_rate }}</div>
                    <div class="col-md-3"><strong>O₂ Saturation:</strong> {{ $consultation->oxygen_saturation }}%</div>
                    <div class="col-md-3"><strong>Temperature:</strong> {{ $consultation->temperature }} °C</div>
                    <div class="col-md-3"><strong>Blood Pressure:</strong> {{ $consultation->blood_pressure }}</div>
                </div>
            </div>

            @if ($consultation->treatment || $consultation->treatment_description || $consultation->treatment_formula)
                <div class="card mt-4">

                    <div class="card-header bg-primary">
                        <strong>Treatment</strong>
                    </div>

                    <div class="card-body">

                        <h4>{{ $consultation->treatment->name ?? '' }}</h4>

                        <hr>

                        <strong>Description</strong>

                        <p style="white-space: pre-line;">
                            {{ $consultation->treatment_description }}
                        </p>

                        <br>

                        <strong>Formula</strong>

                        <p style="white-space: pre-line;">
                            {{ $consultation->treatment_formula }}
                        </p>

                    </div>

                </div>
            @endif

            <div class="card mt-4">

                <div class="card-header bg-secondary">
                    <strong>Notes</strong>
                </div>

                <div class="card-body">

                    <p style="white-space: pre-line;">
                        {{ $consultation->notes }}
                    </p>

                </div>

            </div>
            <a href="{{ route('consultas.pdf', $consultation->id) }}" class="btn btn-info mt-3" target="_blank">

                <i class="fas fa-file-pdf"></i>

                Print Treatment Summary
            </a>
            @if ($consultation->patient->group)
                <div class="callout callout-info">
                    <h5>
                        <i class="fas fa-users"></i>
                        Patient belongs to the group
                    </h5>

                    <a href="{{ route('grupos.show', $consultation->patient->group->id) }}" class="btn btn-info btn-lg">
                        {{ $consultation->patient->group->place }}
                    </a>
                </div>
            @endif
            <div class="card mt-4">
                <div class="card-header bg-secondary">
                    <strong>Registration date</strong>
                </div>
                <div class="card-body">
                    <p style="white-space: pre-line;">{{ $consultation->registration_date }}</p>
                </div>
            </div>
        </div>
    </div>


    @if ($consultation->patient->group)
        <a href="{{ route('grupos.show', $consultation->patient->group->id) }}" class="btn btn-secondary">
            Return to Group
        </a>
    @endif
    <a href="{{ route('consultas.index', $consultation->patient_id) }}" class="btn btn-secondary mt-3">⬅️ Return to
        list</a>
@endsection
