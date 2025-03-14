<?php

namespace App\Livewire\Teacher;

use App\Models\Level;
use App\Models\Teacher;
use Livewire\Component;

class MostrarProfesores extends Component
{

    // public $niveles;
    public $personal;

    public function mount(){
        // $this->niveles = Level::with('teachers')->get();
        $this->personal = Teacher::all();
    }

    public function placeholder(){
        return view('placeholder');
    }

    public function render()
    {

        return view('livewire.teacher.mostrar-profesores');
    }
}
