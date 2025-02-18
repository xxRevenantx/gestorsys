<?php

namespace App\Livewire\Director;

use App\Models\Director;
use Livewire\Component;

class CrearDirector extends Component
{

    public $nombre;
    public $apellido_paterno;
    public $apellido_materno;
    public $email;
    public $telefono;

    protected $rules = [
        'nombre' => 'required',
        'apellido_paterno' => 'required',
        'apellido_materno' => 'required',
        'email' => 'nullable|email|unique:directors,email',
        'telefono' => 'nullable|numeric|min:10',
    ];

    protected $messages = [
        'nombre.required' => 'El campo nombre es requerido.',
        'apellido_paterno.required' => 'El campo apellido paterno es requerido.',
        'apellido_materno.required' => 'El campo apellido materno es requerido.',
        'email.email' => 'El campo email debe ser un correo válido.',
        'telefono.numeric' => 'El campo teléfono debe ser un número.',
        'telefono.digits' => 'El campo teléfono debe tener 10 dígitos.',
    ];

    public function updated($propertyName) // ACTUALIZAR EN TIEMPO REAL
    {
        $this->validateOnly($propertyName);
    }



    public function guardarDirector()
    {
        $this->validate();


        Director::create([
            'nombre' => $this->nombre,
            'apellido_paterno' => $this->apellido_paterno,
            'apellido_materno' => $this->apellido_materno,
            'email' => $this->email,
            'telefono' => $this->telefono,
        ]);

        $this->reset();

        session()->flash('mensaje', 'Director creado correctamente.');

        return redirect()->route('admin.directores.index');
    }



    public function render()
    {
        return view('livewire.director.crear-director');
    }
}
