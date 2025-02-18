<?php

namespace App\Livewire\Supervisor;

use App\Models\Supervisor;
use Livewire\Component;
use Livewire\WithPagination;

class MostrarSupervisores extends Component
{



    public function render()
    {

        return view('livewire.supervisor.mostrar-supervisores');
    }
}
