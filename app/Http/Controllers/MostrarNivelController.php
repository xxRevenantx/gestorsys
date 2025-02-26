<?php

namespace App\Http\Controllers;

use App\Models\Action;
use App\Models\Level;
use Illuminate\Http\Request;

class MostrarNivelController extends Controller
{
    public function index()
    {
        $niveles = Level::all();
        return view('admin.level.index', compact('niveles'));
    }

    public function nivel($level_id)
    {

        $nivel = Level::where('slug', $level_id)->first();


        $acciones = Action::all();
        return view('admin.level.action', compact('nivel', 'acciones'));
    }

    public function action($nivel, $action){
        dd($nivel, $action);
    }

}
