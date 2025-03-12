<?php

namespace App\Livewire\Personnel;

use Livewire\Component;

class MostrarPersonal extends Component
{

    public $personnel;
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


    public function placeholder(){
        return view('placeholder');
    }

    public function render()
    {
        return view('livewire.personnel.mostrar-personal');
    }
}
