<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    //
    protected $fillable = [
        'nombre_evento' ,'encargado_evento','fecha_evento','estado_id', 'sala_id'
    ];
    public function estado(){
        return $this->belongsTo(ReservaEstado::class);
    }

    public function sala(){
        return $this->belongsTo(Sala::class);
    }
}
