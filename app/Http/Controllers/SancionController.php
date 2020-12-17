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

                        $sancionTable=DB::table('sancions')->where('prestamo_id',$id_prestamo);
                        $idSancion=$sancionTable->pluck('id');

                        if(empty($idSancion['0'])){
                            //dd('no tiene una sancion asociado a este prestamo');
                                //continua con ciclo for en i++
                        }else{
                            //->where('prestamo_id',$id_prestamo);
                            
                            $idSancionn=$idSancion[0]; 
                            $sancion= Sancion::find($idSancionn);
                            $estadoSancion=$sancion->estado_id;
                            if($estadoSancion == '1'){
                                $data['sanciones']=  Sancion::find($idSancionn);
                            
                                return view('alumno.sancions.index',$data);
                            }
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
        //Esta funcion no se esta ocupando, se pasa directamente de prestamocontroller -> sancionar
        $categorias = CategoriaSancion::all(['id','nombre']);
        $hoySancion= Carbon::today();
        //$categorias=DB::table('categoria_sancions')->get()->pluck('nombre','id');
        
        return view('encargado.sanciones.create',compact('categorias','hoySancion','prestamo'));
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
       $idSancion = DB::table('sancions')->insert([
             'descripcion'=>$datosSancion['descripcion'],
            'fecha_inicio'=>$datosSancion['fecha_inicio_sancion'],
            'fecha_fin'=>$datosSancion['fecha_fin_sancion'],
            'prestamo_id'=>$id_prestamo,
            'categoria_id'=>$datosSancion['categoria'],
            'estado_id' =>'1',
        ]);
       
        //Enviar correo indicando que se creo el prestamo 
        // dd($request->all());  

        $infoPrestamo = Prestamo::find($id_prestamo);
        $idSolicitud = $infoPrestamo->solicitud_id;
        $infoSolicitud = Solicitud::find($idSolicitud);

        $id_user = $infoSolicitud->user_id;
        $alumnoNombre = User::find($id_user)->name;
        $alumnoApellido = User::find($id_user)->lastname;
        $mailusuario = User::find($id_user)->email;
        $encargadoNombre = User::find(Auth::id())->name;
        $encargadoApellido = User::find(Auth::id())->lastname;

        //rescatar el id de la sancion
        $sancionTable=DB::table('sancions')->where('prestamo_id',$id_prestamo);
        $idSancion=$sancionTable->pluck('id');
        $idSancionn = $idSancion[0];
        $sancion= Sancion::find($idSancionn);


        $sancion->fecha_devolucion = $now;
        $sancion->alumnoNombre = $alumnoNombre;
        $sancion->alumnoApellido = $alumnoApellido;
        $sancion->encargadoNombre = $encargadoNombre;
        $sancion->encargadoApellido = $encargadoApellido;
        $sancion->idSolicitud = $idSolicitud;



        //Terminar Prestamo
        DB::table('prestamos')->where('id',$id_prestamo)->update(['estado_id' => 2]);
        DB::table('prestamos')->where('id',$id_prestamo)->update(['fecha_devolucion' => $now]);
        DB::table('solicituds')->where('id',$idSolicitud)->update(['estado_id' => 5]);
        DB::table('existencias')->where('id',$infoSolicitud->existencia_id)->update(['disponibilidad_id' => 1]);

     
        Mail::to($mailusuario)->send(new SancionarPrestamo($sancion));

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
        $usuario = Auth::id();
        $prestamoid = $sancion->prestamo_id;
        $infoPrestamo= Prestamo::find($prestamoid);

        $solicitud = Solicitud::find($infoPrestamo->solicitud_id);

        $alumno_id = $solicitud->user_id;
        $infoAlumno = User::find($alumno_id); 

        $sancion->alumnoNombre = $infoAlumno->name;
        $sancion->alumnoApellido = $infoAlumno->lastname;
        $sancion->rutAlumno = $infoAlumno->run;

        if($usuario == '1'){
            return view('encargado.sanciones.show')->with('sancion',$sancion);
        }else{
            return view('alumno.sancions.show')->with('sancion',$sancion);
        }
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Sancion  $sancion
     * @return \Illuminate\Http\Response
     */
    public function edit(Sancion $sancion)
    {
            $categorias=CategoriaSancion::all(['id','nombre']);
            return view('encargado.sanciones.edit',compact('sancion','categorias'));
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
