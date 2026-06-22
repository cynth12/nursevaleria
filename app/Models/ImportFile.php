<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImportFile extends Model
{
    protected $fillable = [
        'file_name',
        'original_name',
        'path'
    ];
}
