<?php

namespace App\Http\Controllers;

use App\Models\Level;
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
        $pdf = Pdf::loadView('admin.PDF.expediente-alumno', $data)->setPaper('letter', 'landscape');
        return $pdf->stream("Expediente de ". $student->nombre." ".$student->apellido_paterno. " ".$student->apellido_materno. " - ".$student->CURP .".pdf");
    }

    public function listaAlumnos($level_id)
    {

        $level = Level::findOrFail($level_id);
        $students = $level->students;
        $data = [
            'students' => $students,
        ];
        $pdf = Pdf::loadView('admin.PDF.lista-alumnos', $data)->setPaper('letter', 'portrait');
        return $pdf->stream("Lista de alumnos de ". $level->level.".pdf");
    }



}
