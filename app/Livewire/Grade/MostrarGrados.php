<?php

namespace App\Livewire\Grade;

use Livewire\Component;

class MostrarGrados extends Component
{

    public function placeholder(){
        return view('placeholder');
    }



    public function render()
    {
        return view('livewire.grade.mostrar-grados');
    }
}
