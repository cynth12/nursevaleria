<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Nurse – Valeria</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">

</head>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


<div class="container">
    <img src="{{ asset('img/formulario.png') }}" class="form-header-image"><br>

    <form action="{{ route('patient.form.store') }}" method="POST">
        @csrf
        <h1></h1><br>
        <h2 class="form-title">BASIC EVALUATION FOR IV THERAPY</h2><br>
        <!-- Datos personales -->
        <h4>PERSONAL DATE</h4>
        <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Date of birth:</label>
            <input type="date" name="date_of_birth" id="date_of_birth" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Phone (WhatsApp)</label>
            <input type="text" name="phone" id="phone" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Address</label>
            <input type="address" name="address" id="address" class="form-control">
        </div>

        <div class="form-group">
            <label>HOW DID YOU HEAR ABOUT US?</label>
        </div>
        <div class="form-group">
            <label><input type="checkbox" name="referral_source[]" value="instagram"> Instagram</label><br>
            <label><input type="checkbox" name="referral_source[]" value="facebook"> Facebook</label><br>
            <label>Other</label>
            <input type="text" name="referral_other" class="form-control">
        </div>
        <!-- Motivo y síntomas -->
        <h4>REASON FOR VISIT:</h4>
        <div class="form-group">
            <label>Reason</label>
            <input type="text" name="reason" class="form-control">
        </div>
        <div class="form-group">
            <label>Are you experiencing any of the following symptoms? Please select</label><br>
            <label><input type="checkbox" name="symptoms[]" value="Dolor abdominal"> ABDOMINAL PAINS</label><br>
            <label><input type="checkbox" name="symptoms[]" value="Fiebre"> FEVER</label><br>
            <label><input type="checkbox" name="symptoms[]" value="Vómito"> VOMITING</label><br>
            <label><input type="checkbox" name="symptoms[]" value="Diarrea">DIARRHEA</label><br>
            <label><input type="checkbox" name="symptoms[]" value="Ninguno">NONE OF THE ABOVE</label>
        </div>

        <!-- Contacto de emergencia -->
        <h4>EMERGENCY CONTACT:</h4>
        <div class="form-group">
            <label>Name</label>
            <input type="text" name="emergency_name" id="emergency_name" class="form-control">
        </div>
        <div class="form-group">
            <label>Relationship</label>
            <input type="text"  name="emergency_relationship" id="emergency_relationship" class="form-control">
        </div>
        <div class="form-group">
            <label>Phone</label>
            <input type="text" name="emergency_phone" id="emergency_phone" class="form-control">
        </div>

        <!-- Solicitud de IV -->
        <h4>WHICH INTRAVENOUS ROUTE WOULD YOU LIKE?</h4>
        <p>Nurse Valeria does an evaluation and in her professional opinion, you may not receive
            the IV that you have initially requested. </p>
        <div class="form-group">
            <select name="iv_type" class="form-control custom-select">
                <option value="">Select...</option>
                <option class="form-control optio">Custom IV</option>
                <option value="Wellness Duo">IV Wellness Duo</option>
                <option value="Energy Boost"> IV Energy Boost</option>
                <option value="Beauty Glow">IV Beauty Glow</option>
                <option value="Hangover"> IV Hangover</option>
                <option value="Immune Boost">IV Immune Boost</option>
                <option value="Immune Boost">IV Immune master Boost</option>
                <option value="Immune Boost">IV Superdetox</option>
                <option value="Immune Boost">IV Sportpower</option>
                <option value="Immune Boost">IV Post op</option>
                <option value="Immune Boost">IV NAD</option>
            </select>
        </div>

        <!-- Historial médico -->
        <h4>MEDICAL / SURGICAL HISTORY:</h4>
        <div class="form-group">
            <label>ARE YOU, OR COULD YOU BE PREGNANT?</label>
            <select name="pregnant" class="form-control">
                <option value="">Seleccione...</option>
                <option value="yes">Yes</option>
                <option value="no">No</option>
            </select>
        </div>

        <div class="form-group">
            <label for="vitamins_intolerance">¿Have you ever had and intolerance to vitamins?</label>
            <select name="vitamins_intolerance" id="vitamins_intolerance" class="form-control">
                <option value="" disabled selected>Select</option>
                <option value="yes">Yes</option>
                <option value="no">No</option>

            </select>
        </div>
        <div class="form-group">
            <label for="minerals_intolerance">¿Have you ever had and intolerance to minerals?</label>
            <select name="minerals_intolerance" id="minerals_intolerance" class="form-control">
                <option value="" disabled selected>Select</option>
                <option value="yes">Yes</option>
                <option value="no">No</option>

            </select>
        </div>


