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
        //reporte solicitudes
        $inicioAnio=Carbon::now()->startOfYear()->format('Y-m-d 00:00:00');
        $hoy=Carbon::now()->format('Y-m-d 00:00:00');
        $totalSolicitudes=Solicitud::whereBetween('fecha_inicio', [$inicioAnio, $hoy])->get();
        $solicitudesEntrantes =Solicitud::Where('estado_id',1)->whereBetween('fecha_inicio', [$inicioAnio, $hoy])->get();
        $solicitudesAceptadas =Solicitud::Where('estado_id',2)->whereBetween('fecha_inicio', [$inicioAnio, $hoy])->get();
        $solicitudesRechazadas =Solicitud::Where('estado_id',3)->whereBetween('fecha_inicio', [$inicioAnio, $hoy])->get();
        $solicitudesEnCurso =Solicitud::Where('estado_id',4)->whereBetween('fecha_inicio', [$inicioAnio, $hoy])->get();
        $solicitudesTerminadas =Solicitud::Where('estado_id',5)->whereBetween('fecha_inicio', [$inicioAnio, $hoy])->get();
        $solicitudesCanceladas =Solicitud::Where('estado_id',6)->whereBetween('fecha_inicio', [$inicioAnio, $hoy])->get();
        $sanciones =Sancion::all();

        //para buscar solicitudes
        $busqueda = $request['nombre'];
        $users = User::where('role_id',2)->where('name','like','%' . $busqueda . '%')->paginate(3);
       // $solicitudes =Solicitud::where('user_id','like','%' . $busqueda . '%')->paginate(3);
        $users->appends(['nombre' => $busqueda]);

        //reporte sanciones
        $totalSanciones=Sancion::whereBetween('fecha_inicio', [$inicioAnio, $hoy])->get();
        $sancionesActivas =Sancion::where('estado_id',1)->get();
        $sancionPlazo =Sancion::where('estado_id',1)->get();
        $sancionDaño =Sancion::where('estado_id',2)->get();
        $sancionEntrega =Sancion::where('estado_id',3)->get();
        $sancionRobo =Sancion::where('estado_id',4)->get();

        $reservas=Reserva::where('dia_reserva',$hoy)->get();

        return view('encargado.index',compact('hoy','sanciones','reservas','users',
        'solicitudesEntrantes','solicitudesAceptadas','solicitudesRechazadas',
        'solicitudesEnCurso','solicitudesTerminadas','solicitudesCanceladas','totalSolicitudes',
        'totalSanciones','sancionesActivas','sancionPlazo','sancionDaño','sancionEntrega','sancionRobo'));
    }

}
