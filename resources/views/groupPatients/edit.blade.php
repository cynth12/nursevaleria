@extends('adminlte::page')

@section('title', 'Editar Paciente del Grupo')

@section('content_header')
    <h1>Editar Paciente del Grupo</h1>
@endsection

@section('content')
    <div class="container">
        <h2>Editar: {{ $patient->name }}</h2>

        <form action="{{ route('groupPatients.update', $patient->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Nombre del paciente</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $patient->name) }}" required>
            </div>

            <div class="form-group">
                <label for="date_of_birth">Fecha de nacimiento</label>
                <input type="date" name="date_of_birth" class="form-control"
                    value="{{ old('date_of_birth', $patient->date_of_birth) }}">
            </div>

            <div class="form-group">
                <label for="phone">Teléfono</label>
                <input type="text" name="phone" class="form-control" value="{{ old('phone', $patient->phone) }}">
            </div>

            <div class="form-group">
                <label for="email">Correo</label>
                <input type="email" name="email" class="form-control" value="{{ old('email', $patient->email) }}">
            </div>

            <div class="form-group">
                <label for="address">Dirección</label>
                <input type="text" name="address" class="form-control" value="{{ old('address', $patient->address) }}">
            </div>

            <div class="form-group">
                <label for="emergency_contact_name">Contacto de emergencia (nombre)</label>
                <input type="text" name="emergency_contact_name" class="form-control"
                    value="{{ old('emergency_contact_name', $patient->emergency_contact_name ?? '') }}">
            </div>

            <div class="form-group">
                <label for="emergency_contact_phone">Contacto de emergencia (teléfono)</label>
                <input type="text" name="emergency_contact_phone" class="form-control"
                    value="{{ old('emergency_contact_phone', $patient->emergency_contact_phone ?? '') }}">
            </div>

            <hr>
            <h4>Historial médico</h4>
            <div class="form-check">
                <input type="checkbox" name="pregnant" value="1" class="form-check-input"
                    {{ $patient->pregnant ? 'checked' : '' }}>
                <label class="form-check-label">¿Embarazada?</label>
            </div>
            <div class="form-check">
                <input type="checkbox" name="vitamins_intolerance" value="1" class="form-check-input"
                    {{ $patient->vitamins_intolerance ? 'checked' : '' }}>
                <label class="form-check-label">Intolerancia a vitaminas</label>
            </div>
            <div class="form-check">
                <input type="checkbox" name="minerals_intolerance" value="1" class="form-check-input"
                    {{ $patient->minerals_intolerance ? 'checked' : '' }}>
                <label class="form-check-label">Intolerancia a minerales</label>
            </div>

            <hr>
            <h4>Alergias</h4>
            <div class="form-group">
                <label for="allergy_medicine">Medicamentos</label>
                <input type="text" name="allergy_medicine" class="form-control"
                    value="{{ old('allergy_medicine', $patient->allergy_medicine) }}">
            </div>
            <div class="form-group">
                <label for="allergy_food">Alimentos</label>
                <input type="text" name="allergy_food" class="form-control"
                    value="{{ old('allergy_food', $patient->allergy_food) }}">
            </div>
            <div class="form-group">
                <label for="reaction">Reacción</label>
                <input type="text" name="reaction" class="form-control"
                    value="{{ old('reaction', $patient->reaction) }}">
            </div>

            <hr>
            <div class="form-group">
                <label for="medications">Medicamentos</label>
                <input type="text" name="medications" class="form-control"
                    value="{{ old('medications', $patient->medications ?? '') }}">
            </div>

            <div class="form-group">
                <label for="supplements">Suplementos</label>
                <input type="text" name="supplements" class="form-control"
                    value="{{ old('supplements', $patient->supplements ?? '') }}">
            </div>






            <hr>
            <h4>Signos vitales</h4>
            <div class="form-group">
                <label for="heart_rate">Frecuencia cardíaca</label>
                <input type="number" name="heart_rate" class="form-control"
                    value="{{ old('heart_rate', $patient->heart_rate) }}">
            </div>
            <div class="form-group">
                <label for="oxygen_saturation">Saturación de oxígeno</label>
                <input type="number" name="oxygen_saturation" class="form-control"
                    value="{{ old('oxygen_saturation', $patient->oxygen_saturation) }}">
            </div>
            <div class="form-group">
                <label for="temperature">Temperatura</label>
                <input type="text" name="temperature" class="form-control"
                    value="{{ old('temperature', $patient->temperature) }}">
            </div>
            <div class="form-group">
                <label for="blood_pressure">Presión arterial</label>
                <input type="text" name="blood_pressure" class="form-control"
                    value="{{ old('blood_pressure', $patient->blood_pressure) }}">
            </div>

            <hr>
            <h4>Notas</h4>
            <div class="form-group">
                <textarea name="notes" class="form-control">{{ old('notes', $patient->notes) }}</textarea>
            </div>

            <h4>Consentimiento</h4>
            <h1>NURSE VALERIA IV THERAPY</h1><br>




            <h3>INFORMED CONSENT FOR THE APPLICATION OF IM/IV MEDICATIONS</h3><br>
            <p>
                I <strong>{{ $patient->name }}</strong>,, in full use of my mental faculties and the exircise of legal
                capacity,
                DECLARE the following:
            </p>

            <ol>
                <li>I express my Free will to receive the administration of INTRAVENOUS and/or INTRAMUSCULAR medications
                    and
                    solutions.</li><br>

                <li>The nurse <input type="text" name="nurse_name" required>
                    with professional ID <input type="text" name="nurse_id" required>
                    has provided the complete information regarding my current condition which was given in an ample,
                    precise, and suffcient way in CLEAR and SIMPLE lenguage, informing about opnions, possible risks,
                    and
                    complications.</li><br>

                <p>The nurse is complying with all the hygiene and protection measures to avoid the spreading of the
                    COVID-19
                    virus.

                    The patient/client is aware and understands that in case additional medical attention
                    is required (either from a doctor or from a medical institution), it is the responsibility and
                    decision of
                    the patient/client to follow recommendations, releasing
                    the nurse of any consequences derived from following said indications.

                    Acknowledging the procedures to be performed by the medical team and that they have been explained
                    to me,
                    I grant authorization and release the medical team and the location from all liability
                    once the benefits have been explained to me. I understand the possible complications, reactions, and
                    results, assuming the consequences of this decision.</p>
            </ol>



            <div class="form-check">
                <input type="checkbox" name="consent_accepted" value="1" class="form-check-input"
                    {{ $patient->consent_accepted ? 'checked' : '' }}>
                <label class="form-check-label">Consentimiento aceptado</label>
            </div>
            <div class="form-group">
            <label>Digital signature:</label><br>
            <canvas id="consent-signature-pad" width="400" height="200" style="border:1px solid #000;"></canvas>
            <input type="hidden" name="digital_signature" id="consent_signature"><br>
            <button type="button" id="clear-consent-signature" class="btn btn-warning btn-sm">Borrar</button>
        </div>
            
            <div class="form-group">
                <label for="authorized_procedure">Procedimiento autorizado</label>
                <input type="text" name="authorized_procedure" class="form-control"
                    value="{{ old('authorized_procedure', $patient->authorized_procedure) }}">
            </div>
            <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>
            <script>
                // Firma del paciente
                var patientCanvas = document.getElementById('patient-signature-pad');
                if (patientCanvas) {
                    var patientSignaturePad = new SignaturePad(patientCanvas);
                    document.querySelector('form').addEventListener('submit', function() {
                        if (!patientSignaturePad.isEmpty()) {
                            document.getElementById('patient_signature').value = patientSignaturePad.toDataURL();
                        }
                    });
                    document.getElementById('clear-patient-signature').addEventListener('click', function() {
                        patientSignaturePad.clear();
                    });
                }

                // Firma del consentimiento
                var consentCanvas = document.getElementById('consent-signature-pad');
                if (consentCanvas) {
                    var consentSignaturePad = new SignaturePad(consentCanvas);
                    document.querySelector('form').addEventListener('submit', function() {
                        if (!consentSignaturePad.isEmpty()) {
                            document.getElementById('consent_signature').value = consentSignaturePad.toDataURL();
                        }
                    });
                    document.getElementById('clear-consent-signature').addEventListener('click', function() {
                        consentSignaturePad.clear();
                    });
                }
            </script>





            <button type="submit" class="btn btn-primary mt-3">Actualizar paciente</button>
        </form>
    </div>
@endsection
