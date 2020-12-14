<?php

namespace App\Http\Controllers;

use App\Equipo;
use App\Solicitud;
use Carbon\Carbon;
use App\Existencia;
use App\ExistenciaEstado;
use Illuminate\Http\Request;
use App\ExistenciaDisponibilidad;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;

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
        $fecha = Carbon::parse($existencia->fecha_adquisicion);
        return view('encargado.existencias.show',compact('existencia','fecha'));
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
        try{
        //validacion
        $datosExistencia = $request->validate([
            'codigo' => 'required|max:40',
            'disponibilidad' => 'required|max:200',
            'solicitud' => 'required',
           
        ]);
        $id_existencia=$existencia->id;
        
        //rescato valores para crear prestamo
        $hoy=Carbon::today()->format('Y-m-d 00:00:00');
        $now=Carbon::now();
        $devolucion=Carbon::parse() ;
        $devolucion=null;
        $usuario = auth()->user()->id;
        $id_solicitud= $request->solicitud;
        $solicitud=Solicitud::findOrFail($id_solicitud);
    //    $solicitud=DB::table('solicituds')->where('id',$id_solicitud);
        $fecha_inicio=$solicitud->pluck('fecha_inicio');
        $fecha=$fecha_inicio[0];
        $solicitud_id=$solicitud->pluck('id');
        $id=$solicitud_id[0];
        $estado_id=$solicitud->pluck('estado_id');
        $estado_sol=$estado_id[0];

        //rescato valores para cambiar la existencia
        $existencia_id=$solicitud->pluck('existencia_id');
        $exis=$existencia_id[0];
        $estado=1;
        /*condicion para ver si la fecha de hoy coincide con el de la solicitud, 
            si el id de solicitud coincide con el equipo seleccionado
        */
        if($id_solicitud == $id){
            if($hoy == $fecha){
              if($exis == $id_existencia){
                if($estado_sol == 2){
                        //asigna valores actualizados a existencia
                       //   $existencia->codigo = $datosExistencia['codigo'];
                          $existencia->disponibilidad_id = 2;
                          $existencia->save();
          
                         $id=  DB::table('prestamos')->insertGetId(
                           ['fecha_retiro_equipo'=> $fecha ,'fecha_devolucion'=>$devolucion,'estado_id'=>$estado,'solicitud_id'=> $id, 'user_id'=> $usuario,'created_at'=>$now,'updated_at'=>$now]);
                  // //         return 'hola';
                       return redirect()->action('ExistenciaController@index')->with('exito','Se ha generado el préstamo correctamente!');
            }else{
             $existencia_id=$existencia->id;
                      return redirect()->route('existencias.prestar', ['existencia'=> $existencia->id])->with('fracaso','No se ha podido crear el préstamo! Esta solicitud no está aprobada');
          }
            }else{
             $existencia_id=$existencia->id;
                      return redirect()->route('existencias.prestar', ['existencia'=> $existencia->id])->with('fracaso','No se ha podido crear el préstamo! El equipo no corresponde');
          }
            }else{
              $existencia_id=$existencia->id;
                      return redirect()->route('existencias.prestar', ['existencia'=> $existencia->id])->with('fracaso','No se ha podido crear el préstamo! Las fechas no corresponde');
            }
            
          }else{
            $existencia_id=$existencia->id;
                      return redirect()->route('existencias.prestar', ['existencia'=> $existencia->id])->with('fracaso','No se ha podido crear el préstamo! La solicitud no corresponde');
          }
        }catch (ModelNotFoundException $ex) {
            return redirect()->route('existencias.prestar', ['existencia'=> $existencia->id])->with('fracaso','No se ha podido crear el préstamo! La solicitud no existe');

          }
           
      //  return redirect()->action('ExistenciaController@index')->with('mensaje','Se ha generado el préstamo correctamente!');
    }

    public function devolver( Existencia $existencia){
        $hoy=Carbon::today()->format('Y-m-d');
        $disponibilidads = ExistenciaDisponibilidad::all(['id','nombre']);
        return view('encargado.existencias.devolver',compact('existencia','disponibilidads','hoy'));
    }

     public function devolverUpdate(Request $request, Existencia $existencia){
         try{
         //validacion
         $datosExistencia = $request->validate([
             'codigo' => 'required|max:40',
             'disponibilidad' => 'required|max:200',
             'solicitud' =>'required',
             'fecha_devolucion' => 'required|date',
         ]);
        $now=Carbon::now();
          //rescato valores para modificar prestamo
        $fecha_devolucion=$request->fecha_devolucion;
        $devolucion=Carbon::parse($fecha_devolucion)->format('Y-m-d 00:00:00');
     //   $devolucion=$request->fecha_devolucion->format('d-m-Y');
        $id_solicitud=$request->solicitud;
        $id_existencia =$existencia->id;
        $solicitud=Solicitud::findOrFail($id_solicitud);
     //   $solicitud = DB::table('solicituds')->where('id',$id_solicitud);

        //para verificar datos de devolucion
        $fecha_fin=$solicitud->pluck('fecha_fin');
        $fecha=$fecha_fin[0];
        
        $solicitud_id=$solicitud->pluck('id');
        $id=$solicitud_id[0];

        $existencia_id=$solicitud->pluck('existencia_id');
        $exis=$existencia_id[0];

        $estado_id=$solicitud->pluck('estado_id');
        $estado_sol=$estado_id[0];
        
        //rescato valores de prestamo 
        $prestamo=DB::table('prestamos')->where('solicitud_id',$id_solicitud);
        $estado_prestamo=$prestamo->pluck('estado_id');
        $estado_pres=$estado_prestamo[0];

            //condicion  para vefificar datos de la solicitud y formulario de devolucion
        if($devolucion <= $fecha && $exis == $id_existencia && $id == $id_solicitud && $estado_sol == 2 && $estado_pres == 1){
              $existencia->disponibilidad_id = 1;
              $existencia->save();
            
         DB::table('solicituds')->where('id',$id_solicitud)->update(['estado_id' => 4]);
         DB::table('prestamos')->where('solicitud_id',$id_solicitud)->update(['estado_id' => 2]);
           
            return redirect()->action('ExistenciaController@index')->with('exito','Se ha devuleto el equipo correctamente!');
        }else{
            $existencia_id=$existencia->id;
            return redirect()->route('existencias.devolver', ['existencia'=> $existencia->id])->with('fracaso','No se ha podido devolver el equipo!');
           
        }
    }catch (ModelNotFoundException $ex) {
        return redirect()->route('existencias.devolver', ['existencia'=> $existencia->id])->with('fracaso','No se ha podido devolver el equipo! La solicitud no existe');
      }
}

     public function items()
    {
        //
        $datos ['existencias']=Existencia::paginate(10);
        return view ('encargado.existencias.items',$datos);
    }
}
