@extends('layouts.app')


@section('content')
<body style="background-image:url('../images/fondo17.jpg') ">
<div class="container py-4">
            <div >
                <h1 class="text-center">Solicitud #{{$solicitud->id}}</h1>
                <div class="row justify-content-end mr-5">
                     <h5 class="">Estado: @if ($solicitud->estado->nombre == 'Pendiente')
                        <span class="badge badge-pill badge-warning display-4">{{$solicitud->estado->nombre}}</span>
                        @endif
                        @if ($solicitud->estado->nombre == 'Aprobada')
                        <span class="badge badge-pill badge-success">{{$solicitud->estado->nombre}}</span>
                        @endif
                        @if ($solicitud->estado->nombre == 'Rechazada')
                        <span class="badge badge-pill badge-danger">{{$solicitud->estado->nombre}}</span>
                        @endif </h5> 
                    
                </div>
                 
            </div>
            <hr>
            <h4 class="mb-0">Información del Equipo:</h4>
            <br>
            <div class="row">
                <div class="form-group col-md-3">
                    <label>Nombre</label>
                    <input class="form-control" type="text" value= "{{$solicitud->existencia->equipo->nombre}}" readonly>
                </div>
                <div class="form-group col-md-3">
                    <label>Marca</label>
                    <input class="form-control" type="text" value="{{$solicitud->existencia->equipo->marca}}" readonly>
                </div>
                <div class="form-group col-md-3">
                    <label>Modelo</label>
                    <input class="form-control" type="text" value="{{$solicitud->existencia->equipo->modelo}}" readonly>
                </div>
                <div class="form-group col-md-3">
                    <label>Número de equipo</label>
                    <input class="form-control" type="text" value="{{$solicitud->existencia->codigo}}" readonly>
                </div>
                
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    <label>Motivo</label>
                    <div class="form-control" type="text" readonly >
                        {{-- imprime codigo html por el input --}}
                         {!! $solicitud->motivo !!}
                    </div>
                </div>
                <div class="form-group col-md-3">
                    <label>Asignatura</label>
                    <input class="form-control" type="text" value="{{$solicitud->asignatura->nombre}}" readonly>
                </div>   
                <div class="form-group col-md-3">
                    <label>Solicitud creada el:</label>
                    <input class="form-control" type="text" value="{{ \Carbon\Carbon::parse($solicitud->created_at)->isoFormat('DD [de] MMMM [del] YYYY')}} " readonly>
                </div>             
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    <label>Motivo</label>
                    <div class="form-control" type="text" readonly >
                        {{-- imprime codigo html por el input --}}
                         {!! $solicitud->motivo !!}
                    </div>
                </div>
                <div class="form-group col-md-3">
                    <label>Asignatura</label>
                    <input class="form-control" type="text" value="{{$solicitud->asignatura->nombre}}" readonly>
                </div>   
                <div class="form-group col-md-3">
                    <label>Solicitud creada el:</label>
                    <input class="form-control" type="text" value="{{ \Carbon\Carbon::parse($solicitud->created_at)->isoFormat('DD [de] MMMM [del] YYYY')}} " readonly>
                </div>             
            </div>
            <div class="row">       
                <div class="form-group col-md-3">
                    <label>Desde:</label>
                    <input class="form-control" type="text" value="{{ \Carbon\Carbon::parse($solicitud->fecha_inicio)->isoFormat('DD [de] MMMM [del] YYYY')}} " readonly>
                </div> 
                <div class="form-group col-md-3">
                    <label>Hasta:</label>
                    <input class="form-control" type="text" value="{{ \Carbon\Carbon::parse($solicitud->fecha_fin)->isoFormat('DD [de] MMMM [del] YYYY')}} " readonly>
                </div> 
                   
            </div>
            

            
    </div></body>

@endsection
{{-- <p>
    <h4 class="text-primary">Hasta:</h4>
    
    @php
        $fecha = $solicitud->fecha_fin
    @endphp

     <fecha-equipo fecha="{{$fecha}}"></fecha-equipo>
</p>  --}}