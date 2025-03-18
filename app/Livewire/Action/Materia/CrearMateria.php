<?php

namespace App\Livewire\Action\Materia;

use App\Models\CamposFormativo;
use App\Models\Group;
use App\Models\Materia;
use App\Models\Teacher;
use Livewire\Component;
use Illuminate\Support\Str;

class CrearMateria extends Component
{


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
        'slug' => 'required|unique:materias',
        'clave' => 'nullable|unique:materias',
        'campo_formativo_id' => 'required|exists:campos_formativos,id',
        'calificacion' => 'required|numeric|in:0,1',
    ];

    protected $messages = [
        'materia.required' => 'El campo materia es obligatorio',
        'slug.required' => 'El campo slug es obligatorio',
        'slug.unique' => 'El slug ya existe',
        'clave.unique' => 'La clave ya existe',
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

    public function guardarMateria()
    {
        $this->validate();

        Materia::create([
            'materia' => $this->materia,
            'slug' => $this->slug,
            'clave' => $this->clave,
            'level_id' => $this->level_id,
            'grade_id' => $this->grade->id,
            'campo_formativo_id' => $this->campo_formativo_id,
            'calificacion' => $this->calificacion,
        ]);

        $this->reset([
            'materia',
            'slug',
            'clave',
            'campo_formativo_id',
            'calificacion',
        ]);

        $this->dispatch('swal', [
            'title' => '¡La materia se ha creado correctamente!',
            'icon' => 'success',
            'position' => 'top',
        ]);

        $this->dispatch('refreshMaterias');



    }

    public function mount(){
        $this->grupos = $this->grade->groups; // GRUPOS DEL GRADO SELECCIONADO POR DEFECTO EN EL SELECT DE GRUPOS EN LA VISTA DE MATRICULA ESCOLAR

        $this->profesores = Teacher::where('level_id', $this->level_id)->orderBy('sort','asc')->get();
    }


    public function render()
    {
        $campos = CamposFormativo::all();

        return view('livewire.action.materia.crear-materia', compact('campos'));
    }
}
