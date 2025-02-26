<?php

namespace App\Livewire\Action;

use Livewire\Component;
use Illuminate\Support\Str;

class CrearAccion extends Component
{

    public $accion;
    public $slug;

    protected $rules = [
        'accion' => 'required|unique:actions,accion',
        'slug' => 'required|unique:actions,slug'
    ];

    protected $messages = [
        'accion.required' => 'El campo acción es obligatorio',
        'accion.unique' => 'La acción ya existe',
        'slug.required' => 'El campo slug es obligatorio',
        'slug.unique' => 'El slug ya existe',
    ];



    public function updatedAccion($value)
    {
        // Genera el slug automáticamente cuando el título cambia
        $this->slug = Str::slug(trim($value));
    }


    public function guardarAccion(){
        $this->validate();

        // dd($this->accion, $this->slug);

        \App\Models\Action::create([
            'accion' => trim($this->accion),
            'slug' => Str::slug($this->accion)
        ]);

        $this->reset(['accion', 'slug']);

        $this->dispatch('swal', [
            'title' => 'Acción creada con éxito!',
            'icon' => 'success',
            'position' => 'top-end',
        ]);


        $this->dispatch('resfreshTable');



    }

    public function render()
    {
        return view('livewire.action.crear-accion');
    }
}