<div class="form-group">
    <h4>MANY FOOD OR DRUG ALLERGIES?</h4>
    <div class="form-group">
        <label>Food</label>
        <textarea name="allergy_food" class="form-control"></textarea>
    </div>
    <div class="form-group">
        <label for="allergy_medicine">Medicine</label>
        <select name="allergy_medicine" id="allergy_medicine" class="form-control">
            <option value="" disabled selected>Select medicine</option>
            <option value="No">NO</option>
            <option value="penicillin">Penicillin</option>
            <option value="aspirin">Aspirin</option>
            <option value="ibuprofen">Ibuprofen</option>
            <option value="morphine">Morphine</option>
            <option value="other">Other</option>
        </select>
    </div>
    <div class="form-group">
        <label>REACTION TO SAID ALLERGY:</label>
        <textarea name="reaction" id="reaction" class="form-control"></textarea>
    </div>
</div>
<div class="form-group">
    <h4>DO YOU TAKE ANY MEDICATIONS OR SUPLEMENTS? IF SO WRITE NAME, DOSE AND FREQUENCY.</h4>
    <label>Medications</label>
    <textarea name="medications" class="form-control"></textarea>
</div>
<div class="form-group">
    <label>Supplements</label>
    <textarea name="supplements" class="form-control"></textarea>
</div>

<!-- Consentimiento -->
<h4>CONSENT FORM:</h4>
<div class="form-group">
    <p>ACKNOWLEDGING THE PROCEDURES TO BE PERFORMED BY THE MEDICAL TEAM AND THAT THEY HAVE BEEN EXPLAINED TO ME, 
    I GRANT AUTHORIZATION AND RELEASE THE MEDICAL TEAM AND THE LOCATION FROM ANY AND ALL LIABILITY ONCE THE BENEFITS HAVE BEEN 
    EXPLAINED TO ME. I UNDERSTAND THE POSSIBLE COMPLICATIONS, REACTIONS, AND RESULTS, ASSUMING CONSEQUENCES OF THIS DECISION. </p>
    <label for="consent_accepted">Accept treatment</label>
    <select name="consent_accepted" id="consent_accepted" class="form-control">
        <option value="" disabled selected>Select</option>
        <option value="1">Yes</option>
        <option value="0">No</option>
    </select>
</div>

<div class="form-group">
    <label for="authorized_procedure">Authorized Procedure</label>
    <select name="authorized_procedure" id="authorized_procedure" class="form-control custom-select">
                <option value="">Select...</option>
                <option class="form-control optio">Custom IV</option>
                <option value="Wellness Duo">IV Wellness Duo</option>
                <option value="Energy Boost"> IV Energy Boost</option>
                <option value="Beauty Glow">IV Beauty Glow</option>
                <option value="Hangover"> IV Hangover</option>
                <option value="Immune Boost">IV Immune Boost</option>
                <option value="Immune Boost">IV Immune master Boost</option>
                <option value="Immune Boost">IV Superdetox</option>
                <option value="Immune Boost">IV Sportpower</option>
                <option value="Immune Boost">IV Post op</option>
                <option value="Immune Boost">IV NAD</option>
            </select>
</div>

 <!--<h4>Vital Signs</h4>
                    <div class="form-group">
                            <label for="heart_rate">heart rate (FC)</label>
                            <input type="number" name="heart_rate" id="heart_rate" class="form-control"
                                placeholder="Ej. 78">
                        </div>
                        <div class="form-group">
                            <label for="oxygen_saturation">Saturation O₂ (%)</label>
                            <input type="number" name="oxygen_saturation" id="oxygen_saturation" class="form-control"
                                placeholder="Ej. 97">
                        </div>
                        <div class="form-group">
                            <label for="temperature">Temperature (°C)</label>
                            <input type="number" step="0.1" name="temperature" id="temperature"
                                class="form-control" placeholder="Ej. 36.7">
                        </div>
                        <div class="form-group">
                            <label for="blood_pressure">Blood pressure</label>
                            <input type="text" name="blood_pressure" id="blood_pressure" class="form-control"
                                placeholder="Ej. 120/80">
                        </div>-->
                    
               

                <!-- Notas del administrador -->
                <!-- <h4>Note</h4>
                <div class="form-group">
                    <textarea name="notes" id="notes" class="form-control" rows="4"
                        placeholder="Text"></textarea>
                </div>-->

<div class="form-group">
                <!--<h4>Singature patient:</h4><br>
                <canvas id="patient-signature-pad" width="400" height="200"
                    style="border:1px solid #000;"></canvas><br>
                <input type="hidden" name="patient_signature" id="patient_signature"><br>-->
                <button type="submit" class="btn btn-primary">SAVE</button>
                
            </div> 
        
 </div>

            
</div>

</form>

</div>

<!--<script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>
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
</script>-->

