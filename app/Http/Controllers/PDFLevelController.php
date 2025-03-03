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

        $pdf = Pdf::loadView('admin.PDF.expedienteAlumno', $data)->setPaper('letter', 'portrait');



        return $pdf->stream("archivo.pdf");

    }



}
