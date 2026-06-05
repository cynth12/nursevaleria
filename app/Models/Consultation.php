<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'registration_date',
        'name',
        'last_name',
        'date_of_birth',
        'phone',
        'email',
        'address',
        'emergency_name',
        'emergency_relationship',
        'emergency_phone',
        'pregnant',
        'vitamins_intolerance',
        'minerals_intolerance',
        'allergy_medicine',
        'allergy_food',
        'reaction',
        'medications',
        'supplements',
        'physical_exam',
        'consent_accepted',
        'digital_signature',
        'authorized_procedure',
        'heart_rate',
        'oxygen_saturation',
        'temperature',
        'blood_pressure',
        'notes',
        'iv_type',
        'symptoms',
        'reason',
        'referral_source',
        'referral_other',
    ];

    // Relación con paciente
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
    public function consentimiento()
{
    return $this->hasOne(Consentimiento::class);
}
}
