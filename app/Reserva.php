<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    //
    protected $fillable = [
        'nombre_reserva' ,'encargado_reserva','dia_reserva','hora_inicio','hora_fin','tipo_publico','estado_id', 'sala_id'
    ];
    public function estado(){
        return $this->belongsTo(ReservaEstado::class);
    }

    public function sala(){
        return $this->belongsTo(Sala::class);
    }
}
