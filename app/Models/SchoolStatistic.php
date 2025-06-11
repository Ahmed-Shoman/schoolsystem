<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SchoolStatistic extends Model
{
protected $fillable = [
'stage_name',
'stage_year',
'schools_count',
'total_students',
'total_boys',
'total_girls',
'total_classrooms',
];
}