<?php

namespace App\Livewire\Personnel;

use App\Models\Personnel;
use Faker\Provider\ar_EG\Person;
use Livewire\Component;

class CrearPersonal extends Component
{
    public $titulo;
    public $nombre;
    public $apellido_paterno;
    public $apellido_materno;
    public $CURP;
    public $RFC;
    public $email;
    public $telefono;
    public $direccion;
    public $perfil;


    protected $rules = [
        'titulo' => 'required',
        'nombre' => 'required',
        'apellido_paterno' => 'required',
        'apellido_materno' => 'required',
        'CURP' => 'required|unique:personnels,CURP|max:18|min:18',
        'RFC' => 'required|unique:personnels,RFC|max:13|min:13',
        'email' => 'required|email|unique:personnels,email',
        'telefono' => 'required|unique:personnels,telefono|max:10|min:10',
        'direccion' => 'required|max:255',
        'perfil' => 'required',
    ];

    protected $messages = [
        'titulo.required' => 'El campo título es requerido',
        'nombre.required' => 'El campo nombre es requerido',
        'apellido_paterno.required' => 'El campo apellido paterno es requerido',
        'apellido_materno.required' => 'El campo apellido materno es requerido',
        'CURP.required' => 'El campo CURP es requerido',
        'CURP.unique' => 'El CURP ya existe',
        'CURP.max' => 'El CURP debe tener 18 caracteres',
        'CURP.min' => 'El CURP debe tener 18 caracteres',
        'RFC.required' => 'El campo RFC es requerido',
        'RFC.unique' => 'El RFC ya existe',
        'RFC.max' => 'El RFC debe tener 13 caracteres',
        'RFC.min' => 'El RFC debe tener 13 caracteres',
        'email.required' => 'El campo email es requerido',
        'email.email' => 'El email no es válido',
        'email.unique' => 'El email ya existe',
        'telefono.required' => 'El campo teléfono es requerido',
        'telefono.numeric' => 'El teléfono debe ser numérico',
        'telefono.unique' => 'El teléfono ya existe',
        'telefono.max' => 'El teléfono debe tener 10 caracteres',
        'telefono.min' => 'El teléfono debe tener 10 caracteres',
        'direccion.required' => 'El campo dirección es requerido',
        'direccion.max' => 'La dirección debe tener máximo 255 caracteres',
        'perfil.required' => 'El campo perfil es requerido',
    ];



    public function guardarPersonal(){
        $this->validate();

        Personnel::create([
            'titulo' => $this->titulo,
            'nombre' => $this->nombre,
            'apellido_paterno' => $this->apellido_paterno,
            'apellido_materno' => $this->apellido_materno,
            'CURP' => $this->CURP,
            'RFC' => $this->RFC,
            'email' => $this->email,
            'telefono' => $this->telefono,
            'direccion' => $this->direccion,
            'perfil' => $this->perfil,
        ]);


        $this->reset();
        $this->dispatch('swal', [
            'title' => 'Nuevo personal adscrito',
            'icon' => 'success',
            'position' => 'top',
        ]);
    }




    public function render()
    {
        return view('livewire.personnel.crear-personal');
    }
}
