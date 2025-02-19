<?php

namespace App\Http\Controllers;

use App\Models\Generation;
use App\Http\Requests\StoreGenerationRequest;
use App\Http\Requests\UpdateGenerationRequest;

class GenerationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.generations.index');
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
    public function store(StoreGenerationRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Generation $generation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Generation $generation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGenerationRequest $request, Generation $generation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Generation $generation)
    {
        //
    }
}
