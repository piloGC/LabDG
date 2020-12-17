@extends('layouts.app')

@section('content')
<body style="background-image:url('../images/fondo19.png') ">
<div class="container py-4">
<h1 class="text-center mb-3 titulos">Sancion</h1>

<hr>
<div class="row justify-content-center mt-4">
    <div class="container mx-auto bg-white">
    <div class="table-responsive">
    <table class="table table-hover">
        <thead class="bg-success text-light">
           <tr class="table-active">

            <th scole="col">ID Solicitud</th>
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
                        <td>{!! $sanciones->descripcion !!}</td> 
                        <td><fecha-index fecha="{{$sanciones->fecha_inicio}}">-</fecha-index></td>
                        <td><fecha-index fecha="{{$sanciones->fecha_fin}}">-</fecha-index></td>
                        {{--  <td><fecha-equipo fecha="{{$sancion->fecha_inicio}}">-</fecha-equipo></td>
                        <td><fecha-equipo fecha="{{$sancion->fecha_fin}}">-</fecha-equipo></td>  --}}
                        <td>
                            @if ($sanciones->estado->id == 1)
                            <h5> <span class="badge badge-pill badge-info">{{$sanciones->estado->nombre}}</span> </h5>
                             @endif
                             @if ($sanciones->estado->id == 2)
                            <h5><span class="badge badge-pill badge-secondary">{{$sanciones->estado->nombre}}</span></h5>
                             @endif    
                        </td> 
                        <td>
                            <a href="{{route ('sanciones.show',['sancion' => $sanciones->id]) }}" class="btn btn-info text-white mr-1">Detalle</a>
                        </td>
                    </tr>                    
            </tbody>
        </table>
    </div>
    </div>


</div>

@endsection