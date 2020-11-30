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
         dd($listarSolicitud);
        if($listarSolicitud->estado_id == 1){
            return view('encargado.solicitudes.entrantes.show', compact('listarSolicitud'));
        }elseif ($listarSolicitud->estado_id == 2) {
             return view('encargado.solicitudes.aprobadas.show', compact('listarSolicitud'));
        }elseif ($listarSolicitud->estado_id == 3) {
            return view('encargado.solicitudes.rechazadas.show', compact('listarSolicitud'));
        }
        
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
    public function update( ListarSolicitud $listarSolicitud)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ListarSolicitud  $listarSolicitud
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function entrantes(){ 
        $solicitudes = Solicitud::where('estado_id',1)->orderBy('id','DESC')->paginate(15);
        return view('encargado.solicitudes.entrantes.index',compact('solicitudes'));

    }

    public function aprobadas(){
        $solicitudes = Solicitud::where('estado_id',2)->orderBy('id','DESC')->paginate(15);
        return view('encargado.solicitudes.aprobadas.index',compact('solicitudes'));
    }

    public function rechazadas(){
        $solicitudes = Solicitud::where('estado_id',3)->orderBy('id','DESC')->paginate(15);
        return view('encargado.solicitudes.rechazadas.index',compact('solicitudes'));
    }
    

    public function cambiarEstadoAprobada(Solicitud $listarSolicitud)
    {
        $listarSolicitud->estado_id = 2;
        $listarSolicitud->save();
        //dd($listarSolicitud);
        return redirect()->action('ListarSolicitudController@entrantes');
    }

    public function cambiarEstadoRechazada(Solicitud $listarSolicitud)
    {
        $listarSolicitud->estado_id = 3;
        $listarSolicitud->save();
        return redirect()->action('ListarSolicitudController@rechazadas');
    }

    
    public function generarPrestamo(){

    }
    
}
