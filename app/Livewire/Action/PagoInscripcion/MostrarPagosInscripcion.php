<?php

namespace App\Livewire\Action\PagoInscripcion;

use App\Models\PagoInscripcion;
use App\Models\Student;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class MostrarPagosInscripcion extends Component
{
    public $level_id;
    public $termino;
    use WithPagination;


    public function updatingTermino() // Reseatear la paginación cuando se realiza una búsqueda en el input de búsqueda de la tabla
    {
        $this->resetPage();
    }


    #[On('refreshInscripcion')]
    public function refreshInscripcion()
    {
        $this->termino = '';
    }


    public function render()
    {

        $recibos = PagoInscripcion::where('level_id', $this->level_id)
        ->where(function ($query) {
            $query->where('nombre_pago', 'like', '%' . $this->termino . '%')
                ->orWhere('tipo_pago', 'like', '%' . $this->termino . '%')
                ->orWhere('folio', 'like', '%' . $this->termino . '%')
              ->orWhereHas('student', function ($query) { // RELACION CON STUDENT
                  $query->where('nombre', 'like', '%' . $this->termino . '%')
                    ->orWhere('apellido_paterno', 'like', '%' . $this->termino . '%')
                    ->orWhere('apellido_materno', 'like', '%' . $this->termino . '%')
                    ->orWhere('matricula', 'like', '%' . $this->termino . '%')
                    ->orWhere('CURP', 'like', '%' . $this->termino . '%');
              });
        })
        ->latest('id')
        ->paginate(10);




        return view('livewire.action.pago-inscripcion.mostrar-pagos-inscripcion', compact('recibos'));
    }
}
