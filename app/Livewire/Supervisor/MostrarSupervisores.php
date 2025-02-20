<?php

namespace App\Livewire\Supervisor;

use App\Models\Supervisor;
use Livewire\Component;
use Livewire\WithPagination;

class MostrarSupervisores extends Component
{

    public function placeholder(){
        return view('placeholder');
    }



    public function render()
    {

        return view('livewire.supervisor.mostrar-supervisores');
    }
}
