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
    public $studentsFinalByGroup = [];
    public $calificacionesPorcentaje = [];

    public $finales = [];
    public $promedioFinalAlumno = [];

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

        $this->materias = Materia::where('grade_id', $this->grade_id)->orderBy('sort')->get();

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

        foreach ($students as $student) {
            foreach ($this->materias as $materia) {
                $sum = 0;
                $validos = 0;

                foreach ($periodos as $periodo) {
                    $valor = $this->inputs[$periodo->id][$student->id][$materia->id] ?? null;

                    if (is_numeric($valor)) {
                        $sum += $valor;
                        $validos++;
                    }
                }

                $this->finales[$student->id][$materia->id] = [
                    'promedio' => round($sum / 3, 2),
                    'completas' => $validos === 3 && $sum > 0,
                ];
            }

            $materiasCalificables = $this->materias->where('calificacion', 1);
            $promedios = [];

            foreach ($materiasCalificables as $materia) {
                $promedioMateria = $this->finales[$student->id][$materia->id]['promedio'] ?? null;
                if (is_numeric($promedioMateria)) {
                    $promedios[] = $promedioMateria;
                }
            }

            $this->promedioFinalAlumno[$student->id] = count($promedios) > 0
                ? round(array_sum($promedios) / count($promedios), 2)
                : '';
        }

        // Grupo ordenado por ID para periodos (estático)
        $this->studentsByGroup = collect($students)->groupBy('group_id');

        // Grupo ordenado por promedio final (para calificaciones finales)
        $this->studentsFinalByGroup = collect($students)
            ->groupBy('group_id')
            ->map(function ($grupoEstudiantes) {
                return $grupoEstudiantes->sortByDesc(function ($student) {
                    return $this->promedioFinalAlumno[$student->id] ?? 0;
                });
            });

        $this->actualizarPorcentajes();
    }

    public function updatedInputs($value, $key)
    {
        [$periodo_id, $student_id, $materia_id] = explode('.', $key);

        if (!is_numeric($value)) {
            $this->inputs[$periodo_id][$student_id][$materia_id] = strtoupper($value);
        }

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

        $sum = 0;
        $validos = 0;
        $periodos = Periodo::all();

        foreach ($periodos as $periodo) {
            $valor = $this->inputs[$periodo->id][$student_id][$materia_id] ?? null;
            if (is_numeric($valor)) {
                $sum += $valor;
                $validos++;
            }
        }

        $this->finales[$student_id][$materia_id] = [
            'promedio' => round($sum / 3, 2),
            'completas' => $validos === 3 && $sum > 0,
        ];

        $materiasCalificables = $this->materias->where('calificacion', 1);
        $promedios = [];

        foreach ($materiasCalificables as $materia) {
            $promedioMateria = $this->finales[$student_id][$materia->id]['promedio'] ?? null;
            if (is_numeric($promedioMateria)) {
                $promedios[] = $promedioMateria;
            }
        }

        $this->promedioFinalAlumno[$student_id] = count($promedios) > 0
            ? round(array_sum($promedios) / count($promedios), 2)
            : '';

        $grupo_id = $student->group_id;
        $this->studentsFinalByGroup[$grupo_id] = collect($this->studentsFinalByGroup[$grupo_id])
            ->sortByDesc(fn($student) => $this->promedioFinalAlumno[$student->id] ?? 0);

        $this->actualizarPorcentajes();
    }

    public function actualizarPorcentajes()
    {
        $this->calificacionesPorcentaje = [];

        $periodos = Periodo::all();
        $students = Student::where('level_id', $this->level_id)
            ->where('grade_id', $this->grade_id)
            ->get();

        foreach ($periodos as $periodo) {
            foreach ($this->grupos as $grupo) {
                $grupoStudents = $students->where('group_id', $grupo->id);
                $materiasCalificables = $this->materias->where('calificacion', 1);

                $totalEsperadas = $grupoStudents->count() * $materiasCalificables->count();
                $calificacionesInsertadas = 0;

                foreach ($grupoStudents as $student) {
                    foreach ($materiasCalificables as $materia) {
                        $valor = $this->inputs[$periodo->id][$student->id][$materia->id] ?? null;
                        if (is_numeric($valor)) {
                            $calificacionesInsertadas++;
                        }
                    }
                }

                $porcentaje = $totalEsperadas > 0
                    ? round(($calificacionesInsertadas / $totalEsperadas) * 100, 1)
                    : 0;

                $this->calificacionesPorcentaje[$grupo->id][$periodo->id] = $porcentaje;
            }
        }
    }

    public function obtenerLugarAlumno($studentId, $grupoId)
    {
        $grupo = $this->studentsFinalByGroup[$grupoId] ?? collect();
        $ordenados = $grupo->values();

        foreach ($ordenados as $index => $alumno) {
            if ($alumno->id === $studentId) {
                return $index + 1;
            }
        }

        return null;
    }

    public function calcularLugaresConMedallas($grupoId)
{
    $grupo = $this->studentsFinalByGroup[$grupoId] ?? collect();
    $ranking = [];
    $lastProm = null;
    $place = 0;
    $contador = 0;

    foreach ($grupo as $student) {
        $promedio = $this->promedioFinalAlumno[$student->id] ?? 0;
        $contador++;

        if ($promedio !== $lastProm) {
            $place = $contador;
        }

        $ranking[$student->id] = $place;
        $lastProm = $promedio;
    }

    return $ranking;
}


    public function render()
    {
        $grados = Grade::where('level_id', $this->level_id)->get();
        $periodos = Periodo::all();

        return view('livewire.action.calificacion', compact('grados', 'periodos'));
    }
}
