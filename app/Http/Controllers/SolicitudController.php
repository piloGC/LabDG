<?php

namespace App\Http\Controllers;

use App\SolicitudEstado;
use App\Solicitud;
use Carbon\Carbon;
use App\Asignatura;
use App\Existencia;
use Illuminate\Http\Request;

class SolicitudController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $usuario =auth()->user();

        //prestamos CON paginacion
        $solicitudes = Solicitud::where('user_id', $usuario->id)->orderBy('id','DESC')->paginate(5);


        return view('alumno.solicitudes.index',compact('solicitudes','usuario'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $asignaturas = Asignatura::all(['id', 'nombre']);
        $estados = SolicitudEstado::all(['id', 'nombre']);
        $existencias = Existencia::all(['id','codigo','equipo_id']);
        $usuario =auth()->user();
        $hoy = Carbon::now();

        return view('alumno.solicitudes.create',compact('asignaturas','estados','hoy','existencias','usuario'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validacion
         $datosSolicitud = $request->validate([
            'motivo' => 'required|max:200',
            'fecha_inicio'=> 'required|date|before:fecha_fin',
            'fecha_fin'=> 'required|date',
            'asignatura' =>'required',
            'existencia'=>'required',
            'estado'=>'required',
        ]);

        //inserta en la bdd con modelo
        auth()->user()->solicitud()->create([
            'motivo'=> $datosSolicitud['motivo'],
            'fecha_inicio'=> $datosSolicitud['fecha_inicio'],
            'fecha_fin'=> $datosSolicitud['fecha_fin'],
            'asignatura_id' =>$datosSolicitud['asignatura'],
            'existencia_id'=> $datosSolicitud['existencia'],
            'estado_id'=>$datosSolicitud['estado'],
        ]);

        return redirect()->action('SolicitudController@index')->with('mensaje','Solicitud enviada!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Solicitud  $solicitud
     * @return \Illuminate\Http\Response
     */
    public function show(Solicitud $solicitud)
    {
        //
        return view('alumno.solicitudes.show', compact('solicitud'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Solicitud  $solicitud
     * @return \Illuminate\Http\Response
     */
    public function edit(Solicitud $solicitud)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Solicitud  $solicitud
     * @return \Illuminate\Http\Response
     */
    public function update( Solicitud $solicitud)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Solicitud  $solicitud
     * @return \Illuminate\Http\Response
     */
    public function destroy(Solicitud $solicitud)
    {
        //
    }



}
