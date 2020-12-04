<?php

namespace App\Http\Controllers;

use App\Equipo;
use Carbon\Carbon;
use App\Asignatura;
use App\Existencia;
use App\CategoriaEquipo;
use App\SolicitudEstado;
use App\Notifications\SolicitudNotificacion;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware(['auth','user']);
    }
    public function index(){
        
        $usuario =auth()->user();

        return view('alumno.index',compact('usuario'));
    }
    public function create(Existencia $existencia){
        
        $asignaturas = Asignatura::all(['id', 'nombre']);
        $estados = SolicitudEstado::all(['id', 'nombre']);
        //$existencias = Existencia::all('id');
        $usuario =auth()->user();
        $hoy = Carbon::now();
        return view('alumno.catalogo.equipos.create',compact('usuario','asignaturas','hoy','estados','existencia'));
    }

    public function store(Request $request){
        
        //validacion
        $datosSolicitud = $request->validate([
            'motivo' => 'required|max:200',
            'fecha_inicio'=> 'required|date',
            'fecha_fin'=> 'required|date',
            'asignatura' =>'required',
            'existencia'=>'required',
            'estado'=>'required',
        ]);

        //inserta en la bdd con modelo
        auth()->user()->solicitud()->create([
            'motivo'=> $datosSolicitud['motivo'],
            'fecha_inicio'=> $datosSolicitud['fecha_inicio'],
            'fecha_fin'=> $datosSolicitud['fecha_fin'],
            'asignatura_id' =>$datosSolicitud['asignatura'],
            'existencia_id'=> $datosSolicitud['existencia'],
            'estado_id'=>$datosSolicitud['estado'],
        ]);

        $NotificarEncargado = User::find(1);
        $NotificarEncargado->notify(new SolicitudNotificacion($solicitud));

        return redirect()->action('SolicitudController@index');
    }

    public function show(Existencia $existencia){
        return view('alumno.catalogo.equipos.show',compact('existencia'));
    }

    //return desde navbar e inicio
    public function catalogo(){
        return view('alumno.catalogo.catalogo');
    }

     //return desde catalogo categorías
     public function todosEquipos(){
         
        $equipos=Equipo::where('en_catalogo',1)->get();
        $existencias=[];
        foreach($equipos as $equipo){
            $existencias[Str::slug($equipo->nombre)][]= Existencia::where('equipo_id',$equipo->id)->where('estado_id',1)->where('disponibilidad_id',1)->get();
            
        }
       // return $existencias;
        return view('alumno.catalogo.equipos.equipos',compact('existencias'));
    }

     //return desde catalogo categorías
     public function camarasFot(){

        $equipos=Equipo::where('en_catalogo',1)->where('categoria_id',1)->get();
        $existencias=[];
        foreach($equipos as $equipo){
            $existencias[Str::slug($equipo->nombre)][]= Existencia::where('equipo_id',$equipo->id)->where('estado_id',1)->where('disponibilidad_id',1)->get();
            
        }
        return view('alumno.catalogo.equipos.fotograficas',compact('existencias'));
    }

    //return desde catalogo categorías
    public function camarasVid(){
        $equipos=Equipo::where('en_catalogo',1)->where('categoria_id',2)->get();
        $existencias=[];
        foreach($equipos as $equipo){
            $existencias[Str::slug($equipo->nombre)][]= Existencia::where('equipo_id',$equipo->id)->where('estado_id',1)->where('disponibilidad_id',1)->get();
            
        } 
        return view('alumno.catalogo.equipos.videos',compact('existencias'));
        
    }

    //return desde catalogo categorías
    public function tripode(){
        $equipos=Equipo::where('en_catalogo',1)->where('categoria_id',5)->get();
        $existencias=[];
        foreach($equipos as $equipo){
            $existencias[Str::slug($equipo->nombre)][]= Existencia::where('equipo_id',$equipo->id)->where('estado_id',1)->where('disponibilidad_id',1)->get();
            
        } 
        return view('alumno.catalogo.equipos.tripodes',compact('existencias'));
    }
    //return desde catalogo categorías
    public function tableta(){
        $equipos=Equipo::where('en_catalogo',1)->where('categoria_id',4)->get();
        $existencias=[];
        foreach($equipos as $equipo){
            $existencias[Str::slug($equipo->nombre)][]= Existencia::where('equipo_id',$equipo->id)->where('estado_id',1)->where('disponibilidad_id',1)->get();
            
        }
        return view('alumno.catalogo.equipos.tabletas',compact('existencias'));
    }
    //return desde catalogo categorías
    public function lector(){
        $equipos=Equipo::where('en_catalogo',1)->where('categoria_id',3)->get();
        $existencias=[];
        foreach($equipos as $equipo){
            $existencias[Str::slug($equipo->nombre)][]= Existencia::where('equipo_id',$equipo->id)->where('estado_id',1)->where('disponibilidad_id',1)->get();
            
        }
        return view('alumno.catalogo.equipos.lectores',compact('existencias'));
    }
}
