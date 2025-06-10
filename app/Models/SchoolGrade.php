<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SchoolGrade extends Model
{
    protected $fillable = [
        'school_name',
        'education_level',
        'dependency',
        'grades',

    ];

    protected $casts = [

        'grades'=>'array',
    ];
}
//////
