<?php

namespace App\Livewire\Action;

use App\Models\Horario;
use App\Models\Materia;
use Livewire\Component;

class HorarioClase extends Component
{
    public $materias;
    public $level_id;
    public $horarios = [];

    // Se carga el nivel y los horarios en la inicialización
    public function mount($level_id)
    {
        $this->level_id = $level_id;  // Asegúrate de que se pase el level_id correctamente
        $this->horarios = Horario::all()->keyBy('id'); // keyBy('id') organiza los horarios con el id como clave
        $this->materias = Materia::where('level_id', $this->level_id)->get();  // Cargar materias desde la base de datos



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
        return view('livewire.action.horario-clase');
    }
}

