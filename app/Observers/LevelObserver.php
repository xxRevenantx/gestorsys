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

}
