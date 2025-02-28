<?php

namespace App\Livewire\Student;

use Livewire\Component;

class MostrarEstudiante extends Component
{
    public $student;
    public $CURP;
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
    public $imagen;


    public $grupo_name;
       // NOMBRES
       public $nivel_nombre;
       public $generacion_nombre;
       public $grado_nombre;
       public $tutor_nombre;
       public $tutor_ocupacion;
       public $tutor_estudiantes;


    public function mount($student){
        $this->student = $student;
        $this->CURP = $student->CURP;
        $this->nombre = $student->nombre;
        $this->apellido_paterno = $student->apellido_paterno;
        $this->apellido_materno = $student->apellido_materno;
        $this->fecha_nacimiento = $student->fecha_nacimiento;
        $this->edad = $student->edad;
        $this->genero = $student->genero;

        $this->tutor_id = $student->tutor_id;
        $this->status = $student->status;
        $this->imagen = $student->imagen;

        $this->nivel_nombre = $student->level->level;
        $this->generacion_nombre = $student->generation->anio_inicio.'-'.$student->generation->anio_termino;
        $this->grado_nombre = $student->grade->grado_numero.'° ';
        $this->grupo_name = $student->group->grupo;
        $this->tutor_nombre = $student->tutor->nombre . ' ' . $student->tutor->apellido_paterno . ' ' . $student->tutor->apellido_materno;
        $this->tutor_ocupacion = $student->tutor->ocupacion;
        $this->tutor_estudiantes = $student->tutor->students;
    }

    public function render()
    {
        return view('livewire.student.mostrar-estudiante');
    }
}
