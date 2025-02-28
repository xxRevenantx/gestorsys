<?php

namespace App\Livewire\Action;

use Livewire\Component;

class DatosAlumno extends Component
{


    public function placeholder(){
        return view('placeholder');
    }

    public function render()
    {
        return view('livewire.action.datos-alumno');
    }
}
