<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $fillable = ['place','date'];

    // Relación: un grupo tiene muchos pacientes
    public function patients()
    {
        return $this->hasMany(GroupPatient::class);
    }
}

