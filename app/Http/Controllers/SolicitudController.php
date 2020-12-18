<?php

namespace App\Http\Controllers;

use App\SolicitudEstado;
use App\User;
use App\Role;
use App\Equipo;
use App\Sancion;
use App\Solicitud;
use App\Prestamo;
use App\CategoriaEquipo;
use App\Existencia;
use Carbon\Carbon;
use App\Asignatura;

use App\Events\SolicitudEvent;
use App\Notifications\SolicitudNotificacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        $solicitudes = Solicitud::where('user_id', $usuario->id)->orderBy('id','DESC')->paginate(10);


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
        $hoy = Carbon::now();

        return view('alumno.solicitudes.create',compact('asignaturas','estados','hoy','existencias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validacion de datos 
        $datosSolicitud = $request->validate([
            'motivo' => 'required|string|max:200',
            'fecha_inicio'=> 'required|date',
            'fecha_fin'=> 'required|date|after:fecha_inicio',
            'asignatura' =>'required',
            'existencia'=>'required',
            'estado'=>'required',
            'condiciones' => 'required',
        ]);

        $continuar = '1';
        while($continuar == '1'){
            //todas sus solicitudes en la variable id_solicitud
            $id_solicitud = DB::table('solicituds')->where('user_id',Auth::id());
            $id_solicitudd=$id_solicitud->pluck('id');
            $cantidadSolicitud = count($id_solicitudd);
            
            for ($i=0; $i <= $cantidadSolicitud; $i++) { 
                //si no posee alguna solicitud en el sistema registrada, se sale del ciclo while
                if(empty($id_solicitudd[$i])){
                    $continuar='2';
                }else{
                    //al ya poseer alguna solicitud en el sistema, buscamos algun prestamo sancionado, y si este posee el estado activo
                    $idSolicitud=$id_solicitudd[$i]; 

                    $idPrestamo = DB::table('prestamos')->where('solicitud_id',$idSolicitud);
                    $idPrestamoo=$idPrestamo->pluck('id');
                    if(empty($idPrestamoo[0])){
                        //si esta solicitud no tiene prestamo, volver a consultar con la siguiente solicitud
                    }else{
                        //Recuperamos la categoria del Request y la categoria del prestamo para asi compararlas si es que existe una sancion
                        $idPrestamooo=$idPrestamoo[0]; 
                        $infoPrestamo = Prestamo::find($idPrestamooo);   
                        $estadoPrestamo = $infoPrestamo->estado_id;
                        
                        $infoSolicitud = Solicitud::find($idSolicitud);
                        $idExistencia= $infoSolicitud->existencia_id;
                        $idExistenciaRequest = $request->existencia;
                        
                        $infoExistencia = Existencia::find($idExistencia);
                        $infoExistenciaRequest = Existencia::find($idExistenciaRequest);
                        $idEquipo= $infoExistencia->equipo_id;
                        $idEquipoRequest= $infoExistenciaRequest->equipo_id;
                        
                        $infoEquipo = Equipo::find($idEquipo);
                        $infoEquipoRequest = Equipo::find($idEquipoRequest);
                        $idCategoria= $infoEquipo->categoria_id;
                        $idCategoriaRequest= $infoEquipoRequest->categoria_id;
                        
                        //seccion Sancion
                        $idSancion = DB::table('sancions')->where('prestamo_id',$idPrestamooo);
                        $idSancionn=$idSancion->pluck('id');
                        
                        //si no estoy sancionado
                        if(empty($idSancionn[0])){
                            //consulta si tengo alguna solicitud pendiente en el sistema, y si la categoria del equipo de esta
                            //coincide con la categoria de la solicitud que estoy realizando ahora mismoa
                            if ($idCategoria == $idCategoriaRequest && $estadoPrestamo == '1') {
                                return redirect()->action('SolicitudController@create')->with('fracaso','No puede realizar la solicitud, ya posee una solicitud en el sistema con un equipo correspondiente a esa categoria');
                            }
                        }else{
                            
                            $idSancionnn=$idSancionn[0];    
                            $infoSancion = Sancion::find($idSancionnn);
                            $estadoSancion = $infoSancion->estado_id;
                            //si es que estoy sancionado   ->> condicion para categoria idCategoria == $idCategoriaRequest && 
                            if($estadoSancion == '1'){  //1=iniciada    2=terminada
                                return redirect()->action('SolicitudController@create')->with('fracaso','No puede realizar la solicitud, se encuentra Sancionado');
                            }
                        }
                    }
                }
            } // fin for
        }//fin while
        
        $solicitud = auth()->user()->solicitud()->create([
            'motivo'=> $datosSolicitud['motivo'],
            'fecha_inicio'=> $datosSolicitud['fecha_inicio'],
            'fecha_fin'=> $datosSolicitud['fecha_fin'],
            'asignatura_id' =>$datosSolicitud['asignatura'],
            'existencia_id'=> $datosSolicitud['existencia'],
            'estado_id'=>$datosSolicitud['estado'],
        ]);
        $datosSolicitud['user_id'] = Auth::id();
        $datosSolicitud['user_name'] =Auth::User()->name;
        $datosSolicitud['user_lastname'] =Auth::User()->lastname;
        $datosSolicitud['equipo'] = Equipo::find($datosSolicitud['existencia'])->nombre;
        $solicitud->user_name = Auth::User()->name;
        $solicitud->user_lastname = Auth::User()->lastname;
        $solicitud->equipo = Equipo::find($datosSolicitud['existencia'])->nombre;
        //Notificar al Encargado
        //auth()->user()->notify(new SolicitudNotificacion($solicitud));
        // User::all()
        //     ->except($solicitud->user_id)
        //     ->each(function(User $user) use ($solicitud){
        //         user()->notify(new SolicitudNotificacion($solicitud));
        //     });
        //metodo Notificacion con Evento y Listener  -> para todos
        // event (new SolicitudEvent($solicitud));
        $NotificarEncargado = User::find(1);
        $NotificarEncargado->notify(new SolicitudNotificacion($solicitud));
        
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
    public function NotificationNoLeidas()
    {
        $postNotifications = auth()->user()->unreadNotifications;
        return view('encargado.index', compact('postNotifications'));
    }
    public function markNotification(Request $request)
    {
        auth()->user()->unreadNotifications
                ->when($request->input('id'), function($query) use ($request){
                    return $query->where('id', $request->input('id'));
                })->markAsRead();
        return response()->noContent();

        
    }
}
