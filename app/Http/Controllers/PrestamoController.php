<?php

namespace App\Http\Controllers;

use App\Prestamo;
use App\Asignatura;
use Illuminate\Http\Request;

class PrestamoController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','user']);
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
        $prestamos = Prestamo::where('user_id', $usuario->id)->paginate(5);


        return view('alumno.prestamos.index')->with('prestamos',$prestamos)->with('usuario',$usuario);
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

        return view('alumno.prestamos.create',compact('asignaturas'));
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
         //validacion
         $datosSolicitud = $request->validate([
            'motivo' => 'required|max:200',
            'fecha_inicio'=> 'required|date',
            'fecha_fin'=> 'required|date',
            // 'fecha_devolucion' => 'date',
            // 'fecha_solicitud' => 'date',
            'asignatura' =>'required',
            
        ]);

        //inserta en la bdd con modelo
        auth()->user()->prestamo()->create([
            'motivo'=> $datosSolicitud['motivo'],
            'fecha_inicio'=> $datosSolicitud['fecha_inicio'],
            'fecha_fin'=> $datosSolicitud['fecha_fin'],
            // 'fecha_devolucion' => $datosSolicitud['fecha_devolucion'],
            // 'fecha_solicitud' => $datosSolicitud['fecha_solicitud'],
            'asignatura_id' =>$datosSolicitud['asignatura'],
        ]);

        //return
        return redirect()->action('PrestamoController@index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Prestamo  $prestamo
     * @return \Illuminate\Http\Response
     */
    public function show(Prestamo $prestamo)
    {
        //
        return view('alumno.prestamos.show', compact('prestamo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Prestamo  $prestamo
     * @return \Illuminate\Http\Response
     */
    public function edit(Prestamo $prestamo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Prestamo  $prestamo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Prestamo $prestamo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Prestamo  $prestamo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Prestamo $prestamo)
    {
        //
    }
}
