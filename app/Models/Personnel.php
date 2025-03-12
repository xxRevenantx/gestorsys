<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
    ];

    public function teacher(){
        return $this->hasOne(Teacher::class);
    }



}
