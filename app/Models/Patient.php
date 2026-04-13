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
        'physical_exam',
        'notes',
        'iv_type',      // 👈 nuevo campo
        'symptoms',  
        'reason',
        // Consentimiento
        'consent_accepted',
        'digital_signature',
        'consent_date',
        'authorized_procedure',

        // Signos vitales
        'heart_rate',
        'oxygen_saturation',
        'temperature',
        'blood_pressure',

        // Auditoría
        'registered_by',
        'updated_by',
        'registration_date',
    ];
}
