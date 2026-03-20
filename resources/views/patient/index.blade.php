@extends('adminlte::page')

@section('title', 'Pacientes')

@section('content')

    <h1>🩺 Create New Patient</h1>

    <form method="POST" action="{{ route('patient.store') }}">
        @csrf
        <div class="row">

            <!-- Datos personales -->
            <div class="col-md-6">
                <h4 class="mt-4">Datos Personales</h4>
                <div class="form-group">
                    <label for="name">Patient Name</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Full name" required>
                </div>

                <div class="form-group">
                    <label for="date_of_birth">📅 Date of Birth</label>
                    <input type="date" name="date_of_birth" id="date_of_birth" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="phone">📞 Phone</label>
                    <input type="text" name="phone" id="phone" class="form-control" placeholder="Phone number"
                        required>
                </div>

                <div class="form-group">
                    <label for="email">✉️ Email</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="example@mail.com"
                        required>
                </div>

            </div>

            <!-- Contacto de emergencia -->
            <div class="col-md-6">
                <h4 class="mt-4">Emergency Contact</h4>
                <div class="form-group">
                    <label for="emergency_name">Name</label>
                    <input type="text" name="emergency_name" id="emergency_name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="emergency_relationship">Relationship</label>
                    <input type="text" name="emergency_relationship" id="emergency_relationship" class="form-control"
                        required>
                </div>
                <div class="form-group">
                    <label for="emergency_phone">Phone</label>
                    <input type="text" name="emergency_phone" id="emergency_phone" class="form-control" required>
                </div>
            </div>

            <!-- Historial médico -->
            <div class="col-md-6">
                <h4 class="mt-4">Medical / Surgical History</h4>
                <div class="form-group">
                    <label for="prenant">¿Are you, or could you be, prenant?</label>
                    <select name="prenant" id="prenant" class="form-control">
                        <option value="" disabled selected>Select</option>
                        <option value="yes">Yes</option>
                        <option value="no">No</option>

                    </select>
                </div>
                <div class="form-group">
                    <label for="vitamins">¿Have you ever had and intolerance to vitamins?</label>
                    <select name="vitamins" id="vitamins" class="form-control">
                        <option value="" disabled selected>Select</option>
                        <option value="yes">Yes</option>
                        <option value="no">No</option>

                    </select>
                </div>
                <div class="form-group">
                    <label for="minerals">¿Have you ever had and intolerance to minerals?</label>
                    <select name="minerals" id="minerals" class="form-control">
                        <option value="" disabled selected>Select</option>
                        <option value="yes">Yes</option>
                        <option value="no">No</option>

                    </select>
                </div>
            </div>


            <!-- Alergias -->
            <div class="col-md-6">
                <h4 class="mt-4">Allergies</h4>
                <div class="form-group">
                    <label for="allergy_medicine">Medicine</label>
                    <select name="allergy_medicine" id="allergy_medicine" class="form-control">
                        <option value="" disabled selected>Select medicine</option>
                        <option value="penicillin">Penicillin</option>
                        <option value="aspirin">Aspirin</option>
                        <option value="ibuprofen">Ibuprofen</option>
                        <option value="morphine">Morphine</option>
                        <option value="other">Other</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="allergy_food">Food</label>
                    <input type="text" name="allergy_food" id="allergy_food" class="form-control"
                        placeholder="Food allergies">
                </div>
                <div class="form-group">
                    <label for="reaction">Reaction</label>
                    <input type="text" name="reaction" id="reaction" class="form-control"
                        placeholder="Describe reaction">
                </div>
            </div>

            <!-- Medicamentos -->
            <div class="col-md-6">
                <h4 class="mt-4">Medications</h4>
                <div class="form-group">
                    <label for="medications">List medications</label>
                    <textarea name="medications" id="medications" class="form-control" rows="3"
                        placeholder="Name, dose, frequency"></textarea>
                </div>
            </div>

            <!-- Suplementos -->
            <div class="col-md-6">
                <h4 class="mt-4">Supplements</h4>
                <div class="form-group">
                    <label for="supplements">List supplements</label>
                    <textarea name="supplements" id="supplements" class="form-control" rows="3"
                        placeholder="Type, dose, frequency"></textarea>
                </div>
            </div>

            <!-- Examen físico -->
            <div class="col-md-12">
                <h4 class="mt-4">Abbreviated Physical Exam</h4>
                <div class="form-group">
                    <textarea name="physical_exam" id="physical_exam" class="form-control" rows="4"
                        placeholder="Notes from physical exam"></textarea>
                </div>

                <!-- Consentimiento informado -->
                <div class="col-md-12">
                    <h4 class="mt-4">Consentimiento Informado</h4>
                    <div class="form-group">
                        <label for="consent_accepted">Acepta tratamiento</label>
                        <select name="consent_accepted" id="consent_accepted" class="form-control">
                            <option value="" disabled selected>Select</option>
                            <option value="1">Sí</option>
                            <option value="0">No</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="authorized_procedure">Procedimiento Autorizado</label>
                        <input type="text" name="authorized_procedure" id="authorized_procedure" class="form-control"
                            placeholder="Ej. Multivitamin IV Drip">
                    </div>
                </div>

                <!-- Signos vitales -->
                <div class="col-md-12">
                    <h4 class="mt-4">Signos Vitales</h4>
                    <div class="row">
                        <div class="col-md-3">
                            <label for="heart_rate">Frecuencia Cardíaca (FC)</label>
                            <input type="number" name="heart_rate" id="heart_rate" class="form-control"
                                placeholder="Ej. 78">
                        </div>
                        <div class="col-md-3">
                            <label for="oxygen_saturation">Saturación O₂ (%)</label>
                            <input type="number" name="oxygen_saturation" id="oxygen_saturation" class="form-control"
                                placeholder="Ej. 97">
                        </div>
                        <div class="col-md-3">
                            <label for="temperature">Temperatura (°C)</label>
                            <input type="number" step="0.1" name="temperature" id="temperature"
                                class="form-control" placeholder="Ej. 36.7">
                        </div>
                        <div class="col-md-3">
                            <label for="blood_pressure">Tensión Arterial</label>
                            <input type="text" name="blood_pressure" id="blood_pressure" class="form-control"
                                placeholder="Ej. 120/80">
                        </div>
                    </div>
                </div>

                <!-- Notas del administrador -->
                <h4 class="mt-4">Notas</h4>
                <div class="form-group">
                    <textarea name="notes" id="notes" class="form-control" rows="4"
                        placeholder="Observaciones del administrador"></textarea>
                </div>
            </div>

            <div class="form-group">
                        <label>Firma del paciente:</label><br>
                        <canvas id="patient-signature-pad" width="400" height="200"
                            style="border:1px solid #000;"></canvas>
                        <input type="hidden" name="patient_signature" id="patient_signature"><br>
                        <button type="button" id="clear-patient-signature"
                            class="btn btn-warning btn-sm">Borrar</button>
                    </div>
        </div>

        <button type="submit" class="btn btn-success mt-3">✅ Save Patient</button>
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
