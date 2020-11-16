<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    //datos a insertar
    protected $fillable = [
        'motivo' ,'fecha_inicio' ,'fecha_fin'  ,'asignatura_id','existencia_id'
    ];


    public function asignatura(){
        return $this->belongsTo(Asignatura::class);
    }

    //obtine la info del usuario via FK
    public function usuario(){
        return $this->belongsTo(User::class, 'user_id');
    }
    public function existencia(){
        return $this->belongsTo(Existencia::class);
    }


}