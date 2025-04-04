<?php

namespace App\Livewire\Action;

use App\Models\Action;
use App\Models\Calificacion as ModelsCalificacion;
use App\Models\Grade;
use App\Models\Level;
use App\Models\Materia;
use App\Models\Periodo;
use App\Models\Student;
use Livewire\Component;

class Calificacion extends Component
{
    public $grade_id;
    public $level_id;

    public $level;
    public $action;
    public $grade;

    public $students;
    public $materias;
    public $inputs = [];

    public $grupos = [];


    public $studentsByGroup = [];

    public function placeholder()
    {
        return view('placeholder');
    }

    public function mount()
    {
        $this->level = Level::find($this->level_id);
        $this->action = Action::where('slug', 'calificaciones')->first();
        $this->grade_id = $this->grade->id;

        $this->grupos = \App\Models\Group::where('grade_id', $this->grade->id)->get();

        $students = Student::where('level_id', $this->level_id)
            ->where('grade_id', $this->grade_id)
            ->get();

        $this->studentsByGroup = collect($students)->groupBy('group_id'); // AGRUPAR POR GRUPO

        $this->materias = Materia::where('grade_id', $this->grade_id)->get();

        $periodos = Periodo::all();

        foreach ($periodos as $periodo) {
            foreach ($students as $student) {
                foreach ($this->materias as $materia) {
                    $calificacion = ModelsCalificacion::where('student_id', $student->id)
                        ->where('materia_id', $materia->id)
                        ->where('periodo_id', $periodo->id)
                        ->first();

                    $this->inputs[$periodo->id][$student->id][$materia->id] = $calificacion ? $calificacion->calificacion : '';
                }
            }
        }
    }

    public function updatedInputs($value, $key)
    {
        [$periodo_id, $student_id, $materia_id] = explode('.', $key);

        // Validar rango permitido
        if (!is_numeric($value) || $value < 5 || $value > 10) {
            // Si el valor no es válido, forzar el valor a 5 en la vista
            $this->inputs[$periodo_id][$student_id][$materia_id] = 5;
            return;
        }

        // Obtener grupo del estudiante
        $student = Student::find($student_id);

        ModelsCalificacion::updateOrCreate(
            [
                'student_id' => $student_id,
                'materia_id' => $materia_id,
                'periodo_id' => $periodo_id,
            ],
            [
                'level_id' => $this->level->id,
                'grade_id' => $this->grade->id,
                'group_id' => $student?->group_id,
                'calificacion' => $value,
            ]
        );
    }

    public function render()
    {
        $grados = Grade::where('level_id', $this->level_id)->get();
        $periodos = Periodo::all();

        return view('livewire.action.calificacion', compact('grados', 'periodos'));
    }
}
