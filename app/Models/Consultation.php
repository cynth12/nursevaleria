<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    use HasFactory;

    // Campos que se pueden asignar masivamente
    protected $fillable = [
        'patient_id',
        'registration_date',
    ];

    // Relación: cada consulta pertenece a un paciente
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}

