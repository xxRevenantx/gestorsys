<?php

namespace App\Http\Controllers;

use App\Models\Action;
use App\Models\Level;
use App\Models\Student;
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

        return redirect()->route('admin.level.action', ['nivel' => $level_slug, 'action' => "matricula-escolar"]);

        // $nivel = Level::where('slug', $level_id)->first();


        // $acciones = Action::all();
        // return view('admin.level.action', compact('nivel', 'acciones'));
    }


    public function action($level_slug, $action_slug){


        $nivel = Level::where('slug', $level_slug)->firstOrFail();
        $action = Action::where('slug', $action_slug)->firstOrFail();

        $acciones = Action::orderBy('sort', "asc")->get();

        $level_id = $nivel->id; // OBTENER EL ID DEL NIVEL

        return view('admin.level.action', compact('nivel',  'action', 'acciones', 'level_id'));
    }




}
