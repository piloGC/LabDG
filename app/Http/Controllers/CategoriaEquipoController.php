<?php

namespace App\Http\Controllers;

use App\Equipo;
use App\Existencia;
use App\CategoriaEquipo;
use Illuminate\Http\Request;

class CategoriaEquipoController extends Controller
{
    //
    
    public function getCategorias()
    {
        $data = CategoriaEquipo::get();
        return response()->json($data);
    }
    
    public function getEquipos(Request $request)
    {
        $data = Equipo::where('categoria_id', $request->categoria_id)->where('en_catalogo',1)->get();
        return response()->json($data);
    }

    public function getExistencias(Request $request)
    {
        //estado 1 es bueno, 2 malo, 3 otro
        //disponible 1, no disponible 2, 3 en laboratorio
        $data = Existencia::where('equipo_id', $request->equipo_id)->where('estado_id',1)->get();
        return response()->json($data);
    }

}
