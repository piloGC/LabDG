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
    public function index(Request $request)
    {
        //
        $busqueda=$request['existencia'];
        $existencias=Existencia::where('codigo','like','%' . $busqueda . '%')->paginate(10);
        $existencias->appends(['existencia' => $busqueda]);

        return view ('encargado.existencias.index',compact('existencias'));
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
            'codigo' => 'required|max:40|unique:existencias',
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
            'codigo' => 'required|max:40|unique:existencias',
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

    

}
