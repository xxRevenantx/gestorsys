<?php

namespace App\Observers;

use App\Models\Tutor;

class TutorObserver
{
    public function creating(Tutor $tutor): void
    {
        $tutor->sort = Tutor::max('sort') + 1;
    }


    public function deleted(Tutor $tutor)
    {
        // Actualizar los tutores
        Tutor::where('sort', '>', $tutor->sort)
            ->decrement('sort');

    }
}
