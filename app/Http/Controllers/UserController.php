<?php

namespace App\Http\Controllers;

use App\User;
use App\Equipo;
use App\Reserva;
use App\Solicitud;
use Carbon\Carbon;
use App\Asignatura;
use App\Existencia;
use App\CategoriaEquipo;
use App\SolicitudEstado;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\SolicitudNotificacion;

class UserController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware(['auth','user']);
    }
    public function index(){
        $hoy=Carbon::now()->format('Y-m-d 00:00:00');
        $reservas = Reserva::Where('dia_reserva',$hoy)->where('estado_id',1)->get();

        $usuario =auth()->user();
        return view('alumno.index',compact('usuario','reservas'));
    }
    public function create(Existencia $existencia){
        
        $estados = SolicitudEstado::all(['id', 'nombre']);
        $hoy = Carbon::now();
        return view('alumno.catalogo.equipos.create',compact('hoy','estados','existencia'));
    }


    public function show(Existencia $existencia){
        return view('alumno.catalogo.equipos.show',compact('existencia'));
    }

    //return desde navbar e inicio
    public function catalogo(){
        return view('alumno.catalogo.catalogo');
    }

     //return desde catalogo categorías
     public function camarasFot(){

        $equipos=Equipo::where('en_catalogo',1)->where('categoria_id',1)->get();
        $existencias=[];
        foreach($equipos as $equipo){
            $existencias[Str::slug($equipo->marca)][]= Existencia::where('equipo_id',$equipo->id)->where('estado_id',1)->get();
            
        }
        return view('alumno.catalogo.equipos.fotograficas',compact('existencias'));
    }

    //return desde catalogo categorías
    public function camarasVid(){
        $equipos=Equipo::where('en_catalogo',1)->where('categoria_id',2)->get();
        $existencias=[];
        foreach($equipos as $equipo){
            $existencias[Str::slug($equipo->marca)][]= Existencia::where('equipo_id',$equipo->id)->where('estado_id',1)->get();
            
        } 
        return view('alumno.catalogo.equipos.videos',compact('existencias'));
        
    }

    //return desde catalogo categorías
    public function tripode(){
        $equipos=Equipo::where('en_catalogo',1)->where('categoria_id',5)->get();
        $existencias=[];
        foreach($equipos as $equipo){
            $existencias[Str::slug($equipo->marca)][]= Existencia::where('equipo_id',$equipo->id)->where('estado_id',1)->get();
            
        } 
        return view('alumno.catalogo.equipos.tripodes',compact('existencias'));
    }
    //return desde catalogo categorías
    public function tableta(){
        $equipos=Equipo::where('en_catalogo',1)->where('categoria_id',4)->get();
        $existencias=[];
        foreach($equipos as $equipo){
            $existencias[Str::slug($equipo->marca)][]= Existencia::where('equipo_id',$equipo->id)->where('estado_id',1)->get();
            
        }
        return view('alumno.catalogo.equipos.tabletas',compact('existencias'));
    }
    //return desde catalogo categorías
    public function lector(){
        $equipos=Equipo::where('en_catalogo',1)->where('categoria_id',3)->get();
        $existencias=[];
        foreach($equipos as $equipo){
            $existencias[Str::slug($equipo->marca)][]= Existencia::where('equipo_id',$equipo->id)->where('estado_id',1)->get();
            
        }
        return view('alumno.catalogo.equipos.lectores',compact('existencias'));
    }
}
