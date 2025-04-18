<?php

namespace App\Livewire\Action\PagoColegiatura;

use App\Livewire\Action\Colegiatura;
use App\Models\Month;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class FaltantesColegiaturas extends Component
{

    public $level_id;
    public $termino;
    public $alumnos;
    public $grades;
    public $grade_id;

    use WithPagination;


    public function  updated($propertyName) // Reseatear la paginación cuando se realiza una búsqueda en el input de búsqueda de la tabla
    {
        if ($propertyName == 'termino') {
            $this->resetPage();

        }
    }



    #[On('refreshColegiatura')]
    public function refreshColegiatura()
    {
        $this->termino = '';
    }


    public function mount($level_id)
    {
        $this->level_id = $level_id;

        $this->alumnos = \App\Models\Student::where('level_id', $this->level_id)
        ->where('status', '1')
        ->with(['grade', 'group', 'level', 'colegiaturas'])
        ->get();

        $this->grades = \App\Models\Grade::where('level_id', $this->level_id)->get();

    }


    public function render()
    {
        $query = \App\Models\Student::where('level_id', $this->level_id)
        ->where('status', '1')
        ->with(['grade', 'group', 'level', 'colegiaturas']);

    if (!empty($this->termino)) {
        $query->where(function ($q) {
            $q->where('nombre', 'like', '%' . $this->termino . '%')
                ->orWhere('apellido_paterno', 'like', '%' . $this->termino . '%')
                ->orWhere('apellido_materno', 'like', '%' . $this->termino . '%')
                ->orWhere('matricula', 'like', '%' . $this->termino . '%')
                ->orWhere('curp', 'like', '%' . $this->termino . '%');
        })
        ->orWhereHas('colegiaturas', function ($q) {
            $q->where('folio', 'like', '%' . $this->termino . '%')
                ->orWhere('tipo_pago', 'like', '%' . $this->termino . '%')
                ->orWhere('fecha_pago', 'like', '%' . $this->termino . '%')
                ->orWhere('observaciones', 'like', '%' . $this->termino . '%');
        });
    }

    $alumnos = $query->get();

    $months = Month::all();

    $alumnosAgrupados = $alumnos->groupBy(function ($alumno) {
        return $alumno->grade->grado . '-' . $alumno->group->grupo;
    });

    return view('livewire.action.pago-colegiatura.faltantes-colegiaturas', compact('months', 'alumnosAgrupados'));

    }
}
