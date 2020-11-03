<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dean extends Model
{

    use SoftDeletes;
    protected $table = 'dean';

     protected $fillable = [
     	'faculty_id',
        'name',
        'signature',
        'active',
    ];
}
