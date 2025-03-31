<?php

namespace App\Livewire\Action\Materia;

use App\Models\CamposFormativo;
use App\Models\Group;
use App\Models\Teacher;
use Livewire\Component;
use Illuminate\Support\Str;


class EditarMateria extends Component
{
    public $materia_id;
    public $materia;
    public $slug;
    public $clave;
    public $campo_formativo_id;
    public $level_id;
    public $teacher_id;
    public $group_id;
    public $grade;
    public $grupos = [];
    public $profesores = [];
    // public $teacher_id;
    public $calificacion;

    protected $rules = [
        'materia' => 'required',
        'level_id' => 'required|exists:levels,id',
        'group_id' => 'required|exists:groups,id',
        'teacher_id' => 'required|exists:teachers,id',
        'campo_formativo_id' => 'required|exists:campos_formativos,id',
        'calificacion' => 'required|numeric|in:0,1',
    ];

    protected $messages = [
        'materia.required' => 'El campo materia es obligatorio',
        'level_id.required' => 'El campo nivel es obligatorio',
        'level_id.exists' => 'El nivel no existe',
        'group_id.required' => 'El campo grupo es obligatorio',
        'group_id.exists' => 'El grupo no existe',
        'teacher_id.required' => 'El campo profesor es obligatorio',
        'teacher_id.exists' => 'El profesor no existe',
        'campo_formativo_id.required' => 'El campo campo formativo es obligatorio',
        'campo_formativo_id.exists' => 'El campo formativo no existe',
        'calificacion.required' => 'El campo calificación es obligatorio',
        'calificacion.numeric' => 'El campo calificación debe ser numérico',
        'calificacion.in' => 'El campo calificación debe ser 0 o 1',
    ];

    public function updatedMateria($value)
    {
        // Genera el slug automáticamente cuando el título cambia
        $this->slug = Str::slug(trim($value));
    }


    public function actualizarMateria(){

        $materia = \App\Models\Materia::findOrFail($this->materia_id);

        $materia->update([
            'materia' => $this->materia,
            'slug' => $this->slug,
            'clave' => $this->clave,
            'campo_formativo_id' => $this->campo_formativo_id,
            'level_id' => $this->level_id,
            'group_id' => $this->group_id,
            'teacher_id' => $this->teacher_id,
            'calificacion' => $this->calificacion,
        ]);

        $this->dispatch('swal', [
            'title' => '¡La materia se ha actualizado correctamente!',
            'icon' => 'success',
            'position' => 'top',
        ]);




    }

    public function mount($materia){

        $this->materia_id = $materia->id;
        $this->materia = $materia->materia;
        $this->slug = $materia->slug;
        $this->clave = $materia->clave;
        $this->campo_formativo_id = $materia->campo_formativo_id;
        $this->level_id = $materia->level_id;
        $this->grade = $materia->grade->id;
        $this->teacher_id = $materia->teacher_id;
        $this->group_id = $materia->group_id;
        $this->calificacion = $materia->calificacion;


        $this->grupos = $this->grade ? Group::where('grade_id', $this->grade)->get() : [];


        $this->profesores = Teacher::where('level_id', $this->level_id)->orderBy('sort','asc')->get();
    }


    public function render()
    {
        $campos = CamposFormativo::all();
        return view('livewire.action.materia.editar-materia', compact('campos'));
    }
}
