@extends('adminlte::page')

@include('encargado.notificacion')
@section('content')

<div class="container" id="app">
    <h1 class="text-center text-uppercase text-bold">Solicitud #{{$listarSolicitud->id}}</h1>
    <div class="row justify-content-end mr-5">
        <h5 class="">Estado: 
           @if ($listarSolicitud->estado->id == 1)
               <span class="badge badge-pill badge-warning">{{$listarSolicitud->estado->nombre}}</span> 
           @endif
           @if ($listarSolicitud->estado->id == 2)
               <span class="badge badge-pill badge-success">{{$listarSolicitud->estado->nombre}}</span>
           @endif
           @if ($listarSolicitud->estado->id == 3)
               <span class="badge badge-pill badge-danger">{{$listarSolicitud->estado->nombre}}</span>
           @endif
           @if ($listarSolicitud->estado->id == 4)
               <span class="badge badge-pill badge-info text-white">{{$listarSolicitud->estado->nombre}}</span>
           @endif
           @if ($listarSolicitud->estado->id == 5)
               <span class="badge badge-pill badge-secondary">{{$listarSolicitud->estado->nombre}}</span>
           @endif 
           @if ($listarSolicitud->estado->id == 6)
               <span class="badge badge-pill badge-secondary">{{$listarSolicitud->estado->nombre}}</span>
           @endif
       </h5> 
       
   </div>

<hr>
<div class="row">
    <div class="form-group col-md-3">
        <h4 >Solicitado por</h4>
        <span class="mt-3">{{$listarSolicitud->usuario->name}} {{$listarSolicitud->usuario->lastname}}</span>
    </div> 
    <div class="form-group col-md-3">
        <h4 >Run</h4>
        <span class="mt-3">{{$listarSolicitud->usuario->run}}</span>
    </div> 
</div><br>

    <h3 class="text-bold text-uppercase">Información del Equipo:</h3>
            <br>
            <div class="row">
                <div class="form-group col-md-3">
                    <h4 >Nombre</h4>
                    <span class="mt-3">{{$listarSolicitud->existencia->equipo->nombre}}</span>
                </div>
                <div class="form-group col-md-3">
                    <h4 >Marca</h4>
                    <span class="mt-3">{{$listarSolicitud->existencia->equipo->marca}}</span>
                </div>
                <div class="form-group col-md-3">
                    <h4>Modelo</h4>
                    <span class="mt-3">{{$listarSolicitud->existencia->equipo->modelo}}</span>
                </div>
                <div class="form-group col-md-3">
                    <h4>Número de equipo</h4>
                    <span class="mt-3">{{$listarSolicitud->existencia->codigo}}</span>
                </div>
                
            </div>
            <br>
            <h3  class="text-bold text-uppercase">Detalle de solicitud:</h3>
            <br>
            <div class="row">
                <div class="form-group col-md-3">
                    <h4>Asignatura</h4>
                    <span class="mt-3">{{$listarSolicitud->asignatura->nombre}}</span>
                </div>   
                 <div class="form-group col-md-3">
                    <h4 >Solicitud creada el:</h4>
                    @php
                        $fecha = $listarSolicitud->created_at
                    @endphp
                    <fecha-index fecha="{{$fecha}}"></fecha-index>
                </div>
                <div class="form-group col-md-3">
                    <h4 >Desde:</h4>
                    @php
                        $fecha = $listarSolicitud->fecha_inicio
                    @endphp
                    <fecha-index fecha="{{$fecha}}"></fecha-index>
                </div> 
                <div class="form-group col-md-3">
                    <h4 >Hasta:</h4>
                    @php
                        $fecha = $listarSolicitud->fecha_fin
                    @endphp
                    <fecha-index fecha="{{$fecha}}"></fecha-index>
                </div>  
                
            </div>
            <div class="row">
                <div class="form-group col-md-12">
                    <h4>Motivo</h4>
                    <div><span>{!! $listarSolicitud->motivo !!}</span></div>
                </div>  
            </div>

            @if ($listarSolicitud->estado->id == 3)
            <br>
            <h3 class="text-bold text-uppercase">motivo estado:</h3>
            <br>
            <div class="row">
                <div class="form-group col-md-12">
                    <h4 >Motivo del rechazo</h4>
                    <div><span>{!! $listarSolicitud->motivo_estado !!}</span></div>
                </div>           
            </div>
            @endif

            @if ($listarSolicitud->estado->id == 6)
            <br>
            <h3 class="text-bold text-uppercase">motivo estado:</h3>
            <br>
            <div class="row">
                <div class="form-group col-md-12">
                    <h4 >Motivo la cancelación</h4>
                    <div><span>{!! $listarSolicitud->motivo_estado !!}</span></div>
                </div>           
            </div>
            @endif
</div>

@endsection 
