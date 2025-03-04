<?php

namespace App\Http\Controllers;

use App\Models\PagoInscripcion;
use App\Http\Requests\StorePagoInscripcionRequest;
use App\Http\Requests\UpdatePagoInscripcionRequest;

class PagoInscripcionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.pago-inscripcion.index');
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
    public function store(StorePagoInscripcionRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(PagoInscripcion $pagoInscripcion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PagoInscripcion $pagoInscripcion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePagoInscripcionRequest $request, PagoInscripcion $pagoInscripcion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PagoInscripcion $pagoInscripcion)
    {
        //
    }
}
