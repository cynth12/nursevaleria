@extends('adminlte::page')

@section('title', 'Pacientes')

@section('content')
    <h1>NURSE VALERIA IV THERAPY</h1><br>

    <form action="{{ route('consentimiento.store', $patient->id) }}" method="POST">
        @csrf

        <p><strong>Date:</strong> {{ $patient->registration_date }}</p><br>
        <h3>INFORMED CONSENT FOR THE APPLICATION OF IM/IV MEDICATIONS</h3><br>
        <p>
            I <strong>{{ $patient->name }}</strong>, in full use of my mental faculties and the exircise of legal capacity,
            DECLARE the following:
        </p>

        <ol>
            <li>I express my Free will to receive the administration of INTRAVENOUS and/or INTRAMUSCULAR medications and
                solutions.</li><br>

            <li>The nurse <input type="text" name="nurse_name" required>
                with professional ID <input type="text" name="nurse_id" required>
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


        <div class="form-group">
            <label>Authorized procedure:</label>
            <input type="text" name="authorized_procedure" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Consent accepted:</label>
            <select name="consent_accepted" class="form-control" required>
                <option value="1">Yes</option>
                <option value="0">No</option>
            </select>
        </div>


        <div class="form-group">
            <label>Digital signature:</label><br>
            <canvas id="consent-signature-pad" width="400" height="200" style="border:1px solid #000;"></canvas>
            <input type="hidden" name="digital_signature" id="consent_signature"><br>
            <button type="button" id="clear-consent-signature" class="btn btn-warning btn-sm">Borrar</button>
        </div>


        <div class="form-group">
            <label>Date of consent:</label>
            <input type="date" name="consent_date" class="form-control" value="{{ now()->toDateString() }}" required>
        </div>

        <button type="submit" class="btn btn-success">Guardar</button>
    </form>

@endsection

<script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>
<script>
    // Firma del paciente
    var patientCanvas = document.getElementById('patient-signature-pad');
    if (patientCanvas) {
        var patientSignaturePad = new SignaturePad(patientCanvas);
        document.querySelector('form').addEventListener('submit', function () {
            if (!patientSignaturePad.isEmpty()) {
                document.getElementById('patient_signature').value = patientSignaturePad.toDataURL();
            }
        });
        document.getElementById('clear-patient-signature').addEventListener('click', function () {
            patientSignaturePad.clear();
        });
    }

    // Firma del consentimiento
    var consentCanvas = document.getElementById('consent-signature-pad');
    if (consentCanvas) {
        var consentSignaturePad = new SignaturePad(consentCanvas);
        document.querySelector('form').addEventListener('submit', function () {
            if (!consentSignaturePad.isEmpty()) {
                document.getElementById('consent_signature').value = consentSignaturePad.toDataURL();
            }
        });
        document.getElementById('clear-consent-signature').addEventListener('click', function () {
            consentSignaturePad.clear();
        });
    }
</script>
