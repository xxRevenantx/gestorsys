<?php

namespace App\Livewire\Generation;

use App\Models\Generation;
use Livewire\Attributes\On;
use Livewire\Component;

class MostrarGeneracion extends Component
{

    public $contarGeneracion;



    public function placeholder(){
        return view('placeholder');
    }


    public function mount()
    {
        $this->contarGeneracion = Generation::count();
    }


    #[On('generacion-eliminada')]
    public function updateGenerationList()
    {
        $this->contarGeneracion = Generation::count();
    }


    public function render()
    {
        return view('livewire.generation.mostrar-generacion');
    }
}
