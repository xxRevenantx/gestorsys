<?php

namespace App\Livewire\Personnel;

use Livewire\Component;

class EditarPersonal extends Component
{
    public $personnel;
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


    public function mount($personnel)
    {
        $this->personnel = $personnel;
        $this->titulo = $personnel->titulo;
        $this->nombre = $personnel->nombre;
        $this->apellido_paterno = $personnel->apellido_paterno;
        $this->apellido_materno = $personnel->apellido_materno;
        $this->CURP = $personnel->CURP;
        $this->RFC = $personnel->RFC;
        $this->email = $personnel->email;
        $this->telefono = $personnel->telefono;
        $this->direccion = $personnel->direccion;
        $this->perfil = $personnel->perfil;
        $this->genero = $personnel->genero;
    }

    protected $rules = [
        'titulo' => 'required',
        'nombre' => 'required',
        'apellido_paterno' => 'required',
        'apellido_materno' => 'required',
        'direccion' => 'nullable|max:255',
        'perfil' => 'required',
        'genero' => 'required|in:H,M',
    ];

    protected $messages = [
        'titulo.required' => 'El campo título es requerido',
        'nombre.required' => 'El campo nombre es requerido',
        'apellido_paterno.required' => 'El campo apellido paterno es requerido',
        'apellido_materno.required' => 'El campo apellido materno es requerido',
        'direccion.required' => 'El campo dirección es requerido',
        'direccion.max' => 'La dirección debe tener máximo 255 caracteres',
        'perfil.required' => 'El campo perfil es requerido',
        'genero.required' => 'El campo género es requerido',
        'genero.in' => 'El género debe ser H (Hombre) o M(Mujer)',
    ];


    public function actualizarPersonal(){
        $this->validate([
            'CURP' => 'nullable|unique:personnels,CURP,'.$this->personnel->id.'|max:18|min:18',
            'RFC' => 'nullable|unique:personnels,RFC,'.$this->personnel->id,
            'email' => 'nullable|email|unique:personnels,email,'.$this->personnel->id,
            'telefono' => 'nullable|unique:personnels,telefono,'.$this->personnel->id.'|max:10|min:10',
        ],[
            'CURP.unique' => 'El CURP ya existe',
            'CURP.max' => 'El CURP debe tener 18 caracteres',
            'CURP.min' => 'El CURP debe tener 18 caracteres',
            'RFC.unique' => 'El RFC ya existe',
            'email.email' => 'El email no es válido',
            'email.unique' => 'El email ya existe',
            'telefono.unique' => 'El teléfono ya existe',
            'telefono.max' => 'El teléfono debe tener 10 caracteres',
            'telefono.min' => 'El teléfono debe tener 10 caracteres',

        ]);

        $this->personnel->update([
            'titulo' => $this->titulo,
            'nombre' => trim(strtoupper($this->nombre)),
            'apellido_paterno' => trim(strtoupper($this->apellido_paterno)),
            'apellido_materno' => trim(strtoupper($this->apellido_materno)),
            'CURP' => trim(strtoupper($this->CURP)),
            'RFC' => trim(strtoupper($this->RFC)),
            'email' => $this->email,
            'telefono' => trim($this->telefono),
            'direccion' => trim(strtoupper($this->direccion)),
            'perfil' => trim(strtoupper($this->perfil)),
            'genero' => $this->genero,
        ]);

        $this->dispatch('swal', [
            'title' => 'Personal Actualizado correctamente',
            'icon' => 'success',
            'position' => 'top',
        ]);
    }

    public function render()
    {
        return view('livewire.personnel.editar-personal');
    }
}
