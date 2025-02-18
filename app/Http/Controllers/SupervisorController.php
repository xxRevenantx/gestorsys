<?php

namespace App\Http\Controllers;

use App\Models\Supervisor;
use App\Http\Requests\StoreSupervisorRequest;
use App\Http\Requests\UpdateSupervisorRequest;
use Illuminate\Http\Request;

class SupervisorController extends Controller
{

    public function index()
    {
        $supervisores = Supervisor::orderBy('id', 'desc')->get();
        return view('admin.autoridades.supervisores.index', compact('supervisores'));
    }


    public function create()
    {
        return view('admin.autoridades.supervisores.create');
    }


    public function edit($supervisor_id)
    {
        $supervisor = Supervisor::find($supervisor_id);


        return view('admin.autoridades.supervisores.edit', compact('supervisor'));
    }


}
