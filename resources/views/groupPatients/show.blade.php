@extends('adminlte::page')

@section('title', 'Detalle del Paciente del Grupo')

@section('content_header')
    <h1>Patient Details of the Group</h1>
@endsection

@section('content')
    <div class="container">
        <h2>{{ $patient->name }}</h2>
        <p><strong>Date of birth:</strong> {{ $patient->date_of_birth }}</p>
        <p><strong>Phone:</strong> {{ $patient->phone }}</p>
        <p><strong>Email:</strong> {{ $patient->email }}</p>
        <p><strong>Address:</strong> {{ $patient->address }}</p>

        <hr>

        <h4>Emergency contact</h4>
        <p><strong>Name:</strong> {{ $patient->emergency_contact_name }}</p>
        <p><strong>Phone:</strong> {{ $patient->emergency_contact_phone }}</p>

        <hr>
        <h4>Medical History</h4>
        <p><strong>Pregnant?</strong> {{ $patient->pregnant ? 'Sí' : 'No' }}</p>
        <p><strong>Vitamins intolerance:</strong> {{ $patient->vitamins_intolerance ? 'Sí' : 'No' }}</p>
        <p><strong>Minerals_intolerance:</strong> {{ $patient->minerals_intolerance ? 'Sí' : 'No' }}</p>

        <hr>
        <h4>Allergies</h4>
        <p><strong>Medications:</strong> {{ $patient->allergy_medicine }}</p>
        <p><strong>Food:</strong> {{ $patient->allergy_food }}</p>
        <p><strong>Reacction:</strong> {{ $patient->reaction }}</p>
        <hr>
        <h4>Medications and supplements</h4>
        <p><strong>Medications:</strong> {{ $patient->medications }}</p>
        <p><strong>Supplements:</strong> {{ $patient->supplements }}</p>

        <hr>
        <h4>Vital sings</h4>
        <p><strong>Heart rate:</strong> {{ $patient->heart_rate }}</p>
        <p><strong>Oxígen saturation:</strong> {{ $patient->oxygen_saturation }}</p>
        <p><strong>Temperature:</strong> {{ $patient->temperature }}</p>
        <p><strong>Blood pressure:</strong> {{ $patient->blood_pressure }}</p>

        <hr>
        <h4>Notes</h4>
        <p>{{ $patient->notes }}</p>
        <hr>

        <h4>INFORMED CONSENT</h4>
        <h3>INFORMED CONSENT FOR THE APPLICATION OF IM/IV MEDICATIONS</h3><br>
        <p>
            I <strong>{{ $patient->name }}</strong>, in full use of my mental faculties and the exircise of legal capacity,
            DECLARE the following:
        </p>

        <ol>
            <li>I express my Free will to receive the administration of INTRAVENOUS and/or INTRAMUSCULAR medications and
                solutions.</li><br>
            <li>The nurse <strong>{{ $patient->nurse_name }}</strong> with professional ID
                <strong>{{ $patient->nurse_id }}</strong>
                has provided the complete information regarding my current condition which was given in an ample,
                precise, and suffcient way in CLEAR and SIMPLE lenguage, informing about opnions, possible risks, and
                complications.</li><br>

            <p>The nurse is complying with all the hygiene and protection measures to avoid the spreading of the COVID-19
                virus.

                The patient/client is aware and understands that in case additional medical attention
                is required (either from a doctor or from a medical institution), it is the responsibility and decision of
                the patient/client to follow recommendations, releasing
                the nurse of any consequences derived from following said indications.

                Acknowledging the procedures to be performed by the medical team and that they have been explained to me,
                I grant authorization and release the medical team and the location from all liability
                once the benefits have been explained to me. I understand the possible complications, reactions, and
                results, assuming the consequences of this decision.</p>
        </ol>

        <p><strong>Authorized procedure:</strong> {{ $patient->authorized_procedure }}</p>
        <p><strong>Digital singature:</strong> {{ $patient->digital_signature }}</p>
        <p><strong>Consent Date:</strong> {{ $patient->created_at }}</p>


        <a href="{{ route('groupPatients.edit', $patient->id) }}" class="btn btn-success">Edit</a>
        <form action="{{ route('groupPatients.destroy', $patient->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delate</button>
        </form>
        <hr>
        <a href="{{ route('grupos.show', $patient->group_id) }}" class="btn btn-secondary">
            ← Return to the group's patient list
        </a>
    </div>

@endsection
