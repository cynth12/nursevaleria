<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
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
        'physical_exam', // aunque no lo uses, lo dejamos para que no dé error

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

        'referral_source', // 👈 nuevo campo
        'referral_other',  // 👈 nuevo campo

        'registration_date',
        'registered_by',
        'updated_by',
    ];
}
