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
        return view('encargado.solicitudes.entrantes.index',compact('solicitudes'));
    }
    public function indexA()
    {
        //
        $solicitudes = Solicitud::paginate(15);
        return view('encargado.solicitudes.aprobadas.index',compact('solicitudes'));
    }
    public function indexR()
    {
        //
        $solicitudes = Solicitud::paginate(15);
        return view('encargado.solicitudes.rechazadas.index',compact('solicitudes'));
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
         return view('encargado.solicitudes.entrantes.show', compact('listarSolicitud'));
    }
    public function showA(Solicitud $listarSolicitud)
    {
        //
         return view('encargado.solicitudes.aprobadas.show', compact('listarSolicitud'));
    }
    public function showR(Solicitud $listarSolicitud)
    {
        //
         return view('encargado.solicitudes.rechazadas.show', compact('listarSolicitud'));
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
    public function updateA(Request $request, ListarSolicitud $listarSolicitud)
    {
        //
    }
    public function updateR(Request $request, ListarSolicitud $listarSolicitud)
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
