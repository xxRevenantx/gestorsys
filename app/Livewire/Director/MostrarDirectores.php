<?php

namespace App\Livewire\Director;

use Livewire\Component;

class MostrarDirectores extends Component
{

    public function placeholder(){
        return view('placeholder');
    }


    public function render()
    {
        return view('livewire.director.mostrar-directores');
    }
}
