@extends('adminlte::page')
@include('encargado.notificacion')
@section('content')

{{-- <h1>{{$sancion}}</h1> --}}
<div class="container" id="app">
        <h1 class="text-center text-uppercase text-bold"> Sanción #{{ $sancion->id}} </h1>
        <div class="row justify-content-end mr-5">
            <h5 class="">Estado: 
               @if ($sancion->estado->id == 1)
                   <span class="badge badge-pill badge-info text-white">{{$sancion->estado->nombre}}</span> 
               @endif
               @if ($sancion->estado->id == 2)
                   <span class="badge badge-pill badge-secondary">{{$sancion->estado->nombre}}</span>
               @endif
           </h5> 
       </div>
    <hr>
    <h3 class="text-bold text-uppercase" >Información de alumno</h3>
    <br>
    
             <div class="row">
                <div class="form-group col-md-3">
                    <h4 >Estudiante</h4>
                    <span class="mt-3">{{ $sancion->alumnoNombre }} {{ $sancion->alumnoApellido }}</span>
                </div>   
                <div class="form-group col-md-7">
                    <h4 >Rut</h4>
                    {!! $sancion->rutAlumno !!}
                </div>
            </div>
            <br>
            <h3 class="text-bold text-uppercase" >detalle sancion</h3>
            <br>
            <div class="row">
                <div class="form-group col-md-4">
                    <h4>Número solicitud </h4>
                    <h5 class="btn btn-outline-info">
                        <a href="{{action ('ListarSolicitudController@show',['listarSolicitud' => $sancion->prestamo->solicitud_id])}}" 
                            style="color:black">{{Str::words(strip_tags($sancion->prestamo->solicitud_id),9)}}</a></h5>
                            
                </div> 
                <div class="form-group col-md-4">
                    <h4 >Desde</h4>
                    <fecha-index fecha="{{$sancion->fecha_inicio}}"></fecha-index>
                </div>
                <div class="form-group col-md-4">
                    <h4 >Hasta</h4>
                    <fecha-index fecha="{{$sancion->fecha_fin}}"></fecha-index>
                </div>
            </div>
            <div class="row">
                
                <div class="form-group col-md-4">
                    <h4 >Categoría sanción</h4>
                    <span class="mt-3">{{ $sancion->categoria->nombre }}</span>
                </div>   
                <div class="form-group col-md-7">
                    <h4 >Descripción sanción</h4>
                    <div><span class="mt-3">{!! $sancion->descripcion !!}</span></div>
                </div>
            </div>
             
            </div>

@endsection