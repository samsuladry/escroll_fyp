<?php

namespace App\Models;

use App\Scopes\DeleteScope;
use App\Scopes\UniversityScope;
use Illuminate\Database\Eloquent\Model;

class AcademicLevel extends Model
{
    protected $fillable = [
        'name', 'university_id', 'is_delete'
    ];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new UniversityScope);
        static::addGlobalScope(new DeleteScope);
    }
}
