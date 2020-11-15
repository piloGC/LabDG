@extends('layouts.app')

@section('content')
    
<h1 class="text-center mb-5">Mis solicitudes</h1>

<div class="col-md-10 mx-auto bg-white p-3">
    <div class="table-responsive">
    <table class="table">
        <thead class="bg-primary text-light">
           <tr>
            <th scole="col">Código</th>
            <th scole="col">Equipo</th>
            <th scole="col">Asignatura</th>   
            <th scole="col">Desde</th>  
            <th scole="col">Hasta</th>
            <th scole="col">Acción</th>
            </tr> 
        </thead>
        <tbody>
            @foreach ($solicitudes as $solicitud)
            <tr>
                <td>{{$solicitud->id}}</td>
                <td>{{$solicitud->existencia->codigo}}</td>
                <td>{{$solicitud->asignatura->nombre}}</td>
                <td><fecha-equipo fecha="{{$solicitud->fecha_inicio}}">-</fecha-equipo></td>
                <td><fecha-equipo fecha="{{$solicitud->fecha_fin}}">-</fecha-equipo></td>

                <td >
                    <a href="{{action ('SolicitudController@show',['solicitud' => $solicitud->id])}} " class="btn btn-info text-white mr-1">Ver</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    </div></div>
</div>

<div class="col-12 mt-4 justify-content-center d-flex">
    {{$solicitudes->links()}}
</div>
    
@endsection