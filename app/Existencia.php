<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Existencia extends Model
{
    //
    protected $fillable =[
        'codigo', 'fecha_adquisicion' , 'estado_id', 'disponibilidad_id','equipo_id'
    ];

    use SoftDeletes;
    protected $dates = ['deleted_at'];


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

      public function solicitud(){
          return $this->hasMany(Solicitud::class);
      }

    
}