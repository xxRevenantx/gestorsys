<?php

namespace App\Livewire\Group;

use App\Models\Group;
use Livewire\Attributes\On;
use Livewire\Component;

class MostrarGrupos extends Component
{

    public $contarGrupos;



    public function placeholder(){
        return view('placeholder');
    }


    public function mount()
    {
        $this->contarGrupos = Group::count();
    }


    #[On('grupo-eliminado')]
    public function updateGroupList()
    {
        $this->contarGrupos = Group::count();
    }

    public function render()
    {
        return view('livewire.group.mostrar-grupos');
    }
}
