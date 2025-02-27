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

    public function mount($grado){
        $this->grado_id = $grado->id;
        $this->grado = $grado->grado;
        $this->level_id = $grado->level_id;
        $this->generation_id = $grado->generation_id;
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
        $exists = Grade::where('grado', $this->grado)
            ->where('level_id', $this->level_id)
            ->where('generation_id', $this->generation_id)
            ->where('id', '!=', $this->grado_id)
            ->exists();

        if ($exists) {
            session()->flash('error', 'Estos campos ya existen, verifica tus campos y tu tabla.');
            return;
        }

        $grado = Grade::find($this->grado_id);
        $grado->grado = trim($this->grado);
        $grado->level_id = $this->level_id;
        $grado->generation_id = $this->generation_id;

        $grado->save();

        $this->reset('grado', 'level_id', 'generation_id');

        session()->flash('mensaje', '¡Grado actualizado con éxito!');

        return redirect()->route('admin.grades.index');
    }

    public function render()
    {
        $niveles = Level::orderBy('sort', 'ASC')->get();
        $generaciones = Generation::where('level_id', $this->level_id)
                        ->where('status', 1)
                        ->get();

        return view('livewire.grade.editar-grado', compact('niveles', 'generaciones'));
    }
}
