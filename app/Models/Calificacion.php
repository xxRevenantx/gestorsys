<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calificacion extends Model
{
    /** @use HasFactory<\Database\Factories\CalificacionFactory> */
    use HasFactory;

    protected $fillable = [
        'student_id',
        'level_id',
        'grade_id',
        'group_id',
        'materia_id',
        'periodo_id',
        'calificacion',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function level()
    {
        return $this->belongsTo(Level::class);
    }

    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function materia()
    {
        return $this->belongsTo(Materia::class);
    }

    public function periodo()
    {
        return $this->belongsTo(Periodo::class);
    }

}
