<?php

namespace App\Livewire\Personnel;

use App\Models\Personnel;
use Livewire\Component;

class MostrarPersonals extends Component
{

    public function placeholder(){
        return view('placeholder');
    }
    public function render()
    {
        $personal = Personnel::all();
        return view('livewire.personnel.mostrar-personals', compact('personal'));
    }
}
