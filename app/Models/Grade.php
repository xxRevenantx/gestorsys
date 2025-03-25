<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


#[ObservedBy(\App\Observers\GradeObserver::class)]
class Grade extends Model
{
    /** @use HasFactory<\Database\Factories\GradeFactory> */
    use HasFactory;

    protected $fillable = ['grado', 'level_id', 'generation_id', 'sort'];

    public function level()
    {
        return $this->belongsTo(Level::class);
    }

    public function generation()
    {
        return $this->belongsTo(Generation::class);
    }

    public function groups()
    {
        return $this->hasMany(Group::class);
    }

    public function students()
    {
        return $this->hasMany(Student::class);
    }

    public function getRouteKeyName()
    {
        return 'grado';
    }

    public function teachers()
    {
        return $this->hasMany(Teacher::class);
    }



    // HORARIO
    public function horarios()
    {
        return $this->hasMany(Horario::class);
    }
}
