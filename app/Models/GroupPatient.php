<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupPatient extends Model
{
    use HasFactory;

    protected $fillable = [
        'group_id',
        'name',
        'date_of_birth',
        'phone',
        'email',
        'address',
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
    ];

    // Relación: cada paciente pertenece a un grupo
    public function group()
    {
        return $this->belongsTo(Group::class);
    }
}
