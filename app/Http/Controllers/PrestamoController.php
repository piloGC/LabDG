<?php

namespace App\Http\Controllers;

use App\User;
use App\Equipo;
use App\Prestamo;
use App\Solicitud;
use Carbon\Carbon;
use App\Existencia;
use App\PrestamoEstado;
use App\CategoriaSancion;
use Illuminate\Http\Request;
use App\Mail\AprobarPrestamo;
use App\Mail\TerminarPrestamo;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;   

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
        $hoy= Carbon::now();
        $usuario =auth()->user();
        
        //prestamos CON paginacion
        $prestamos = Prestamo::where('user_id', $usuario->id)->orderBy('id','DESC')->paginate(5);


        return view('encargado.prestamos.index',compact('prestamos','usuario','hoy'));
        
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $hoy= Carbon::now();
        $prestamo= Solicitud::all('id');
        return view('encargado.prestamos.create',compact('hoy','prestamo'));
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
            // 'fecha_devolucion'=> 'date',
            'solicitud' =>'required',
            'estado' =>'required',
        ]);   
        $fechaRetiro = Carbon::now();
        //inserta en la bdd con modelo
        $correo = auth()->user()->prestamo()->create([
            'fecha_retiro_equipo'=> $fechaRetiro,
            'estado_id' => $datosPrestamo['estado'],
            'solicitud_id'=>$datosPrestamo['solicitud'],
        ]);

        //cambiar estado de la solicitud a encurso
        $solicitud=$request->solicitud; 
        $cambioEstadoEnCurso = Solicitud::find($datosPrestamo['solicitud']);    //info total de la solicitud 
        $cambioEstadoEnCurso['estado_id']=4;
        $cambioEstadoEnCurso->save();
        
        //cambiar estado de la existencia a no disponible
        $disponibilidad=$request->disponibilidad;   //disponibilidad_id
        $existencia=$request->existencia;           //codigo
        $cambioEstadoExistencia = DB::table('existencias')->where('codigo',$existencia)->update(['disponibilidad_id' => '2']);

        //Enviar correo indicando que se creo el prestamo   
        $infoSolicitud = Solicitud::find($datosPrestamo['solicitud']); 
        $alumno_id = $infoSolicitud->user_id;
        $infoAlumno = User::find($alumno_id); 
        $mailusuario = $infoAlumno->email;

        $infoEncargado =User::find(1);

        //datos para el correo
        $correo->infoEquipo = $infoSolicitud->existencia;
        $correo->alumnoNombre = $infoAlumno->name;
        $correo->alumnoApellido = $infoAlumno->lastname;
        $correo->encargadoNombre = $infoEncargado->name;
        $correo->encargadoApellido = $infoEncargado->lastname;  
        $correo->infoSolicitud = $infoSolicitud;

     
        Mail::to($mailusuario)->send(new AprobarPrestamo($correo));

        return redirect()->action('ListarSolicitudController@aprobadas')->with('exito','Se ha generado el préstamo correctamente!');
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Prestamo  $prestamo
     * @return \Illuminate\Http\Response
     */
    public function devolver(Solicitud $prestamo)
    {
        $hoyDevolucion= Carbon::today()->format('Y-m-d');
        // $fechaSancion = Carbon::today();
        // $prestamo['fechaSancion'] = $fechaSancion;
        $idPrestamo = DB::table('prestamos')->where('solicitud_id',$prestamo->id);
        $id_prestamo=$idPrestamo->pluck('id');
        $id_prest=$id_prestamo[0];
        $prestamo['id_prestamo'] = $id_prest;

        $id_user = Solicitud::find($prestamo->id)->user_id;
        $nombreEstudiante = User::find($id_user)->name;
        $apellidoEstudiante = User::find($id_user)->lastname;
        $rut = User::find($id_user)->run;
        $prestamo['nombre'] = $nombreEstudiante;
        $prestamo['apellido'] = $apellidoEstudiante;
        $prestamo['rut'] = $rut;
    
        $id_existencia = Solicitud::find($prestamo->id)->existencia_id;
        $id_equipo = Existencia::find($id_existencia)->equipo_id;
        $nombre_equipo=Equipo::find($id_equipo)->nombre;
        $prestamo['nombre_equipo'] = $nombre_equipo;

        $prestamo['equipo'] = $id_equipo;

        return view('encargado.prestamos.edit',compact('hoyDevolucion','prestamo'));
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
        $now=Carbon::now();

        //rescato valores para modificar prestamo
        $fecha_devolucion=$request->fecha_devolucion;
        $devolucion=Carbon::parse($fecha_devolucion)->format('Y-m-d 00:00:00');

        $requestId = $request->solicitud;
        $solicitudId=$prestamo->solicitud_id;
        $solicitud=Solicitud::findOrFail($solicitudId);

        $existenciaId = Solicitud::find($solicitudId)->existencia_id;
        $fechaFin = Solicitud::find($solicitudId)->fecha_fin;
        $solicitud_estado = Solicitud::find($solicitudId)->estado_id;

        //rescato valores de prestamo 
        $prestamo_id= $prestamo->id;
        $prestamo_estado=$prestamo->estado_id;


        if($requestId == $solicitudId && $solicitud_estado == 4 && $prestamo_estado == 1){
            $prestamo->estado_id = 2;
            $prestamo->fecha_devolucion = $now;
            $prestamo->save();
            
            
            DB::table('solicituds')->where('id',$solicitudId)->update(['estado_id' => 5]);
            DB::table('existencias')->where('id',$existenciaId)->update(['disponibilidad_id' => 1]);

                
         
            //Enviar correo indicando que se termino el prestamo   
            $alumno_id = $solicitud->user_id;
            $infoAlumno = User::find($alumno_id); 
            $mailusuario = $infoAlumno->email;

            $infoEncargado =User::find(1);

            //datos para el correo
            $correo = DB::table('prestamos')->where('id',$prestamo_id);
            // dd($correo);
            $correo->fecha_devolucion = $now;
            $correo->alumnoNombre = $infoAlumno->name;
            $correo->alumnoApellido = $infoAlumno->lastname;
            $correo->encargadoNombre = $infoEncargado->name;
            $correo->encargadoApellido = $infoEncargado->lastname;  
            $correo->idSolicitud = $solicitud;
            // $correo->idExistencia = $existenciaId;    
   
            Mail::to($mailusuario)->send(new TerminarPrestamo($correo));

            
            

            return redirect()->action('PrestamoController@index')->with('exito','Se ha concluido su prestamo!');
        }

        return redirect()->action('ListarSolicitudController@encursos')->with('fracaso','No se  ha concluido su prestamo!');

     
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

    public function sancionar(Request $request,Prestamo $prestamo)
    {
        //finalizar Prestamo
        $now=Carbon::now();
        
        //rescato valores para modificar prestamo
        $fecha_devolucion= Carbon::today()->format('Y-m-d');
        // $fecha_devolucion=$request->fecha_devolucion;
        $devolucion=Carbon::parse($fecha_devolucion)->format('Y-m-d 00:00:00');

        // $requestId = $request->solicitud;
        $solicitudId=$prestamo->solicitud_id;
        $solicitud=Solicitud::findOrFail($solicitudId);

        $existenciaId = Solicitud::find($solicitudId)->existencia_id;
        $fechaFin = Solicitud::find($solicitudId)->fecha_fin;
        $solicitud_estado = Solicitud::find($solicitudId)->estado_id;

        //rescato valores de prestamo 
        $prestamo_id= $prestamo->id;
        $prestamo_estado=$prestamo->estado_id;

        // si estoy devolviendo el mismo dia que finaliza mi prestamo o me atrase al devolverlo, entro a este ciclo
        if($solicitud_estado == 4 && $prestamo_estado == 1){
            //si corresponde al prestamo, se generara su sancion, y luego de generar la sancion, se libera el prestamo

            $categorias = CategoriaSancion::all(['id','nombre']);
            $hoySancion= Carbon::today();
            $id_user = Solicitud::find($prestamo->solicitud_id)->user_id;
            $nombreEstudiante = User::find($id_user)->name;
            $apellidoEstudiante = User::find($id_user)->lastname;
            $rut = User::find($id_user)->run;
            $prestamo['nombre'] = $nombreEstudiante;
            $prestamo['apellido'] = $apellidoEstudiante;
            $prestamo['rut'] = $rut;
        
            $id_existencia = Solicitud::find($prestamo->solicitud_id)->existencia_id;
            $id_equipo = Existencia::find($id_existencia)->equipo_id;
            $nombre_equipo=Equipo::find($id_equipo)->nombre;
            $prestamo['nombre_equipo'] = $nombre_equipo;

            return view('encargado.sanciones.create',compact('prestamo','categorias','hoySancion'));

        }
        


    }
}
