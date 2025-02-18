<?php

namespace App\Livewire\Supervisor;

use App\Models\Supervisor;
use Livewire\Component;

class EditarSupervisor extends Component
{

    public $supervisor;
    public $supervisor_id;
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
    ];



    public function mount($supervisor)
    {
        $this->supervisor = $supervisor;
        $this->supervisor_id = $supervisor->id;
        $this->nombre = $supervisor->nombre;
        $this->apellido_paterno = $supervisor->apellido_paterno;
        $this->apellido_materno = $supervisor->apellido_materno;
        $this->email = $supervisor->email;
        $this->telefono = $supervisor->telefono;
        $this->zona = $supervisor->zona;
        $this->sector = $supervisor->sector;
    }

    public function actualizarSupervisor(){
        $this->validate();

        $supervisor = Supervisor::find($this->supervisor_id);
        $supervisor->update([
            'nombre' => $this->nombre,
            'apellido_paterno' => $this->apellido_paterno,
            'apellido_materno' => $this->apellido_materno,
            'email' => $this->email,
            'telefono' => $this->telefono,
            'zona' => $this->zona,
            'sector' => $this->sector,
        ]);



        session()->flash('mensaje', 'Supervisor actualizado con éxito');
        $this->reset();

        return redirect()->route('admin.supervisores.index');


    }


    public function render()
    {
        return view('livewire.supervisor.editar-supervisor');
    }
}
