<?php

namespace App\Livewire\Grade;

use App\Models\Generation;
use App\Models\Grade;
use App\Models\Group;
use App\Models\Level;
use Livewire\Component;

class EditarGrado extends Component
{


    public $grados;
    public $grado_id;
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

    public function mount($grado){
        $this->grado_id = $grado->id;
        $this->grado = $grado->grado;
        $this->grado_numero = $grado->grado_numero;
        $this->level_id = $grado->level_id;
        $this->generation_id = $grado->generation_id;
        $this->group_id = $grado->group_id;
        $this->generaciones = Generation::where('level_id', $this->level_id)
                            ->where('status', 1)
                            ->get();
    }

    public function updated($propertyName) // ACTUALIZAR EN TIEMPO REAL
    {
        $this->validateOnly($propertyName);

        if ($propertyName == 'level_id') {
            $this->generaciones = Generation::where('level_id', $this->level_id)
                            ->where('status', 1)
                            ->get();
        }
    }

    public function actualizarGrado()
    {
        $this->validate();

        // Verificar la combinación duplicada de grado_numero, level_id, generation_id y group_id
        $exists = Grade::where('grado_numero', $this->grado_numero)
            ->where('level_id', $this->level_id)
            ->where('generation_id', $this->generation_id)
            ->where('group_id', $this->group_id)
            ->where('id', '!=', $this->grado_id)
            ->exists();

        if ($exists) {
            session()->flash('error', 'Estos campos ya existen, verifica tus campos y tu tabla.');
            return;
        }

        $grado = Grade::find($this->grado_id);
        $grado->grado = trim($this->grado);
        $grado->grado_numero = $this->grado_numero;
        $grado->level_id = $this->level_id;
        $grado->generation_id = $this->generation_id;
        $grado->group_id = $this->group_id;

        $grado->save();

        $this->reset('grado', 'grado_numero', 'level_id', 'generation_id', 'group_id');

        session()->flash('mensaje', '¡Grado actualizado con éxito!');

        return redirect()->route('admin.grades.index');
    }

    public function render()
    {
        $niveles = Level::orderBy('sort', 'ASC')->get();
        $grupos = Group::orderBy('grupo', 'ASC')->get();
        $generaciones = Generation::where('level_id', $this->level_id)
                        ->where('status', 1)
                        ->get();

        return view('livewire.grade.editar-grado', compact('niveles', 'grupos', 'generaciones'));
    }
}
