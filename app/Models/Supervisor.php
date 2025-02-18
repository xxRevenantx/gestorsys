<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supervisor extends Model
{
    /** @use HasFactory<\Database\Factories\SupervisorFactory> */
    use HasFactory;

    protected $fillable = ['nombre', 'apellido_paterno', 'apellido_materno', 'email', 'telefono', 'zona', 'sector'];


    public function levels()
    {
        return $this->hasMany(Level::class);
    }


}
