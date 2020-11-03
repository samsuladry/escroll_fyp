<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    protected $table = 'faculty';

     protected $fillable = [
     	'user_id',
        'name',
    ];

    public function student()
    {
        return $this->hasMany('App\Models\Student');
    }
}
