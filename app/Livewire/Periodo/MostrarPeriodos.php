<?php

namespace App\Livewire\Periodo;

use Livewire\Component;

class MostrarPeriodos extends Component
{


    public function placeholder(){
        return view('placeholder');
    }


    public function render()
    {
        $periodos = \App\Models\Periodo::all();
        return view('livewire.periodo.mostrar-periodos', compact('periodos'));
    }
}
