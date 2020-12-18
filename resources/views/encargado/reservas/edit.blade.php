@extends('adminlte::page')
@include('encargado.notificacion')
@section('content')
<div class="container py-2" id="app">
    <h1 class="text-center mb-3">Editar Reserva</h1>
    <hr>
    <div class="row justify-content-center mt-3">
        <div class="col-md-12">

            <form action="{{ route('reservas.update',['reserva' => $reserva->id])}}" method="POST" enctype="multipart/form-data" novalidate>
                <!--csrf_field()}}  token de acceso unico para -->
                @csrf
                @method('PUT')
                <div class="row justify-content-center">
                    <div class="form-group col-md-4">
                        <label for="estado">Estado</label>
                        <select
                            name="estado" 
                            class="form-control @error('estado') is-invalid @enderror" 
                            id="estado"
                                 
                        >
                            <option value="">-- Seleccione una Opcion --</option>
                            @foreach($estados as $estado)
                            <option 
                               value="{{$estado->id}}" {{$reserva->estado_id == $estado->id ? 'selected' : ''}}
                                >{{$estado->nombre}}</option>
                            @endforeach
                        </select>
    
                        @error('estado')
                            <span class="invalid_feedback d-block" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                        @enderror
                    </div>              
                    <div class="form-group col-md-4">
                        <label for="nombre">Nombre evento</label>
                    <input id="nombre" 
                        type="text" 
                        name="nombre" 
                        class="form-control @error('nombre') is-invalid @enderror" 
                        value="{{ $reserva->nombre_evento}}"
                    >
                    @error('nombre')
                        <span class="invalid_feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                    </div>
                    

                </div>
                <div class="row justify-content-center">
                    <div class="form-group col-md-4">
                        <label for="encargado">Encargado evento</label>
                    <input id="encargado" 
                        type="text" 
                        name="encargado" 
                        class="form-control @error('encargado') is-invalid @enderror" 
                        value="{{ $reserva->encargado_evento}}"
                    >
                    @error('encargado')
                        <span class="invalid_feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                    </div>
                    <div class="form-group col-md-4">
                        <label for="sala">Sala</label>
                        <select
                        name="sala" 
                        class="form-control @error('sala') is-invalid @enderror" 
                        id="sala"        
                    >
                        <option value="">-- Seleccione una Opcion --</option>
                        @foreach($salas as $sala)
                        <option 
                           value="{{$sala->id}}" {{$reserva->sala_id == $sala->id ? 'selected' : ''}}
                            >{{$sala->nombre}}</option>
                        @endforeach
                    </select>
    
                        @error('sala')
                        <span class="invalid_feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                    </div>
                </div>
                <div class="form-group float-right mt-3">
                    <a href="{{ url('reservas')}}"  class="btn btn-secondary"> Cancelar </a>
                    <input type="submit" class="btn btn-success" value="Actualizar reserva">
                </div>
            </form>
        </div>
    </div>

@endsection

