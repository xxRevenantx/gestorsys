<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[ObservedBy(\App\Observers\PersonnelObserver::class)]

class Personnel extends Model
{
    /** @use HasFactory<\Database\Factories\PersonnelFactory> */
    use HasFactory;

    protected $fillable = [
        'titulo',
        'nombre',
        'apellido_paterno',
        'apellido_materno',
        'CURP',
        'RFC',
        'email',
        'telefono',
        'direccion',
        'perfil',
        'genero',
        'foto',
        'sort',
    ];

    public function teacher(){
        return $this->hasOne(Teacher::class);
    }





}
