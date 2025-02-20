<?php

namespace App\Livewire\Level;

use Livewire\Component;

class MostrarNiveles extends Component
{

    public function placeholder(){
        return view('placeholder');
    }


    public function render()
    {
        return view('livewire.level.mostrar-niveles');
    }
}
