@extends('adminlte::page')


@section('content')

<div class="container">
    <h1 class="text-center mb-4">Solicitud Aprobada #{{$listarSolicitud->id}}</h1>
    <div class="row">
        <div class="form-group col-md-4">
            <label>Estado</label>
            <input class="form-control" type="text" value="{{$listarSolicitud->estado->nombre}} "readonly>
        </div>
        </div>
    <div class="row">
        <div class="form-group col-md-4">
            <label>Nombre</label>
            <input class="form-control" type="text" value="{{$listarSolicitud->usuario->name}} "readonly>
        </div>
        <div class="form-group col-md-4">
            <label>Apellidos</label>
            <input class="form-control" type="text" value="{{$listarSolicitud->usuario->lastname}}" readonly>
        </div>
        <div class="form-group col-md-4">
            <label>Teléfono</label>
            <input class="form-control" type="text" value="{{$listarSolicitud->usuario->phone}}" readonly>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-4">
            <label>Equipo</label>
            <input class="form-control" type="text" value="{{$listarSolicitud->existencia->equipo->nombre}}" readonly>
        </div>
        <div class="form-group col-md-4">
            <label>Modelo</label>
            <input class="form-control" type="text" value="{{$listarSolicitud->existencia->equipo->modelo}}" readonly>
        </div>
        <div class="form-group col-md-4">
            <label>Número de equipo</label>
            <input class="form-control" type="text" value="{{$listarSolicitud->existencia->codigo}}" readonly>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-4">
            <label>Asignatura</label>
            <input class="form-control" type="text" value="{{$listarSolicitud->asignatura->nombre}}" readonly>
        </div>
        <div class="form-group col-md-4">
            <label>Motivo</label>
            <div class="form-control" style="width: 744px; height: 10em" readonly>
                {!! $listarSolicitud->motivo !!}
                
            </div>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-4">
            <label>Solicitud creada el</label>
            <input class="form-control" type="text" value="{{ \Carbon\Carbon::parse($listarSolicitud->created_at)->isoFormat('DD [de] MMMM [del] YYYY')}}" readonly>
        </div>
        <div class="form-group col-md-4">
            <label>Desde</label>
            <input class="form-control" type="text" value="{{ \Carbon\Carbon::parse($listarSolicitud->fecha_inicio)->isoFormat('DD [de] MMMM [del] YYYY')}}" readonly>
        </div>
        <div class="form-group col-md-4">
            <label>Hasta</label>
            <input class="form-control" type="text" value="{{ \Carbon\Carbon::parse($listarSolicitud->fecha_fin)->isoFormat('DD [de] MMMM [del] YYYY')}}" readonly>
        </div>
    </div>
</div>

@endsection 