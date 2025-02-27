<?php

namespace App\Livewire\Group;

use App\Models\Grade;
use App\Models\Group;
use App\Models\Level;
use Livewire\Component;

class CrearGrupo extends Component
{

    public $grupo;
    public $level_id;

    public $grade_id;
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
        'level_id.required' => 'El nivel es requerido.',
        'level_id.exists' => 'El nivel seleccionado no existe.',
        'grade_id.required' => 'El grado es requerido.',
        'grade_id.exists' => 'El grado seleccionado no existe.',

    ];


    public function updated($propertyName) // ACTUALIZAR EN TIEMPO REAL
    {

        $this->validateOnly($propertyName);

        if ($propertyName == 'level_id') {
            $this->grados = Grade::where('level_id', $this->level_id)
                ->orderBy('grado', 'ASC')
                    ->get();
        }
    }

    public function guardarGrupo()
    {
        $this->validate();

           // Verificar la combinación duplicada de anio_inicio, anio_termino y level_id
           $exists = Group::where('level_id', $this->level_id)
           ->where('grade_id', $this->grade_id)
           ->where('grupo', $this->grupo)
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

        Group::create([
            'level_id' => $this->level_id,
            'grade_id' => $this->grade_id,
            'grupo' => strtoupper(trim($this->grupo)),

        ]);

        $this->reset('grupo', 'level_id', 'grade_id');


        $this->dispatch('resfreshTable');

        $this->dispatch('grupos');




        // session()->flash('mensaje', '¡Grado creado con éxito!');
        $this->dispatch('swal', [
            'title' => '¡Grupo creado con éxito!',
            'icon' => 'success',
            'position' => 'top',
        ]);





    }




    public function render()
    {
        $niveles = Level::orderBy('sort', 'ASC')->get();

        return view('livewire.group.crear-grupo', compact('niveles'));
    }
}
