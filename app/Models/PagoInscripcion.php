<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


#[ObservedBy(\App\Observers\PagoInscripcionObserver::class)]
class PagoInscripcion extends Model
{
    /** @use HasFactory<\Database\Factories\PagoInscripcionFactory> */
    use HasFactory;

    protected $fillable = [
        'nombre_pago',
        'student_id',
        'level_id',
        'monto',
        'descuento',
        'total',
        'tipo_pago',
        'comprobante',
        'folio',
        'observaciones',
        'fecha_pago',
    ];

    // protected $casts = [
    //     'fecha_pago' => 'date',
    // ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

}
