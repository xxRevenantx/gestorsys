<?php

namespace App\Livewire\Student;

use Livewire\Component;

class MostrarEstudiantes extends Component
{

    public function placeholder()
    {
        return view('placeholder');
    }
    
    public function render()
    {
        return view('livewire.student.mostrar-estudiantes');
    }
}
