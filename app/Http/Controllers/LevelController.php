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


    public function edit($slug)
    {
        $level = Level::where('slug', $slug)->firstOrFail();

        return view('admin.levels.edit', compact('level'));
    }







}
