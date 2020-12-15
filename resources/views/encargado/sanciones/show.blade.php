@extends('adminlte::page')
@include('encargado.notificacion')
@section('content')

{{-- <h1>{{$sancion}}</h1> --}}
<div class="container" id="app">
        <h1 class="text-center text-uppercase text-bold"> Sanción #{{ $sancion->id}} </h1>
        <div class="row justify-content-end mr-5">
            <h5 class="">Estado: 
               @if ($sancion->estado->id == 1)
                   <span class="badge badge-pill badge-info">{{$sancion->estado->nombre}}</span> 
               @endif
               @if ($sancion->estado->id == 2)
                   <span class="badge badge-pill badge-secondary">{{$sancion->estado->nombre}}</span>
               @endif
           </h5> 
       </div>
<hr>
<h3 class="text-bold text-uppercase">Información de sanción:</h3>
        <br>
        <div class="row"> 
            <div class="form-group col-md-3">
                <h4 >Categoría sanción</h4>
                <span class="mt-3">{{ $sancion->categoria->nombre }}</span>
            </div>   
            <div class="form-group col-md-9">
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
        <br>

        <div class="row">
            <div class="form-group col-md-2">
                <h4 >Prestamo ID</h4>
                <span class="mt-3">{{ $sancion->prestamo_id }}</span>
            </div>  
            <div class="form-group col-md-2">
                <h4 >Solicitud ID</h4>
                <span class="mt-3">{{ $sancion->prestamo->solicitud_id }}</span>
            </div>   
            <div class="form-group col-md-3">
                <h4 >Estudiante</h4>
                <span class="mt-3">{{ $sancion->alumnoNombre }} {{ $sancion->alumnoApellido }}</span>
            </div>   
            <div class="form-group col-md-3">
                <h4 >Rut</h4>
                {!! $sancion->rutAlumno !!}
            </div>
        </div>
    </div> 

@endsection