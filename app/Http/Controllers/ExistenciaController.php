<?php

namespace App\Http\Controllers;

use App\Existencia;
use App\ExistenciaEstado;
use App\ExistenciaDisponibilidad;
use App\Equipo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ExistenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $datos ['existencias']=Existencia::paginate(10);
        return view ('existencias.index',$datos);
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
        return view('existencias.create')->with('estados',$estados)->with('disponibilidads',$disponibilidads)->with('equipos',$equipos);
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
        return view('existencias.show',compact('existencia'));
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
        return view('existencias.edit',compact('estados','disponibilidads','equipos','existencia'));
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
            'fecha_adquisicion' => 'required|date',
            'estado' => 'required|max:40',
            'disponibilidad' => 'required|max:200',
            'equipo' => 'required',
           
        ]);

        //asigna valores
        $existencia->codigo = $datosExistencia['codigo'];
        $existencia->fecha_adquisicion= $datosExistencia['fecha_adquisicion'];
        $existencia->estado_id = $datosExistencia['estado'];
        $existencia->disponibilidad_id =$datosExistencia['disponibilidad'];
        $existencia->equipo_id =$datosExistencia['equipo'];

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
