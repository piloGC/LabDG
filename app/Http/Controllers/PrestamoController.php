<?php

namespace App\Http\Controllers;

use App\Prestamo;
use App\Solicitud;
use Carbon\Carbon;
use App\Asignatura;
use Illuminate\Http\Request;

class PrestamoController extends Controller
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
    public function index( )
    {
        //
        $usuario =auth()->user();

        //prestamos CON paginacion
        $prestamos = Prestamo::where('user_id', $usuario->id)->orderBy('id','DESC')->paginate(5);


        return view('encargado.prestamos.index',compact('prestamos','usuario'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('encargado.prestamos.create');
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
         $datosPrestamo = $request->validate([
            'fecha_retiro_equipo'=> 'required|date',
            'fecha_devolucion'=> 'required|date',
            'solicitud' =>'required',
        ]);

        //inserta en la bdd con modelo
        auth()->user()->prestamo()->create([
            'fecha_retiro_equipo'=> $datosPrestamo['fecha_retiro_equipo'],
            'fecha_devolucion'=> $datosPrestamo['fecha_devolucion'],
            'solicitud_id'=>$datosPrestamo['solicitud'],
        ]);

        return redirect()->action('PrestamoController@index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Prestamo  $prestamo
     * @return \Illuminate\Http\Response
     */
    public function show(Solicitud $prestamo)
    {
        //
        
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
