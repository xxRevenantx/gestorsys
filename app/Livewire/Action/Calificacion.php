<?php

namespace App\Livewire\Action;

use App\Models\Action;
use App\Models\Grade;
use App\Models\Level;
use Livewire\Component;

class Calificacion extends Component
{

        public $grade_id;
        public $level_id;

        // VARIABLES GET
        public $level;
        public $action;
        public $grade; // GRADO SELECCIONADO


        public function placeholder(){
            return view('placeholder');
        }


        public function mount(){

            $this->level = Level::find($this->level_id);
            $this->action = Action::where('slug', 'calificaciones')->first();
            $this->grade_id = $this->grade->id; // GRADO SELECCIONADO POR DEFECTO EN EL SELECT DE GRADOS EN LA VISTA DE MATRICULA ESCOLAR

        }

    public function render()
    {
        $grados = Grade::where('level_id', $this->level_id)->get();

        return view('livewire.action.calificacion', compact('grados'));
    }
}
