<?php

namespace App\Livewire\Action;

use App\Models\Action;
use App\Models\Grade;
use App\Models\Group;
use App\Models\Level;
use App\Models\Student;
use App\Models\Teacher;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class MatriculaEscolar extends Component
{
    use WithPagination;

    public $level_id;
    public $grade_id;

    public $group_id;
    public $genero;
    public $termino;
    public $grupos = [];
    public $profesor;

    public $headers = ['#','CURP', 'Nombre completo', 'Nivel', 'Grado', 'Grupo','Genero', 'Fecha de Nacimiento', 'Edad'];

    public $contarAlumnos = 0;
    public $totalAlumnos = 0;

    // VARIABLES GET
    public $level;
    public $action;
    public $grade; // GRADO SELECCIONADO


    public function placeholder(){
        return view('placeholder');
    }


    public function updated($propertyName)
    {
        // OBTENER LOS GRUPOS DE ACUERDO AL GRADO SELECCIONADO Y VOLVER A CONTAR LOS ALUMNOS QUE HAY EN LA TABLA
        // if ($propertyName == 'grade_id') {
        //     $this->resetPage();
        //     $this->termino = "";
        //     if (empty($this->grade_id)) {
        //     $this->grupos = [];
        //     $this->contarAlumnos = 0;
        //     } else {
        //     $grade = Grade::find($this->grade_id);
        //     $this->grupos = $grade ? $grade->groups : [];
        //     $this->contarAlumnos = Student::where('level_id', $this->level_id)
        //     ->when($this->grade_id, function ($query) {
        //         $query->where('grade_id', $this->grade_id);
        //     })
        //     ->when($this->group_id, function ($query) {
        //         $query->where('group_id', $this->group_id);
        //     })
        //     ->when($this->genero, function ($query) {
        //         $query->where('genero', $this->genero);
        //     })
        //     ->count();
        //     }
        // }


        // CUANDO CAMBIE EL CAMPO genero, VOLVER A CONTAR LOS ALUMNOS QUE HAY EN LA TABLA
        if($propertyName == 'genero'){
            $this->resetPage();
            $this->termino = "";

            $this->contarAlumnos = Student::where('level_id', $this->level_id)
            ->when($this->genero, function ($query) {
                $query->where('genero', $this->genero);
            })
            ->when($this->grade_id, function ($query) {
                $query->where('grade_id', $this->grade_id);
            })
            ->when($this->group_id, function ($query) {
                $query->where('group_id', $this->group_id);
            })
            ->count();

        }


        //CUANDO CAMBIE EL CAMPO GRADO, VOLVER A CONTAR LOS ALUMNOS QUE HAY EN LA TABLA
        if($propertyName == 'group_id'){
            $this->resetPage();
            $this->termino = "";

            $this->profesor = Teacher::where('level_id', $this->level_id)
            ->where('grade_id', $this->grade_id)
            ->where('group_id', $this->group_id)
            ->with('personnel')
            ->first();

            $this->contarAlumnos = Student::where('level_id', $this->level_id)
            ->when($this->group_id, function ($query) {
                $query->where('group_id', $this->group_id);
            })
            ->when($this->grade_id, function ($query) {
                $query->where('grade_id', $this->grade_id);
            })
            ->when($this->genero, function ($query) {
                $query->where('genero', $this->genero);
            })
            ->count();

        }


        if($propertyName == 'termino'){
            if (empty($this->termino)) {
                $this->resetPage();
                $this->contarAlumnos = 0;
            } else {
                $this->resetPage();
                $this->grade_id = null;
                $this->group_id = null;
                $this->genero = null;

            $this->contarAlumnos = Student::where('level_id', $this->level_id)
            ->where('status', 1)
            ->where('grade_id', $this->grade->id)
            ->where(function ($query) {
                $query->where('CURP', 'like', '%' . $this->termino . '%')
                ->orWhere('nombre', 'like', '%' . $this->termino . '%')
                ->orWhere('apellido_paterno', 'like', '%' . $this->termino . '%')
                ->orWhere('apellido_materno', 'like', '%' . $this->termino . '%');
                $query->orWhereRaw("CONCAT(nombre, ' ', apellido_paterno, ' ', apellido_materno) like ?", ['%' . $this->termino . '%']);
                })
            ->count();
            }
        }



    }


    #[On('refreshAlumnos')]
    public function refreshAlumnos()
    {
        // ESPERAR UN SEGUNDO, Y RESETEAR EL GRADO, GRUPO Y genero
        sleep(1);
        $this->grade_id = null;
        $this->group_id = null;
        $this->genero = null;
        $this->termino  = null;
        $this->resetPage();

        $this->contarAlumnos = 0;


    }

    public function mount(){

        // return ($this->grade);
        // CUANDO SE CARGUE EL COMPONENTE QUE LLAME EL TOTAL DE ALUMNOS
        $this->totalAlumnos = Student::where('level_id', $this->level_id)
            ->where('status', 1)
            ->where('grade_id', $this->grade->id)
            ->count();

        // GRUPOS
        $this->grupos = $this->grade->groups; // GRUPOS DEL GRADO SELECCIONADO POR DEFECTO EN EL SELECT DE GRUPOS EN LA VISTA DE MATRICULA ESCOLAR




        $this->level = Level::find($this->level_id);
        $this->action = Action::where('slug', 'matricula-escolar')->first();
        $this->grade_id = $this->grade->id; // GRADO SELECCIONADO POR DEFECTO EN EL SELECT DE GRADOS EN LA VISTA DE MATRICULA ESCOLAR


        $this->profesor = Teacher::where('level_id', $this->level_id)
            ->where('grade_id', $this->grade_id)
            ->where('group_id', $this->group_id)
            ->with('personnel')
            ->first();


    }


    public function render()
    {

        $alumnos = Student::where('level_id', $this->level_id)
            ->where('status', 1)
            ->when($this->grade->id, function ($query) {
            $query->where('grade_id', $this->grade->id);
            })
            ->when($this->group_id, function ($query) {
            $query->where('group_id', $this->group_id);
            })
            ->when($this->genero, function ($query) {
            $query->where('genero', $this->genero);
            })
            ->where(function ($query) {
            $query->where('CURP', 'like', '%' . $this->termino . '%')
                ->orWhere('nombre', 'like', '%' . $this->termino . '%')
                ->orWhere('apellido_paterno', 'like', '%' . $this->termino . '%')
                ->orWhere('apellido_materno', 'like', '%' . $this->termino . '%');
            $query->orWhereRaw("CONCAT(nombre, ' ', apellido_paterno, ' ', apellido_materno) like ?", ['%' . $this->termino . '%']);
            })
            ->orderByDesc('level_id')
            ->orderByDesc('grade_id')
            ->orderByDesc('group_id')
            ->orderBy('apellido_paterno')
            ->orderBy('apellido_materno')
            ->paginate(20);

        $level_nombre = \App\Models\Level::find($this->level_id)->level;


        $grados = Grade::where('level_id', $this->level_id)->get();

        $acciones = Action::orderBy('sort', "asc")->get();

        return view('livewire.action.matricula-escolar', compact('alumnos', 'level_nombre', 'grados', 'acciones'));
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
