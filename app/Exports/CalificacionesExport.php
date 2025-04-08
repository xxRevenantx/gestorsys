<?php

namespace App\Exports;

use App\Models\Calificacion;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class CalificacionesExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {

        return view('exports.exportCalificaciones', [
            'calificaciones' => Calificacion::with('student')->get(),
        ]);

    }
}
