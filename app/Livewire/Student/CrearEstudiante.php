<?php

namespace App\Livewire\Student;

use App\Models\Generation;
use App\Models\Grade;
use App\Models\Group;
use App\Models\Level;
use App\Models\Student;
use App\Models\Tutor;
use Livewire\Component;
use Illuminate\Support\Str;


class CrearEstudiante extends Component
{

    use \Livewire\WithFileUploads;

    public $CURP;
    public $matricula;
    public $nombre;
    public $apellido_paterno;
    public $apellido_materno;
    public $fecha_nacimiento;
    public $edad;
    public $genero;
    public $level_id;
    public $generation_id;
    public $grade_id;
    public $group_id;
    public $tutor_id;
    public $status;
    public $turno;
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
        'CURP' => 'required|unique:students,CURP|min:18|max:18',
        'matricula' => 'required|unique:students,matricula|min:13|max:13',
        'nombre' => 'required|string',
        'apellido_paterno' => 'required|string',
        'apellido_materno' => 'required|string',
        'fecha_nacimiento' => 'required|date',
        'edad' => 'required|integer',
        'genero' => 'required|in:H,M',
        'level_id' => 'required|exists:levels,id',
        'generation_id' => 'required|exists:generations,id',
        'grade_id' => 'required|exists:grades,id',
        'group_id' => 'required|exists:groups,id',
        'tutor_id' => 'required|exists:tutors,id',
        'status' => 'required|in:0,1',
        'turno' => 'required|in:Matutino,Vespertino',
        'imagen' => 'image|nullable|max:2048|mimes:jpeg,jpg,png',
    ];

    protected $messages = [
        'CURP.required' => 'El campo CURP es requerido',
        'CURP.unique' => 'El CURP ya existe',
        'CURP.min' => 'El CURP debe tener 18 caracteres',
        'CURP.max' => 'El CURP debe tener 18 caracteres',
        'matricula.required' => 'El campo matricula es requerido',
        'matricula.unique' => 'La matricula ya existe',
        'matricula.min' => 'La matricula debe tener 13 caracteres',
        'matricula.max' => 'La matricula debe tener 13 caracteres',
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
        'genero.required' => 'El campo genero es requerido',
        'genero.in' => 'El campo genero debe ser H o M',
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
        'turno.required' => 'El campo turno es requerido',
        'turno.in' => 'El campo turno no es válido',
        'imagen.image' => 'El archivo debe ser una imagen',
        'imagen.max' => 'El archivo no debe pesar más de 2MB',
        'imagen.mimes' => 'El archivo debe ser formato jpeg, jpg o png',


    ];

    public function generarMatricula($curp)
    {
        if (strlen($curp) >= 10) {
            $base = substr($curp, 0, 10);
            $randomStr = Str::upper(Str::random(3)); // 3 caracteres aleatorios (letras y números)
            $this->matricula = $base . $randomStr;
        } else {
            $this->matricula = "NO VÁLIDO";
        }
    }


    public function updated($propertyName)
    {
        // Si el campo está vacío, no intentar validar
    if (empty($this->$propertyName)) {
        if ($propertyName === 'CURP') {
            $this->matricula = ''; // Limpiar matrícula si el CURP está vacío
        }
        return;
    }

    // Validar solo si el campo tiene valor
    $this->validateOnly($propertyName);

    // Generar matrícula automáticamente si CURP tiene al menos 10 caracteres
    if ($propertyName === 'CURP' && strlen($this->CURP) >= 10) {
        $this->generarMatricula($this->CURP);

    }

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
            $this->grupos = Grade::find($this->grade_id)->groups; // RELACION INVERSA CON GRUPOS

            $this->grado_nombre = Grade::find($this->grade_id)->grado.'° grado' ;
        }

        if ($propertyName == 'group_id') {
            $this->grupo_name = Group::find($this->group_id)->grupo;
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
            'matricula' => trim($this->matricula),
            'CURP' => trim($this->CURP),
            'nombre' => trim($this->nombre),
            'apellido_paterno' => trim($this->apellido_paterno),
            'apellido_materno' => trim($this->apellido_materno),
            'fecha_nacimiento' => $this->fecha_nacimiento,
            'edad' => $this->edad,
            'genero' => $this->genero,
            'level_id' => $this->level_id,
            'generation_id' => $this->generation_id,
            'grade_id' => $this->grade_id,
            'group_id' => $this->group_id,
            'tutor_id' => $this->tutor_id,
            'status' => $this->status,
            'turno' => $this->turno,
            'imagen' => $datos["imagen"],
        ]);


        $this->imagen = null;

        $this->dispatch('resetImagePreview');

        $this->reset([
            'matricula',
            'CURP',
            'nombre',
            'apellido_paterno',
            'apellido_materno',
            'fecha_nacimiento',
            'edad',
            'genero',
            'level_id',
            'generation_id',
            'grade_id',
            'group_id',
            'tutor_id',
            'status',
            'turno',
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
