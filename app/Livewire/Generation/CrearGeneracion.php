<?php

namespace App\Livewire\Generation;

use App\Models\Generation;
use App\Models\Level;
use Livewire\Component;

class CrearGeneracion extends Component
{

    public $anio_inicio;
    public $anio_termino;
    public $status;
    public $level_id;

    protected $rules = [
        'anio_inicio' => 'required|integer|digits:4',
        'anio_termino' => 'required|integer|digits:4',
        'status' => 'required|integer|in:0,1',
        'level_id' => 'required|integer|exists:levels,id',
    ];

    protected $messages = [
        'anio_inicio.required' => 'El campo año de inicio es requerido',
        'anio_inicio.integer' => 'El campo año de inicio debe ser un número entero',
        'anio_inicio.min' => 'El campo año de inicio debe tener al menos 4 números',
        'anio_termino.required' => 'El campo año de término es requerido',
        'anio_termino.integer' => 'El campo año de término debe ser un número entero',
        'anio_termino.min' => 'El campo año de término debe tener al menos 4 números',
        'status.required' => 'El campo status es requerido',
        'status.integer' => 'El campo status debe ser un número entero',
        'status.in' => 'El campo status es desconocido',
        'level_id.required' => 'El campo nivel es requerido',
        'level_id.integer' => 'El campo nivel debe ser un número entero',
        'level_id.exists' => 'El nivel seleccionado no existe',
    ];





    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function guardarGeneracion()
    {
        $this->validate();

        // Verificar la combinación duplicada de anio_inicio, anio_termino y level_id
        $exists = Generation::where('anio_inicio', $this->anio_inicio)
            ->where('anio_termino', $this->anio_termino)
            ->where('level_id', $this->level_id)
            ->exists();

        if ($exists) {
            session()->flash('error', 'La combinación de año de inicio, año de término y nivel ya existe.');
            return;
        }

        Generation::create([
            'anio_inicio' => trim($this->anio_inicio),
            'anio_termino' => trim($this->anio_termino),
            'status' => $this->status,
            'level_id' => $this->level_id,
        ]);

        $this->reset(['anio_inicio', 'anio_termino', 'status', 'level_id']);

        // session()->flash('mensaje', '¡Generación creada con éxito!');

        $this->dispatch('swal', [
            'title' => '¡Generación creada con éxito!',
            'icon' => 'success',
            'position' => 'top-end',
        ]);

        $this->dispatch('resfreshTable');

    }

    public function render()
    {
        $niveles = Level::orderBy('sort', 'ASC')->get();
        return view('livewire.generation.crear-generacion', compact('niveles'));
    }
}
