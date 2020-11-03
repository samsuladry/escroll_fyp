<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rector extends Model
{
    use SoftDeletes;
    
     protected $fillable = [
        'user_id',
        'name',
        'signature',
        'university_id',
        'active',
    ];

    public function student()
    {
        return $this->hasMany('App\Models\Student');
    }
}
