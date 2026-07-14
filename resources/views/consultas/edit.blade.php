@extends('adminlte::page')

@section('title', 'Edit Patient')

@section('content_header')
    <h1>Edit Patient</h1>
@endsection

@section('content')
    <form action="{{ route('consultas.update', $consultation->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="card">
            <div class="card-body">
                <h4 class="mb-3"></h4>
                <div class="form-group">
                    <label>Name:</label>
                    <input type="text" name="name" class="form-control" value="{{ $consultation->name }}" required>
                </div>
                <div class="form-group">
                    <label>Last name:</label>
                    <input type="text" name="last_name" class="form-control" value="{{ $consultation->last_name }}"
                        required>
                </div>
                <div class="form-group">
                    <label>Date of birth:</label>
                    <input type="date" name="date_of_birth" class="form-control"
                        value="{{ $consultation->date_of_birth }}" required>
                </div>
                <div class="form-group">
                    <label>Phone:</label>
                    <input type="text" name="phone" class="form-control" value="{{ $consultation->phone }}">
                </div>
                <div class="form-group">
                    <label>Email:</label>
                    <input type="email" name="email" class="form-control" value="{{ $consultation->email }}">
                </div>

                <h4 class="mt-4">Emergency contact</h4>
                <div class="form-group">
                    <label>Name:</label>
                    <input type="text" name="emergency_name" class="form-control"
                        value="{{ $consultation->emergency_name }}">
                </div>
                <div class="form-group">
                    <label>Relation:</label>
                    <input type="text" name="emergency_relationship" class="form-control"
                        value="{{ $consultation->emergency_relationship }}">
                </div>
                <div class="form-group">
                    <label>Phone:</label>
                    <input type="text" name="emergency_phone" class="form-control"
                        value="{{ $consultation->emergency_phone }}">
                </div>
                <div class="form-group">
                    <label>Address:</label>
                    <input type="address" name="address" class="form-control" value="{{ $consultation->address }}">
                </div>

                <h4 class="mt-4">How did you hear about us?</h4>
                <div class="form-group">
                    <label><input type="checkbox" name="referral_source[]" value="instagram"
                            {{ str_contains($consultation->referral_source, 'instagram') ? 'checked' : '' }}>
                        Instagram</label><br>
                    <label><input type="checkbox" name="referral_source[]" value="facebook"
                            {{ str_contains($consultation->referral_source, 'facebook') ? 'checked' : '' }}>
                        Facebook</label><br>
                    <label>Other</label>
                    <input type="text" name="referral_other" class="form-control"
                        value="{{ $consultation->referral_other }}">
                </div>

                <!-- Motivo y síntomas -->
                <h4>REASON FOR VISIT:</h4>
                <div class="form-group">
                    <label>Reason</label>
                    <input type="text" name="reason" class="form-control" value="{{ $consultation->reason }}">
                </div>
                <h4 class="mt-4">Symptoms</h4>
                <div class="form-group">
                    <label><input type="checkbox" name="symptoms[]" value="Dolor abdominal"
                            {{ str_contains($consultation->symptoms, 'Dolor abdominal') ? 'checked' : '' }}> Abdominal
                        pains</label><br>
                    <label><input type="checkbox" name="symptoms[]" value="Fiebre"
                            {{ str_contains($consultation->symptoms, 'Fiebre') ? 'checked' : '' }}> Fever</label><br>
                    <label><input type="checkbox" name="symptoms[]" value="Vómito"
                            {{ str_contains($consultation->symptoms, 'Vómito') ? 'checked' : '' }}> Vomiting</label><br>
                    <label><input type="checkbox" name="symptoms[]" value="Diarrea"
                            {{ str_contains($consultation->symptoms, 'Diarrea') ? 'checked' : '' }}> Diarrhea</label><br>
                    <label><input type="checkbox" name="symptoms[]" value="Ninguno"
                            {{ str_contains($consultation->symptoms, 'Ninguno') ? 'checked' : '' }}> None of the
                        above</label>
                </div>


                <!-- Solicitud de IV -->
                <h4>WHICH IV WOULD YOU LIKE TO REQUEST?</h4>
                <p>Nurse Valeria does an evaluation and in her professional opinion, you may not receive
                    the IV that you have initially requested. </p>
                <div class="form-group">
                    <select name="iv_type" class="form-control custom-select">
                        <option value="">Select...</option>
                        <option value="Custom IV" {{ $consultation->iv_type == 'Custom IV' ? 'selected' : '' }}>Custom IV
                        </option>
                        <option value="Wellness Duo" {{ $consultation->iv_type == 'Wellness Duo' ? 'selected' : '' }}>IV
                            Wellness Duo</option>
                        <option value="Energy Boost" {{ $consultation->iv_type == 'Energy Boost' ? 'selected' : '' }}>IV
                            Energy
                            Boost</option>
                        <option value="Beauty Glow" {{ $consultation->iv_type == 'Beauty Glow' ? 'selected' : '' }}>IV
                            Beauty
                            Glow</option>
                        <option value="Hangover" {{ $consultation->iv_type == 'Hangover' ? 'selected' : '' }}>IV Hangover
                        </option>
                        <option value="Immune Boost" {{ $consultation->iv_type == 'Immune Boost' ? 'selected' : '' }}>IV
                            Immune
                            Boost</option>
                        <option value="Immune master Boost"
                            {{ $consultation->iv_type == 'Immune master Boost' ? 'selected' : '' }}>IV Immune master Boost
                        </option>
                        <option value="Superdetox" {{ $consultation->iv_type == 'Superdetox' ? 'selected' : '' }}>IV
                            Superdetox
                        </option>
                        <option value="Sportpower" {{ $consultation->iv_type == 'Sportpower' ? 'selected' : '' }}>IV
                            Sportpower
                        </option>
                        <option value="Post op" {{ $consultation->iv_type == 'Post op' ? 'selected' : '' }}>IV Post op
                        </option>
                        <option value="NAD" {{ $consultation->iv_type == 'NAD' ? 'selected' : '' }}>IV NAD</option>
                    </select>
                </div>



                <h4 class="mt-4 text-nurseblue">Medical History</h4>
                <div class="form-group">
                    <label>Are you, or could you be pregnant? </label>
                    <select name="pregnant" class="form-control">
                        <option value="1" {{ $consultation->pregnant ? 'selected' : '' }}>yes</option>
                        <option value="0" {{ !$consultation->pregnant ? 'selected' : '' }}>no</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Have you ever had an intolerance to vitamins?</label>
                    <select name="vitamins_intolerance" class="form-control">
                        <option value="1" {{ $consultation->vitamins_intolerance ? 'selected' : '' }}>yes</option>
                        <option value="0" {{ !$consultation->vitamins_intolerance ? 'selected' : '' }}>no</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Have you ever had an intolerance to minerals?</label>
                    <select name="minerals_intolerance" class="form-control">
                        <option value="1" {{ $consultation->minerals_intolerance ? 'selected' : '' }}>yes</option>
                        <option value="0" {{ !$consultation->minerals_intolerance ? 'selected' : '' }}>no</option>
                    </select>
                </div>

                <h4 class="mt-4">Allergies</h4>
                <div class="form-group">
                    <label>Medications:</label>
                    <input type="text" name="allergy_medicine" class="form-control"
                        value="{{ $consultation->allergy_medicine }}">
                </div>
                <div class="form-group">
                    <label>Food:</label>
                    <input type="text" name="allergy_food" class="form-control"
                        value="{{ $consultation->allergy_food }}">
                </div>
                <div class="form-group">
                    <label>Reaction:</label>
                    <input type="text" name="reaction" class="form-control" value="{{ $consultation->reaction }}">
                </div>

                <h4 class="mt-4">Medications:</h4>
                <textarea name="medications" class="form-control">{{ $consultation->medications }}</textarea>

                <h4 class="mt-4">Supplements</h4>
                <textarea name="supplements" class="form-control">{{ $consultation->supplements }}</textarea>

                <!--<h4 class="mt-4">Examen físico</h4>
                                                                <textarea name="physical_exam" class="form-control">{{ $consultation->physical_exam }}</textarea>--->

                <h4 class="mt-4">Informed Consent</h4>
                <div class="form-group">
                    <label>Accepted:</label>
                    <select name="consent_accepted" class="form-control">
                        <option value="1" {{ $consultation->consent_accepted ? 'selected' : '' }}>Yes</option>
                        <option value="0" {{ !$consultation->consent_accepted ? 'selected' : '' }}>No</option>
                    </select>
                </div>
                <!-- <div class="form-group">
                        <label>Signature:</label>
                        <input type="text" name="digital_signature" class="form-control"
                            value="{{ $consultation->digital_signature }}">
                    </div>-->
                <div class="form-group">
                    <label>Authorized Procedure:</label>
                    <input type="text" name="authorized_procedure" class="form-control"
                        value="{{ $consultation->authorized_procedure }}">
                </div>

                <h4 class="mt-4">Vital signs pre</h4>
                <div class="row">
                    <div class="col-md-3">
                        <label>Heart Rate:</label>
                        <input type="number" name="pre_heart_rate" class="form-control"
                            value="{{ $consultation->pre_heart_rate }}">
                    </div>

                    <div class="col-md-3">
                        <label>O₂ Saturation (%):</label>
                        <input type="number" name="pre_oxygen_saturation" class="form-control"
                            value="{{ $consultation->pre_oxygen_saturation }}">
                    </div>

                    <div class="col-md-3">
                        <label>Temperature (°C):</label>
                        <input type="number" step="0.1" name="pre_temperature" class="form-control"
                            value="{{ $consultation->pre_temperature }}">
                    </div>

                    <div class="col-md-3">
                        <label>Blood Pressure:</label>
                        <input type="text" name="pre_blood_pressure" class="form-control"
                            value="{{ $consultation->pre_blood_pressure }}">
                    </div>
                </div>

                <h4 class="mt-4">Vital signs post</h4>
                <div class="row">
                    <div class="col-md-3">
                        <label>Heart Rate:</label>
                        <input type="number" name="heart_rate" class="form-control"
                            value="{{ $consultation->heart_rate }}">
                    </div>
                    <div class="col-md-3">
                        <label>O₂ Saturation (%):</label>
                        <input type="number" name="oxygen_saturation" class="form-control"
                            value="{{ $consultation->oxygen_saturation }}">
                    </div>
                    <div class="col-md-3">
                        <label>Temperature (°C):</label>
                        <input type="number" step="0.1" name="temperature" class="form-control"
                            value="{{ $consultation->temperature }}">
                    </div>
                    <div class="col-md-3">
                        <label>Blood Pressure:</label>
                        <input type="text" name="blood_pressure" class="form-control"
                            value="{{ $consultation->blood_pressure }}">
                    </div>
                </div>

                <label>Treatment</label>

                <select id="treatment_id" name="treatment_id" class="form-control">

                    <option value="">Select...</option>

                    @foreach ($treatments as $treatment)
                        <option value="{{ $treatment->id }}" data-description="{{ $treatment->description }}"
                            data-formula="{{ $treatment->formula }}"
                            {{ $consultation->treatment_id == $treatment->id ? 'selected' : '' }}>

                            {{ $treatment->name }}

                        </option>
                    @endforeach

                </select>

                <br>

                <label>Description</label>

                <textarea name="treatment_description" id="treatment_description" class="form-control" rows="4">{{ old('treatment_description', $consultation->treatment_description) }}</textarea>

                <br>

                <label>Treatment</label>

                <textarea name="treatment_formula" id="treatment_formula" class="form-control" rows="8">{{ old('treatment_formula', $consultation->treatment_formula) }}</textarea>

                <label>Notes</label>

                <textarea name="notes" id="notes" class="form-control" rows="8">{{ old('notes', $consultation->notes) }}</textarea>
                <div class="form-group">
                    <label>Registration Date</label>

                    <input type="datetime-local" name="registration_date" class="form-control"
                        value="{{ \Carbon\Carbon::parse($consultation->registration_date)->format('Y-m-d\TH:i') }}">
                </div>
            </div>
        </div>


        <div class="form-group mt-4">

            <label>Group</label>

            <select name="group_id" class="form-control">

                <option value="">No group</option>

                @foreach ($groups as $group)
                    <option value="{{ $group->id }}" {{ $patient->group_id == $group->id ? 'selected' : '' }}>

                        {{ $group->place }}

                    </option>
                @endforeach

            </select>

        </div>

        <button type="submit" class="btn btn-primary mt-3">Save changes</button>
        
        <a href="{{ route('consultas.index', $consultation->patient_id) }}" class="btn btn-secondary mt-3">⬅️ Return to
            list</a>
        @if ($consultation->patient->group)
            <a href="{{ route('grupos.show', $consultation->patient->group->id) }}" class="btn btn-secondary">
                Return to Group
            </a>
        @endif

    </form>


    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const select = document.getElementById('treatment_id');

            const description = document.getElementById('treatment_description');

            const formula = document.getElementById('treatment_formula');

            function cargar() {

                let option = select.options[select.selectedIndex];

                if (select.value == "") return;

                if (description.value == "")
                    description.value = option.dataset.description;

                if (formula.value == "")
                    formula.value = option.dataset.formula;

            }

            select.addEventListener('change', cargar);

            cargar();

        });
    </script>
@endsection
