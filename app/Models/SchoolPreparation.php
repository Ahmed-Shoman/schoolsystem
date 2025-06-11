<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SchoolPreparation extends Model
{
    protected $fillable = ['data'];

    protected $casts = [
        'data' => 'array',
    ];
}
