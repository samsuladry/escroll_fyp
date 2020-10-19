<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bachelor extends Model
{
    protected $table = 'bachelor';

     protected $fillable = [
     	'department_id',
        'title',
    ];
}

