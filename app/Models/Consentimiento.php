<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Consultation;

class Consentimiento extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'consultation_id',
        'consent_accepted',
        'digital_signature',
        'consent_date',
        'authorized_procedure',
        'nurse_name',
        'nurse_id',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
    public function consultation()
{
    return $this->belongsTo(Consultation::class);
}
}
