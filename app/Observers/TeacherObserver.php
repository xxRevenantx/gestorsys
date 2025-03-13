<?php

namespace App\Observers;

use App\Models\Teacher;

class TeacherObserver
{
    public function creating(Teacher $teacher): void
    {
        $teacher->sort = Teacher::max('sort') + 1;
    }


    public function deleted(Teacher $teacher)
    {
        // Actualizar los Teacheres
        Teacher::where('sort', '>', $teacher->sort)
            ->decrement('sort');

    }
}
