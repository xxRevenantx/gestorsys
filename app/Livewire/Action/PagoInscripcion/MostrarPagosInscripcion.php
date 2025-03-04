<?php

namespace App\Livewire\Action\PagoInscripcion;

use App\Models\PagoInscripcion;
use App\Models\Student;
use Livewire\Component;

class MostrarPagosInscripcion extends Component
{
    public $level_id;


    public function render()
    {

        $estudiantes = PagoInscripcion::select('student_id')->get();

        return view('livewire.action.pago-inscripcion.mostrar-pagos-inscripcion', compact('estudiantes'));
    }
}
