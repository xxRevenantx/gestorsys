<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


#[ObservedBy(\App\Observers\MateriaObserver::class)]
class Materia extends Model
{
    /** @use HasFactory<\Database\Factories\MateriaFactory> */
    use HasFactory;

    protected $fillable = ['materia', 'slug', 'clave', 'level_id', 'grade_id', 'group_id', 'teacher_id', 'campo_formativo_id', 'calificacion', 'sort'];


    public function level(){
        return $this->belongsTo(Level::class);
    }

    public function grade(){
        return $this->belongsTo(Grade::class);
    }

    public function group(){
        return $this->belongsTo(Group::class);
    }

    public function teacher(){
        return $this->belongsTo(Teacher::class);
    }

    public function campoFormativo(){
        return $this->belongsTo(CamposFormativo::class);
    }


    public function horarios()
    {
        return $this->hasMany(Horario::class);
    }

    // CALIFICACIONES
    public function calificaciones()
    {
        return $this->hasMany(Calificacion::class);
    }

}
