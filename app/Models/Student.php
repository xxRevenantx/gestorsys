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
        'matricula',
        'nombre',
        'apellido_paterno',
        'apellido_materno',
        'pais_nacimiento',
        'estado_nacimiento',
        'municipio_nacimiento',
        'estado_vive',
        'municipio_vive',
        'colonia',
        'calle',
        'numero',
        'CP',
        'edad',
        'fecha_nacimiento',
        'genero',
        'status',
        'turno',
        'level_id',
        'grade_id',
        'group_id',
        'generation_id',
        'tutor_id',
        'imagen',
        'sort',


    ];


    protected $casts = [
        'fecha_nacimiento' => 'datetime', // Convertir a fecha el campo fecha_nacimiento de la tabla students en la base de datos
    ];

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

    public function generation()
    {
        return $this->belongsTo(Generation::class);
    }



    public function tutor()
    {
        return $this->belongsTo(Tutor::class);
    }

}
