<?php

namespace App\Livewire\Action\PagoColegiatura;

use App\Models\Colegiatura;
use App\Models\Month;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class MostrarColegiaturas extends Component
{
    public $level_id;
    public $termino;
    public $contar = 0;

    public $totalRegistros;

    use WithPagination;


    public function mount()
    {
        $this->totalRegistros = Colegiatura::where('level_id', $this->level_id)->count();
    }

    public function  updated($propertyName) // Reseatear la paginación cuando se realiza una búsqueda en el input de búsqueda de la tabla
    {
        if ($propertyName == 'termino') {
            $this->resetPage();

            if (!empty($this->termino)) {
                $this->contar = Colegiatura::where('level_id', $this->level_id)
                ->where(function ($query) {
                    $query->where('nombre_pago', 'like', '%' . $this->termino . '%')
                    ->orWhere('tipo_pago', 'like', '%' . $this->termino . '%')
                    ->orWhere('folio', 'like', '%' . $this->termino . '%')
                    ->orWhereRaw("DATE_FORMAT(fecha_pago, '%d/%m/%Y') like ?", ['%' . $this->termino . '%'])
                    ->orWhereHas('student', function ($query) { // RELACION CON STUD
                        $query->where('nombre', 'like', '%' . $this->termino . '%')
                        ->orWhere('apellido_paterno', 'like', '%' . $this->termino . '%')
                        ->orWhere('apellido_materno', 'like', '%' . $this->termino . '%')
                        ->orWhere('matricula', 'like', '%' . $this->termino . '%')
                        ->orWhere('CURP', 'like', '%' . $this->termino . '%');
                    })
                    ->orWhereHas('month', function ($query) { // RELACION CON MONTH
                        $query->where('mes', 'like', '%' . $this->termino . '%');
                    });
                })
                ->count();
            } else {
                $this->contar = 0;
            }
        }


    }


    #[On('refreshColegiatura')]
    public function refreshColegiatura()
    {
        $this->termino = '';
    }


    public function render()
    {
        // $meses = Month::all();

        $colegiaturas = Colegiatura::where('level_id', $this->level_id)
        ->where(function ($query) {
            $query->where('nombre_pago', 'like', '%' . $this->termino . '%')
            ->orWhere('tipo_pago', 'like', '%' . $this->termino . '%')
            ->orWhere('folio', 'like', '%' . $this->termino . '%')
            ->orWhereRaw("DATE_FORMAT(fecha_pago, '%d/%m/%Y') like ?", ['%' . $this->termino . '%'])
              ->orWhereHas('student', function ($query) { // RELACION CON STUDENT
              $query->where('nombre', 'like', '%' . $this->termino . '%')
                ->orWhere('apellido_paterno', 'like', '%' . $this->termino . '%')
                ->orWhere('apellido_materno', 'like', '%' . $this->termino . '%')
                ->orWhere('matricula', 'like', '%' . $this->termino . '%')
                ->orWhere('CURP', 'like', '%' . $this->termino . '%');
              })
              ->orWhereHas('month', function ($query) { // RELACION CON MONTH
              $query->where('mes', 'like', '%' . $this->termino . '%');
              });

              ;
        })
        ->orderBy('id', 'desc')
        ->orderBy('month_id', 'desc')
        ->paginate(10);



        return view('livewire.action.pago-colegiatura.mostrar-colegiaturas', compact('colegiaturas'));
    }
}
