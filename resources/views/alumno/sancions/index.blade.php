@extends('layouts.app')

@section('content')
  
<div class="container">

    <h1 class="text-center mb-5">Sanciones</h1>
    <div class="col-md-10 mx-auto bg-white p-3">
        <div class="table-responsive">
        <table class="table table-hover table-light">
            <thead class="bg-primary text-white">
                <tr>

                    <th scole="col">ID Solicitud</th>
                    <th scole="col">ID Prestamo</th>
                    <th scole="col">Descripcion</th>
                    <th scole="col">Desde</th>
                    <th scole="col">Hasta</th>
                    <th scole="col">Estado</th>
                    <th scole="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
            {{--  {{ dd(count($sanciones))}}  --}}
                    <tr>

                        <td>{{$sanciones->prestamo->solicitud_id}}</td>
                        <td>{{$sanciones->prestamo_id}}</td>
                        <td>{!! $sanciones->descripcion !!}</td> 
                        <td>{{$sanciones->fecha_inicio}}</td>
                        <td>{{$sanciones->fecha_fin}}</td>
                        {{--  <td><fecha-equipo fecha="{{$sancion->fecha_inicio}}">-</fecha-equipo></td>
                        <td><fecha-equipo fecha="{{$sancion->fecha_fin}}">-</fecha-equipo></td>  --}}
                        <td>{{$sanciones->estado->nombre}}</td> 
                        <td>
                            <a href="{{route ('sanciones.edit',['sancion' => $sanciones->id]) }}" class="btn btn-success text-white mr-1">Editar</a>
                            <a href="{{route ('sanciones.show',['sancion' => $sanciones->id]) }}" class="btn btn-info text-white mr-1">Ver Detalle</a>
                            <eliminar-sancion sancion-id={{$sanciones->id}}></eliminar-sancion>

                        </td>
                    </tr>                    
            </tbody>
        </table>
    </div>
    </div>


</div>

@endsection