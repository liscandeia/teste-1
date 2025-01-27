<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    /** @use HasFactory<\Database\Factories\StudantFactory> */
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'date_birth',
        "password"
    ];

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }
    public function getAgeAttribute()
    {
        return Carbon::parse($this->attributes['date_birth'])->age;
    }

}
