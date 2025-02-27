<?php

namespace App\Livewire\Group;

use App\Models\Grade;
use App\Models\Group;
use App\Models\Level;
use Livewire\Component;

class EditarGrupo extends Component
{

    public $grupo;
    public $grupo_id;
    public $grade_id;
    public $level_id;

    public $grados = [];


    protected $rules = [
        'grupo' => 'required|max:1|string',
        'level_id' => 'required|exists:levels,id',
        'grade_id' => 'required|exists:grades,id',

    ];

    protected $messages = [
        'grupo.required' => 'El campo grupo es requerido',
        'grupo.min' => 'El campo grupo debe tener al menos 1 caracter',
        'grupo.string' => 'El campo grupo debe ser un texto',
    ];


    public function mount($grupo)
    {
        $this->grupo_id = $grupo->id;
        $this->grupo = $grupo->grupo;
        $this->grade_id = $grupo->grade_id;
        $this->level_id = $grupo->level_id;

        $this->grados = Grade::where('level_id', $this->level_id)
            ->get();


    }



    public function updated($propertyName) // ACTUALIZAR EN TIEMPO REAL
    {

        $this->validateOnly($propertyName);

        if ($propertyName == 'level_id') {
            $this->grados = Grade::where('level_id', $this->level_id)
                    ->get();
        }
    }


    public function actualizarGrupo()
    {
        $this->validate();

        // Verificar la combinación duplicada de anio_inicio, anio_termino y level_id
        $exists = Group::where('level_id', $this->level_id)
        ->where('grade_id', $this->grade_id)
        ->where('grupo', $this->grupo)
        ->where('id', '!=', $this->grupo_id)
        ->exists();

        if ($exists) {
            //    session()->flash('error', 'Estos campos ya existen, verifica tus campos y tu tabla.');
               $this->dispatch('swal', [
                'title' => 'Estos campos ya existen, verifica tus campos y tu tabla.',
                'icon' => 'error',
                'position' => 'top-end',
            ]);

               return;
           }


        Group::find($this->grupo_id)->update([
            'grupo' => $this->grupo,
            'level_id' => $this->level_id,
            'grade_id' => $this->grade_id,
        ]);


        session()->flash('mensaje', 'Grupo actualizado con éxito');

        return redirect()->route('admin.groups.index');

    }



    public function render()
    {
        $niveles = Level::all();
        $grados = Grade::all();
        return view('livewire.group.editar-grupo', compact('niveles', 'grados'));
    }
}
