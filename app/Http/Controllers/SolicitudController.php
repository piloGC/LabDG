<?php

namespace App\Http\Controllers;

use App\SolicitudEstado;
use App\User;
use App\Role;
use App\Equipo;
use App\Solicitud;
use Carbon\Carbon;
use App\Asignatura;
use App\Existencia;
use App\Events\SolicitudEvent;
use App\Notifications\SolicitudNotificacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        //validacion
         $datosSolicitud = $request->validate([
            'motivo' => 'required|max:200',
            'fecha_inicio'=> 'required|date',
            'fecha_fin'=> 'required|date|after:fecha_inicio',
            'asignatura' =>'required',
            'existencia'=>'required',
            'estado'=>'required',
            'condiciones' => 'required',
        ]);
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
