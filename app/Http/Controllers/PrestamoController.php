<?php

namespace App\Http\Controllers;

use App\Prestamo;
use App\User;
use App\Equipo;
use App\Solicitud;
use Carbon\Carbon;
use App\Existencia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $hola = auth()->user()->prestamo()->create([
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

        return redirect()->action('ListarSolicitudController@aprobadas')->with('exito','Se ha generado el préstamo correctamente!');
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
    public function devolver(Solicitud $prestamo)
    {

        $hoyDevolucion= Carbon::today()->format('Y-m-d');
        $fechaSancion = Carbon::today();
        $prestamo['fechaSancion'] = $fechaSancion;
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

        return view('encargado.prestamos.edit',compact('hoyDevolucion','prestamo','fechaSancion'));
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


        if($devolucion >= $fechaFin  && $requestId == $solicitudId && $solicitud_estado == 4 && $prestamo_estado == 1){
            $prestamo->estado_id = 2;
            $prestamo->fecha_devolucion = $now;
            $prestamo->save();

            DB::table('solicituds')->where('id',$solicitudId)->update(['estado_id' => 5]);
            DB::table('existencias')->where('id',$existenciaId)->update(['disponibilidad_id' => 1]);

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

    public function sancionar(Solicitud $prestamo)
    {
        dd($prestamo);
        asda;
    }
}
