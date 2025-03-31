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
        'clave' => 'nullable|unique:materias',
        'level_id' => 'required|exists:levels,id',
        'group_id' => 'required|exists:groups,id',
        'teacher_id' => 'required|exists:teachers,id',
        'campo_formativo_id' => 'required|exists:campos_formativos,id',
        'calificacion' => 'required|numeric|in:0,1',
    ];

    protected $messages = [
        'materia.required' => 'El campo materia es obligatorio',
        'clave.unique' => 'La clave ya existe',
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

    public function guardarMateria()
    {
        $this->validate();

         // Verificar la combinación duplicada de anio_inicio, anio_termino y level_id
            $exists = Materia::where('slug', $this->slug)
                ->where('group_id', $this->group_id)
                 ->exists();

        if ($exists) {
            $this->dispatch('swal',[
                'title' => '¡Esta materia ya existe en el grupo seleccionado!',
                'icon' => 'error',
                'position' => 'top',
            ]);
            return;
        }

        Materia::create([
            'materia' => trim($this->materia),
            'slug' => $this->slug,
            'clave' => $this->clave,
            'level_id' => $this->level_id,
            'grade_id' => $this->grade->id,
            'group_id' => $this->group_id,
            'teacher_id' => $this->teacher_id,
            'campo_formativo_id' => $this->campo_formativo_id,
            'calificacion' => $this->calificacion,
        ]);

        $this->reset([
            'materia',
            'slug',
            'clave',
            'group_id',
            'teacher_id',
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

        $this->profesores = Teacher::where('level_id', $this->level_id)->orderBy('sort', 'asc')->get();
    }


    public function render()
    {
        $campos = CamposFormativo::all();

        return view('livewire.action.materia.crear-materia', compact('campos'));
    }
}
