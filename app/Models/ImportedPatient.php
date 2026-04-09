<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImportedPatient extends Model
{
   

    protected $table = 'imported_patients';

    protected $fillable = [
        'name',
        'phone',
        'email',
        'date',
    ];
}
