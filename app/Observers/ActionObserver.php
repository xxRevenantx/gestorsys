<?php

namespace App\Observers;

use App\Models\Action;

class ActionObserver
{

    public function creating(Action $action): void
    {
        $action->sort = Action::max('sort') + 1;
    }


    public function deleted(Action $action)
    {
        // Actualizar los niveles
        Action::where('sort', '>', $action->sort)
            ->decrement('sort');

    }


}
