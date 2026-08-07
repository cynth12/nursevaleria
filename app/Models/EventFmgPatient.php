<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventFmgPatient extends Model
{
    use HasFactory;

    protected $table = 'event_fmg_patients';

    protected $fillable = [

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

        'reason',
        'symptoms',

        'referral_source',
        'referral_other',

        'iv_type',
    ];

    protected $casts = [

        'registration_date' => 'datetime',

        'date_of_birth' => 'date',

        'pregnant' => 'boolean',
        'vitamins_intolerance' => 'boolean',
        'minerals_intolerance' => 'boolean',

    ];
}