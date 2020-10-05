<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sala extends Model
{
        //campos que se agregaran
        protected $fillable =[
            'codigo_interno', 'nombre' , 'estado', 'capacidad', 'internet', 'aire_acondicionado'
        ];
}
