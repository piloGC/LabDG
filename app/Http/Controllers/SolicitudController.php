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
        $estados = SolicitudEstado::all(['id', 'nombre']);
        $existencias = Existencia::all(['id','codigo','equipo_id']);
        $hoy = Carbon::now();

        return view('alumno.solicitudes.create',compact('estados','hoy','existencias'));
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
           'motivo' => 'required|string|max:200',
           'fecha_inicio'=> 'required|date',
           'fecha_fin'=> 'required|date|after:fecha_inicio',
           'asignatura' =>'required|string',
           'existencia'=>'required',
           'estado'=>'required',
           'condiciones' => 'required',
       ]);
        
       if($datosSolicitud['existencia']==0){
        return redirect()->action('SolicitudController@create');
       }

       $fecha_un_dia = strtotime ( '1 days' , strtotime ( $datosSolicitud['fecha_inicio'] ) ) ;
       $fecha_un_diaformato = date ( 'Y-m-d' , $fecha_un_dia );

       $fecha_dos_dia = strtotime ( '2 days' , strtotime ( $datosSolicitud['fecha_inicio'] ) ) ;
       $fecha_dos_diaformato = date ( 'Y-m-d' , $fecha_dos_dia );

       $fecha_tres_dia = strtotime ( '3 days' , strtotime ( $datosSolicitud['fecha_inicio'] ) ) ;
       $fecha_tres_diaformato = date ( 'Y-m-d' , $fecha_tres_dia );

       $fechats_inicio = strtotime($datosSolicitud['fecha_inicio']); //a timestamp
       $fechats_fin = strtotime($datosSolicitud['fecha_fin']); //a timestamp

       //el parametro w en la funcion date indica que queremos el dia de la semana
       //lo devuelve en numero 0 domingo, 1 lunes,....
       switch (date('w', $fechats_inicio)){
           case 0:  //domingo                           
                return redirect()->action('SolicitudController@create')->with('fracaso','No puede crear una solicitud para un día domingo');
                break;
           case 1: //lunes
                //si fecha fin es distinto que martes o miercoles
                if($datosSolicitud['fecha_fin'] != $fecha_un_diaformato && $datosSolicitud['fecha_fin'] != $fecha_dos_diaformato ){
                    return redirect()->action('SolicitudController@create')->with('fracaso','Puede solicitar un equipo por máximo de 2 días');
                    break;
                }
                break;
           case 2: //martes
                //si fecha fin es distinto que  miercoles o jueves
                if($datosSolicitud['fecha_fin'] != $fecha_un_diaformato && $datosSolicitud['fecha_fin'] != $fecha_dos_diaformato ){
                    return redirect()->action('SolicitudController@create')->with('fracaso','Puede solicitar un equipo por máximo de 2 días');
                    break;
                }
                break;
           case 3: //miercoles
                //si fecha fin es distinto que  jueves o viernes
                if($datosSolicitud['fecha_fin'] != $fecha_un_diaformato && $datosSolicitud['fecha_fin'] != $fecha_dos_diaformato ){
                    return redirect()->action('SolicitudController@create')->with('fracaso','Puede solicitar un equipo por máximo de 2 días');
                    break;
                }
                break;
           case 4: //"Jueves"
                //si fecha fin es distinto que  viernes
                if($datosSolicitud['fecha_fin'] != $fecha_un_diaformato){
                    return redirect()->action('SolicitudController@create')->with('fracaso','Puede solicitar un equipo por máximo de 2 días');
                    break;
                }
                break;
           case 5: //viernes
                //si fecha fin es distinto que lunes
                if($datosSolicitud['fecha_fin'] != $fecha_tres_diaformato){
                    return redirect()->action('SolicitudController@create')->with('fracaso','Solo puedes pedir el equipo hasta el día lunes');
                    break;
                }
                break;
           case 6: 
            return redirect()->action('SolicitudController@create')->with('fracaso','No puede crear una solicitud para un día sabado');
            break;
       } 
       switch (date('w', $fechats_fin)){
        case 0:  //domingo                           
             return redirect()->action('SolicitudController@create')->with('fracaso','No puede finalizar una solicitud para un día domingo');
             break;
        case 1: //lunes
             break;
        case 2: //martes
             break;
        case 3: //miercoles
             break;
        case 4: //"Jueves"
             break;
        case 5: //viernes
             break;
        case 6: 
         return redirect()->action('SolicitudController@create')->with('fracaso','No puede finalizar una solicitud para un día sabado');
         break;
    } 


       //Validacion para ver si usuario esta sancionado o tiene alguna solicitud en sistema con misma categoria
        $consultaValidacion = '1';
        while($consultaValidacion == '1'){
            //todas sus solicitudes en la variable id_solicitud
            $id_solicitud = DB::table('solicituds')->where('user_id',Auth::id());
            $id_solicitudd=$id_solicitud->pluck('id');
            $cantidadSolicitud = count($id_solicitudd);
            
            for ($i=0; $i <= $cantidadSolicitud; $i++) { 
                //si no posee alguna solicitud en el sistema registrada, se sale del ciclo while
                if(empty($id_solicitudd[$i])){
                    $consultaValidacion='2';
                }else{
                    //rescatamos la info de la solicitud en el sistema
                    $idSolicitud=$id_solicitudd[$i]; 
                    $infoSolicitud = Solicitud::find($idSolicitud);
                    $estadoSolicitud = $infoSolicitud->estado_id;

                    $idExistencia= $infoSolicitud->existencia_id;
                    $idExistenciaRequest = $request->existencia;
                    $infoExistencia = Existencia::find($idExistencia);
                    $infoExistenciaRequest = Existencia::find($idExistenciaRequest);

                    $idEquipo= $infoExistencia->equipo_id;
                    $idEquipoRequest= $infoExistenciaRequest->equipo_id;
                    $infoEquipo = Equipo::find($idEquipo);
                    $infoEquipoRequest = Equipo::find($idEquipoRequest);

                    //Recuperamos la categoria del Request y la categoria de la solicitud, para asi realizar las diversas validaciones
                    $idCategoria= $infoEquipo->categoria_id;
                    $idCategoriaRequest= $infoEquipoRequest->categoria_id;

                    $infoCategoria = CategoriaEquipo::find($idCategoria);

                    //buscamos si esta solicitud tiene algun prestamo vinculado
                    $idPrestamo = DB::table('prestamos')->where('solicitud_id',$idSolicitud);
                    $idPrestamoo=$idPrestamo->pluck('id');

                    if(empty($idPrestamoo[0])){
                        //si esta solicitud no tiene prestamo, volver a consultar con la siguiente solicitud

                        if ($idCategoria == $idCategoriaRequest && $estadoSolicitud == '2') { //aprobada
                            return redirect()->action('SolicitudController@create')->with('fracaso','No puede realizar la solicitud, ya posee una solicitud reservada correspondiente a la categoría '.$infoCategoria->nombre);
                        }
                        if ($idCategoria == $idCategoriaRequest && $estadoSolicitud == '1') {   //pendiente
                            return redirect()->action('SolicitudController@create')->with('fracaso','No puede realizar la solicitud, ya posee una solicitud pendiende correspondiente a la categoría '.$infoCategoria->nombre);
                        }
                    }else{

                        //si esta solicitud tiene generado un prestamo, rescatamos su info
                        $idPrestamooo=$idPrestamoo[0]; 
                        $infoPrestamo = Prestamo::find($idPrestamooo);   
                        $estadoPrestamo = $infoPrestamo->estado_id;
        
                        //seccion Sancion
                        $idSancion = DB::table('sancions')->where('prestamo_id',$idPrestamooo);
                        $idSancionn=$idSancion->pluck('id');
                        
                        //si no estoy sancionado, verificar el estado del prestamo correspondiente a su solicitud
                        if(empty($idSancionn[0])){
                            if ($idCategoria == $idCategoriaRequest && $estadoPrestamo == '1') {    //iniciado
                                return redirect()->action('SolicitudController@create')->with('fracaso','No puede realizar la solicitud, no se ha dado por concluido su solicitud anterior, referente al equipo '.$infoEquipoRequest->nombre);
                            }

                            //si me encuentro sancionado, verificar el estado de la sancion
                        }else{
                            $idSancionnn=$idSancionn[0];    
                            $infoSancion = Sancion::find($idSancionnn);
                            $estadoSancion = $infoSancion->estado_id;
                            if($estadoSancion == '1'){  //1=iniciada 
                                return redirect()->action('SolicitudController@create')->with('fracaso','No puede realizar la solicitud, se encuentra Sancionado');
                            }
                        }
                    }
                }
            } // fin for
            $consultaValidacion = '2';
        }//fin while
        


        //validacion para que su el equipo solicitado este disponible en esas fechas
        $consultaDisponibilidadExistencia = '1';
        $fecha = Carbon::now();
        $nuevafecha = strtotime ( '5 days' , strtotime ( $fecha ) ) ;
        $nuevafecha = date ( 'Y-m-d' , $nuevafecha );

        while($consultaDisponibilidadExistencia == '1'){
            //todas  en la variable id_solicitud
            $id_solicitud = DB::table('solicituds')->where('existencia_id',$datosSolicitud['existencia'])->where('fecha_inicio','>','nuevafecha');
            $id_solicitudd=$id_solicitud->pluck('id');
            $cantidadSolicitud = count($id_solicitudd);

            for ($i=0; $i <= $cantidadSolicitud; $i++) { 
                //si no existe alguna solicitud con ese equipo en el sistema, se sale del ciclo while
                if(empty($id_solicitudd[$i])){
                    $consultaDisponibilidadExistencia='2';
                }else{
                    //al ya poseer una solicitud en el sistema con ese misma existencia, consultar por las fechas
                    $idSolicitud=$id_solicitudd[$i]; 
                    $infoSolicitud = Solicitud::find($idSolicitud); 
                    $estadoSolicitud = $infoSolicitud->estado_id;
                    if($estadoSolicitud == '1' || $estadoSolicitud == '3' || $estadoSolicitud == '5' || $estadoSolicitud == '6'){  //pendiente rechazada, terminada, cancelada
                        //revisar siguiente solicitud
                    }else{
                        //el estado de la solicitud esta pendiente, aprobada o en curso, comparamos sus fechas, para verificar si es posible la solicitud deseada por el estudiante


                        $fis = Carbon::parse($infoSolicitud->fecha_inicio);
                        // $dfecha_inicio_sis = $fis->day;
                        // $mfecha_inicio_sis = $fis->month;
                        $ffs = Carbon::parse($infoSolicitud->fecha_fin);
                        $fi = Carbon::parse($datosSolicitud['fecha_inicio']);
                        $ff = Carbon::parse($datosSolicitud['fecha_fin']);

                        if($fi == $fis ){
                            return redirect()->action('SolicitudController@create')->with('fracaso','Este equipo ya está reservado entre el rango de las fechas ingresadas');
                        }elseif($fi > $fis && $fi < $ffs){
                            return redirect()->action('SolicitudController@create')->with('fracaso','Este equipo ya está reservado entre el rango de las fechas ingresadas');
                        }elseif($fi == $ffs){
                            $consultaDisponibilidadExistencia='2';
                        }
                    
                        if($ff == $fis){
                            $consultaDisponibilidadExistencia='2';
                        }else
                        if($ff > $fis && $fi < $fis){
                            return redirect()->action('SolicitudController@create')->with('fracaso','Este equipo ya está reservado entre el rango de las fechas ingresadas');
                        }

                        if($fi < $fis && $ff > $ffs){
                            return redirect()->action('SolicitudController@create')->with('fracaso','Este equipo ya está reservado entre el rango de las fechas ingresadas');
                        }
                    }

                }
            }//fin ciclo for
            $consultaDisponibilidadExistencia='2';
        }//fin ciclo while

        $solicitud = auth()->user()->solicitud()->create([
            'motivo'=> $datosSolicitud['motivo'],
            'fecha_inicio'=> $datosSolicitud['fecha_inicio'],
            'fecha_fin'=> $datosSolicitud['fecha_fin'],
            'asignatura' =>$datosSolicitud['asignatura'],
            'existencia_id'=> $datosSolicitud['existencia'],
            'estado_id'=>$datosSolicitud['estado'],
        ]);
        $infoExistencia = Existencia::find($datosSolicitud['existencia']);
        $idEquipo= $infoExistencia->equipo_id;
        $infoEquipo = Equipo::find($idEquipo);

        $datosSolicitud['user_id'] = Auth::id();
        $datosSolicitud['user_name'] =Auth::User()->name;
        $datosSolicitud['user_lastname'] =Auth::User()->lastname;
        $datosSolicitud['equipo'] = $infoEquipo->nombre;
        $solicitud->user_name = Auth::User()->name;
        $solicitud->user_lastname = Auth::User()->lastname;
        $solicitud->equipo = $infoEquipo->nombre;

        //Notificar al Encargado
        $encargados = db::table('users')->where('role_id',1);
        $id_encargados=$encargados->pluck('id');
        $cantidad = count($id_encargados);

        for ($i=0; $i < $cantidad; $i++) { 
            $id=$id_encargados[$i]; 
            $NotificarEncargado = User::find($id);
            $NotificarEncargado->notify(new SolicitudNotificacion($solicitud));
        }
        
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
