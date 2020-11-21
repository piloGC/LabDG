@extends('adminlte::page')

@section('content')
    
<h1 class="text-center mb-5">Solicitudes de préstamo</h1>

<div class="container mx-auto bg-white">
    <div class="table-responsive">
    <table class="table table-hover ">
        <thead class="bg-olive text-light ">
           <tr class="table-active">
            <th scole="col" >#</th>
            <th scole="col">Solicitado por</th> 
            <th scole="col">Equipo</th>
            <th scole="col">N° de equipo</th>
            <th scole="col">Desde</th>  
            <th scole="col">Hasta</th>
            <th scole="col">Estado</th>
            <th scole="col">Acción</th>
            </tr> 
        </thead>
        <tbody>
            @foreach ($solicitudes as $solicitud)
            <tr >
                <td >{{$solicitud->id}}</td>
                <td>{{$solicitud->usuario->name}}{{$solicitud->usuario->lastname}}</td>
                <td>{{$solicitud->existencia->equipo->nombre}}</td>
                <td>{{$solicitud->existencia->codigo}}</td>
                <td>{{ \Carbon\Carbon::parse($solicitud->fecha_inicio)->isoFormat('DD [de] MMMM [del] YYYY')}}</td>
                <td>{{ \Carbon\Carbon::parse($solicitud->fecha_fin)->isoFormat('DD [de] MMMM [del] YYYY')}}</td>
                {{-- <td><fecha-equipo fecha="{{$solicitud->fecha_inicio}}">-</fecha-equipo></td>  --}}
                {{-- <td><fecha-equipo fecha="{{$solicitud->fecha_fin}}">-</fecha-equipo></td>  --}}
                <td>{{$solicitud->estado->nombre}}</td> 

                 <td >
                     <div class="btn-group mr-1" role="group">
                        <a href="{{action ('ListarSolicitudController@show',['listarSolicitud' => $solicitud->id])}} " class="btn btn-info text-white" >Detalle</a>
                        {{--  <a href="{{route ('listarSolicitud.update',['listarSolicitud' => $solicitud->id])}}" class="btn btn-success text-white">UPDATE</a>  --}}
                        <a href="{{action ('ListarSolicitudController@cambiarEstadoAprobada',['listarSolicitud' => $solicitud->id])}} " class="btn btn-success text-white">Aprobar</a>
                        <a href="{{action ('ListarSolicitudController@cambiarEstadoRechazada',['listarSolicitud' => $solicitud->id])}}" class="btn btn-danger text-white">Rechazar</a>
                      </div> 
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

