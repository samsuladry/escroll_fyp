<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    //

    protected $table = 'students';

     protected $fillable = [
        'uuid',
        'matric_number',
        'name',
        // 'field',
        'university_id',
        'rector_id',
        'faculty_id',
        'dean_id',
        'department_id',
        'template_id',
        'qr_code_path',
    ];

    public function graduate_field()
    {
        return $this->belongsTo('App\Models\Bachelor', 'field', 'id');
    }

    public function department()
    {
        return $this->belongsTo('App\Models\Department');
    }
    public function university()
    {
        return $this->belongsTo('App\Models\University');
    }

    public function faculty()
    {
        return $this->belongsTo('App\Models\Faculty');
    }

    public function rector()
    {
        return $this->belongsTo('App\Models\Rector');
    }
}

           