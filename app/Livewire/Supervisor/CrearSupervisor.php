<?php

namespace App\Livewire\Supervisor;

use App\Models\Supervisor;
use Livewire\Component;

class CrearSupervisor extends Component
{

    public $nombre;
    public $apellido_paterno;
    public $apellido_materno;
    public $email;
    public $telefono;
    public $zona;
    public $sector;


    protected $rules = [
        'nombre' => 'required',
        'apellido_paterno' => 'required',
        'apellido_materno' => 'required',
        'email' => 'nullable|email',
        'telefono' => 'nullable|numeric|min:10',
    ];

    protected $messages = [
        'nombre.required' => 'El campo nombre es requerido.',
        'apellido_paterno.required' => 'El campo apellido paterno es requerido.',
        'email.email' => 'El campo email debe ser un correo válido.',
        'telefono.numeric' => 'El campo teléfono debe ser un número.',
        'telefono.digits' => 'El campo teléfono debe tener 10 dígitos.',
    ];

    public function updated($propertyName) // ACTUALIZAR EN TIEMPO REAL
    {
        $this->validateOnly($propertyName);
    }



    public function guardarSupervisor()
    {
        $this->validate();


        Supervisor::create([
            'nombre' => $this->nombre,
            'apellido_paterno' => $this->apellido_paterno,
            'apellido_materno' => $this->apellido_materno,
            'email' => $this->email,
            'telefono' => $this->telefono,
            'zona' => $this->zona,
            'sector' => $this->sector,
        ]);

        $this->reset();

        session()->flash('mensaje', 'Supervisor creado correctamente.');

        return redirect()->route('admin.supervisores.index');
    }



    public function render()
    {
        return view('livewire.supervisor.crear-supervisor');
    }
}
