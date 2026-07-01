<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Treatment extends Model
{
    protected $fillable = [

        'name',
        'description',
        'formula',

    ];

    public function consultations()
    {
        return $this->hasMany(Consultation::class);
    }
}
