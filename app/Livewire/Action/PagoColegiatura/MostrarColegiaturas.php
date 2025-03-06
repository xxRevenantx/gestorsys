<?php

namespace App\Livewire\Action\PagoColegiatura;

use App\Models\Colegiatura;
use App\Models\Month;
use Livewire\Component;

class MostrarColegiaturas extends Component
{
    public $level_id;
    public function render()
    {
        // $meses = Month::all();

        $colegiaturas = Colegiatura::where('level_id', $this->level_id)->get();
        return view('livewire.action.pago-colegiatura.mostrar-colegiaturas', compact('colegiaturas'));
    }
}
