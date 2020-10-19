<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rector extends Model
{
     protected $table = 'university_rector';

     protected $fillable = [
        'user_id',
        'name',
        'signature',
    ];
}
