<?php

namespace App\Livewire\Component\Datatables;

use Livewire\Component;

class ActionColumn extends Component
{
    public $id;


    public function render()
    {
        return view('livewire.component.datatables.action-column');
    }
}
