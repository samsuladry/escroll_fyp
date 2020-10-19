<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EscrollTemplate extends Model
{
    protected $table = 'escroll_template';

     protected $fillable = [
     	'user_id',
        'description',
        'image_template',
        'pdf_template',
    ];
}
