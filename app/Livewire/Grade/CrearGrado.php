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
    public $grado_numero;
    public $level_id;
    public $generation_id;
    public $group_id;
    public $generaciones = [];


    protected $rules = [
        'grado' => 'required|string',
        'grado_numero' => 'required|integer',
        'level_id' => 'required|exists:levels,id',
        'generation_id' => 'required|exists:generations,id',
        'group_id' => 'required|exists:groups,id',
    ];

    protected $messages = [
        'grado.required' => 'El nombre del grado es requerido.',
        'grado.string' => 'El nombre del grado debe ser una cadena de texto.',
        'grado_numero.required' => 'El número del grado es requerido.',
        'grado_numero.min' => 'El número del grado debe ser mínimo 1.',
        'grado_numero.max' => 'El número del grado debe ser máximo 1.',
        'grado_numero.integer' => 'El número del grado debe ser un número entero.',
        'level_id.required' => 'El nivel es requerido.',
        'level_id.exists' => 'El nivel seleccionado no existe.',
        'generation_id.required' => 'La generación es requerida.',
        'generation_id.exists' => 'La generación seleccionada no existe.',
        'group_id.required' => 'El grupo es requerido.',
        'group_id.exists' => 'El grupo seleccionado no existe.',
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
          $exists = Grade::where('grado_numero', $this->grado_numero)
          ->where('level_id', $this->level_id)
          ->where('generation_id', $this->generation_id)
            ->where('group_id', $this->group_id)
          ->exists();

      if ($exists) {
          session()->flash('error', 'Estos campos ya existen, verifica tus campos y tu tabla.');
          return;
      }

        Grade::create([
            'grado' => strtolower(trim($this->grado)),
            'grado_numero' => $this->grado_numero,
            'level_id' => $this->level_id,
            'generation_id' => $this->generation_id,
            'group_id' => $this->group_id,
        ]);

        $this->reset('grado', 'grado_numero', 'level_id', 'generation_id', 'group_id');

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
        $grupos = Group::orderBy('grupo', 'ASC')->get();
        return view('livewire.grade.crear-grado', compact('niveles', 'grupos'));
    }
}
