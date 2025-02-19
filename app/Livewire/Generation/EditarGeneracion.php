<?php

namespace App\Livewire\Generation;

use App\Models\Generation;
use App\Models\Level;
use Livewire\Component;

class EditarGeneracion extends Component
{

    public $generacion;
    public $generacion_id;
    public $anio_inicio;
    public $anio_termino;
    public $status;
    public $level_id;



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


    public function mount($generacion)
    {
        $this->generacion_id = $generacion->id;
        $this->anio_inicio = $generacion->anio_inicio;
        $this->anio_termino = $generacion->anio_termino;
        $this->status = $generacion->status;
        $this->level_id = $generacion->level_id;
    }


    public function actualizarGeneracion()
    {
        $this->validate([
            'anio_inicio' => 'required|integer|min:4',
            'anio_termino' => 'required|integer|min:4',
            'status' => 'required|integer|in:0,1',
            'level_id' => 'required|integer|exists:levels,id',
        ]);

        // Verificar la combinación duplicada de anio_inicio, anio_termino y level_id
        $exists = Generation::where('anio_inicio', $this->anio_inicio)
            ->where('anio_termino', $this->anio_termino)
            ->where('level_id', $this->level_id)
            ->where('id', '!=', $this->generacion_id)
            ->exists();

        if ($exists) {
            session()->flash('error', 'La combinación de año de inicio, año de término y nivel ya existe.');
            return;
        }

        $generacion = Generation::find($this->generacion_id);
        $generacion->anio_inicio = trim($this->anio_inicio);
        $generacion->anio_termino = trim($this->anio_termino);
        $generacion->status = $this->status;
        $generacion->level_id = $this->level_id;
        $generacion->save();

        $this->reset(['anio_inicio', 'anio_termino', 'status', 'level_id']);

        session()->flash('mensaje', '¡Generación actualizada con éxito!');

        return redirect()->route('admin.generations.index');
    }


    public function render()
    {

        $niveles = Level::orderBy('sort', 'ASC')->get();
        return view('livewire.generation.editar-generacion', compact('niveles'));
    }
}
