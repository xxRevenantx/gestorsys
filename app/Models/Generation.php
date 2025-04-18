<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[ObservedBy(\App\Observers\GenerationObserver::class)]
class Generation extends Model
{
    /** @use HasFactory<\Database\Factories\GenerationFactory> */
    use HasFactory;

    protected $fillable = [
        'anio_inicio',
        'anio_termino',
        'status',
        'level_id',
        'sort',
    ];


    public function level()
    {
        return $this->belongsTo(Level::class);
    }

    public function grades()
    {
        return $this->hasMany(Grade::class);
    }

    public function students()
    {
        return $this->hasMany(Student::class);
    }

}
