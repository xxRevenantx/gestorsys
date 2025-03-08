<?php

namespace App\Livewire\Personnel;

use Livewire\Component;

class MostrarPersonal extends Component
{


    public function placeholder(){
        return view('placeholder');
    }

    public function render()
    {
        return view('livewire.personnel.mostrar-personal');
    }
}
