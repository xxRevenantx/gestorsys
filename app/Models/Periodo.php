<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Periodo extends Model
{
    /** @use HasFactory<\Database\Factories\PeriodoFactory> */
    use HasFactory;

    protected $fillable = ['num_periodo', 'fechas'];

    public function calificaciones()
    {
        return $this->hasMany(Calificacion::class);
    }
}
