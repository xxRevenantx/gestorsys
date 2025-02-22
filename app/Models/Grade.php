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

    protected $fillable = ['grado', 'grado_numero', 'level_id', 'generation_id', 'group_id', 'sort'];

    public function level()
    {
        return $this->belongsTo(Level::class);
    }

    public function generation()
    {
        return $this->belongsTo(Generation::class);
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function students()
    {
        return $this->hasMany(Student::class);
    }


}
