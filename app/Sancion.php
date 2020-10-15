<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sancion extends Model
{
    //lo que agrega el usuario
    protected $fillable=[
        'descripcion', 'fecha_inicio', 'fecha_fin', 'categoria_id'
    ];

    //relacion con categoria_sancion
    public function categoria(){
        return $this->belongsTo(CategoriaSancion::class);
    }

}
