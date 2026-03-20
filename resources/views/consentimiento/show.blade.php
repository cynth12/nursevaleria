@extends('adminlte::page')

@section('title', 'Consentimiento Firmado')

@section('content_header')
    <h1>Consentimiento Informado</h1>
@endsection

@section('content')
    <h3>INFORMED CONSENT FOR THE APPLICATION OF IM/IV MEDICATIONS</h3><br>
    <p>
        I <strong>{{ $consentimiento->patient->name }}</strong>,  in full use of my mental faculties and the exircise of legal capacity,
        DECLARE the following:
    </p>

    <ol>
         <li>I express my Free will to receive the administration of INTRAVENOUS and/or INTRAMUSCULAR medications and solutions.</li><br>
        <li>The nurse <strong>{{ $consentimiento->nurse_name }}</strong>  with professional ID  <strong>{{ $consentimiento->nurse_id }}</strong>
       has provided the complete information regarding my current condition which was given in an ample, 
            precise, and suffcient way in CLEAR and SIMPLE lenguage, informing about opnions, possible risks, and complications.</li><br>

    <p>The nurse is complying with all the hygiene and protection measures to avoid the spreading of the COVID-19 virus.

    The patient/client is aware and understands that in case additional medical attention 
    is required (either from a doctor or from a medical institution), it is the responsibility and decision of the patient/client to follow recommendations, releasing
    the nurse of any consequences derived from following said indications.

    Acknowledging the procedures to be performed by the medical team and that they have been explained to me, 
    I grant authorization and release the medical team and the location from all liability 
    once the benefits have been explained to me. I understand the possible complications, reactions, and results, assuming the consequences of this decision.</p>
</ol>

    <p><strong>Procedimiento autorizado:</strong> {{ $consentimiento->authorized_procedure }}</p>
    <p><strong>Firma digital:</strong> {{ $consentimiento->digital_signature }}</p>
    <p><strong>Fecha del consentimiento:</strong> {{ $consentimiento->consent_date }}</p>
    <p><strong>Fecha de registro del paciente:</strong> {{ $consentimiento->patient->registration_date }}</p>
@endsection



