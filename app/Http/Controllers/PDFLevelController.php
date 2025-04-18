<?php

namespace App\Http\Controllers;

use App\Models\Colegiatura;
use App\Models\Horario;
use App\Models\Level;
use App\Models\Materia;
use App\Models\Month;
use App\Models\PagoInscripcion;
use App\Models\Student;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PDFLevelController extends Controller
{
    public function nivelesPDF ()
    {
        $levels = Level::get();

        $data = [
            'levels' => $levels
        ];

        $pdf = Pdf::loadView('admin.PDF.levelsPdf', $data);

        return $pdf->stream("archivo.pdf");

    }

    public function expedienteAlumno ($student_id)
    {
        $student = Student::findOrFail($student_id);
        $data = [
            'student' => $student
        ];
        $pdf = Pdf::loadView('admin.PDF.expediente-alumno', $data)->setPaper('letter', 'portrait');
        return $pdf->stream("Expediente de ". $student->nombre." ".$student->apellido_paterno. " ".$student->apellido_materno. " - ".$student->CURP .".pdf");
    }

    public function listaAlumnosGrade($level_id, $grade_id)
    {
        $students = Student::where('level_id', $level_id)
            ->where('grade_id', $grade_id)
            ->orderBy('apellido_paterno')
            ->orderBy('apellido_materno')
            ->get();

        $level = Level::findOrFail($level_id);
        $grade = $level->grades->find($grade_id);


        $data = [
            'students' => $students,
            'level' => $level,
            'grade' => $grade,
            'group' => null,
        ];

        $pdf = Pdf::loadView('admin.PDF.lista-alumnos', $data)->setPaper('letter', 'landscape');
        return $pdf->stream("Lista de alumnos de ". $level->level." ".$grade->grade.".pdf");

    }



    public function listaAlumnosGroup($level_id, $grade_id, $group_id)
    {

        $students = Student::where('level_id', $level_id)
            ->where('grade_id', $grade_id)
            ->where('group_id', $group_id)
            ->orderBy('apellido_paterno')
            ->orderBy('apellido_materno')
            ->get();

        $level = Level::findOrFail($level_id);
        $grade = $level->grades->find($grade_id);
        $group = $level->groups->find($group_id);


        $data = [
            'students' => $students,
            'level' => $level,
            'grade' => $grade,
            'group' => $group,
        ];

        $pdf = Pdf::loadView('admin.PDF.lista-alumnos', $data)->setPaper('letter', 'landscape');
        return $pdf->stream("Lista de alumnos de ". $level->level." ".$grade->grade.".pdf");

    }

    public function listaAlumnosGroupGender($level_id, $grade_id, $group_id, $gender)
    {

        $students = Student::where('level_id', $level_id)
            ->where('grade_id', $grade_id)
            ->where('group_id', $group_id)
            ->where('genero', $gender)
            ->orderBy('apellido_paterno')
            ->orderBy('apellido_materno')
            ->get();

        $level = Level::findOrFail($level_id);
        $grade = $level->grades->find($grade_id);
        $group = $level->groups->find($group_id);


        $data = [
            'students' => $students,
            'level' => $level,
            'grade' => $grade,
            'group' => $group,
        ];

        $pdf = Pdf::loadView('admin.PDF.lista-alumnos', $data)->setPaper('letter', 'landscape');
        return $pdf->stream("Lista de alumnos de ". $level->level." ".$grade->grade.".pdf");

}


    // PDF DE COLEGIATURAS
    public function colegiatura_faltantes_pdf($level_id, $grade_id){

        $level = Level::findOrFail($level_id);
        $grade = $level->grades->find($grade_id);

        $students = Student::where('level_id', $level_id)
            ->where('grade_id', $grade_id)
            ->orderBy('apellido_paterno')
            ->orderBy('apellido_materno')
            ->get();
        $colegiaturas = Colegiatura::where('level_id', $level_id)
            ->get();


        $months = Month::all();

        $data = [
            'colegiaturas' => $colegiaturas,
            'students' => $students,
            'months' => $months,
            'level' => $level,
            'grade' => $grade,
        ];

        $pdf = Pdf::loadView('admin.PDF.colegiaturas-faltantes', $data)->setPaper('letter', 'landscape');
        return $pdf->stream("Colegiaturas faltantes.pdf");

    }





    public function reciboInscripcion($student_id)
    {
        $pago = PagoInscripcion::where('student_id', $student_id)->firstOrFail();
        $data = [
            'pago' => $pago
        ];
        $pdf = Pdf::loadView('admin.PDF.recibo-inscripcion', $data)->setPaper('letter', 'portrait');
        return $pdf->stream("Recibo de inscripción de ". $pago->student->nombre." ".$pago->student->apellido_paterno. " ".$pago->student->apellido_materno. " - ".$pago->student->CURP .".pdf");

    }

    public function reciboColegiatura ($alumno, $mes)
    {
        $student = Student::findOrFail($alumno);
        $colegiatura = Colegiatura::where('student_id', $alumno)->where('month_id', $mes)->firstOrFail();
        $data = [
            'colegiatura' => $colegiatura,
            'student' => $student,
        ];
        $pdf = Pdf::loadView('admin.PDF.recibo-colegiatura', $data)->setPaper('letter', 'portrait');
        return $pdf->stream("Recibo de colegiatura de ". $student->nombre." ".$student->apellido_paterno. " ".$student->apellido_materno. " - ".$student->CURP .".pdf");
    }

    // ESTADO DE CUENTA DE LAS COLEGIATURAS
    public function estadoCuenta ($alumno)
    {
        $student = Student::findOrFail($alumno);
        $colegiaturas = Colegiatura::where('student_id', $alumno)->orderBy('month_id', 'asc')->get();
        $data = [
            'colegiaturas' => $colegiaturas,
            'student' => $student,
        ];
        $pdf = Pdf::loadView('admin.PDF.estado-cuenta', $data)->setPaper('legal', 'landscape');
        return $pdf->stream("Estado de cuenta de ". $student->nombre." ".$student->apellido_paterno. " ".$student->apellido_materno. " - ".$student->CURP .".pdf");
    }


    // HORARIOS
    public function horarios ($level, $grade, $group)
    {

        $horario = Horario::where('level_id', $level)
            ->where('grade_id', $grade)
            ->where('group_id', $group)
            ->get();



            $materias = Materia::with('teacher.personnel')
            ->where('level_id', $level)
            ->where('grade_id', $grade)
            ->where('group_id', $group)
            ->get();

        // Agrupar por el nombre completo del profesor
        $materiasAgrupadas = $materias->groupBy(function ($materia) {
            $teacher = $materia->teacher?->personnel;
            return $teacher ? $teacher->nombre . ' ' . $teacher->apellido_paterno . ' ' . $teacher->apellido_materno : 'Sin asignar';
        });


        // LEVEL PARA OBTENER EL NIVEL STRING
        $level = Level::findOrFail($level);

        // GRADE PARA OBTENER EL GRADO STRING
        $grade = $level->grades->find($grade);

        $data = [
            'horarios' => $horario,
            'materiasAgrupadas' => $materiasAgrupadas,
            'level' => $level,
            'grade' => $grade,
            'group' => $group,
        ];

        $pdf = Pdf::loadView('admin.PDF.horarios', $data)->setPaper('letter', 'portrait');
        return $pdf->stream("Horarios de ". $grade."° de ".$level->level.".pdf");
    }

    public function horarioGeneral($level_slug)
    {
        $level = Level::where('slug', $level_slug)->firstOrFail();

        $horarios = Horario::where('level_id', $level->id)
            ->orderBy('hora')
            ->get();

        $materias = Materia::where('level_id', $level->id)
            ->orderBy('sort')
            ->get();



        $data = [
            'horarios' => $horarios,
            'materias' => $materias,
            'level' => $level,
        ];


            $pdf = Pdf::loadView('admin.PDF.horario-general', $data)
            ->setPaper($level->slug == 'primaria' ? 'legal' : 'letter', 'landscape')
            ->setOptions([
                'defaultFont' => 'Nunito',
                'isHtml5ParserEnabled' => true,

            ]);

        return $pdf->stream("Horarios generales de {$level->level}.pdf");
    }

    // CALIFICACIONES DEL ALUMNO
    public function calificaciones_pdf($student, $periodo){

        $student = Student::findOrFail($student);
        $periodo = \App\Models\Periodo::findOrFail($periodo);

        $calificaciones = \App\Models\Calificacion::where('student_id', $student->id)
            ->where('periodo_id', $periodo->id)
            ->get();

        $data = [
            'calificaciones' => $calificaciones,
            'student' => $student,
            'periodo' => $periodo,
        ];

        $pdf = Pdf::loadView('admin.PDF.calificaciones-pdf', $data)->setPaper('letter', 'portrait');
        return $pdf->stream("Calificaciones de ". $student->nombre." ".$student->apellido_paterno. " ".$student->apellido_materno. " - ".$student->CURP .".pdf");
    }

    // CALIFICACIONES FINALES DEL ALUMNO
    public function calificaciones_finales_pdf($studentId)
    {
        $student = Student::findOrFail($studentId);
        $periodos = \App\Models\Periodo::all();
        $materias = \App\Models\Materia::where('grade_id', $student->grade_id)
        ->where('level_id', $student->level_id)
            ->where('calificacion', "1")
            ->orderBy('sort')
            ->get();



                // Declaraciones iniciales
            $promediosPorPeriodo = [];
            $sumaGeneral = 0;
            $totalMaterias = 0;

            foreach ($materias as $materia) {
                $promedio = 0;
                $suma = 0;
                $contador = 0;

                foreach ($periodos as $periodo) {
                    $calificacion = \App\Models\Calificacion::where('student_id', $student->id)
                        ->where('materia_id', $materia->id)
                        ->where('periodo_id', $periodo->id)
                        ->first();

                    $valor = $calificacion ? $calificacion->calificacion : '';
                    $calificacionesPorMateria[$materia->materia]['periodos'][$periodo->num_periodo] = $valor;

                    if (is_numeric($valor)) {
                        $suma += $valor;
                        $promediosPorPeriodo[$periodo->num_periodo][] = $valor;
                        $contador++;
                    }
                }

                $calificacionesPorMateria[$materia->materia]['promedio'] = $contador > 0 ? round($suma / $contador, 2) : '-';

                if ($contador > 0) {
                    $sumaGeneral += $suma / $contador;
                    $totalMaterias++;
                }
            }



            $materiasNoCalificables = \App\Models\Materia::where('grade_id', $student->grade_id)
                ->where('calificacion', "0")
                ->orderBy('sort')
                ->get();

            $noCalificables = [];

            $noCalificables = [];

            foreach ($materiasNoCalificables as $materia) {
                $suma = 0;
                $contador = 0;

                foreach ($periodos as $periodo) {
                    $calificacion = \App\Models\Calificacion::where('student_id', $student->id)
                        ->where('materia_id', $materia->id)
                        ->where('periodo_id', $periodo->id)
                        ->first();

                    $valor = $calificacion ? $calificacion->calificacion : '';
                    $noCalificables[$materia->materia]['periodos'][$periodo->num_periodo] = $valor;

                    if (is_numeric($valor)) {
                        $suma += $valor;
                        $contador++;
                    }
                }

                $noCalificables[$materia->materia]['promedio'] = $contador > 0 ? round($suma / $contador, 2) : '-';
            }


            // Calcular promedios por periodo
            $promedioPorPeriodo = [];
            foreach ($periodos as $periodo) {
                $periodoCalifs = $promediosPorPeriodo[$periodo->num_periodo] ?? [];
                $promedioPorPeriodo[$periodo->num_periodo] = count($periodoCalifs) > 0
                    ? round(array_sum($periodoCalifs) / count($periodoCalifs), 2)
                    : '-';
            }

            // Calcular promedio general del alumno
            $promedioGeneralAlumno = $totalMaterias > 0 ? round($sumaGeneral / $totalMaterias, 2) : '-';




            $data = [
                'student' => $student,
                'periodos' => $periodos,
                'calificacionesPorMateria' => $calificacionesPorMateria,
                'promedioPorPeriodo' => $promedioPorPeriodo,
                'promedioGeneralAlumno' => $promedioGeneralAlumno,
                 'noCalificables' => $noCalificables,

            ];

            $pdf = pdf::loadView('admin.PDF.calificaciones-finales-pdf', $data)->setPaper('letter', 'portrait');
            return $pdf->stream("Calificaciones finales de {$student->nombre} {$student->apellido_paterno} {$student->apellido_materno} - {$student->CURP}.pdf");

    }


}
