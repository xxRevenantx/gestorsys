<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CamposFormativo extends Model
{
    /** @use HasFactory<\Database\Factories\CamposFormativoFactory> */
    use HasFactory;

    protected $fillable = ['nombre', 'slug', 'descripcion'];


    public function materias(){
        return $this->hasMany(Materia::class);
    }

}
