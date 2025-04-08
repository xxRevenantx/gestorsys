<?php

namespace App\Http\Controllers;

use App\Exports\CalificacionesExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function calificaciones()
    {
        return Excel::download(new CalificacionesExport,'calificaciones.xlsx');
    }


}
