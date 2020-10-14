<?php

namespace App\Http\Controllers;

use App\Existencia;
use Illuminate\Http\Request;

class ExistenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('existencia.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Existencia  $existencia
     * @return \Illuminate\Http\Response
     */
    public function show(Existencia $existencia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Existencia  $existencia
     * @return \Illuminate\Http\Response
     */
    public function edit(Existencia $existencia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Existencia  $existencia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Existencia $existencia)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Existencia  $existencia
     * @return \Illuminate\Http\Response
     */
    public function destroy(Existencia $existencia)
    {
        //
    }
}
