<?php

namespace App\Livewire\Grade;

use App\Models\Generation;
use App\Models\Grade;
use App\Models\Group;
use App\Models\Level;
use Livewire\Component;

class CrearGrado extends Component
{

    public $grado;
    public $level_id;
    public $generation_id;
    public $generaciones = [];


    protected $rules = [
        'grado' => 'required|integer',
        'level_id' => 'required|exists:levels,id',
        'generation_id' => 'required|exists:generations,id',
    ];

    protected $messages = [
        'grado.required' => 'El nombre del grado es requerido.',
        'grado.integer' => 'El nombre del grado debe ser un número.',
        'level_id.required' => 'El nivel es requerido.',
        'level_id.exists' => 'El nivel seleccionado no existe.',
        'generation_id.required' => 'La generación es requerida.',
        'generation_id.exists' => 'La generación seleccionada no existe.',

    ];

    public function updated($propertyName) // ACTUALIZAR EN TIEMPO REAL
    {

        $this->validateOnly($propertyName);

        if ($propertyName == 'level_id') {
            $this->generaciones = Generation::where('level_id', $this->level_id)
                    ->where('status', 1)
                    ->get();
        }


    }

    public function guardarGrado()
    {
        $this->validate();

          // Verificar la combinación duplicada de anio_inicio, anio_termino y level_id
          $exists = Grade::where('grado', $this->grado)
          ->where('level_id', $this->level_id)
          ->where('generation_id', $this->generation_id)
          ->exists();

      if ($exists) {
          session()->flash('error', 'Estos campos ya existen, verifica tus campos y tu tabla.');
          return;
      }

        Grade::create([
            'grado' => strtolower(trim($this->grado)),
            'level_id' => $this->level_id,
            'generation_id' => $this->generation_id,
        ]);

        $this->reset('grado', 'level_id', 'generation_id');

        $this->dispatch('resfreshTable');
        // session()->flash('mensaje', '¡Grado creado con éxito!');
        $this->dispatch('swal', [
            'title' => '¡Grado creado con éxito!',
            'icon' => 'success',
            'position' => 'top-end',
        ]);

        // return redirect()->route('admin.grades.index');
    }



    public function render()
    {
        $niveles = Level::orderBy('sort', 'ASC')->get();
        return view('livewire.grade.crear-grado', compact('niveles'));
    }
}
