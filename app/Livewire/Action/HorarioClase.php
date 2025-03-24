<?php

namespace App\Livewire\Action;

use App\Models\Action;
use App\Models\Grade;
use App\Models\Horario;
use App\Models\Level;
use App\Models\Materia;
use Livewire\Component;

class HorarioClase extends Component
{
    public $materias;
    public $grade_id;
    public $level_id;
    public $horarios = [];


    // VARIABLES GET
    public $level;
    public $action;
    public $grade; // GRADO SELECCIONADO


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
        ];
    }

    $this->materias = Materia::where('level_id', $this->level_id)->get();

    $this->level = Level::find($this->level_id);
    $this->action = Action::where('slug', 'horarios')->first();
    $this->grade_id = $this->grade->id; // GRADO SELECCIONADO POR DEFECTO EN EL SELECT DE GRADOS EN LA VISTA DE MATRICULA ESCOLAR


    }

    // Actualizar la materia en el día específico del horario
    public function actualizarMateria($id, $dia, $materia)
    {
        // Asegurarse de que la materia no esté vacía antes de actualizar
        if (empty($materia)) {
            return; // No hacer nada si no hay materia seleccionada
        }

        $horario = Horario::find($id);

        if ($horario) {
            $horario->$dia = $materia;
            $horario->save();

            // Disparar notificación de éxito
            $this->dispatch('swal', [
                'icon' => 'success',
                'position' => 'top',
                'text' => 'Horario actualizado correctamente.',
            ]);
        }
    }

    public function render()
    {
        $grados = Grade::where('level_id', $this->level_id)->get();

        return view('livewire.action.horario-clase', compact('grados'));
    }
}

