<?php

namespace App\Observers;

use App\Models\Student;

class StudentObserver
{
    public function creating(Student $student): void
    {
        $student->sort = Student::max('sort') + 1;
    }


    public function deleted(Student $student)
    {
        // Actualizar los estudiantes
        Student::where('sort', '>', $student->sort)
            ->decrement('sort');

    }
}
