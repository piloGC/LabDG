@extends('adminlte::page')
@include('encargado.notificacion')
@section('content')
<div class="container" id="app">
    <h1 class="text-center text-uppercase text-bold">Ítem {{$existencia->codigo}}</h1>
    <div class="row justify-content-end mr-5">
        
        <h5 class="">Disponibilidad: 
          @if ($existencia->disponibilidad->id == 1)
              <span class="badge badge-pill badge-success">{{$existencia->disponibilidad->nombre}}</span> 
          @endif
          @if ($existencia->disponibilidad->id == 2)
              <span class="badge badge-pill badge-danger">{{$existencia->disponibilidad->nombre}}</span>
          @endif
      </h5>  
      
  </div>
    <hr>
<h3 class="text-bold text-uppercase">Información del Equipo:</h3>
    <br>
    <div class="row">
        <div class="form-group col-md-3">
            <h4 >Código</h4>
            <span class="mt-3">{{$existencia->codigo}}</span>
        </div>
        <div class="form-group col-md-3">
            <h4 >Fecha ingreso</h4>
            <fecha-index fecha="{{$existencia->fecha_adquisicion}}"></fecha-index>
        </div>
        <div class="form-group col-md-3">
            <h4 >Estado</h4>
            <span class="mt-3">{{$existencia->estado->nombre}}</span>
        </div>
        <div class="form-group col-md-3">
            <h4 >Equipo</h4>
            <span class="mt-3">{{$existencia->equipo->nombre}}</span>
        </div>
        
        
    </div>
    <div class="form-group float-right">
        <a href="{{ url('existencias')}}"  class="btn btn-secondary"> Volver </a>
    </div>
</div>
@endsection
