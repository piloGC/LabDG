<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Equipo;
use App\Reserva;
use App\Sancion;

use App\Prestamo;
use App\Solicitud;
use Carbon\Carbon;
use App\Asignatura;
use App\Existencia;
use App\Mail\SancionTerminada; 
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Mail;   
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;
    public function redirectTo(){
        switch (Auth::user()->role_id) {
            case 1:
                
                $hoy = Carbon::today()->format('Y-m-d 00:00:00');
                $now=Carbon::now();
                $sanciones = Sancion::where('estado_id',1);
                $id_sanciones=$sanciones->pluck('id');
                $cantidad = count($id_sanciones);  
                
                if($cantidad>0){
                    $i=0;
                    for($i=0; $i< $cantidad; $i++){
                        $id_sancion = $id_sanciones[$i];
                        $sancion= Sancion::find($id_sancion);

                        if($sancion->fecha_fin <= $hoy){
                            DB::table('sancions')->where('id',$id_sancion)->update(['estado_id' => 2]);
                            
                            //notificar que su sancion a terminado

                            $id_prestamo = $sancion->prestamo_id;
                            $infoPrestamo = Prestamo::find($id_prestamo);
            
                            $id_solicitud = $infoPrestamo->solicitud_id;
                            $infoSolicitud = Solicitud::find($id_solicitud); 
            
                            $id_existencia = $infoSolicitud->existencia_id;
                            $infoExistencia = Existencia::find($id_existencia); 
            
                            $id_equipo = $infoExistencia->equipo_id;
                            $infoEquipo = Equipo::find($id_equipo);
            
                            $id_user = $infoSolicitud->user_id;
                            $infoUser = User::find($id_user);

                            
                            $sancion->infoSolicitud = $infoSolicitud;
                            $sancion->nombre = $infoUser->name;
                            $sancion->apellido = $infoUser->lastname;
                            $sancion->infoExistencia = $infoExistencia;
                            $sancion->infoEquipo = $infoEquipo;
                            $sancion->notificacioncorreo = $now;

                            $mailusuario = $infoUser->email;
                            Mail::to($mailusuario)->send(new SancionTerminada($sancion));


                        }
                    }
                }

                //para actualizar estado de reservas
                $fecha_comparacion = Carbon::now()->format('Y-m-d');
                $reservas=Reserva::Where('estado_id',1)->get();
                foreach ($reservas as $reserva) {
                    if($reserva->dia_reserva < $fecha_comparacion){
                        $reserva->estado_id = 2;
                        $reserva->save();
                    }
                }

                return $this->redirectTo= '/admin';
                break;
            case 2:
                //para actualizar estado de reservas
                $fecha_comparacion = Carbon::now()->format('Y-m-d 00:00:00');
                $reservas=Reserva::Where('estado_id',1)->get();
                foreach ($reservas as $reserva) {
                    if($reserva->dia_reserva < $fecha_comparacion ){
                        $reserva->estado_id = 2;
                        $reserva->save();
                    }
                }

               return $this->redirectTo= '/';
           break;
            default:
                return $this->redirectTo= '/login';
                break;
        }
    }


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    //para iniciar sesion con run
    public function username(){
        return 'run';
    }
}
