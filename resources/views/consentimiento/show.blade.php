@extends('layouts.app')

@section('content')
<h1>Informed Consent</h1>

<p>
I, <strong>{{ $consentimiento->patient->name }}</strong>, in full use of my faculties and legal capacity,
DECLARE the following:
</p>

<ol>
    <li>I freely express my will to receive the administration of medications and solutions intravenously and/or intramuscularly.</li>
    <li>The nurse <strong>{{ $consentimiento->nurse_name }}</strong> with professional ID {{ $consentimiento->nurse_id }}
        has provided me with complete, clear, and sufficient information about my current condition,
        risks, and possible complications.</li>
    <li>All hygiene and protection measures have been taken to avoid contagion.</li>
    <li>I understand that, in case additional medical attention is required, it is my responsibility to follow recommendations,
        releasing the staff from any consequences derived.</li>
    <li>I acknowledge the procedures to be performed, the benefits and possible complications,
        and I grant authorization releasing the medical team and clinic from all responsibility.</li>
</ol>

<p><strong>Authorized procedure:</strong> {{ $consentimiento->authorized_procedure }}</p>
<p><strong>Consent accepted:</strong> {{ $consentimiento->consent_accepted ? 'Yes' : 'No' }}</p>
<p><strong>Digital signature:</strong> {{ $consentimiento->digital_signature }}</p>
<p><strong>Date:</strong> {{ $consentimiento->consent_date }}</p>
@endsection
