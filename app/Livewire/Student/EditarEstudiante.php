<?php

namespace App\Livewire\Student;

use App\Models\Generation;
use App\Models\Grade;
use App\Models\Level;
use App\Models\Student;
use App\Models\Tutor;
use Livewire\Component;

class EditarEstudiante extends Component
{

    use \Livewire\WithFileUploads;

    public $student;
    public $student_id;
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
    public $imagen_nueva;

    public $generaciones = [];
    public $grados = [];
    public $grupo_name;

    // NOMBRES
    public $nivel_nombre;
    public $generacion_nombre;
    public $grado_nombre;
    public $tutor_nombre;
    public $tutor_estudiantes;

    public function placeholder(){
        return view('placeholder');
    }


    protected $messages = [
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
        'imagen_nueva' => 'El archivo debe ser una imagen',
        'imagen_nueva.max' => 'El archivo no debe pesar más de 2MB',
        'imagen_nueva.mimes' => 'El archivo debe ser formato jpeg, jpg o png',
    ];

    protected $rules = [
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
        'imagen_nueva' => 'image|nullable|max:2048|mimes:jpeg,jpg,png',
    ];

    public function mount($student){
        $this->student_id = $student->id;
        $this->student = $student;
        $this->CURP = $student->CURP;
        $this->nombre = $student->nombre;
        $this->apellido_paterno = $student->apellido_paterno;
        $this->apellido_materno = $student->apellido_materno;
        $this->fecha_nacimiento = $student->fecha_nacimiento;
        $this->edad = $student->edad;
        $this->sexo = $student->sexo;
        $this->level_id = $student->level_id;
        $this->generation_id = $student->generation_id;
        $this->grade_id = $student->grade_id;
        $this->group_id = $student->group_id;
        $this->tutor_id = $student->tutor_id;
        $this->status = $student->status;
        $this->imagen = $student->imagen;

        $this->generaciones = \App\Models\Generation::where('level_id', $this->level_id)->orderBy('sort', 'ASC')->get();
        $this->grados = \App\Models\Grade::where('level_id', $this->level_id)->orderBy('sort', 'ASC')->get();

        $this->grupo_name = \App\Models\Group::find($this->group_id)->grupo;
        $this->nivel_nombre = \App\Models\Level::find($this->level_id)->level;
        $this->generacion_nombre = \App\Models\Generation::find($this->generation_id)->anio_inicio . ' - ' . \App\Models\Generation::find($this->generation_id)->anio_termino;
        $this->grado_nombre = \App\Models\Grade::find($this->grade_id)->grado_numero.'° grado' ;
        $this->tutor_nombre = \App\Models\Tutor::find($this->tutor_id)->nombre . ' ' . \App\Models\Tutor::find($this->tutor_id)->apellido_paterno . ' ' . \App\Models\Tutor::find($this->tutor_id)->apellido_materno;
        $this->tutor_estudiantes = \App\Models\Student::where('tutor_id', $this->tutor_id)->count();
    }

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

    public function actualizarEstudiante(){

        $datos = $this->validate([
            'CURP' => 'required|unique:students,CURP,'.$this->student_id,
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
            'imagen_nueva' => 'image|nullable|max:2048|mimes:jpeg,jpg,png',
        ],[
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
            'imagen_nueva' => 'El archivo debe ser una imagen',
            'imagen_nueva.max' => 'El archivo no debe pesar más de 2MB',
            'imagen_nueva.mimes' => 'El archivo debe ser formato jpeg, jpg o png',
        ]

            );


            if($this->imagen_nueva){
                $imagen = $this->imagen_nueva->store('students');
                $datos['imagen'] = str_replace('students/', '', $imagen);
            }



        $student = Student::find($this->student_id);
        $student->CURP =  strtoupper(trim($this->CURP));
        $student->nombre = trim($this->nombre);
        $student->apellido_paterno = trim($this->apellido_paterno);
        $student->apellido_materno = trim($this->apellido_materno);
        $student->fecha_nacimiento = $this->fecha_nacimiento;
        $student->edad = $this->edad;
        $student->sexo = $this->sexo;
        $student->level_id = $this->level_id;
        $student->generation_id = $this->generation_id;
        $student->grade_id = $this->grade_id;
        $student->group_id = $this->group_id;
        $student->tutor_id = $this->tutor_id;
        $student->status = $this->status;
        $student->imagen = $datos['imagen'] ?? $student->imagen;

        $student->save();


        $this->dispatch('swal', [
            'title' => 'Estudiante actualizado correctamente',
            'icon' => 'success',
            'position' => 'top-end',
        ]);
    }

    public function render()
    {
        $tutores = \App\Models\Tutor::orderBy('sort', 'DESC')->get();
        $niveles = \App\Models\Level::orderBy('sort', 'ASC')->get();


        return view('livewire.student.editar-estudiante' , compact('tutores', 'niveles'));
    }
}
