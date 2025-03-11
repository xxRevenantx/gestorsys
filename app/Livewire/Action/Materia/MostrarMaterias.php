<?php

namespace App\Livewire\Action\Materia;

use App\Models\Grade;
use App\Models\Level;
use Livewire\Component;

class MostrarMaterias extends Component
{
    public $level_id;
    public $grade;


    public function placeholder(){
        return view('placeholder');
    }


    public function render()
    {

        $grados = Grade::where('level_id', $this->level_id)->get();


        return view('livewire.action.materia.mostrar-materias', compact('grados'));
    }
}
