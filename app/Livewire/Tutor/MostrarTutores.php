<?php

namespace App\Livewire\Tutor;

use Livewire\Component;

class MostrarTutores extends Component
{

    public function placeholder(){
        return view('placeholder');
    }



    public function render()
    {
        return view('livewire.tutor.mostrar-tutores');
    }
}
