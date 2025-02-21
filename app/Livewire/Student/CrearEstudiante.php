<?php

namespace App\Livewire\Student;

use App\Models\Generation;
use App\Models\Grade;
use App\Models\Group;
use Livewire\Component;

class CrearEstudiante extends Component
{

    public $CURP;
    public $nombre;
    public $apellido_paterno;
    public $apellido_materno;
    public $fecha_nacimiento;
    public $edad;
    public $sexo;
    public $level_id;
    public $generation_id;
    public $grade_id;
    public $group_id;
    public $tutor_id;
    public $status;

    public $generaciones = [];
    public $grados = [];
    public $grupos = [];

    protected $rules = [
        'CURP' => 'required|min:18|max:18|unique:students,CURP',
        'nombre' => 'required|min:3|max:50',
        'apellido_paterno' => 'required|min:3|max:50',
        'apellido_materno' => 'required|min:3|max:50',
        'fecha_nacimiento' => 'required',
        'edad' => 'required|numeric',
        'sexo' => 'required',
        'level_id' => 'required|exists:levels,id',
        'generation_id' => 'required|exists:generations,id',
        'grade_id' => 'required|exists:grades,id',
        'group_id' => 'required|exists:groups,id',
        'tutor_id' => 'required|exists:tutors,id',
        'status' => 'required|in:0,1',
    ];

    protected $messages = [
        'CURP.required' => 'El campo CURP es requerido',
        'CURP.min' => 'El campo CURP debe tener al menos 18 caracteres',
        'CURP.max' => 'El campo CURP debe tener máximo 18 caracteres',
        'CURP.unique' => 'El CURP ya existe',
        'nombre.required' => 'El campo nombre es requerido',
        'nombre.min' => 'El campo nombre debe tener al menos 3 caracteres',
        'nombre.max' => 'El campo nombre debe tener máximo 50 caracteres',
        'apellido_paterno.required' => 'El campo apellido paterno es requerido',
        'apellido_paterno.min' => 'El campo apellido paterno debe tener al menos 3 caracteres',
        'apellido_paterno.max' => 'El campo apellido paterno debe tener máximo 50 caracteres',
        'apellido_materno.required' => 'El campo apellido materno es requerido',
        'apellido_materno.min' => 'El campo apellido materno debe tener al menos 3 caracteres',
        'apellido_materno.max' => 'El campo apellido materno debe tener máximo 50 caracteres',
        'fecha_nacimiento.required' => 'El campo fecha de nacimiento es requerido',
        'edad.required' => 'El campo edad es requerido',
        'edad.numeric' => 'El campo edad debe ser numérico',
        'sexo.required' => 'El campo sexo es requerido',
        'level_id.required' => 'El campo nivel es requerido',
        'level_id.exists' => 'El nivel seleccionado no existe',
        'generation_id.required' => 'El campo generación es requerido',
        'generation_id.exists' => 'La generación seleccionada no existe',
        'grade_id.required' => 'El campo grado es requerido',
        'grade_id.exists' => 'El grado seleccionado no existe',
        'group_id.required' => 'El campo grupo es requerido',
        'group_id.exists' => 'El grupo seleccionado no existe',
        'tutor_id.required' => 'El campo tutor es requerido',
        'tutor_id.exists' => 'El tutor seleccionado no existe',
        'status.required' => 'El campo estatus es requerido',
        'status.in' => 'El estatus seleccionado no es válido',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);

        if ($propertyName == 'level_id') {
            $this->generaciones = Generation::where('level_id', $this->level_id)
                            ->where('status', 1)
                            ->get();
        }

        if ($propertyName == 'generation_id') {
            $this->grados = Grade::where('generation_id', $this->generation_id)
                    ->get();
        }

        // if ($propertyName == 'grade_id') {
        //     $this->group_id = Group::where('grade_id', $this->grade_id)
        //             ->first();
        // }
    }

    public function guardarEstudiante(){
        $this->validate();
    }

    public function placeholder(){
        return view('placeholder');
    }

    public function render()
    {
        $tutores = \App\Models\Tutor::all();
        $niveles = \App\Models\Level::orderBy('sort', 'ASC')->get();
        $grados = \App\Models\Grade::orderBy('sort', 'ASC')->get();
        $generaciones = \App\Models\Generation::orderBy('sort', 'ASC')->get();
        $grupos = \App\Models\Group::orderBy('grupo', 'ASC')->get();
        return view('livewire.student.crear-estudiante', compact('tutores', 'niveles', 'grados', 'generaciones', 'grupos'));
    }
}
