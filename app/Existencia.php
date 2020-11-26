<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Existencia extends Model
{
    //
    protected $fillable =[
        'codigo', 'fecha_adquisicion' , 'estado_id', 'disponibilidad_id','equipo_id'
    ];
    //obtiene la categoria del equipo via fk
    public function disponibilidad(){
        return $this->belongsTo(ExistenciaDisponibilidad::class);
    }
    public function estado(){
        return $this->belongsTo(ExistenciaEstado::class);
    }
    public function equipo(){
        return $this->belongsTo(Equipo::class);
    }

    
}