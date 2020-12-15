@extends('adminlte::page')
@include('encargado.notificacion')
@section('content')
<div id="app">
    <h1 class="text-center mb-5">Préstamos</h1>
{{-- <a href="{{route('prestamos.create')}}" class="btn btn-secondary">Agregar prestamo</a> --}}
    <div class="container mx-auto bg-white">
        <div class="table-responsive">
        <table class="table table-hover">
            <thead class="bg-olive text-light ">
           <tr class="table-active">
            <th scole="col">Código</th>
            <th scole="col">Fecha retiro</th>   
            <th scole="col">Fecha devolucion</th>  
            <th scole="col">Creación préstamo</th>
            <th scole="col">Solicitud</th>
            <th scole="col">Estado</th>
            </tr> 
        </thead>
        <tbody>
            @foreach ($prestamos as $prestamo)
            <tr>
                <td>{{$prestamo->id}}</td>
                <td><fecha-index fecha="{{$prestamo->fecha_retiro_equipo}}"></fecha-index></td>
                <td>
                    @if ($prestamo->fecha_devolucion == null)
                        <span>Fecha no disponible</span>
                    @else
                    <fecha-index fecha="{{$prestamo->fecha_devolucion}}"></fecha-index>
                    @endif
                </td>
                <td><fecha-index fecha="{{$prestamo->created_at}}"></fecha-index></td>
                <td><a class="p-2" data-toggle="tooltip" data-placement="top" 
                    title="Ver solicitud" style="color:black;text-decoration:none"
                     href="{{action ('ListarSolicitudController@show',['listarSolicitud' => $prestamo->solicitud_id])}} ">
                     {{$prestamo->solicitud_id}}<i class="fas fa-caret-right ml-2 mt-1"></i></a>
                </td>
                <td>@if ($prestamo->estado->id == 1)
                    <h5> <span class="badge badge-pill badge-success">{{$prestamo->estado->nombre}}</span> </h5>
                     @endif
                     @if ($prestamo->estado->id == 2)
                    <h5><span class="badge badge-pill badge-secondary">{{$prestamo->estado->nombre}}</span></h5>
                     @endif</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    </div></div>
</div>

<div class="col-12 mt-4 justify-content-center d-flex">
    {{$prestamos->links()}}
</div>
    
@endsection