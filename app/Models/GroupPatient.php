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

    // Historial médico
    'pregnant',
    'vitamins_intolerance',
    'minerals_intolerance',
    'allergy_medicine',
    'allergy_food',
    'reaction',

    // Medicamentos y suplementos
    'medications',
    'supplements',

    // Contacto de emergencia
    'emergency_contact_name',
    'emergency_contact_phone',

    // Signos vitales
    'heart_rate',
    'oxygen_saturation',
    'temperature',
    'blood_pressure',

    // Notas
    'notes',

    // Consentimiento
    'consent_accepted',
    'digital_signature',
    'consent_date',
    'authorized_procedure',
    'nurse_name',
    'nurse_id',
];


    // Relación: cada paciente pertenece a un grupo
    public function group()
    {
        return $this->belongsTo(Group::class);
    }
}
