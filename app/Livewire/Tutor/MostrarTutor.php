<?php

namespace App\Livewire\Tutor;

use Livewire\Component;

class MostrarTutor extends Component
{

    public $tutor;


    public function placeholder()
    {
        return view('placeholder');
    }

    public function render()
    {
        return view('livewire.tutor.mostrar-tutor');
    }
}
