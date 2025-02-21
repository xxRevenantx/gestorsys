<?php

namespace App\Models;

use App\Observers\TutorObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[ObservedBy(TutorObserver::class)]
class Tutor extends Model
{
    /** @use HasFactory<\Database\Factories\TutorFactory> */
    use HasFactory;

    protected $table = 'tutors'; // Define el nombre real de la tabla

    protected $fillable = [
        'CURP',
        'nombre',
        'apellido_paterno',
        'apellido_materno',
        'calle',
        'num_ext',
        'num_int',
        'localidad',
        'colonia',
        'CP',
        'municipio',
        'estado',
        'telefono',
        'celular',
        'email',
        'parentesco',
        'ocupacion',
        'sort',
    ];

    public function students()
    {
        return $this->hasMany(Student::class);
    }



}
