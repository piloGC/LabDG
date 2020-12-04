<?php

namespace App\Http\Controllers;

use App\Equipo;
use Carbon\Carbon;
use App\Existencia;
use App\ExistenciaEstado;
use Illuminate\Http\Request;
use App\ExistenciaDisponibilidad;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ExistenciaController extends Controller
{
    public function __construct(){
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
        $datos ['existencias']=Existencia::paginate(10);
        return view ('encargado.existencias.index',$datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $estados = ExistenciaEstado::all(['id','nombre']);
        $disponibilidads = ExistenciaDisponibilidad::all(['id','nombre']);
        $equipos = Equipo::all(['id','nombre']);
        $hoy = Carbon::now()->format('Y-m-d');
        return view('encargado.existencias.create',compact('estados','disponibilidads','equipos','hoy'));
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
        $dato = $request->validate([
            'codigo' => 'required|max:40',
            'fecha_adquisicion' => 'required|date',
            'estado' => 'required|max:40',
            'disponibilidad' => 'required|max:200',
            'equipo' => 'required',
           
        ]);

        DB::table('existencias')->insert([
            'codigo' => $dato['codigo'],
            'fecha_adquisicion' => $dato['fecha_adquisicion'],
            'estado_id' => $dato['estado'],
            'disponibilidad_id' => $dato['disponibilidad'],
            'equipo_id' => $dato['equipo']
        ]);

        return redirect()->action('ExistenciaController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Existencia  $existencia
     * @return \Illuminate\Http\Response
     */
    public function show(Existencia $existencia)
    {
        return view('encargado.existencias.show',compact('existencia'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Existencia  $existencia
     * @return \Illuminate\Http\Response
     */
    public function edit(Existencia $existencia)
    {
        $estados = ExistenciaEstado::all(['id','nombre']);
        $disponibilidads = ExistenciaDisponibilidad::all(['id','nombre']);
        $equipos = Equipo::all(['id','nombre']);
        $fecha = Carbon::parse($existencia->fecha_adquisicion);
        return view('encargado.existencias.edit',compact('estados','disponibilidads','equipos','existencia','fecha'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Existencia  $existencia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Existencia $existencia)
    {
        //validacion
        $datosExistencia = $request->validate([
            'codigo' => 'required|max:40',
         //   'fecha_adquisicion' => 'required|date',
         //   'estado' => 'required|max:40',
            'disponibilidad' => 'required|max:200',
         //   'equipo' => 'required',
         'solicitud' => 'required',
           
        ]);

        //asigna valores
        $existencia->codigo = $datosExistencia['codigo'];
    //  $existencia->fecha_adquisicion= $datosExistencia['fecha_adquisicion'];
    //    $existencia->estado_id = $datosExistencia['estado'];
        $existencia->disponibilidad_id =$datosExistencia['disponibilidad'];
    //    $existencia->equipo_id =$datosExistencia['equipo'];

        $existencia->save();

        return redirect()->action('ExistenciaController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Existencia  $existencia
     * @return \Illuminate\Http\Response
     */
    public function destroy(Existencia $existencia)
    {
        $existencia->delete();
        return redirect()->action('ExistenciaController@index');
    }

    public function prestar( Existencia $existencia){
        $hoy=Carbon::today()->format('Y-m-d');
        $disponibilidads = ExistenciaDisponibilidad::all(['id','nombre']);
        return view('encargado.existencias.prestar',compact('existencia','disponibilidads','hoy'));
    }

    public function prestarUpdate(Request $request, Existencia $existencia)
    {
        //validacion
        $datosExistencia = $request->validate([
            'codigo' => 'required|max:40',
            'disponibilidad' => 'required|max:200',
         'solicitud' => 'required',
           
        ]);
        //asigna valores actualizados a existencia
        $existencia->codigo = $datosExistencia['codigo'];
        $existencia->disponibilidad_id =2;
        $existencia->save();


        //rescato valores para crear prestamo
        $hoy=Carbon::today()->format('Y-m-d 00:00:00');
        $now=Carbon::now();
        $devolucion=Carbon::parse() ;
        $devolucion=null;
        $usuario = auth()->user()->id;
        $solicitud_id= $request->solicitud;
        $fecha_retiro= $request->fecha_retiro_equipo;
        $solicitud=DB::table('solicituds')->where('fecha_inicio',$fecha_retiro);
        $fecha_inicio=$solicitud->pluck('fecha_inicio');
        $fecha=$fecha_inicio[0];
        $solicitud_id=$solicitud->pluck('id');
        $id=$solicitud_id[0];
        $existencia_id=$solicitud->pluck('existencia_id');
        $exis=$existencia_id[0];
        // dd($hoy);
           if($hoy == $fecha && $request->solicitud == $id && $exis == $existencia->id){
               $id=  DB::table('prestamos')->insertGetId(
                 ['fecha_retiro_equipo'=> $fecha_retiro ,'fecha_devolucion'=>$devolucion,'solicitud_id'=> $id, 'user_id'=> $usuario,'created_at'=>$now,'updated_at'=>$now]);
        // //         return 'hola';
             return redirect()->action('ExistenciaController@index')->with('mensaje','Se ha generado el préstamo correctamente!');
           }else{
            $existencia_id=$existencia->id;
            return redirect()->route('existencia.prestar', ['existencia'=> $existencia->id])->with('mensaje','No se ha podido crear el préstamo! El código de solicitud o el equipo seleccionado es incorrecto');
           }
               
           
      //  return redirect()->action('ExistenciaController@index')->with('mensaje','Se ha generado el préstamo correctamente!');
    }

    public function devolver( Existencia $existencia){
        $disponibilidads = ExistenciaDisponibilidad::all(['id','nombre']);
        return view('encargado.existencias.devolver',compact('existencia','disponibilidads'));
    }

    // public function devolverUpdate(Request $request, Existencia $existencia){
    //     //validacion
    //     $datosExistencia = $request->validate([
    //         'codigo' => 'required|max:40',
    //         'disponibilidad' => 'required|max:200',
    //         'solicitud' =>'required',
    //         'fecha_devolucion' => 'required|date',
    //     ]);

    //     //asigna valores
    //     $existencia->codigo = $datosExistencia['codigo'];
    //     $existencia->fecha_adquisicion= $datosExistencia['fecha_adquisicion'];
    //     $existencia->estado_id = $datosExistencia['estado'];
    //     $existencia->disponibilidad_id =$datosExistencia['disponibilidad'];
    //     $existencia->equipo_id =$datosExistencia['equipo'];

    //     $existencia->save();

    //     return redirect()->action('ExistenciaController@index');
    // }
}
