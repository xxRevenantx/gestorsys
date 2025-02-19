<?php

namespace App\Observers;

use App\Models\Generation;

class GenerationObserver
{
    public function creating(Generation $generation): void
    {
        $generation->sort = Generation::max('sort') + 1;
    }


    public function deleted(Generation $generation)
    {
        // Actualizar los niveles
        Generation::where('sort', '>', $generation->sort)
            ->decrement('sort');

    }
}
