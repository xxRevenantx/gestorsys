<?php

namespace App\Http\Controllers;

use App\Models\Personnel;
use App\Http\Requests\StorePersonnelRequest;
use App\Http\Requests\UpdatePersonnelRequest;

class PersonnelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.personnel.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePersonnelRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($personnel_id)
    {
        $personnel = Personnel::findOrFail($personnel_id);
        return view('admin.personnel.show', compact('personnel'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($personnel_id)
    {
        $personnel = Personnel::findOrFail($personnel_id);
        return view('admin.personnel.edit', compact('personnel'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePersonnelRequest $request, Personnel $personnel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Personnel $personnel)
    {
        //
    }
}
