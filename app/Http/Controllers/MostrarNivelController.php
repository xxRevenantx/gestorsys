<?php

namespace App\Http\Controllers;

use App\Models\Action;
use App\Models\Grade;
use App\Models\Level;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;

class MostrarNivelController extends Controller
{
    public function index()
    {
        $niveles = Level::all();
        return view('admin.level.index', compact('niveles'));
    }

    public function nivel($level_slug)
    {
        // return redirect()->route('admin.level.action', ['nivel' => $level_slug, 'action' => "matricula-escolar"]);

        // $nivel = Level::where('slug', $level_id)->first();

        // $acciones = Action::all();
        // return view('admin.level.action', compact('nivel', 'acciones'));
    }

    public function action($level_slug, $action_slug, $grade_grado){

        if(empty($grade_grado)){
            return redirect()->route('admin.level.action', ['nivel' => $level_slug, 'action' => "matricula-escolar", 'grado' => "1"]);
        }

        $nivel = Level::where('slug', $level_slug)->firstOrFail();
        $action = Action::where('slug', $action_slug)->firstOrFail();
        $grade = Grade::where('grado', $grade_grado)->where('level_id', $nivel->id)->firstOrFail();

        $acciones = Action::orderBy('sort', "asc")->get();
        $level_id = $nivel->id; // OBTENER EL ID DEL NIVEL

        return view('admin.level.action', compact('nivel',  'action', 'acciones', 'level_id', 'grade', 'action'));


    }

    public function matricula($level, $action)
    {
        $nivel = Level::where('slug', $level)->firstOrFail();
        $action = Action::where('slug', $action)->firstOrFail();
        // $grade = Grade::where('grado', $grade)->firstOrFail();

        $acciones = Action::orderBy('sort', "asc")->get();

        $level_id = $nivel->id; // OBTENER EL ID DEL NIVEL

        return view('admin.level.grade', compact('nivel',  'action', 'acciones', 'level_id'));
    }

    // public function materias($level, $action)
    // {

    //     dd($level, $action);

    //     // $nivel = Level::where('slug', $level)->firstOrFail();
    //     // $action = Action::where('slug', $action)->firstOrFail();
    //     // // $grade = Grade::where('grado', $grade)->firstOrFail();

    //     // $acciones = Action::orderBy('sort', "asc")->get();

    //     // $level_id = $nivel->id; // OBTENER EL ID DEL NIVEL

    //     // return view('admin.level.grade', compact('nivel',  'action', 'acciones', 'level_id'));
    // }







}
