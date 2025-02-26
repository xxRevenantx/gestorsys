<?php

namespace App\Livewire\Action;

use App\Models\Grade;
use App\Models\Student;
use Livewire\Component;
use Livewire\WithPagination;

class MatriculaEscolar extends Component
{

    use WithPagination;

    public $level_id;
    public $termino;



    public function render()
    {
        $alumnos = Student::where('level_id', $this->level_id)
            ->where(function ($query) {
                $query->where('CURP', 'like', '%' . $this->termino . '%')
                    ->orWhere('nombre', 'like', '%' . $this->termino . '%')
                    ->orWhere('apellido_paterno', 'like', '%' . $this->termino . '%')
                    ->orWhere('apellido_materno', 'like', '%' . $this->termino . '%');
                    $query->orWhereRaw("CONCAT(nombre, ' ', apellido_paterno, ' ', apellido_materno) like ?", ['%' . $this->termino . '%']);
            })
            ->paginate(10);

        $level_nombre = \App\Models\Level::find($this->level_id)->level;

        $grados = Grade::where('level_id', $this->level_id)->get();

        return view('livewire.action.matricula-escolar', compact('alumnos', 'level_nombre', 'grados'));
    }
}
