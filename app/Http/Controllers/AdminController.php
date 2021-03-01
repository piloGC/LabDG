<?php

namespace App\Http\Controllers;

use App\User;
use App\Reserva;
use App\Sancion;
use App\Solicitud;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware(['auth','admin']);
    }
    //
    public function index(Request $request){
        //reporte solicitudes año
        $inicioAnio=Carbon::now()->startOfYear()->format('Y-m-d 00:00:00');
        $finAnio=Carbon::now()->endOfYear()->format('Y-m-d 00:00:00');

        $totalSolicitudes=Solicitud::whereBetween('fecha_inicio', [$inicioAnio, $finAnio])->get();
        $solicitudesEntrantes =Solicitud::Where('estado_id',1)->WhereBetween('fecha_inicio', [$inicioAnio, $finAnio])->get();
        $solicitudesAceptadas =Solicitud::Where('estado_id',2)->whereBetween('fecha_inicio', [$inicioAnio, $finAnio])->get();
        $solicitudesRechazadas =Solicitud::Where('estado_id',3)->whereBetween('fecha_inicio', [$inicioAnio, $finAnio])->get();
        $solicitudesEnCurso =Solicitud::Where('estado_id',4)->whereBetween('fecha_inicio', [$inicioAnio, $finAnio])->get();
        $solicitudesTerminadas =Solicitud::Where('estado_id',5)->whereBetween('fecha_inicio', [$inicioAnio, $finAnio])->get();
        $solicitudesCanceladas =Solicitud::Where('estado_id',6)->whereBetween('fecha_inicio', [$inicioAnio, $finAnio])->get();
        $sanciones =Sancion::all();


        //reporte solicitudes mes
        
        $inicioMes=Carbon::now()->startOfMonth()->format('Y-m-d 00:00:00');
        $finMes=Carbon::now()->endOfMonth()->format('Y-m-d 00:00:00');

        $totalSolicitudesMes=Solicitud::whereBetween('fecha_inicio', [$inicioMes, $finMes])->get();
        $solicitudesEntrantesMes =Solicitud::Where('estado_id',1)->WhereBetween('fecha_inicio', [$inicioMes, $finMes])->get();
        $solicitudesAceptadasMes =Solicitud::Where('estado_id',2)->whereBetween('fecha_inicio', [$inicioMes, $finMes])->get();
        $solicitudesRechazadasMes =Solicitud::Where('estado_id',3)->whereBetween('fecha_inicio', [$inicioMes, $finMes])->get();
        $solicitudesEnCursoMes =Solicitud::Where('estado_id',4)->whereBetween('fecha_inicio', [$inicioMes, $finMes])->get();
        $solicitudesTerminadasMes =Solicitud::Where('estado_id',5)->whereBetween('fecha_inicio', [$inicioMes, $finMes])->get();
        $solicitudesCanceladasMes =Solicitud::Where('estado_id',6)->whereBetween('fecha_inicio', [$inicioMes, $finMes])->get();

        //para buscar solicitudes
        $busqueda = $request['nombre'];
        $users = User::where('role_id',2)->where('name','like','%' . $busqueda . '%')->orWhere('lastname','like','%' . $busqueda . '%')->paginate(4);
       // $solicitudes =Solicitud::where('user_id','like','%' . $busqueda . '%')->paginate(3);
        $users->appends(['nombre' => $busqueda]);

        $hoy=Carbon::now()->format('Y-m-d');
        //reporte sanciones
        $totalSanciones=Sancion::whereBetween('fecha_inicio', [$inicioAnio, $finAnio])->get();
        $sancionesActivas =Sancion::where('estado_id',1)->get();
        $sancionPlazo =Sancion::where('estado_id',1)->get();
        $sancionDaño =Sancion::where('estado_id',2)->get();
        $sancionEntrega =Sancion::where('estado_id',3)->get();
        $sancionRobo =Sancion::where('estado_id',4)->get();

        $reservas=Reserva::where('dia_reserva',$hoy)->get();

        return view('encargado.index',compact('hoy','sanciones','reservas','users',
        'solicitudesEntrantes','solicitudesAceptadas','solicitudesRechazadas',
        'solicitudesEnCurso','solicitudesTerminadas','solicitudesCanceladas','totalSolicitudes',
        'totalSanciones','sancionesActivas','sancionPlazo','sancionDaño','sancionEntrega','sancionRobo',
        'solicitudesCanceladasMes','solicitudesTerminadasMes','solicitudesEnCursoMes','solicitudesRechazadasMes',
        'solicitudesAceptadasMes','solicitudesEntrantesMes','totalSolicitudesMes'));
    }

}
