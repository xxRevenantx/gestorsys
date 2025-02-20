<?php

namespace App\Observers;

use App\Models\Grade;

class GradeObserver
{
    public function creating(Grade $grade): void
    {
        $grade->sort = Grade::max('sort') + 1;
    }


    public function deleted(Grade $grade)
    {
        // Actualizar los niveles
        Grade::where('sort', '>', $grade->sort)
            ->decrement('sort');

    }

}
