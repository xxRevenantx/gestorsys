<?php

namespace App\Livewire\Tutor;

use App\Models\Tutor;
use Livewire\Attributes\On;
use Livewire\Component;

class MostrarTutores extends Component
{

    public $contarTutores;



    public function placeholder(){
        return view('placeholder');
    }


    public function mount()
    {
        $this->contarTutores = Tutor::count();
    }


    #[On('tutor-eliminado')]
    public function updateTutorList()
    {
        $this->contarTutores = Tutor::count();
    }


    public function render()
    {
        return view('livewire.tutor.mostrar-tutores');
    }
}
