<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class University extends Model
{
    protected $fillable = [
        'name', 'blockchainAddress', 'acronym', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function student()
    {
        return $this->hasMany('App\Models\Student');
    }
}
