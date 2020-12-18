@extends('adminlte::page')
@include('encargado.notificacion')
@section('content')
<div class="container py-2" id="app">
    <h1 class="text-center mb-3">Editar fecha de reserva #{{$reserva->id}}</h1>
<hr>
    <div class="row justify-content-center mt-3">
        <div class="col-md-12">
            <form action="{{ route('cambiar.fecha',['reserva' => $reserva->id])}}" method="POST" enctype="multipart/form-data" novalidate>
                <!--csrf_field()}}  token de acceso unico para -->
                @csrf
                @method('PUT')
                <div class="row justify-content-center">
                    <div class="form-group col-md-4">
                        <label for="fecha">Nueva fecha evento </label>
                    <input id="fecha"
                        type="datetime-local"
                        name="fecha" 
                        class="form-control @error('fecha') is-invalid @enderror" 
                        placeholder="Ingrese fecha"
                        value="{{$reserva->fecha_evento}}"
                    >
                    @error('fecha')
                        <span class="invalid_feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                    <br>
                    
                    <label class="mt-2">Fecha original </label>
                    <fecha-index fecha="{{$reserva->fecha_evento}}"></fecha-index> - 
                    <formato-hora fecha="{{$reserva->fecha_evento}}"></formato-hora>hrs. <br>
                    </div> 
                </div>
                    
                    
                <div class="form-group  float-right mt-3">
                    
                    <a href="{{ url('reservas')}}"  class="btn btn-secondary"> Cancelar </a>
                    <input type="submit" class="btn btn-success" value="Actualizar Fecha">
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
