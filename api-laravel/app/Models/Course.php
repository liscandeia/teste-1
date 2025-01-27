<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    /** @use HasFactory<\Database\Factories\CourseFactory> */
    use HasFactory;
    protected $fillable = [
        'title',
        'body',
        'date_start',
        'date_end'

    ];
    public function discipline()
    {
        return $this->hasMany(Discipline::class);
    }
}
