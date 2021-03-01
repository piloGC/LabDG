<?php

namespace App\Http\Controllers;

use App\Sala;
use App\Equipo;
use App\Reserva;
use Carbon\Carbon;
use App\ReservaEstado;
use ReservaEstadoSeeder;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReservaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $busqueda=$request['reserva'];
        $reservas = Reserva::where('id','>',0)->where('nombre_reserva','like','%' . $busqueda . '%')->orderBy('id','desc')->paginate(10);
        $reservas->appends(['reserva' => $busqueda]);
        return view ('encargado.reservas.index')->with('reservas',$reservas);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $salas=Sala::all(['id','nombre']); 
        $hoy=Carbon::now()->format('Y-m-d');
        return view('encargado.reservas.create',compact('salas','hoy'));
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
        $datosReserva = $request->validate([
            'nombre' => 'required|string|max:80',
            'encargado' => 'required|string|max:40',
            'dia_reserva' => 'required',
            'hora_inicio' => 'required|string|max:5',
            'hora_fin' =>'required|string|max:5',
            'tipo_publico'=> 'required|string|max:40',
            'sala' => 'required',
            
        ]);
        auth()->user()->reserva()->create([
            'nombre_reserva' =>$datosReserva['nombre'],
            'encargado_reserva'=> $datosReserva['encargado'],
            'dia_reserva' => $datosReserva['dia_reserva'],
            'hora_inicio' =>$datosReserva['hora_inicio'],
            'hora_fin' =>$datosReserva['hora_fin'],
            'tipo_publico' =>$datosReserva['tipo_publico'],
            'sala_id'=>$datosReserva['sala'],
            'estado_id'=>1,
        ]);
        // dd($datosReserva);
        return redirect()->action('ReservaController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Reserva  $reserva
     * @return \Illuminate\Http\Response
     */
    public function show(Reserva $reserva)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Reserva  $reserva
     * @return \Illuminate\Http\Response
     */
    public function edit(Reserva $reserva)
    {
        $salas=Sala::all(['id','nombre']);
        $estados=ReservaEstado::all();
        $hoy=Carbon::now()->format('Y-m-d');
        return view('encargado.reservas.edit',compact('salas','reserva','estados','hoy'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Reserva  $reserva
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reserva $reserva)
    {
        //validacion
        $datosReserva = $request->validate([
            'nombre' => 'required|max:80',
            'encargado' => 'required|max:40',
            'dia_reserva' => 'required',
            'hora_inicio' => 'required|string|max:5',
            'hora_fin' =>'required|string|max:5',
            'tipo_publico'=> 'required|string|max:40',
            'sala' => 'required',
            'estado' =>'required',
        ]);
        //asignar valores
        $reserva->nombre_reserva = $datosReserva['nombre'];
        $reserva->encargado_reserva = $datosReserva['encargado'];
        $reserva->dia_reserva = $datosReserva['dia_reserva'];
        $reserva->hora_inicio =$datosReserva['hora_inicio'];
        $reserva->hora_fin  =$datosReserva['hora_fin'];
        $reserva->tipo_publico = $datosReserva['tipo_publico'];
        $reserva->sala_id = $datosReserva['sala'];
        $reserva->estado_id = $datosReserva['estado'];

        $reserva->save();
        return redirect()->action('ReservaController@index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Reserva  $reserva
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reserva $reserva)
    {
        //
    }

    public function reservas(){
        $hoy=Carbon::now()->format('Y-m-d');
        $reservas = Reserva::Where('estado_id',1)->orderBy('dia_reserva','asc')->paginate(20);
        return view('alumno.salas.reservas',compact('reservas','hoy'));
    }

    public function reservasHoy(){
        $hoy=Carbon::now()->format('Y-m-d');
        $reservas = Reserva::Where('estado_id',1)->where('dia_reserva',$hoy)->paginate(20);
        return view('encargado.reservas.reservas',compact('reservas','hoy'));

    }
}
//Str::slug($reserva->nombre_reserva)
// $now=Carbon::now()->isoFormat('dddd');
// Str::slug(\Carbon\Carbon::parse($reserva->fecha_inicio_reserva)->isoFormat('DD [de] MMMM [del] YYYY'))