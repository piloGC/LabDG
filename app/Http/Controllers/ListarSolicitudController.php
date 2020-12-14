<?php

namespace App\Http\Controllers;

use App\User;
use App\Equipo;
use App\Solicitud;
use Carbon\Carbon;
use App\Asignatura;
use App\Existencia;
use App\PrestamoEstado;
use App\ListarSolicitud;


use App\SolicitudEstado;
use Illuminate\Http\Request;
use App\Mail\AprobarSolicitud; 
use App\Mail\RechazarSolicitud; 
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;   
use Symfony\Component\Console\Input\Input;
use Illuminate\Database\Eloquent\ModelNotFoundException;
;  
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
        $asignaturas = Asignatura::all(['id', 'nombre']);
        $estados = SolicitudEstado::all(['id', 'nombre']);
        $existencias = Existencia::all(['id','codigo','equipo_id']);
     //   $usuario =auth()->user();
        $hoy = Carbon::now()->format('Y-m-d');
        return view('encargado.solicitudes.encursos.create',compact('asignaturas','estados','hoy','existencias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
          $datosSolicitud = $request->validate([
              'motivo' => 'required|max:200',
              'fecha_inicio'=> 'required|date',
              'fecha_fin'=> 'required|date|after:fecha_inicio',
              'asignatura' =>'required',
              'existencia'=>'required',
              'estado'=>'required',
              'run' =>'required|exists:users'
          ]);

        $now=Carbon::now();
        $run=$request->run;
        $usuario=User::where('run',$run);
        $run_usuario=$usuario->pluck('run');
        $run_user=$run_usuario[0];
        $id_usuario=$usuario->pluck('id');
        $id =$id_usuario[0];

         if(strcmp($run, $run_user) === 0){
         //creo la solicitud
         $id_solicitud = DB::table('solicituds')->insertGetId([
             'motivo' => $datosSolicitud['motivo'],
              'fecha_inicio' => $datosSolicitud['fecha_inicio'],
              'fecha_fin' => $datosSolicitud['fecha_fin'],
              'asignatura_id' => $datosSolicitud['asignatura'],
              'existencia_id' => $datosSolicitud['existencia'],
              'estado_id' => 4,
             'user_id' => $id,
             'created_at'=>$now,
             'updated_at'=>$now
          ]);
         //creo el préstamo
         $id_prestamo=  DB::table('prestamos')->insertGetId(
             ['fecha_retiro_equipo'=> $request->fecha_inicio ,
             'fecha_devolucion'=>$request->fecha_fin,
             'estado_id'=>1,
             'solicitud_id'=> $id_solicitud, 
             'user_id'=> $id,
             'created_at'=>$now,
             'updated_at'=>$now]);

         //actualizo la existencia
         DB::table('existencias')->where('id',$request->existencia)->update(['disponibilidad_id'=>2]);

         return redirect()->action('AdminController@index')->with('exito','Solicitud creada exitosamente!');
         }else{
            return redirect()->action('ListarSolicitudController@create')->with('fracaso','No se pudo crear la solicitud!');
         }
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
        //  dd($listarSolicitud);
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
        $solicitudes = Solicitud::where('estado_id',1)->paginate(15);
        return view('encargado.solicitudes.entrantes.index',compact('solicitudes'));

    }

    public function aprobadas(){
        $hoy= Carbon::today();
        $solicitudes = Solicitud::where('estado_id',2)->orderBy('id','DESC')->paginate(15);

        return view('encargado.solicitudes.aprobadas.index',compact('solicitudes','hoy'));
    }

    public function rechazadas(){
        $solicitudes = Solicitud::where('estado_id',3)->orderBy('id','DESC')->paginate(15);
        return view('encargado.solicitudes.rechazadas.index',compact('solicitudes'));
    }
    

    public function cambiarEstadoAprobada(Solicitud $listarSolicitud)
{
    $listarSolicitud->estado_id = 2;
    $listarSolicitud->save();
    //valores de añadido a solicitud para realizar la notificación
    $nombre = auth()->user()->name;
    $apellido = auth()->user()->lastname;
    $listarSolicitud->encargadoNombre = $nombre;
    $listarSolicitud->encargadoApellido = $apellido;
    //Enviar correo indicando el apruebo de solicitud
    $mailusuario = $listarSolicitud->usuario->email;
    Mail::to($mailusuario)->send(new AprobarSolicitud($listarSolicitud));
    
    return redirect()->action('ListarSolicitudController@entrantes');
}

public function cambiarEstadoRechazada(Solicitud $listarSolicitud)
{
    $listarSolicitud->estado_id = 3;
    $listarSolicitud->save();
    //valores de añadido a solicitud para realizar la notificación
    $nombre = auth()->user()->name;
    $apellido = auth()->user()->lastname;
    $listarSolicitud->encargadoNombre = $nombre;
    $listarSolicitud->encargadoApellido = $apellido;
    //Enviar correo indicando el apruebo de solicitud
    $mailusuario = $listarSolicitud->usuario->email;
    Mail::to($mailusuario)->send(new RechazarSolicitud($listarSolicitud));
    return redirect()->action('ListarSolicitudController@rechazadas');
    }

    
    public function generarPrestamo(){

    }
    
}
