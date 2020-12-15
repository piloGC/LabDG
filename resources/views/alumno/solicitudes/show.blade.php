@extends('layouts.app')


@section('content')
<body style="background-image:url('../images/fondo17.jpg') ">
<div class="container py-4">
            <div >
                <h1 class="text-center titulos">Solicitud #{{$solicitud->id}}</h1>
                <div class="row justify-content-end mr-5">
                     <h5 class="">Estado: 
                        @if ($solicitud->estado->id == 1)
                            <span class="badge badge-pill badge-warning">{{$solicitud->estado->nombre}}</span> 
                        @endif
                        @if ($solicitud->estado->id == 2)
                            <span class="badge badge-pill badge-success">{{$solicitud->estado->nombre}}</span>
                        @endif
                        @if ($solicitud->estado->id == 3)
                            <span class="badge badge-pill badge-danger">{{$solicitud->estado->nombre}}</span>
                        @endif
                        @if ($solicitud->estado->id == 4)
                            <span class="badge badge-pill badge-info text-white">{{$solicitud->estado->nombre}}</span>
                        @endif
                        @if ($solicitud->estado->id == 5)
                            <span class="badge badge-pill badge-secondary">{{$solicitud->estado->nombre}}</span>
                        @endif 
                        @if ($solicitud->estado->id == 6)
                            <span class="badge badge-pill badge-secondary">{{$solicitud->estado->nombre}}</span>
                        @endif
                    </h5> 
                    
                </div>
                
            </div>
            <hr>
            <h3 class="mb-4 titulo-categoria">Información del Equipo:</h3>
            <br>
            <div class="row">
                <div class="form-group col-md-3">
                    <h4 class="titulos">Nombre</h4>
                    <h5 class="mt-3">{{$solicitud->existencia->equipo->nombre}}</h5>
                </div>
                <div class="form-group col-md-3">
                    <h4 class="titulos">Marca</h4>
                    <h5 class="mt-3">{{$solicitud->existencia->equipo->marca}}</h5>
                </div>
                <div class="form-group col-md-3">
                    <h4 class="titulos">Modelo</h4>
                    <h5 class="mt-3">{{$solicitud->existencia->equipo->modelo}}</h5>
                </div>
                <div class="form-group col-md-3">
                    <h4 class="titulos">Número de equipo</h4>
                    <h5 class="mt-3">{{$solicitud->existencia->codigo}}</h5>
                </div>
                
            </div>
            <br>
            <h3 class="mb-4 titulo-categoria">Detalle de solicitud:</h3>
            <br>
            <div class="row">
                <div class="form-group col-md-3">
                    <h4 class="titulos">Asignatura</h4>
                    <h5 class="mt-3">{{$solicitud->asignatura->nombre}}</h5>
                </div>   
                <div class="form-group col-md-3">
                    <h4 class="titulos">Solicitud creada el:</h4>
                    @php
                        $fecha = $solicitud->created_at
                    @endphp
                    <fecha-formato fecha="{{$fecha}}"></fecha-formato>
                </div>
                <div class="form-group col-md-3">
                    <h4 class="titulos">Desde:</h4>
                    @php
                        $fecha = $solicitud->fecha_inicio
                    @endphp
                    <fecha-formato fecha="{{$fecha}}"></fecha-formato>
                </div> 
                <div class="form-group col-md-3">
                    <h4 class="titulos">Hasta:</h4>
                    @php
                        $fecha = $solicitud->fecha_fin
                    @endphp
                    <fecha-formato fecha="{{$fecha}}"></fecha-formato>
                </div> 
                
            </div>
            <div class="row">
                <div class="form-group col-md-12">
                    <h4 class="titulos">Motivo</h4>
                    <div><h5>{!! $solicitud->motivo !!}</h5></div>
                </div>           
            </div>
    </div></body>

@endsection