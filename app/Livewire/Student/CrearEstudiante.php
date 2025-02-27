<?php

namespace App\Livewire\Student;

use App\Models\Generation;
use App\Models\Grade;
use App\Models\Group;
use App\Models\Level;
use App\Models\Student;
use App\Models\Tutor;
use Livewire\Component;

class CrearEstudiante extends Component
{

    use \Livewire\WithFileUploads;

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
    public $imagen;

    public $generaciones = [];
    public $grados = [];
    public $grupos = [];
    public $grupo_name;

    // NOMBRES
    public $nivel_nombre;
    public $generacion_nombre;
    public $grado_nombre;
    public $tutor_nombre;
    public $tutor_estudiantes;


    protected $rules = [
        'CURP' => 'required|unique:students,CURP',
        'nombre' => 'required|string',
        'apellido_paterno' => 'required|string',
        'apellido_materno' => 'required|string',
        'fecha_nacimiento' => 'required|date',
        'edad' => 'required|integer',
        'sexo' => 'required|in:H,M',
        'level_id' => 'required|exists:levels,id',
        'generation_id' => 'required|exists:generations,id',
        'grade_id' => 'required|exists:grades,id',
        'group_id' => 'required|exists:groups,id',
        'tutor_id' => 'required|exists:tutors,id',
        'status' => 'required|in:0,1',
        'imagen' => 'image|nullable|max:2048|mimes:jpeg,jpg,png',
    ];

    protected $messages = [
        'CURP.required' => 'El campo CURP es requerido',
        'CURP.unique' => 'El CURP ya existe',
        'nombre.required' => 'El campo nombre es requerido',
        'nombre.string' => 'El campo nombre debe ser una cadena de texto',
        'apellido_paterno.required' => 'El campo apellido paterno es requerido',
        'apellido_paterno.string' => 'El campo apellido paterno debe ser una cadena de texto',
        'apellido_materno.required' => 'El campo apellido materno es requerido',
        'apellido_materno.string' => 'El campo apellido materno debe ser una cadena de texto',
        'fecha_nacimiento.required' => 'El campo fecha de nacimiento es requerido',
        'fecha_nacimiento.date' => 'El campo fecha de nacimiento debe ser una fecha',
        'edad.required' => 'El campo edad es requerido',
        'edad.integer' => 'El campo edad debe ser un número entero',
        'sexo.required' => 'El campo sexo es requerido',
        'sexo.in' => 'El campo sexo debe ser H o M',
        'level_id.required' => 'El campo nivel es requerido',
        'level_id.exists' => 'El nivel seleccionado no existe',
        'generation_id.required' => 'El campo generación es requerido',
        'generation_id.exists' => 'La generación seleccionada no existe',
        'grade_id.required' => 'El campo grado es requerido',
        'grade_id.exists' => 'El grado seleccionado no existe',
        'group_id.required' => 'El campo grupo es requerido',
        'group_id.exists' => 'El grupo seleccionado no existe',
        'tutor_id.exists' => 'El tutor seleccionado no existe',
        'tutor_id.required' => 'El campo tutor es requerido',
        'status.required' => 'El campo status es requerido',
        'status.in' => 'El campo status no es válido',
        'imagen.image' => 'El archivo debe ser una imagen',
        'imagen.max' => 'El archivo no debe pesar más de 2MB',
        'imagen.mimes' => 'El archivo debe ser formato jpeg, jpg o png',


    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);

        if($propertyName == 'fecha_nacimiento'){
            $this->edad = \Carbon\Carbon::parse($this->fecha_nacimiento)->age;
        }



        if ($propertyName == 'level_id') {
                    $this->generation_id = null; // Reset generation_id
                    $this->generacion_nombre = null; // Reset generacion_nombre
                    $this->generaciones = Generation::where('level_id', $this->level_id)
                            ->where('status', 1)
                            ->get();

            $this->nivel_nombre = Level::find($this->level_id)->level;

            }

        if ($propertyName == 'generation_id') {
            $this->grade_id = "";
            $this->grado_nombre = "";
            $this->grados = Grade::where('generation_id', $this->generation_id)
                    ->get();

            $generation = Generation::find($this->generation_id);
            $this->generacion_nombre = $generation->anio_inicio . ' - ' . $generation->anio_termino;

        }

        if ($propertyName == 'group_id') {
            $this->grupos = Grade::where('gr', $this->generation_id)
                    ->get();
        }
        if ($propertyName == 'grade_id') {
            $this->group_id = Grade::find($this->grade_id)->group->id; // Obtenemos el grupo del grado seleccionado para mostrarlo en la vista
            $this->grupo_name = Grade::find($this->grade_id)->group->grupo; // Obtenemos el grupo del grado seleccionado para mostrarlo en la vista

            $this->grado_nombre = Grade::find($this->grade_id)->grado_numero.'° grado' ;
        }

        if($propertyName == 'tutor_id'){
            $tutor = Tutor::find($this->tutor_id);
            $this->tutor_nombre = $tutor->nombre.' '.$tutor->apellido_paterno.' '.$tutor->apellido_materno;

            $this->tutor_estudiantes = ' (Estudiantes: ' . $tutor->students()->count() . ')';
        }




    }

    public function guardarEstudiante(){
        $datos = $this->validate();

        if ($this->imagen) {
            $imagen = $this->imagen->store('students');
            $datos["imagen"] = str_replace('students/', '', $imagen);
        } else {
            $datos["imagen"] = null;
        }

        Student::create([
            'CURP' => $this->CURP,
            'nombre' => $this->nombre,
            'apellido_paterno' => $this->apellido_paterno,
            'apellido_materno' => $this->apellido_materno,
            'fecha_nacimiento' => $this->fecha_nacimiento,
            'edad' => $this->edad,
            'sexo' => $this->sexo,
            'level_id' => $this->level_id,
            'generation_id' => $this->generation_id,
            'grade_id' => $this->grade_id,
            'group_id' => $this->group_id,
            'tutor_id' => $this->tutor_id,
            'status' => $this->status,
            'imagen' => $datos["imagen"],
        ]);


        $this->imagen = null;

        $this->dispatch('resetImagePreview');

        $this->reset([
            'CURP',
            'nombre',
            'apellido_paterno',
            'apellido_materno',
            'fecha_nacimiento',
            'edad',
            'sexo',
            'level_id',
            'generation_id',
            'grade_id',
            'group_id',
            'tutor_id',
            'status',
            'imagen',

            'nivel_nombre',
            'grado_nombre',
            'grupo_name',
            'generacion_nombre',
            'tutor_nombre',

        ]);

        // session()->flash('mensaje', 'Estudiante creado correctamente');

        $this->dispatch('swal', [
            'title' => 'Estudiante creado correctamente',
            'icon' => 'success',
            'position' => 'top-end',
        ]);

        // return redirect()->route('admin.students.index');


    }

    public function placeholder(){
        return view('placeholder');
    }

    public function render()
    {
        $tutores = \App\Models\Tutor::orderBy('sort', 'DESC')->get();
        $niveles = \App\Models\Level::orderBy('sort', 'ASC')->get();

        return view('livewire.student.crear-estudiante', compact('tutores', 'niveles'));
    }
}
