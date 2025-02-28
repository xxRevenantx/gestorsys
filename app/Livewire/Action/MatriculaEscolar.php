<?php

namespace App\Livewire\Action;

use App\Models\Grade;
use App\Models\Group;
use App\Models\Student;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class MatriculaEscolar extends Component
{
    use WithPagination;

    public $level_id;
    public $grade_id;
    public $group_id;
    public $termino;
    public $grupos = [];

    public $contarAlumnos = 0;


    public function placeholder(){
        return view('placeholder');
    }

    public function updated($propertyName)
    {
        if ($propertyName == 'grade_id') {
            $grade = Grade::find($this->grade_id);
            $this->grupos = $grade ? $grade->groups : [];
        }


        if($propertyName == 'grade_id'){
            $this->contarAlumnos = Student::where('level_id', $this->level_id)
            ->when($this->grade_id, function ($query) {
            $query->where('grade_id', $this->grade_id);
            })
            ->when($this->group_id, function ($query) {
            $query->where('group_id', $this->group_id);
            })
            ->count();
        }

        if($propertyName == 'group_id'){
            $this->contarAlumnos = Student::where('level_id', $this->level_id)
            ->when($this->grade_id, function ($query) {
            $query->where('grade_id', $this->grade_id);
            })
            ->when($this->group_id, function ($query) {
            $query->where('group_id', $this->group_id);
            })
            ->count();
        }

    }

    #[On('refreshAlumnos')]
    public function refreshAlumnos()
    {
        // ESPERAR UN SEGUNDO, Y RESETEAR EL GRADO Y TERMINO
        sleep(1);
        $this->grade_id = null;
        $this->group_id = null;
        $this->termino = null;

        $this->contarAlumnos = Student::where('level_id', $this->level_id)
        ->count();
    }

    public function mount(){
        $this->contarAlumnos = Student::where('level_id', $this->level_id)
            ->count();
    }


    public function render()
    {
        $alumnos = Student::where('level_id', $this->level_id)
            ->when($this->grade_id, function ($query) {
            $query->where('grade_id', $this->grade_id);
            })
            ->when($this->group_id, function ($query) {
            $query->where('group_id', $this->group_id);
            })
            ->paginate(10);

        $level_nombre = \App\Models\Level::find($this->level_id)->level;

        $grados = Grade::where('level_id', $this->level_id)->get();

        return view('livewire.action.matricula-escolar', compact('alumnos', 'level_nombre', 'grados'));
    }
}


// $alumnos = Student::where('level_id', $this->level_id)
//             ->where('grade_id', $this->grade_id)
//             ->where(function ($query) {
//             $query->where('CURP', 'like', '%' . $this->termino . '%')
//                 ->orWhere('nombre', 'like', '%' . $this->termino . '%')
//                 ->orWhere('apellido_paterno', 'like', '%' . $this->termino . '%')
//                 ->orWhere('apellido_materno', 'like', '%' . $this->termino . '%');
//                 $query->orWhereRaw("CONCAT(nombre, ' ', apellido_paterno, ' ', apellido_materno) like ?", ['%' . $this->termino . '%']);
//             })
//             ->paginate(10);
