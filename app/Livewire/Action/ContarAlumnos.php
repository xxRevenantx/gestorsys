<?php

namespace App\Livewire\Action;

use App\Models\Student;
use Livewire\Attributes\On;
use Livewire\Component;

class ContarAlumnos extends Component
{
    public $level_id;
    public $contarAlumnos = 0;

    #[On('contarAlumnos')]
    public function updateStudentList() // Esta función se ejecutará cuando se emita el evento 'contarAlumnos' desde el componente hijo 'MatriculaEscolar' 
    {
        $this->contarAlumnos = Student::where('level_id', $this->level_id)->count();
    }

    public function mount(){
        $this->contarAlumnos = Student::where('level_id', $this->level_id)->count();
    }

    public function render()
    {
        return view('livewire.action.contar-alumnos');
    }
}
