<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sancion extends Model
{
    //lo que agrega el usuario
    protected $fillable=[
        'descripcion', 'fecha_inicio', 'fecha_fin', 'categoria_id','prestamo_id'
    ];

    //relacion con categoria_sancion
    public function categoria(){
        return $this->belongsTo(CategoriaSancion::class);
    }
    public function estado(){
        return $this->belongsTo(EstadoSancion::class);
    }
    public function prestamo(){
        return $this->belongsTo(Prestamo::class);
    }

}
