<?php

namespace App\Livewire\Group;

use App\Models\Group;
use Livewire\Component;

class CrearGrupo extends Component
{

    public $grupo;

    protected $rules = [
        'grupo' => 'required|max:1|string|unique:groups,grupo',
    ];

    protected $messages = [
        'grupo.required' => 'El campo grupo es requerido',
        'grupo.min' => 'El campo grupo debe tener al menos 1 caracter',
        'grupo.string' => 'El campo grupo debe ser un texto',
    ];

    public function updated($propertyName) // ACTUALIZAR EN TIEMPO REAL
    {
        $this->validateOnly($propertyName);
    }

    public function guardarGrupo()
    {
        $this->validate();

        Group::create([
            'grupo' => strtoupper(trim($this->grupo)),
        ]);

        $this->reset('grupo');

        session()->flash('mensaje', '¡Grupo creado con éxito!');

        return redirect()->route('admin.groups.index');
    }




    public function render()
    {
        return view('livewire.group.crear-grupo');
    }
}
