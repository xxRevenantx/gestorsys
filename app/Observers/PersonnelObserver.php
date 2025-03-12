<?php

namespace App\Observers;

use App\Models\Personnel;

class PersonnelObserver
{
    public function creating(Personnel $personnel): void
    {
        $personnel->sort = Personnel::max('sort') + 1;
    }


    public function deleted(Personnel $personnel)
    {
        // Actualizar los niveles
        Personnel::where('sort', '>', $personnel->sort)
            ->decrement('sort');

    }
}
