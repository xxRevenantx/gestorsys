<?php

namespace App\Http\Controllers;

use App\Models\Colegiatura;
use App\Models\Level;
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

    public function listaAlumnos($level_id, $grade_id, $genero)
    {

        $students = Student::where('level_id', $level_id)
            ->where('grade_id', $grade_id)
            ->where('genero', $genero)
            ->orderBy('apellido_paterno')
            ->orderBy('apellido_materno')
            ->get();

        $level = Level::findOrFail($level_id);
        $grade = $level->grades->find($grade_id);


        $data = [
            'students' => $students,
            'level' => $level,
            'grade' => $grade,
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




}
