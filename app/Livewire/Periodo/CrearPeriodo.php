<?php

namespace App\Livewire\Periodo;

use App\Models\Periodo;
use Livewire\Component;

class CrearPeriodo extends Component
{

    public $num_periodo;
    public $fechas;


    public function placeholder(){
        return view('placeholder');
    }

    public function guardarPeriodo(){
        $this->validate([
            'num_periodo' => 'required|numeric|min:1|unique:periodos,num_periodo',
            'fechas' => 'required|string|unique:periodos,fechas',
        ],[
            'num_periodo.unique' => 'El número de periodo ya existe',
            'num_periodo.required' => 'El número de periodo es requerido',
            'num_periodo.min' => 'El número de periodo debe ser mayor a 0',
            'fechas.required' => 'Las fechas son requeridas',
            'fechas.unique' => 'Las fechas ya existen',
        ]);

        Periodo::create([
            'num_periodo' => $this->num_periodo,
            'fechas' => $this->fechas,
        ]);

        $this->reset(['num_periodo', 'fechas']);



        $this->dispatch('swal', [
            'title' => '¡Periodo creado correctamente!',
            'icon' => 'success',
            'position' => 'top',
        ]);
    }


    public function render()
    {
        return view('livewire.periodo.crear-periodo');
    }
}
