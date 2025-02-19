<?php

namespace App\Observers;

use App\Models\Level;


class LevelObserver
{

    public function deleting(Level $level): void
    {
        if ($level->imagen) {
            unlink(public_path('storage/levels/' . $level->imagen));
        }
    }

    public function creating(Level $level): void
    {
        $level->sort = Level::max('sort') + 1;
    }


    public function deleted(Level $level)
    {
        // Actualizar los niveles
        Level::where('sort', '>', $level->sort)
            ->decrement('sort');

    }

}
