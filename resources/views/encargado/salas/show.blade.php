@extends('adminlte::page')

@include('encargado.notificacion')
@section('content')

    <div class="container">
        <h1 class="text-center text-uppercase text-bold">{{ $sala->nombre}}</h1>
        <div class="row justify-content-end mr-5">
            <h5 class="">Estado: 
               @if ($sala->estado == "Disponible")
                   <span class="badge badge-pill badge-success">{{$sala->estado}}</span> 
               @endif
               @if ($sala->estado == "No disponible")
                   <span class="badge badge-pill badge-danger">{{$sala->estado}}</span>
               @endif
           </h5> 
           
       </div>
        <hr>
        <div class="row">
            <div class="form-group col-md-3">
                <h4 >Código</h4>
                <span class="mt-3">{{$sala->codigo_interno}}</span>
            </div>
            <div class="form-group col-md-3">
                <h4 >Nombre</h4>
                <span class="mt-3">{{$sala->nombre}}</span>
            </div> 
           
            <div class="form-group col-md-3">
                <h4 >Capacidad</h4>
                <span class="mt-3">{{$sala->capacidad}}</span>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-3">
                <h4 >Internet</h4>
                <span class="mt-3">{{$sala->internet}}</span>
            </div>
            <div class="form-group col-md-3">
                <h4 >Aire acondicionado</h4>
                <span class="mt-3">{{$sala->aire_acondicionado}}</span>
            </div>
        </div>
        <div class="form-group float-right">
            <a href="{{ url('salas')}}"  class="btn btn-secondary"> Volver </a>
        </div>
    </div>

@endsection