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
    ];
}
