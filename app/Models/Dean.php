<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dean extends Model
{
    protected $table = 'dean';

     protected $fillable = [
     	'faculty_id',
        'name',
        'signature',
    ];
}
