<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $table = 'patients';

    protected $fillable = [
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
        'notes',
        'registration_date',
        'iv_type',
        'symptoms',
        'reason',
        'referral_source',
        'referral_other',
        'consent_accepted',
        'digital_signature',
        'authorized_procedure',
        'heart_rate',
        'oxygen_saturation',
        'temperature',
        'blood_pressure',
    ];
}
