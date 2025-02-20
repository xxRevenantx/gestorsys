<?php

namespace App\Models;

use App\Observers\StudentObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[ObservedBy(StudentObserver::class)]
class Student extends Model
{
    /** @use HasFactory<\Database\Factories\StudentFactory> */
    use HasFactory;

    protected $fillable = [
        'CURP',
        'nombre',
        'apellido_paterno',
        'apellido_materno',
        'edad',
        'fecha_nacimiento',
        'sexo',
        'status',
        'level_id',
        'grade_id',
        'group_id',
        'generation_id',
        'tutor_id',
        'sort',


    ];

}
