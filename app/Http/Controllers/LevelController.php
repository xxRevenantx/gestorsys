<?php

namespace App\Http\Controllers;

use App\Models\Level;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class LevelController extends Controller
{

    public function index()
    {
        return view('admin.levels.index');
    }


    public function create()
    {

    }

    public function show()
    {

    }


    public function edit($level_id)
    {
        $level = Level::find($level_id);
        return view('admin.levels.edit', compact('level'));

    }






}
