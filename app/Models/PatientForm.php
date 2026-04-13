<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientForm extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'dob',
        'phone',
        'email',
        'emergency_contact_name',
        'emergency_contact_phone',
        'emergency_contact_relation',
        'iv_type',
        'symptoms',
        'allergies',
        'medications',
        'supplements',
        'consent',
    ];
}
