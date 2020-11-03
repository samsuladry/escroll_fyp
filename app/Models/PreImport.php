<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PreImport extends Model
{
    protected $fillable = [
        'matric_no', 'name', 'faculty', 'programme', 'serial_no', 'citizenship', 'date_endorse', 'user_id', 'is_import'
    ];
}
