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
        $level = Level::findOrFail($level);
        $grade = $level->grades->find($grade);
        $group = $level->groups->find($group);
        $materias = Materia::where('level_id', $level->id)
            ->where('grade_id', $grade->id)
            ->where('group_id', $group->id)
            ->get();
        $data = [
            'horarios' => $horario,
            'materias' => $materias,
            'level' => $level,
            'grade' => $grade,
            'group' => $group,
        ];

        $pdf = Pdf::loadView('admin.PDF.horarios', $data)->setPaper('letter', 'portrait');
        return $pdf->stream("Horarios de ". $level->level." ".$grade->grade.".pdf");
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

        $pdf = Pdf::loadView('admin.PDF.horario-general', $data)->setPaper('letter', 'landscape');
        return $pdf->stream("Horarios generales de ". $level->level.".pdf");
    }


}
