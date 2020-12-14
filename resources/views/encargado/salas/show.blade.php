@extends('adminlte::page')


@include('encargado.notificacion')
@section('content')

    <div class="container">
        <h1 class="text-center mb-4">{{ $sala->nombre}}</h1>
        <hr>
        <div class="row">
            
            <div class="form-group col-md-4">
                <label>Código</label>
                <input class="form-control" type="text" value= "{{$sala->codigo_interno}}" readonly>
            </div>
            <div class="form-group col-md-4">
                <label>Nombre</label>
                <input class="form-control" type="text" value=" {{$sala->nombre}}" readonly>
            </div>
            <div class="form-group col-md-4">
                <label>Estado</label>
                <input class="form-control" type="text" value="{{$sala->aire_acondicionado}}" readonly>
            </div>
            
        </div>
        <div class="row">
           
            <div class="form-group col-md-4">
                <label>Capacidad</label>
                <input class="form-control" type="text" value="{{$sala->capacidad}}" readonly>
            </div>
            <div class="form-group col-md-4">
                <label>Internet</label>
                <input class="form-control" type="text" value=" {{$sala->internet}}" readonly>
            </div>
            <div class="form-group col-md-4">
                <label>Aire acondicionado</label>
                <input class="form-control" type="text" value="{{$sala->capacidad}}" readonly>
            </div>
        </div>
        <div class="form-group float-right">
            <a href="{{ url('salas')}}"  class="btn btn-secondary"> Volver </a>
        </div>
    </div>

@endsection