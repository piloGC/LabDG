<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    //campos que se agregaran
    protected $fillable =[
        'nombre', 'marca' , 'modelo', 'descripcion', 'imagen', 'categoria_id', 'en_catalogo'
    ];
    //obtiene la categoria del equipo via fk
    public function categoria(){
        return $this->belongsTo(CategoriaEquipo::class);
    }
    public function catalogo(){
        return $this->belongsTo(CatalogoEquipo::class,'en_catalogo');
    }
}
