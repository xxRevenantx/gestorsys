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
    public $genero;


    protected $rules = [
        'titulo' => 'required',
        'nombre' => 'required',
        'apellido_paterno' => 'required',
        'apellido_materno' => 'required',
        'CURP' => 'nullable|unique:personnels,CURP|max:18|min:18',
        'RFC' => 'nullable|unique:personnels,RFC',
        'email' => 'nullable|email|unique:personnels,email',
        'telefono' => 'nullable|unique:personnels,telefono|numeric|digits:10',
        'direccion' => 'nullable|max:255',
        'perfil' => 'required',
        'genero' => 'required|in:H,M',
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
        'genero.required' => 'El campo género es requerido',
        'genero.in' => 'El género debe ser H (Hombre) o M(Mujer)',
    ];



    public function guardarPersonal(){
        $this->validate();

        Personnel::create([
            'titulo' => $this->titulo ?: null,
            'nombre' => trim(strtoupper($this->nombre)) ?: null,
            'apellido_paterno' => trim(strtoupper($this->apellido_paterno)) ?: null,
            'apellido_materno' => trim(strtoupper($this->apellido_materno)) ?: null,
            'CURP' => trim(strtoupper($this->CURP)) ?: null,
            'RFC' => trim(strtoupper($this->RFC)) ?: null,
            'email' => trim(strtoupper($this->email)) ?: null,
            'telefono' => trim($this->telefono) ?: null,
            'direccion' => trim(strtoupper($this->direccion)) ?: null,
            'perfil' => trim(strtoupper($this->perfil)) ?: null,
            'genero' => $this->genero ?: null,

        ]);


        $this->reset();
        $this->dispatch('swal', [
            'title' => 'Nuevo personal adscrito',
            'icon' => 'success',
            'position' => 'top',
        ]);

        $this->dispatch('resfreshTable');
    }




    public function render()
    {
        return view('livewire.personnel.crear-personal');
    }
}
