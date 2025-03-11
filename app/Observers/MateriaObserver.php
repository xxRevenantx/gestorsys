<?php

namespace App\Observers;

use App\Models\Materia;

class MateriaObserver
{
    public function creating(Materia $materia): void
    {
        $materia->sort = Materia::max('sort') + 1;
    }


    public function deleted(Materia $materia)
    {
        // Actualizar los niveles
        materia::where('sort', '>', $materia->sort)
            ->decrement('sort');

    }
}
