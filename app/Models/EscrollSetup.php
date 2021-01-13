<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EscrollSetup extends Model
{
    protected $fillable = [
        'name', 'bachelor', 'left_signature', 'right_signature', 'qr', 'serial_no', 'date_endorse', 'other_variable', 'escroll_template_id'
    ];

    public function escrollTemplate(){
        return $this->belongsTo('App\Models\EscrollTemplate');
    }
}
