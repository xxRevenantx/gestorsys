<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Month extends Model
{
    /** @use HasFactory<\Database\Factories\MonthFactory> */
    use HasFactory;

    protected $fillable = [
        'month',
    ];

    public function colegiaturas()
    {
        return $this->hasMany(Colegiatura::class);
    }

}
