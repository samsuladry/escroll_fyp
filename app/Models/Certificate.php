<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
     protected $table = 'certificate_info';

     protected $fillable = [
        'user_id',
        'name',
        'location',
        'reason',
        'contact_info',
        'certificate',
    ];
}
