<?php

namespace App\Livewire\Group;

use App\Models\Group;
use Livewire\Component;

class EditarGrupo extends Component
{

    public $grupo;
    public $grupo_id;



    public function actualizarGrupo()
    {
        $this->validate([
            'grupo' => 'required|max:1|string|unique:groups,grupo,' . $this->grupo_id,

        ]);


        Group::find($this->grupo_id)->update([
            'grupo' => strtoupper(trim($this->grupo))
        ]);


        session()->flash('mensaje', 'Grupo actualizado con éxito');

        return redirect()->route('admin.groups.index');

    }


    public function mount($grupo)
    {
        $this->grupo_id = $grupo->id;
        $this->grupo = $grupo->grupo;
    }


    public function render()
    {
        return view('livewire.group.editar-grupo');
    }
}
