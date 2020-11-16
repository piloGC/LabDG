<?php

namespace App\Http\Controllers;

use App\Sancion;
use App\CategoriaSancion;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use SebastianBergmann\Environment\Console;

class SancionController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth','admin']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data['sanciones']=Sancion::paginate(3);

        return view('sanciones.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //obtener categorias
        $categorias = CategoriaSancion::all(['id','nombre']);
        $hoy = Carbon::now();

        //$categorias=DB::table('categoria_sancions')->get()->pluck('nombre','id');
        

        return view('sanciones.create',compact('categorias','hoy'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

       // dd($request->all());

        //validacion
        $datosSancion= request()->validate([
            'descripcion'=>'required',
            'fecha_inicio'=>'required|date',
            'fecha_fin'=>'required|date',
            'categoria'=>'required',
        ]);
        

        //almacenar en base de datos sin modelo
        DB::table('sancions')->insert([
            'descripcion'=>$datosSancion['descripcion'],
            'fecha_inicio'=>$datosSancion['fecha_inicio'],
            'fecha_fin'=>$datosSancion['fecha_fin'],
            'categoria_id'=>$datosSancion['categoria']
        ]);

        //return
        return redirect()->action('SancionController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Sancion  $sancion
     * @return \Illuminate\Http\Response
     */
    public function show(Sancion $sancion)
    {
        //

        return view('sanciones.show')->with('sancion',$sancion);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Sancion  $sancion
     * @return \Illuminate\Http\Response
     */
    public function edit(Sancion $sancion)
    {
        //
        // return dd($sancion->all());
        $categorias=CategoriaSancion::all(['id','nombre']);

        return view('sanciones.edit',compact('sancion','categorias'));
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
