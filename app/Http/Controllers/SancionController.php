<?php

namespace App\Http\Controllers;

use App\Sancion;
use App\CategoriaSancion;
use App\EstadoSancion;
use App\Prestamo;
use App\Solicitud;
use App\User;
use App\Existencia;
use App\Equipo;
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

            $terminarCiclo = 1;
            while($terminarCiclo ==1){
                //recuperamos los id de las solicitudes que ha generado ese alumno                
                $cantidadPrestamos=DB::table('prestamos')->where('user_id','1')->pluck('id');
                $cantidadPrestamoss = count($cantidadPrestamos);  

                if($cantidadPrestamoss == 0){
                    $terminarCiclo='2';
                    return view('encargado.sanciones.indexVacio');
                }

                for ($i=0; $i < $cantidadPrestamoss; $i++) { 
                    //obtener los prestamos que posee
                    $idprestamo=$cantidadPrestamos[$i]; 

                    $infoPrestamo=Prestamo::find($idprestamo);
                    $idSancion = DB::table('sancions')->where('prestamo_id',$infoPrestamo->id);

                    $idSancionn=$idSancion->pluck('id');

                    if(empty($idSancionn['0'])){
                        //dd('no tiene un prestamo asociado a esta solicitud');
                            //continua con ciclo for en i++
                    }else{
                        $id_sancion=$idSancionn[0]; 
                        $infoSancion = Sancion::find($id_sancion);   
                        $id_sancione = $infoSancion->id;

                        $idSolicitud = DB::table('solicituds')->where('id',$infoPrestamo->solicitud_id)->pluck('id');
                        $infoSolicitud = Solicitud::find($idSolicitud);
                        // $id_estud = $infoSolicitud->user_id;

                        $idEstudiante = DB::table('users')->where('id',$infoSolicitud[0]->user_id)->pluck('id');
                        $infoEstudiante = User::find($idEstudiante);
                        $infoEstudiante = $infoEstudiante[0];

                        $nombreEstudiante = $infoEstudiante->name;
                        $apellidoEstudiante = $infoEstudiante->lastname;
                        
                        $correo = DB::table('sancions');
                    
                        for($j=$i;$j<$cantidadPrestamoss;$j++){
                            // $posNombre = DB::table('sancions')->where('id',$id_sancione);
                            $data['sanciones']= Sancion::orderBy('estado_id','ASC')->paginate(10);
                            // $posNombre->infoSancion = $infoSancion;
                            $h=$i+1;
                            $id=$id_sancione;
                            // $data['id'] = [$h];
                            $data[''.$id]= $nombreEstudiante.$apellidoEstudiante;
                            // $data['pos'.$h] = ;

                            
                        }
               

                    }
                }
                $terminarCiclo='2';
            }
            $count = $h;
            // dd($data);
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
    public function create(Request $request)
    {
        $categorias = CategoriaSancion::all(['id','nombre']);
        $hoySancion= Carbon::today();
        // dd($request);
        $idSolicitud = $request->prestamo;
        $infoSolicitud = Solicitud::find($idSolicitud);
        $idPrestamo = DB::table('prestamos')->where('solicitud_id',$idSolicitud)->pluck('id');
        $id_prestamo = $idPrestamo[0];
        $prestamo= Prestamo::find($id_prestamo);

        
        $id_user = Solicitud::find($idSolicitud)->user_id;
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
        

        //verificar cuantas sanciones tiene por cada categoria
        $cont1=0;
        $cont2=0;
        $cont3=0;
        $cont4=0;
        $prestamo->fueraPlazo =  $cont1;
        $prestamo->danio =  $cont2;
        $prestamo->entregadoTercero =  $cont3;
        $prestamo->robado =  $cont4;

        $terminarCiclo = 1;
        while($terminarCiclo ==1){
            //recuperamos los id de las solicitudes que ha generado ese alumno                
            $cantidadSolicitud=DB::table('solicituds')->where('user_id',$id_user)->pluck('id');
            $cantidadSolicitudd = count($cantidadSolicitud);  

            if($cantidadSolicitudd == 0){
                $terminarCiclo='2';
                return view('encargado.sanciones.create',compact('categorias','hoySancion','prestamo'));
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
                        $categoriaSancion=$sancion->categoria_id;

                        if($categoriaSancion == '1'){
                            $cont1 = $cont1 + 1;
                            $prestamo->fueraPlazo =  $cont1;
                        }elseif ($categoriaSancion == '2') {
                                $cont2 = $cont2 + 1;
                                $prestamo->danio =  $cont2;
                            }elseif ($categoriaSancion == '3') {
                                    $cont3 = $cont3 + 1;
                                    $prestamo->entregadoTercero =  $cont3;
                                }elseif ($categoriaSancion == '4') {
                                    $cont4 = $cont4 + 1;
                                    $prestamo->robado =  $cont4;
                                    }

                        }
                    }
                }
                $terminarCiclo='2';
            }

        

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
