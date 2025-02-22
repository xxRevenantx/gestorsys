<?php

namespace App\Livewire\Tutor;

use App\Models\Tutor;
use Livewire\Component;

class EditarTutor extends Component
{
    public $tutor;
    public $tutor_id;
    public $CURP;
    public $nombre;
    public $apellido_paterno;
    public $apellido_materno;
    public $calle;
    public $num_ext;
    public $num_int;
    public $localidad;
    public $colonia;
    public $CP;
    public $municipio;
    public $estado;
    public $telefono;
    public $celular;
    public $email;
    public $parentesco;
    public $ocupacion;
    public $ultimo_grado;

    protected $messages = [
        'CURP.min' => 'La CURP debe tener 18 caracteres',
        'CURP.max' => 'La CURP debe tener 18 caracteres',
        'CURP.unique' => 'La CURP ya existe',
        'nombre.required' => 'El nombre es requerido',
        'apellido_paterno.required' => 'El apellido paterno es requerido',
        'apellido_materno.required' => 'El apellido materno es requerido',
        'telefono.numeric' => 'El teléfono debe ser numérico',
        'telefono.digits' => 'El teléfono debe tener 10 dígitos',
        'celular.numeric' => 'El celular debe ser numérico',
        'celular.digits' => 'El celular debe tener 10 dígitos',
        'email.email' => 'El email debe ser válido',
    ];

    // public function updated($propertyName) // ACTUALIZAR EN TIEMPO REAL
    // {
    //     $this->validateOnly($propertyName);
    // }


    public function mount($tutor){
        $this->tutor_id = $tutor->id;
        $this->CURP = $tutor->CURP;
        $this->nombre = $tutor->nombre;
        $this->apellido_paterno = $tutor->apellido_paterno;
        $this->apellido_materno = $tutor->apellido_materno;
        $this->calle = $tutor->calle;
        $this->num_ext = $tutor->num_ext;
        $this->num_int = $tutor->num_int;
        $this->localidad = $tutor->localidad;
        $this->colonia = $tutor->colonia;
        $this->CP = $tutor->CP;
        $this->municipio = $tutor->municipio;
        $this->estado = $tutor->estado;
        $this->telefono = $tutor->telefono;
        $this->celular = $tutor->celular;
        $this->email = $tutor->email;
        $this->parentesco = $tutor->parentesco;
        $this->ocupacion = $tutor->ocupacion;
        $this->ultimo_grado = $tutor->ultimo_grado;
    }

    public function actualizarTutor()
    {
        $this->validate([
            'CURP' => 'unique:tutors,CURP,'.$this->tutor_id,
            'nombre' => 'required|string',
            'apellido_paterno' => 'required|string',
            'apellido_materno' => 'required|string',
            'calle' => 'nullable|string',
            'localidad' => 'nullable|string',
            'colonia' => 'nullable|string',
            'municipio' => 'nullable|string',
            'estado' => 'nullable|string',
            'telefono' => 'nullable|numeric|digits:10',
            'celular' => 'nullable|numeric|digits:10',
            'email' => 'nullable|email|unique:tutors,email,'.$this->tutor_id,
            'ultimo_grado' => 'nullable|string',


        ]);

        $tutor = Tutor::find($this->tutor_id);

        $tutor->CURP =  strtoupper(trim($this->CURP));
        $tutor->nombre = trim($this->nombre);
        $tutor->apellido_paterno = trim($this->apellido_paterno);
        $tutor->apellido_materno = trim($this->apellido_materno);
        $tutor->calle = trim($this->calle);
        $tutor->num_ext = trim($this->num_ext);
        $tutor->num_int = trim($this->num_int);
        $tutor->localidad = trim($this->localidad);
        $tutor->colonia = trim($this->colonia);
        $tutor->CP = trim($this->CP);
        $tutor->municipio = trim($this->municipio);
        $tutor->estado = trim($this->estado);
        $tutor->telefono = trim($this->telefono);
        $tutor->celular = trim($this->celular);
        $tutor->email = trim($this->email);
        $tutor->parentesco = trim($this->parentesco);
        $tutor->ocupacion = trim($this->ocupacion);
        $tutor->ultimo_grado = trim($this->ultimo_grado);



        $tutor->save();



        $this->reset(['CURP', 'nombre', 'apellido_paterno', 'apellido_materno', 'calle', 'num_ext', 'num_int', 'localidad', 'colonia', 'CP', 'municipio', 'estado', 'telefono', 'celular', 'email', 'parentesco', 'ocupacion', 'ultimo_grado']);

        session()->flash('mensaje', '¡Tutor actualizado correctamente!');

        return redirect()->route('admin.tutors.index');




    }

    public function render()
    {
        return view('livewire.tutor.editar-tutor');
    }
}
