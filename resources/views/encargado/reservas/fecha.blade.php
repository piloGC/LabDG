@extends('adminlte::page')
@include('encargado.notificacion')
@section('content')
<div class="container py-2" id="app">
    <h1 class="text-center mb-3">Editar fecha_inicio de reserva #{{$reserva->id}}</h1>
<hr>
    <div class="row justify-content-center mt-3">
        <div class="col-md-12">
            <form action="{{ route('cambiar.fecha',['reserva' => $reserva->id])}}" method="POST" enctype="multipart/form-data" novalidate>
                <!--csrf_field()}}  token de acceso unico para -->
                @csrf
                @method('PUT')
                <div class="row justify-content-center">
                    <div class="form-group col-md-4">
                        <label for="fecha_inicio">Nueva fecha inicio reserva </label>
                    <input id="fecha_inicio"
                        type="datetime-local"
                        name="fecha_inicio" 
                        class="form-control @error('fecha_inicio') is-invalid @enderror" 
                        placeholder="Ingrese fecha_inicio"
                        value="{{$reserva->fecha_inicio_reserva}}"
                    >
                    @error('fecha_inicio')
                        <span class="invalid_feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                    <br>
                    
                    <label class="mt-2">*Fecha inicio original </label>
                    <fecha-index fecha_inicio="{{$reserva->fecha_inicio_reserva}}"></fecha-index> - 
                    <formato-hora fecha_inicio="{{$reserva->fecha_inicio_reserva}}"></formato-hora>hrs. <br>
                    </div> 


                    <div class="form-group col-md-4">
                        <label for="fecha_fin">Nueva fecha fin reserva </label>
                    <input id="fecha_fin"
                        type="datetime-local"
                        name="fecha_fin" 
                        class="form-control @error('fecha_fin') is-invalid @enderror" 
                        placeholder="Ingrese fecha_fin"
                        value="{{$reserva->fecha_fin_reserva}}"
                    >
                    @error('fecha_fin')
                        <span class="invalid_feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                    <br>
                    
                    <label class="mt-2">*Fecha fin original </label>
                    <fecha-index fecha="{{$reserva->fecha_fin_reserva}}"></fecha-index> - 
                    <formato-hora fecha="{{$reserva->fecha_fin_reserva}}"></formato-hora>hrs. <br>
                    </div>

                    
                </div>
                    
                    
                <div class="form-group  float-right mt-3">
                    
                    <a href="{{ url('reservas')}}"  class="btn btn-secondary"> Cancelar </a>
                    <input type="submit" class="btn btn-success" value="Actualizar fechas">
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
