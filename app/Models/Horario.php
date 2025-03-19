<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    /** @use HasFactory<\Database\Factories\HorarioFactory> */
    use HasFactory;

    protected $fillable = ['hora', 'lunes', 'martes', 'miercoles', 'jueves', 'viernes'];


    // Relación con Materia para cada día de la semana
    public function lunesMateria()
    {
        return $this->belongsTo(Materia::class, 'lunes');
    }

    public function martesMateria()
    {
        return $this->belongsTo(Materia::class, 'martes');
    }

    public function miercolesMateria()
    {
        return $this->belongsTo(Materia::class, 'miercoles');
    }

    public function juevesMateria()
    {
        return $this->belongsTo(Materia::class, 'jueves');
    }

    public function viernesMateria()
    {
        return $this->belongsTo(Materia::class, 'viernes');
    }

}
