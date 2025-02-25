<?php

namespace App\Http\Controllers;

use App\Models\Level;
use Illuminate\Http\Request;

class MostrarNivelController extends Controller
{
    public function index()
    {
        $niveles = Level::all();
        return view('admin.level.index', compact('niveles'));
    }

    public function action($action_id)
    {

        $niveles = Level::all();
        return view('admin.level.index', compact('niveles'));
    }

}
