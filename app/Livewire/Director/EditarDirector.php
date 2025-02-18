<?php

namespace App\Livewire\Director;

use App\Models\Director;
use Livewire\Component;

class EditarDirector extends Component
{

    public $director;
    public $director_id;
    public $nombre;
    public $apellido_paterno;
    public $apellido_materno;
    public $email;
    public $telefono;



    public function mount(){
        $this->nombre = $this->director->nombre;
        $this->director_id = $this->director->id;
        $this->apellido_paterno = $this->director->apellido_paterno;
        $this->apellido_materno = $this->director->apellido_materno;
        $this->email = $this->director->email;
        $this->telefono = $this->director->telefono;
    }


    public function actualizarDirector(){
        $this->validate([
            'nombre' => 'required',
            'apellido_paterno' => 'required',
            'apellido_materno' => 'required',
            'email' => 'nullable|email|unique:directors,email,'.$this->director_id,
            'telefono' => 'nullable|numeric|min:10',
        ]);

        $director = Director::find($this->director_id);
        $director->update([
            'nombre' => $this->nombre,
            'apellido_paterno' => $this->apellido_paterno,
            'apellido_materno' => $this->apellido_materno,
            'email' => $this->email,
            'telefono' => $this->telefono,
        ]);



        session()->flash('mensaje', 'Director actualizado con éxito');
        $this->reset();

        return redirect()->route('admin.directores.index');


    }


    public function render()
    {
        return view('livewire.director.editar-director');
    }
}
