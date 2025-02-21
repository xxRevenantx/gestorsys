<?php

namespace App\Livewire\Student;

use Livewire\Component;

class CrearEstudiante extends Component
{
    public function render()
    {

        $tutores = \App\Models\Tutor::all();
        return view('livewire.student.crear-estudiante', compact('tutores'));
    }
}
