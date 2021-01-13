<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PreImport extends Model
{
    protected $fillable = [
        'matric_no', 'name', 'faculty', 'programme', 'serial_no', 'citizenship', 'date_endorse', 'university_id', 'is_import', 'batch', 'academic_levels_id'
    ];
}
