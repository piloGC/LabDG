<?php

namespace App\Http\Controllers;

use App\User;
use App\Equipo;
use App\Sancion;
use App\Prestamo;
use App\Solicitud;
use Carbon\Carbon;
use App\Asignatura;
use App\Existencia;
use App\CategoriaEquipo;
use App\PrestamoEstado;
use App\ListarSolicitud;
use App\SolicitudEstado;
use Illuminate\Http\Request;
use App\Mail\AprobarPrestamo; 
use App\Mail\AprobarSolicitud; 
use App\Mail\RechazarSolicitud;
use App\Mail\CancelarSolicitud;  
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;   
use Symfony\Component\Console\Input\Input;
use Illuminate\Database\Eloquent\ModelNotFoundException;
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

        $continuar = '1';
        while($continuar == '1'){
            //todas sus solicitudes en la variable id_solicitud
            $id_solicitud = DB::table('solicituds')->where('user_id',$id);
            $id_solicitudd=$id_solicitud->pluck('id');
            $cantidadSolicitud = count($id_solicitudd);
            for ($i=0; $i <= $cantidadSolicitud; $i++) { 
                //si no posee alguna solicitud en el sistema registrada, se sale del ciclo while
                if(empty($id_solicitudd[$i])){
                    $continuar='2';
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
                            return redirect()->back()->with('fracaso','No puede realizar la solicitud, ya posee una solicitud aprobada con un equipo correspondiente a la categoria '.$infoCategoria->nombre);
                        }
                        if ($idCategoria == $idCategoriaRequest && $estadoSolicitud == '1') {   //pendiente
                            return redirect()->back()->with('fracaso','No puede realizar la solicitud, ya posee una solicitud pendiende correspondiente a la categoria '.$infoCategoria->nombre);
                            // return redirect()->action('SolicitudController@create')->with('fracaso','No puede realizar la solicitud, ya posee una solicitud pendiende correspondiente a la categoria '.$infoCategoria->nombre);
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
                                return redirect()->back()->with('fracaso','No puede realizar la solicitud, no se ha dado por concluido su solicitud anterior, referente al equipo '.$infoEquipoRequest->nombre);
                            }

                            //si me encuentro sancionado, verificar el estado de la sancion
                        }else{
                            $idSancionnn=$idSancionn[0];    
                            $infoSancion = Sancion::find($idSancionnn);
                            $estadoSancion = $infoSancion->estado_id;
                            if($estadoSancion == '1'){  //1=iniciada 
                                return redirect()->back()->with('fracaso','No puede realizar la solicitud, se encuentra Sancionado');
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
        $nuevafecha = strtotime ( '7 days' , strtotime ( $fecha ) ) ;
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
                    if($estadoSolicitud == '3' || $estadoSolicitud == '5' || $estadoSolicitud == '6'){  //rechazada, terminada, cancelada
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
                            return redirect()->back()->with('fracaso','Este equipo ya esta reservado entre el rango de las fechas ingresadas');
                        }elseif($fi > $fis && $fi < $ffs){
                            return redirect()->back()->with('fracaso','Este equipo ya esta reservado entre el rango de las fechas ingresadas');
                        }elseif($fi == $ffs){
                            $consultaDisponibilidadExistencia='2';
                        }
                    
                        if($ff == $fis){
                            $consultaDisponibilidadExistencia='2';
                        }else
                        if($ff > $fis && $fi < $fis){
                            return redirect()->back()->with('fracaso','Este equipo ya esta reservado entre el rango de las fechas ingresadas');
                        }

                        if($fi < $fis && $ff > $ffs){
                            return redirect()->back()->with('fracaso','Este equipo ya esta reservado entre el rango de las fechas ingresadas');
                        }
                    }

                }
            }//fin ciclo for
            $consultaDisponibilidadExistencia='2';
        }//fin ciclo while


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
         
         $prestamo = auth()->user()->prestamo()->create(
             ['fecha_retiro_equipo'=> $request->fecha_inicio ,
             'estado_id'=>1,
             'solicitud_id'=> $id_solicitud, 
             'user_id'=> $id,
             'created_at'=>$now,
             'updated_at'=>$now]);

         //actualizo la existencia
         DB::table('existencias')->where('id',$request->existencia)->update(['disponibilidad_id'=>2]);
        
        //Enviar correo indicando que se creo el prestamo   
        $infoSolicitud = Solicitud::find($idSolicitud); 
        $alumno_id = $infoSolicitud->user_id;
        $infoAlumno = User::find($alumno_id); 
        $mailusuario = $infoAlumno->email;

        $infoEncargado =User::find(1);

        //datos para el correo
        $prestamo->infoEquipo = $infoSolicitud->existencia;
        $prestamo->alumnoNombre = $infoAlumno->name;
        $prestamo->alumnoApellido = $infoAlumno->lastname;
        $prestamo->encargadoNombre = $infoEncargado->name;
        $prestamo->encargadoApellido = $infoEncargado->lastname;  
        $prestamo->infoSolicitud = $infoSolicitud;


         Mail::to($mailusuario)->send(new AprobarPrestamo($prestamo));

         return redirect()->action('AdminController@index')->with('exito','Solicitud creada exitosamente!');
         }else{
            return redirect()->back()->with('fracaso','No se pudo crear la solicitud!');
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
            return view('encargado.solicitudes.show', compact('listarSolicitud'));
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ListarSolicitud  $listarSolicitud
     * @return \Illuminate\Http\Response
     */
    public function edit(Solicitud $listarSolicitud)
    {
        //
        if($listarSolicitud->estado_id == 1){
            return view('encargado.solicitudes.entrantes.rechazar',compact('listarSolicitud'));

        }
        if($listarSolicitud->estado_id == 2){
            return view('encargado.solicitudes.aprobadas.cancelar',compact('listarSolicitud'));
        }
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

    public function encursos(){ 
        $hoy= Carbon::now();
        $solicitudes = Solicitud::where('estado_id',4)->paginate(15);
        return view('encargado.solicitudes.encursos.index',compact('solicitudes','hoy'));

    }
    public function rechazadas(){
        $solicitudes = Solicitud::where('estado_id',3)->orderBy('id','DESC')->paginate(15);
        return view('encargado.solicitudes.rechazadas.index',compact('solicitudes'));
    }

    public function canceladas(){
        $solicitudes = Solicitud::where('estado_id',6)->orderBy('id','DESC')->paginate(15);
        return view('encargado.solicitudes.canceladas.index',compact('solicitudes'));
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

public function cambiarEstadoRechazada(Request $request, Solicitud $listarSolicitud)
{
    $datosRechazo = request()->validate([
        'motivo_estado' => 'required|max:200',
    ]);

    DB::table('solicituds')->update([
        'motivo_estado' => $datosRechazo['motivo_estado'],
      //  'estado_id' => 3
    ]);
    
     $listarSolicitud->estado_id = 3;
     $listarSolicitud->save();
    //valores de añadido a solicitud para realizar la notificación
    $nombre = auth()->user()->name;
    $apellido = auth()->user()->lastname;
    $listarSolicitud->encargadoNombre = $nombre;
    $listarSolicitud->encargadoApellido = $apellido;
    $listarSolicitud->motivorechazo = $datosRechazo['motivo_estado'];

    //Enviar correo indicando el apruebo de solicitud
    $mailusuario = $listarSolicitud->usuario->email;
   Mail::to($mailusuario)->send(new RechazarSolicitud($listarSolicitud));
    return redirect()->action('ListarSolicitudController@rechazadas');
    }
    
    
    public function cambiarEstadoCancelada(Request $request, Solicitud $listarSolicitud){

        $datosCancelar = request()->validate([
            'motivo_estado' => 'required|max:200',
        ]);
    
        DB::table('solicituds')->update([
            'motivo_estado' => $datosCancelar['motivo_estado'],
           // 'estado_id' => 6
        ]);
        $listarSolicitud->estado_id = 6;
        $listarSolicitud->save();
    //valores de añadido a solicitud para realizar la notificación
    $nombre = auth()->user()->name;
    $apellido = auth()->user()->lastname;
    $listarSolicitud->encargadoNombre = $nombre;
    $listarSolicitud->encargadoApellido = $apellido;
    $listarSolicitud->motivocancelar = $datosCancelar['motivo_estado'];
    //Enviar correo indicando el apruebo de solicitud
    $mailusuario = $listarSolicitud->usuario->email;
    Mail::to($mailusuario)->send(new CancelarSolicitud($listarSolicitud));

    return redirect()->action('ListarSolicitudController@canceladas');
    }
    
}
