@extends('adminlte::page')
@include('encargado.notificacion')
@section('content')

{{-- <h1>{{$sancion}}</h1> --}}
     <div class="container" id="app">
        <h1 class="text-center text-uppercase text-bold"> Sanción #{{ $sancion->id}} </h1>
<hr>
<h3 class="text-bold text-uppercase">Información de sanción:</h3>
        <br>
<div class="row">
    <div class="form-group col-md-3">
        <h4 >Categoría sanción</h4>
        <span class="mt-3">{{ $sancion->categoria->nombre }}</span>
    </div>   
    <div class="form-group col-md-8">
        <h4 >Descripción</h4>
        {!! $sancion->descripcion !!}
    </div>
</div>
<br>
<div class="row">
    <div class="form-group col-md-3">
        <h4 >Desde</h4>
        <fecha-index fecha="{{$sancion->fecha_inicio}}"></fecha-index>
        <br>
        <formato-hora fecha="{{$sancion->fecha_inicio}}"></formato-hora>
    </div>
    <div class="form-group col-md-3">
        <h4 >Hasta</h4>
        <fecha-index fecha="{{$sancion->fecha_fin}}"></fecha-index>
        <br>
        <formato-hora fecha="{{$sancion->fecha_fin}}"></formato-hora>
    </div>
</div>
        
    </div> 

@endsection