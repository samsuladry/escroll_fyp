<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EscrollTemplate extends Model
{
    protected $table = 'escroll_template';

    protected $fillable = [
     	'university_id',
        'description',
        'name_position',
        'bachelor_position',
        'left_signature_position',
        'right_signature_position',
        'image_template',
        'qr_position',
        'active',
    ];

    public function escrollSetup()
    {
        return $this->hasOne('App\Models\EscrollSetup');
    }

    public function scopeUniversity($query)
    {
        return $query->where('university_id', auth()->user()->university->id);
    }
}
