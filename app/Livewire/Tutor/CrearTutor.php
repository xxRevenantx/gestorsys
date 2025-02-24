<?php

namespace App\Livewire\Tutor;

use App\Models\Tutor;
use Livewire\Component;

class CrearTutor extends Component
{

    public $CURP, $nombre, $apellido_paterno, $apellido_materno, $calle;
    public $num_ext, $num_int, $localidad, $colonia, $CP;
    public $municipio, $estado, $telefono, $celular, $email, $parentesco, $ocupacion, $ultimo_grado;


    protected $rules = [
        'CURP' => 'unique:tutors|nullable',
        'nombre' => 'required|string',
        'apellido_paterno' => 'required|string',
        'apellido_materno' => 'required|string',
        'calle' => 'nullable|string',
        'num_ext' => 'nullable',
        'num_int' => 'nullable',
        'localidad' => 'nullable|string',
        'colonia' => 'nullable|string',
        'CP' => 'nullable',
        'municipio' => 'nullable|string',
        'estado' => 'nullable|string',
        'telefono' => 'nullable|numeric|digits:10',
        'celular' => 'nullable|numeric|digits:10',
        'email' => 'nullable|email|unique:tutors',
        'parentesco' => 'nullable',
        'ocupacion' => 'nullable',
        'ultimo_grado' => 'nullable',
    ];


    protected $messages = [
        'CURP.unique' => 'La CURP ya existe',
        'nombre.required' => 'El nombre es requerido',
        'apellido_paterno.required' => 'El apellido paterno es requerido',
        'apellido_materno.required' => 'El apellido materno es requerido',
        'telefono.numeric' => 'El teléfono debe ser numérico',
        'telefono.digits' => 'El teléfono debe tener 10 dígitos',
        'celular.numeric' => 'El celular debe ser numérico',
        'celular.digits' => 'El celular debe tener 10 dígitos',
        'email.email' => 'El email debe ser válido',
        'email.unique' => 'El email ya existe',

    ];

    public function updated($propertyName) // ACTUALIZAR EN TIEMPO REAL
    {
        $this->validateOnly($propertyName);
    }

    public function guardarTutor()
    {
        $this->validate();

        Tutor::create([
            'CURP' => strtoupper(trim($this->CURP)),
            'nombre' => trim($this->nombre),
            'apellido_paterno' => trim($this->apellido_paterno),
            'apellido_materno' => trim($this->apellido_materno),
            'calle' => trim($this->calle),
            'num_ext' => trim($this->num_ext),
            'num_int' => trim($this->num_int),
            'localidad' => trim($this->localidad),
            'colonia' => trim($this->colonia),
            'CP' => trim($this->CP),
            'municipio' => trim($this->municipio),
            'estado' => trim($this->estado),
            'telefono' => trim($this->telefono),
            'celular' => trim($this->celular),
            'email' => trim($this->email),
            'parentesco' => trim($this->parentesco),
            'ocupacion' => trim($this->ocupacion),
            'ultimo_grado' => trim($this->ultimo_grado),
        ]);


        $this->reset(['CURP', 'nombre', 'apellido_paterno', 'apellido_materno', 'calle', 'num_ext', 'num_int', 'localidad', 'colonia', 'CP', 'municipio', 'estado', 'telefono', 'celular', 'email', 'parentesco', 'ocupacion', 'ultimo_grado']);



        $this->dispatch('swal', [
            'title' => '¡Tutor creado correctamente!',
            'icon' => 'success',
            'position' => 'top-end',
        ]);

        $this->dispatch('resfreshTable');
        // session()->flash('mensaje', '¡Tutor creado correctamente!');


        // return redirect()->route('admin.tutors.index');

    }




    public function render()
    {
        return view('livewire.tutor.crear-tutor');
    }
}
