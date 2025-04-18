<?php

namespace App\Http\Controllers;

use App\Models\Bachillerato;
use App\Http\Requests\StoreBachilleratoRequest;
use App\Http\Requests\UpdateBachilleratoRequest;

class BachilleratoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.bachillerato.index');
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
    public function store(StoreBachilleratoRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Bachillerato $bachillerato)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bachillerato $bachillerato)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBachilleratoRequest $request, Bachillerato $bachillerato)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bachillerato $bachillerato)
    {
        //
    }
}
