<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    //datos a insertar
    protected $fillable = [
        'motivo' ,'fecha_inicio' ,'fecha_fin'  ,'asignatura','existencia_id','estado_id',
    ];


    public function estado(){
        return $this->belongsTo(SolicitudEstado::class);
    }
    //obtine la info del usuario via FK
    public function usuario(){
        return $this->belongsTo(User::class, 'user_id');
    }
    public function existencia(){
        return $this->belongsTo(Existencia::class);
    }
    public function prestamo(){
        return $this->belongsTo(Prestamo::class);
    }


}
