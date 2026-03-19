<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consentimiento extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
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
}
