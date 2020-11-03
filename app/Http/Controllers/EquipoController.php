<?php

namespace App\Http\Controllers;

use App\Equipo;
use App\CategoriaEquipo;
use App\CatalogoEquipo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;


class EquipoController extends Controller
{
    public function __construct(){
        $this->middleware(['auth','admin']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datos ['equipos']=Equipo::paginate(10);
        return view ('encargado.equipos.index',$datos);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Obtener las categorias sin modelo)
        //$categorias = DB::table('categoria_equipos')->get()->pluck('nombre','id_categoria');
        //$catalogos = DB::table('en_catalogo')->get()->pluck('disponible','id_catalogo');

        //obtener categorais con modelo
        $categorias = CategoriaEquipo::all(['id','nombre']);
        $catalogos = CatalogoEquipo::all(['id','disponible']);
        

        return view('encargado.equipos.create')->with('categorias',$categorias)->with('catalogos',$catalogos);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        //$datosEquipo=request() ->except('_token');
        //validacion
        $datosEquipo = $request->validate([
            'nombre' => 'required|max:40',
            'marca' => 'required|max:40',
            'modelo' => 'required|max:40',
            'descripcion' => 'required|max:200',
            'imagen' => 'required|image',
            'categoria' =>'required',
            'catalogo' => 'required',
            
        ]);

        //consulta si es que viene imagen, que modifique su ruta para guardar
        //if ($request->hasFile('imagen')){
        $ruta_imagen= $request['imagen']->store('uploads','public');

        //resize image
        $img = Image::make(public_path("storage/{$ruta_imagen}"))->fit(400,400);
        $img->save();


        //insertar en bdd sin modelo
        DB::table('equipos')->insert([
            'nombre' => $datosEquipo['nombre'],
            'marca' => $datosEquipo['marca'],
            'modelo' => $datosEquipo['modelo'],
            'descripcion' => $datosEquipo['descripcion'],
            'imagen' => $ruta_imagen,
            'categoria_id' => $datosEquipo['categoria'],
            'en_catalogo' => $datosEquipo['catalogo'],
            
        ]);

        //Almacenar en la BD con modelos


        //Equipo::insert($datosEquipo);
        //return response()->json($datosEquipo);
        return redirect()->action('EquipoController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Equipo  $equipos
     * @return \Illuminate\Http\Response
     */
    public function show(Equipo $equipo)
    {
        return view('encargado.equipos.show',compact('equipo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Equipo  $equipos
     * @return \Illuminate\Http\Response
     */
    public function edit(Equipo $equipo)
    {
        $categorias = CategoriaEquipo::all(['id','nombre']);
        $catalogos = CatalogoEquipo::all(['id','disponible']);

        return view('encargado.equipos.edit',compact('categorias','catalogos','equipo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Equipo  $equipos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Equipo $equipo)
    {
        //validacion
        $datosEquipo = request()->validate([
            'nombre' => 'required|max:40',
            'marca' => 'required|max:40',
            'modelo' => 'required|max:40',
            'descripcion' => 'required|max:200',
            'catalogo' => 'required',
            'categoria' =>'required',
        ]);

        //Asignar los valores
        $equipo->nombre = $datosEquipo['nombre'];
        $equipo->marca = $datosEquipo['marca'];
        $equipo->modelo = $datosEquipo['modelo'];
        $equipo->descripcion = $datosEquipo['descripcion'];
        $equipo->categoria_id = $datosEquipo['categoria'];
        $equipo->en_catalogo = $datosEquipo['catalogo'];

        if (request('imagen')){

            //Storage::delete('public/'.$equipo->imagen);
            $ruta_imagen= $request['imagen']->store('uploads','public');
            $img = Image::make(public_path("storage/{$ruta_imagen}"))->fit(400,400);
            $img->save();
            $equipo->imagen = $datosEquipo['imagen'];
        }

        $equipo->save();

        //return view('equipos.edit',compact('equipo'))
        return redirect()->action('EquipoController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Equipo  $equipos
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Storage::delete('public/uploads'.$equipo->imagen);
        // $equipo->delete();
        // return redirect()->action('EquipoController@index');
        $equipo = Equipo::find($id);
        $equipo->delete();
        return redirect('/equipos');
        ;
    }
}
