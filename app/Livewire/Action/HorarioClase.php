<?php

namespace App\Livewire\Action;

use App\Models\Action;
use App\Models\Grade;
use App\Models\Horario;
use App\Models\Level;
use App\Models\Materia;
use Livewire\Attributes\On;
use Livewire\Component;

class HorarioClase extends Component
{
    public $materias;
    public $grade_id;
    public $level_id;
    public $group_id;
    public $teacher_id;
    public $horarios = [];
    public $grupos = [];
    public $materiasGrupo;

    // VARIABLES GET
    public $level;
    public $action;
    public $grade; // GRADO SELECCIONADO

    public $hora;

    // Colores de las materias
    public $materiaColors = [];


    // busqueda

    public $search = '';


    public function placeholder(){
        return view('placeholder');
    }

    // Se carga el nivel y los horarios en la inicialización
    public function mount($level_id)
    {
        $this->level_id = $level_id;

    // Obtener los horarios y convertirlos a un arreglo simple
    $horarios = Horario::all();
    foreach ($horarios as $horario) {
        $this->horarios[$horario->id] = [
            'id' => $horario->id,
            'hora' => $horario->hora,
            'lunes' => $horario->lunes,
            'martes' => $horario->martes,
            'miercoles' => $horario->miercoles,
            'jueves' => $horario->jueves,
            'viernes' => $horario->viernes,
            'group_id' => $horario->group_id, // <-- Agregado
        ];
    }

    $this->materias = Materia::where('level_id', $this->level_id)->with('teacher')->get();

    $this->level = Level::find($this->level_id);
    $this->action = Action::where('slug', 'horarios')->first();
    $this->grade_id = $this->grade->id; // GRADO SELECCIONADO POR DEFECTO EN EL SELECT DE GRADOS EN LA VISTA DE MATRICULA ESCOLAR

    $this->grupos = $this->grade->groups; // GRUPOS DEL GRADO SELECCIONADO POR DEFECTO EN EL SELECT DE GRUPOS EN LA VISTA DE MATRICULA ESCOLAR



    }




    public function guardarHora(){



        $this->validate([
            'hora' => [
            'required',
            'string',
            function ($attribute, $value, $fail) {
                $exists = Horario::where('hora', $value)
                ->where('group_id', $this->group_id)
                ->exists();
                if ($exists) {
                $fail('La hora ya existe en el mismo grupo.');
                }
            },
            ],
            'group_id' => 'required|exists:groups,id',
        ],[
            'hora.required' => 'El campo hora es obligatorio',
            'group_id.required' => 'El campo grupo es obligatorio',
            'group_id.exists' => 'El grupo no existe',
        ]);



        Horario::create([
            'hora' => trim($this->hora),
            'level_id' => $this->level_id,
            'grade_id' => $this->grade_id,
            'group_id' => $this->group_id,

        ]);

        $this->hora = '';
        $this->group_id = '';

        $this->dispatch('swal', [
            'title' => 'Hora guardada correctamente',
            'icon' => 'success',
            'position' => 'top',
        ]);

        $this->dispatch('refreshTable');


    }

    #[On('refreshTable')]
    public function refreshTable()
    {
        // ESPERAR UN SEGUNDO, Y RESETEAR EL GRADO, GRUPO Y genero
        sleep(1);
        $this->horarios = Horario::all()->mapWithKeys(function ($horario) {
            return [
                $horario->id => [
                    'id' => $horario->id,
                    'hora' => $horario->hora,
                    'lunes' => $horario->lunes,
                    'martes' => $horario->martes,
                    'miercoles' => $horario->miercoles,
                    'jueves' => $horario->jueves,
                    'viernes' => $horario->viernes,
                    'group_id' => $horario->group_id, // <-- Agregado
                ],
            ];
        })->toArray();

    }

    // ACTUALIZAR HORA
    public function actualizarHora($id)
    {
        $this->validate([
            "horarios.$id.hora" => 'required|string|unique:horarios,hora,' . $id,
        ], [
            "horarios.$id.hora.required" => 'El campo hora es obligatorio',
            "horarios.$id.hora.unique" => 'La hora ya existe',
        ]);


        $horario = Horario::find($id);

        if ($horario) {
            $horario->hora = $this->horarios[$id]['hora'];
            $horario->save();
        }
    }

    // Actualizar la materia en el día específico del horario
    public function actualizarMateria($id, $dia, $materia)
    {
        $horario = Horario::find($id);

        if ($horario) {
            $horario->$dia = $materia ?: null; // Si no se selecciona una materia, se asigna null
            $horario->save();
        }
    }

    public function render()
    {
        $grados = Grade::where('level_id', $this->level_id)->get();

        return view('livewire.action.horario-clase', compact('grados'));
    }
}

