<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OfficialLanguageSchoolStudent extends Model
{
    protected $fillable = ['school_name', 'stage_data'];

    protected $casts = [
        'stage_data' => 'array',
    ];
}