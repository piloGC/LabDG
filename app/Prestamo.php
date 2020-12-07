<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prestamo extends Model
{
    protected $fillable = [
        'fecha_retiro_equipo' ,'fecha_devolucion','solicitud_id','estado_id'
    ];

    public function solicitud(){
        return $this->hasOne(Solicitud::class);
    }
    public function estado(){
        return $this->belongsTo(PrestamoEstado::class);
    }

    public function usuario(){
        return $this->belongsTo(User::class, 'user_id');
    }

}
