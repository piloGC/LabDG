<?php

namespace App\Http\Controllers;

use App\Solicitud;
use App\ListarSolicitud;
use Illuminate\Http\Request;

class ListarSolicitudController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','admin']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $solicitudes = Solicitud::paginate(15);
        return view('encargado.solicitudes.index',compact('solicitudes'));
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Solicitud $listarSolicitud)
    {
        //
         return view('encargado.solicitudes.show', compact('listarSolicitud'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ListarSolicitud  $listarSolicitud
     * @return \Illuminate\Http\Response
     */
    public function edit(ListarSolicitud $listarSolicitud)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ListarSolicitud  $listarSolicitud
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ListarSolicitud $listarSolicitud)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ListarSolicitud  $listarSolicitud
     * @return \Illuminate\Http\Response
     */
    public function destroy(ListarSolicitud $listarSolicitud)
    {
        //
    }
}
