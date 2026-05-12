@extends('adminlte::page')

@section('title', 'Edit Patient')

@section('content_header')
    <h1>Edit Patient</h1>
@endsection

@section('content')
    <form action="{{ route('patient.update', $consultation->patient->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="card">
            <div class="card-body">
                <h4 class="mb-3"></h4>
                <div class="form-group">
                    <label>Name:</label>
                    <input type="text" name="name" class="form-control" value="{{ $consultation->patient->name }}" required>
                </div>
                <div class="form-group">
                    <label>Last name:</label>
                    <input type="text" name="last_name" class="form-control" value="{{ $consultation->patient->last_name }}" required>
                </div>
                <div class="form-group">
                    <label>Date of birth:</label>
                    <input type="date" name="date_of_birth" class="form-control" value="{{ $consultation->patient->date_of_birth }}"
                        required>
                </div>
                <div class="form-group">
                    <label>Phone:</label>
                    <input type="text" name="phone" class="form-control" value="{{ $consultation->patient->phone }}">
                </div>
                <div class="form-group">
                    <label>Email:</label>
                    <input type="email" name="email" class="form-control" value="{{ $consultation->patient->email }}">
                </div>

                <h4 class="mt-4">Emergency contact</h4>
                <div class="form-group">
                    <label>Name:</label>
                    <input type="text" name="emergency_name" class="form-control" value="{{ $consultation->patient->emergency_name }}">
                </div>
                <div class="form-group">
                    <label>Relation:</label>
                    <input type="text" name="emergency_relationship" class="form-control"
                        value="{{ $consultation->patient->emergency_relationship }}">
                </div>
                <div class="form-group">
                    <label>Phone:</label>
                    <input type="text" name="emergency_phone" class="form-control"
                        value="{{ $consultation->patient->emergency_phone }}">
                </div>
                <div class="form-group">
                    <label>Address:</label>
                    <input type="address" name="address" class="form-control" value="{{ $consultation->patient->address }}">
                </div>

                <h4 class="mt-4">How did you hear about us?</h4>
                <div class="form-group">
                    <label><input type="checkbox" name="referral_source[]" value="instagram"
                            {{ str_contains($consultation->patient->referral_source, 'instagram') ? 'checked' : '' }}>
                        Instagram</label><br>
                    <label><input type="checkbox" name="referral_source[]" value="facebook"
                            {{ str_contains($consultation->patient->referral_source, 'facebook') ? 'checked' : '' }}>
                        Facebook</label><br>
                    <label>Other</label>
                    <input type="text" name="referral_other" class="form-control"
                        value="{{ $consultation->patient->referral_other }}">
                </div>

                <!-- Motivo y síntomas -->
                <h4>REASON FOR VISIT:</h4>
                <div class="form-group">
                    <label>Reason</label>
                    <input type="text" name="reason" class="form-control" value="{{ $consultation->patient->reason }}">
                </div>
                <h4 class="mt-4">Symptoms</h4>
                <div class="form-group">
                    <label><input type="checkbox" name="symptoms[]" value="Dolor abdominal"
                            {{ str_contains($consultation->patient->symptoms, 'Dolor abdominal') ? 'checked' : '' }}> Abdominal
                        pains</label><br>
                    <label><input type="checkbox" name="symptoms[]" value="Fiebre"
                            {{ str_contains($consultation->patient->symptoms, 'Fiebre') ? 'checked' : '' }}> Fever</label><br>
                    <label><input type="checkbox" name="symptoms[]" value="Vómito"
                            {{ str_contains($consultation->patient->symptoms, 'Vómito') ? 'checked' : '' }}> Vomiting</label><br>
                    <label><input type="checkbox" name="symptoms[]" value="Diarrea"
                            {{ str_contains($consultation->patient->symptoms, 'Diarrea') ? 'checked' : '' }}> Diarrhea</label><br>
                    <label><input type="checkbox" name="symptoms[]" value="Ninguno"
                            {{ str_contains($consultation->patient->symptoms, 'Ninguno') ? 'checked' : '' }}> None of the above</label>
                </div>


                <!-- Solicitud de IV -->
                <h4>WHICH IV WOULD YOU LIKE TO REQUEST?</h4>
                <p>Nurse Valeria does an evaluation and in her professional opinion, you may not receive
                    the IV that you have initially requested. </p>
                <div class="form-group">
                    <select name="iv_type" class="form-control custom-select">
                        <option value="">Select...</option>
                        <option value="Custom IV" {{ $consultation->patient->iv_type == 'Custom IV' ? 'selected' : '' }}>Custom IV
                        </option>
                        <option value="Wellness Duo" {{ $consultation->patient->iv_type == 'Wellness Duo' ? 'selected' : '' }}>IV
                            Wellness Duo</option>
                        <option value="Energy Boost" {{ $consultation->patient->iv_type == 'Energy Boost' ? 'selected' : '' }}>IV Energy
                            Boost</option>
                        <option value="Beauty Glow" {{ $consultation->patient->iv_type == 'Beauty Glow' ? 'selected' : '' }}>IV Beauty
                            Glow</option>
                        <option value="Hangover" {{ $consultation->patient->iv_type == 'Hangover' ? 'selected' : '' }}>IV Hangover
                        </option>
                        <option value="Immune Boost" {{ $consultation->patient->iv_type == 'Immune Boost' ? 'selected' : '' }}>IV Immune
                            Boost</option>
                        <option value="Immune master Boost"
                            {{ $consultation->patient->iv_type == 'Immune master Boost' ? 'selected' : '' }}>IV Immune master Boost
                        </option>
                        <option value="Superdetox" {{ $consultation->patient->iv_type == 'Superdetox' ? 'selected' : '' }}>IV Superdetox
                        </option>
                        <option value="Sportpower" {{ $consultation->patient->iv_type == 'Sportpower' ? 'selected' : '' }}>IV Sportpower
                        </option>
                        <option value="Post op" {{ $consultation->patient->iv_type == 'Post op' ? 'selected' : '' }}>IV Post op</option>
                        <option value="NAD" {{ $consultation->patient->iv_type == 'NAD' ? 'selected' : '' }}>IV NAD</option>
                    </select>
                </div>



                <h4 class="mt-4 text-nurseblue">Medical History</h4>
                <div class="form-group">
                    <label>Are you, or could you be pregnant? </label>
                    <select name="pregnant" class="form-control">
                        <option value="1" {{ $consultation->patient->pregnant ? 'selected' : '' }}>yes</option>
                        <option value="0" {{ !$consultation->patient->pregnant ? 'selected' : '' }}>no</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Have you ever had an intolerance to vitamins?</label>
                    <select name="vitamins_intolerance" class="form-control">
                        <option value="1" {{ $consultation->patient->vitamins_intolerance ? 'selected' : '' }}>yes</option>
                        <option value="0" {{ !$consultation->patient->vitamins_intolerance ? 'selected' : '' }}>no</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Have you ever had an intolerance to minerals?</label>
                    <select name="minerals_intolerance" class="form-control">
                        <option value="1" {{ $consultation->patient->minerals_intolerance ? 'selected' : '' }}>yes</option>
                        <option value="0" {{ !$consultation->patient->minerals_intolerance ? 'selected' : '' }}>no</option>
                    </select>
                </div>

                <h4 class="mt-4">Allergies</h4>
                <div class="form-group">
                    <label>Medications:</label>
                    <input type="text" name="allergy_medicine" class="form-control"
                        value="{{ $consultation->patient->allergy_medicine }}">
                </div>
                <div class="form-group">
                    <label>Food:</label>
                    <input type="text" name="allergy_food" class="form-control"
                        value="{{ $consultation->patient->allergy_food }}">
                </div>
                <div class="form-group">
                    <label>Reaction:</label>
                    <input type="text" name="reaction" class="form-control" value="{{ $consultation->patient->reaction }}">
                </div>

                <h4 class="mt-4">Medications:</h4>
                <textarea name="medications" class="form-control">{{ $consultation->patient->medications }}</textarea>

                <h4 class="mt-4">Supplements</h4>
                <textarea name="supplements" class="form-control">{{ $consultation->patient->supplements }}</textarea>

                <!--<h4 class="mt-4">Examen físico</h4>
                <textarea name="physical_exam" class="form-control">{{ $consultation->patient->physical_exam }}</textarea>--->

                <h4 class="mt-4">Informed Consent</h4>
                <div class="form-group">
                    <label>Accepted:</label>
                    <select name="consent_accepted" class="form-control">
                        <option value="1" {{ $consultation->patient->consent_accepted ? 'selected' : '' }}>Yes</option>
                        <option value="0" {{ !$consultation->patient->consent_accepted ? 'selected' : '' }}>No</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Signature:</label>
                    <input type="text" name="digital_signature" class="form-control"
                        value="{{ $consultation->patient->digital_signature }}">
                </div>
                <div class="form-group">
                    <label>Authorized Procedure:</label>
                    <input type="text" name="authorized_procedure" class="form-control"
                        value="{{ $consultation->patient->authorized_procedure }}">
                </div>

                <h4 class="mt-4">Vital sings</h4>
                <div class="row">
                    <div class="col-md-3">
                        <label>Heart Rate:</label>
                        <input type="number" name="heart_rate" class="form-control"
                            value="{{ $consultation->patient->heart_rate }}">
                    </div>
                    <div class="col-md-3">
                        <label>O₂ Saturation (%):</label>
                        <input type="number" name="oxigen_saturation" class="form-control"
                            value="{{ $consultation->patient->oxygen_saturation }}">
                    </div>
                    <div class="col-md-3">
                        <label>Temperature (°C):</label>
                        <input type="number" step="0.1" name="temperature" class="form-control"
                            value="{{ $consultation->patient->temperature }}">
                    </div>
                    <div class="col-md-3">
                        <label>Blood Pressure:</label>
                        <input type="text" name="blood_pressure" class="form-control"
                            value="{{ $consultation->patient->blood_pressure }}">
                    </div>
                </div>

                <h4 class="mt-4">Notes</h4>
                <textarea name="notes" class="form-control">{{ $consultation->notes }}</textarea>

                <h4 class="mt-4">Registration Date</h4>
                <p>{{ $consultation->patient->registration_date }}</p>
            </div>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Add patient to group</button>

        <button type="submit" class="btn btn-primary mt-3">Save changes</button>
        <a href="{{ route('consultas.index', $consultation->patient->id) }}" class="btn btn-secondary mt-3">⬅️ Return to list</a>

    </form>
@endsection
