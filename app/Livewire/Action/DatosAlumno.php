<?php

namespace App\Livewire\Action;

use App\Models\Student;
use Livewire\Component;

class DatosAlumno extends Component
{

    public $level_id;
    public $query = ''; // Input del usuario
    public $alumnos; // Resultados de la búsqueda
    public $selectedIndex = 0; // Índice para navegación con teclado
    public $alumnoSeleccionadoId = null; // ID del alumno seleccionado


    public $matricula;
    public $apellido_materno;
    public $apellido_paterno;
    public $nombre;
    public $CURP;
    public $genero;
    public $fecha_nacimiento;

    public $pais_nacimiento;
    public $estado_nacimiento;
    public $municipio_nacimiento;
    public $estado_vive;
    public $municipio_vive;
    public $colonia;
    public $calle;
    public $numero;
    public $CP;


    public function updatedQuery()
    {
        // Verifica que haya al menos 2 caracteres antes de buscar
        if (strlen($this->query) > 1) {
            $this->alumnos = Student::where('level_id', $this->level_id)
                ->where(function($query) {
                    $query->where('CURP', 'like', '%' . $this->query . '%')
                          ->orWhere('nombre', 'like', '%' . $this->query . '%')
                          ->orWhere('apellido_paterno', 'like', '%' . $this->query . '%')
                          ->orWhere('apellido_materno', 'like', '%' . $this->query . '%')
                          ->orWhereRaw("CONCAT(nombre, ' ', apellido_paterno, ' ', apellido_materno) like ?", ['%' . $this->query . '%']);
                })
                ->get();

            if (empty($this->alumnos)) {
                $this->dispatch('swal', [
                    'title' => 'No se encontraron alumnos con los criterios de búsqueda',
                    'icon' => 'warning',
                    'position' => 'top',
                ]);
            }
        } else {
            $this->alumnos = [];
            $this->matricula = '';
            $this->nombre = '';
            $this->apellido_paterno = '';
            $this->apellido_materno = '';
            $this->CURP = '';
            $this->genero = '';
            $this->fecha_nacimiento = '';
            $this->pais_nacimiento = '';
            $this->estado_nacimiento = '';
            $this->municipio_nacimiento = '';
            $this->estado_vive = '';
            $this->municipio_vive = '';
            $this->colonia = '';
            $this->calle = '';
            $this->numero = '';
            $this->CP = '';
        }
    }

    public function selectAlumno($index)
    {
        if (isset($this->alumnos[$index])) {
            // Establece el usuario seleccionado en el input
            $this->query = $this->alumnos[$index]['nombre'] . ' ' . $this->alumnos[$index]['apellido_paterno'] . ' ' . $this->alumnos[$index]['apellido_materno'];
            $this->alumnoSeleccionadoId = $this->alumnos[$index]['id']; // Obtiene el ID del alumno seleccionado
            $this->alumnos = []; // Limpia los resultados


            $alumno = Student::find($this->alumnoSeleccionadoId);

            if ($alumno) {
                $this->matricula = $alumno->matricula;
                $this->nombre = $alumno->nombre;
                $this->apellido_paterno = $alumno->apellido_paterno;
                $this->apellido_materno = $alumno->apellido_materno;
                $this->CURP = $alumno->CURP;
                $this->genero = $alumno->genero;
                $this->fecha_nacimiento = $alumno->fecha_nacimiento->format('d-m-Y');
                $this->pais_nacimiento = $alumno->pais_nacimiento;
                $this->estado_nacimiento = $alumno->estado_nacimiento;
                $this->municipio_nacimiento = $alumno->municipio_nacimiento;
                $this->estado_vive = $alumno->estado_vive;
                $this->municipio_vive = $alumno->municipio_vive;
                $this->colonia = $alumno->colonia;
                $this->calle = $alumno->calle;
                $this->numero = $alumno->numero;
                $this->CP = $alumno->CP;

            }
        }
    }



    protected $rules = [
        'nombre' => 'required|sometimes', // El campo es requerido solo si no se ha seleccionado un alumno de la lista de resultados de búsqueda
        'apellido_paterno' => 'required|sometimes',
        'apellido_materno' => 'required|sometimes',
        'CURP' => 'required|sometimes',
        'genero' => 'required|sometimes',
        'fecha_nacimiento' => 'required|sometimes',

    ];

    public function guardarAlumno()
    {
        $this->validate();

        $alumno = Student::find($this->alumnoSeleccionadoId);

            $alumno->update([
                'pais_nacimiento' => $this->pais_nacimiento,
                'estado_nacimiento' => $this->estado_nacimiento,
                'municipio_nacimiento' => $this->municipio_nacimiento,
                'estado_vive' => $this->estado_vive,
                'municipio_vive' => $this->municipio_vive,
                'colonia' => $this->colonia,
                'calle' => $this->calle,
                'numero' => $this->numero,
                'CP' => $this->CP,


            ]);


        // $this->reset(['matricula','nombre', 'apellido_paterno', 'apellido_materno', 'CURP', 'genero', 'fecha_nacimiento',
        // 'pais_nacimiento', 'estado_nacimiento', 'municipio_nacimiento', 'estado_vive', 'municipio_vive', 'colonia', 'calle', 'numero', 'CP',
        // 'query', 'alumnoSeleccionadoId', 'alumnos']);

        $this->dispatch('swal', [
            'title' => 'Datos del alumno actualizado correctamente',
            'icon' => 'success',
            'position' => 'top-end',
        ]);


    }


    public function placeholder(){
        return view('placeholder');
    }

    public function render()
    {
        return view('livewire.action.datos-alumno');
    }
}
