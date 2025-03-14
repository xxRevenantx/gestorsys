<?php

namespace App\Livewire\Teacher;

use App\Models\Grade;
use App\Models\Group;
use App\Models\Level;
use App\Models\Personnel;
use App\Models\Teacher;
use Livewire\Component;

class EditarProfesor extends Component
{

    public $teacher;
    public $personnel_id;
    public $level_id;
    public $grade_id;
    public $group_id;
    public $funcion;
    public $director;

    public $habilitarInput = true;
    public $grados = [];
    public $grupos = [];



    protected $rules = [
        'level_id' => 'required|exists:levels,id',
        'grade_id' => 'nullable|exists:grades,id',
        'group_id' => 'nullable|exists:groups,id', // Cambiado a nullable
        'funcion' => 'required|string',
        'director' => 'required|in:0,1',
    ];

    protected $messages = [
        'personnel_id.required' => 'El personal es requerido.',
        'personnel_id.exists' => 'El personal seleccionado no existe.',
        'level_id.required' => 'El nivel es requerido.',
        'level_id.exists' => 'El nivel seleccionado no existe.',
        'grade_id.exists' => 'El grado seleccionado no existe.',
        'group_id.required' => 'El grupo es requerido.',
        'group_id.exists' => 'El grupo seleccionado no existe.',
        'funcion.required' => 'La función es requerida.',
        'funcion.string' => 'La función debe ser una cadena de texto.',
        'director.required' => 'El campo director es requerido.',
        'director.in' => 'El campo director es inválido.',
    ];


    public function mount($teacher)
    {
        $this->teacher = $teacher;
        $this->personnel_id = $teacher->personnel_id;
        $this->level_id = $teacher->level_id;
        $this->grade_id = $teacher->grade_id;
        $this->group_id = $teacher->group_id;
        $this->funcion = $teacher->funcion;
        $this->director = $teacher->director;

        if (!empty($this->level_id)) {
            $this->grados = Grade::where('level_id', $this->level_id)
                ->orderBy('grado', 'ASC')
                ->get();
        }

        if (!empty($this->grade_id)) {
            $this->grupos = Group::where('grade_id', $this->grade_id)
                ->orderBy('grupo', 'ASC')
                ->get();
        }


    }



    public function updated($propertyName)
    {
        if ($propertyName == 'level_id') {
            if (!empty($this->level_id)) {
            $this->grados = Grade::where('level_id', $this->level_id)
                ->orderBy('grado', 'ASC')
                ->get();
            } else {
            $this->grados = [];
            }
            $this->grupos = [];
        }

        // CUANDO EL NIVEL SEA SECUNDARIA NO SE PODRÁ SELECCIONAR UN GRUPO NI UN GRADO
        if ($this->level_id == 3) {
            $this->habilitarInput = false;
            $this->dispatch('swal',[
                'title' => 'Para nivel secundaria, no es necesario seleccionar un grado ni un grupo',
                'icon' => 'info',
                'position' => 'top',
            ]);
        }else{
            $this->habilitarInput = true;
        }

        if ($propertyName == 'grade_id') {
            if (!empty($this->grade_id)) {
                $this->grupos = Group::where('grade_id', $this->grade_id)
                    ->orderBy('grupo', 'ASC')
                    ->get();
            } else {
                $this->grupos = [];
            }
        }

        $this->validateOnly($propertyName);
    }

    public function actualizarProfesor()
    {


        if ($this->level_id == 3) {
            $this->validate([
            'group_id' => 'nullable|exists:groups,id',
            'grade_id' => 'nullable|exists:grades,id',
            ]);
        } elseif ($this->director === "0") {
            $this->validate([
            'group_id' => 'required|exists:groups,id',
            'grade_id' => 'required|exists:grades,id',
            ]);
        } else {
            $this->validate();
        }



        $teacher = Teacher::find($this->teacher->id);
        $teacher->personnel_id = $this->personnel_id;
        $teacher->level_id = $this->level_id;
        $teacher->grade_id = $this->grade_id;
        $teacher->group_id = $this->group_id;
        $teacher->funcion = $this->funcion;
        $teacher->director = $this->director;
        $teacher->save();




        $this->dispatch('resfreshTable');

        $this->dispatch('swal', [
            'title' => '¡Personal actualizado con éxito!',
            'icon' => 'success',
            'position' => 'top',
        ]);


    }

    public function placeholder()
    {
        return view('placeholder');
    }



    public function render()
    {

        $personal = Personnel::select('id', 'titulo', 'nombre', 'apellido_paterno', 'apellido_materno')->where('status', 1)->get();
        $niveles = Level::select('id', 'level')->orderBy('sort', 'ASC')->get();
        $grupos = Group::select('id', 'grupo')->get();

        return view('livewire.teacher.editar-profesor', compact('personal', 'niveles', 'grupos'));
    }
}
