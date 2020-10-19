<?php

namespace App\Http\Controllers;

use App\Sala;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SalaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
        $this->middleware(['auth','admin']);
    }
    public function index()
    {
        $datos ['salas']=Sala::paginate(10);
        return view ('encargado.salas.index',$datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('encargado.salas.create');
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
        $datos = $request->validate([
            'codigo_interno' => 'required|max:40',
            'nombre' => 'required|max:40',
            'estado' => 'required|max:40',
            'capacidad' => 'required',       
            'internett' => 'required', 
            'aire_acondicionado' => 'required',   
        ]);

        //insertar en bdd sin modelo
        DB::table('salas')->insert([
            'codigo_interno' => $datos['codigo_interno'],
            'nombre' => $datos['nombre'],
            'estado' => $datos['estado'],
            'capacidad' => $datos['capacidad'],
            'internett' => $datos['internett'],
            'aire_acondicionado' => $datos['aire_acondicionado'],            
        ]);

        //Almacenar en la BD con modelos

        return redirect()->action('SalaController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Sala  $sala
     * @return \Illuminate\Http\Response
     */
    public function show(Sala $sala)
    {
        return view('encargado.salas.show',compact('sala'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Sala  $sala
     * @return \Illuminate\Http\Response
     */
    public function edit(Sala $sala)
    {
        return view('encargado.salas.edit',compact('sala'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Sala  $sala
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sala $sala)
    {
        $datos = $request->validate([
            'codigo_interno' => 'required|max:40',
            'nombre' => 'required|max:40',
            'estado' => 'required|max:40',
            'capacidad' => 'required',       
            'internett' => 'required', 
            'aire_acondicionado' => 'required',   
        ]);

        //insertar en bdd sin modelo
        $sala->codigo_interno = $datos['codigo_interno'];
        $sala->nombre = $datos['nombre'];
        $sala->estado = $datos['estado'];
        $sala->capacidad = $datos['capacidad'];
        $sala->internett = $datos['internett'];
        $sala->aire_acondicionado = $datos['aire_acondicionado'];

        $sala->save();

        //return view('equipos.edit',compact('equipo'))
        return redirect()->action('SalaController@index');
        
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Sala  $sala
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sala $sala)
    {
        $sala->delete();
        return redirect()->action('SalaController@index');
    }
}
