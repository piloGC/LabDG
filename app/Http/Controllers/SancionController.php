<?php

namespace App\Http\Controllers;

use App\Sancion;
use App\CategoriaSancion;
use App\EstadoSancion;
use App\Prestamo;
use App\Solicitud;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use SebastianBergmann\Environment\Console;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;   
use App\Mail\SancionarPrestamo;


class SancionController extends Controller
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
        // $usuario =auth()->user();
        // $id_solicitud = DB::table('solicituds')->where('user_id',Auth::id());
        $cont = 0;
        $usuario = Auth::id();
        if($usuario == '1'){
            $data['sanciones']= Sancion::paginate(10);
            return view('encargado.sanciones.index',$data);

        }else{
            $terminarCiclo = 1;
            while($terminarCiclo ==1){
                //recuperamos los id de las solicitudes que ha generado ese alumno                
                $cantidadSolicitud=DB::table('solicituds')->where('user_id',Auth::id())->pluck('id');
                $cantidadSolicitudd = count($cantidadSolicitud);  

                if($cantidadSolicitudd == 0){
                    $terminarCiclo='2';
                    return view('alumno.sancions.indexVacio');
                }
                for ($i=0; $i < $cantidadSolicitudd; $i++) { 
                    //obtener los prestamos que posee
                    $numero_de_solicitud=$cantidadSolicitud[$i]; 
                   
                    $id_prestamos=DB::table('prestamos')->where('solicitud_id',$numero_de_solicitud);
                    $idPrestamo=$id_prestamos->pluck('id');

                    if(empty($idPrestamo['0'])){

                        //dd('no tiene un prestamo asociado a esta solicitud');
                            //continua con ciclo for en i++
                    }else{
                        
                        $idPrestamooo=$idPrestamo[0]; 
                        $infoPrestamo = Prestamo::find($idPrestamooo);   
                        $id_prestamo = $infoPrestamo->id;
                        
                        $sancion= Sancion::find($id_prestamo);
                        $estadoSancion=$sancion->estado_id;
                        
                        if($estadoSancion == '1'){
                            $data['sanciones']=  Sancion::find($id_prestamo);
                           
                            return view('alumno.sancions.index',$data);
                        }
                    }
                }
                $terminarCiclo='2';
            }
        }
        
        // $datados['sanciones']= Sancion::paginate(10);
        // dd($datados['sanciones']);
        return view('alumno.sancions.indexVacio');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Prestamo $prestamo)
    {
        //obtener categorias
        $categorias = CategoriaSancion::all(['id','nombre']);
        $hoySancion= Carbon::today()->format('Y-m-d');
        //$categorias=DB::table('categoria_sancions')->get()->pluck('nombre','id');
        
        return view('sanciones.create',compact('categorias','hoySancion'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $now=Carbon::now();
    //    dd($request->all());    
        //validacion
        $datosSancion= request()->validate([
            'descripcion'=>'required',
            'fecha_inicio_sancion'=>'required|date',
            'fecha_fin_sancion'=>'required|date',
            'categoria'=>'required',
        ]);

        $id_prestamo=Prestamo::find($request->prestamo)->id; 
           
        //almacenar en base de datos sin modelo
       DB::table('sancions')->insert([
             'descripcion'=>$datosSancion['descripcion'],
            'fecha_inicio'=>$datosSancion['fecha_inicio_sancion'],
            'fecha_fin'=>$datosSancion['fecha_fin_sancion'],
            'prestamo_id'=>$id_prestamo,
            'categoria_id'=>$datosSancion['categoria'],
            'estado_id' =>'1',
        ]);
       
        //Enviar correo indicando que se creo el prestamo   
        $infoPrestamo = Prestamo::find($id_prestamo);
        $solicitud = Solicitud::find($infoPrestamo->solicitud_id);

        $alumno_id = $solicitud->user_id;
        $infoAlumno = User::find($alumno_id); 
        $mailusuario = $infoAlumno->email;

        $infoEncargado =User::find(1);

        $idSancion = DB::table('prestamos')->where('id',$id_prestamo);
       
        
        $idSancion->alumnoNombre = $infoAlumno->name;
        $idSancion->alumnoApellido = $infoAlumno->lastname;
        $idSancion->encargadoNombre = $infoEncargado->name;
        $idSancion->encargadoApellido = $infoEncargado->lastname;  
        $idSancion->idSolicitud = $solicitud;
        $idSancion->fecha_inicio = $datosSancion['fecha_inicio_sancion'];
        $idSancion->fecha_fin = $datosSancion['fecha_fin_sancion'];
        $idSancion->fecha_devolucion = $now;

     
        Mail::to($mailusuario)->send(new SancionarPrestamo($idSancion));

        // $id_prestamo=Prestamo::findOrFail($request->prestamo); 
        // DB::table('prestamos')->where('id',$id_prestamo)->update(['sancion_id' => ]);
        //return
        return redirect()->action('AdminController@index')->with('exito','Se ha concluido su prestamo! y se ha sancionado');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Sancion  $sancion
     * @return \Illuminate\Http\Response
     */
    public function show(Sancion $sancion)
    {
        //

        return view('sanciones.show')->with('sancion',$sancion);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Sancion  $sancion
     * @return \Illuminate\Http\Response
     */
    public function edit(Sancion $sancion)
    {
        //
        // return dd($sancion->all());
        $categorias=CategoriaSancion::all(['id','nombre']);

        return view('sanciones.edit',compact('sancion','categorias'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Sancion  $sancion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sancion $sancion)
    {

        
        //validacion
        $datosSancion= request()->validate([
            'descripción'=>'required',
            'fecha_inicio'=>'required|date',
            'fecha_fin'=>'required|date',
            'categoria'=>'required',
        ]);

        //asigna valores
        $sancion->descripción = $datosSancion['nombre'];
        $sancion->fecha_inicio= $datosSancion['fecha_inicio'];
        $sancion->fecha_fin = $datosSancion['fecha_fin'];
        $sancion->categoria_id =$datosSancion['categoria'];

        $sancion->save();

        return redirect()->action('SancionController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Sancion  $sancion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sancion $sancion)
    {
        //
        $sancion->delete();
        return redirect()->action('SancionController@index');
    }
}
