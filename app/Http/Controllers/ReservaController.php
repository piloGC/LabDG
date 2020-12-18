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
    public function index()
    {
        //
         $reservas = Reserva::where('id',">",0)->orderBy('id','desc')->paginate(10);
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
        return view('encargado.reservas.create',compact('salas'));
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
            'nombre' => 'required|max:80',
            'encargado' => 'required|max:40',
            'fecha' => 'required',
            'sala' => 'required',
            
        ]);
        auth()->user()->reserva()->create([
            'nombre_evento' =>$datosReserva['nombre'],
            'encargado_evento'=> $datosReserva['encargado'],
            'fecha_evento' => $datosReserva['fecha'],
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
        return view('encargado.reservas.edit',compact('salas','reserva','estados'));
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
            'sala' => 'required',
            'estado' =>'required',
        ]);
        $hoy=Carbon::today()->format('Y-m-d H:i:00');
        //asignar valores
        $reserva->nombre_evento = $datosReserva['nombre'];
        $reserva->encargado_evento = $datosReserva['encargado'];
        $reserva->sala_id = $datosReserva['sala'];
        $reserva->estado_id = $datosReserva['estado'];

        $reserva->save();
        return redirect()->action('ReservaController@index');

    }
    public function formFecha(Reserva $reserva){
        return view('encargado.reservas.fecha',compact('reserva'));
    }

    public function cambiarFecha(Request $request,Reserva $reserva){
        request()->validate([
            'fecha'=>'required',
        ]);
        $reserva->fecha_evento = $request->fecha;
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

    public function eventos(){
        $eventoss = Reserva::Where('estado_id',1)->get();
        $eventos=[];
        foreach($eventoss as $evento){
            $eventos[Str::slug(\Carbon\Carbon::parse($evento->fecha_evento)->isoFormat('DD [de] MMMM [del] YYYY'))][] = Reserva::Where('estado_id',1)->get();
        }
        return view('alumno.salas.eventos',compact('eventos'));
    }

    
}
