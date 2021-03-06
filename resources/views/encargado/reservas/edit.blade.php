@extends('adminlte::page')
@include('encargado.notificacion')
@section('content')
<div class="container py-2" id="app">
    <h1 class="text-center mb-3">Editar Reserva</h1>
    <hr>
    <div class="row  mt-3">
        <div class="col-md-12">
            <form action="{{ route('reservas.update',['reserva' => $reserva->id])}}" method="POST" enctype="multipart/form-data" novalidate>
                <!--csrf_field()}}  token de acceso unico para -->
                @csrf
                @method('PUT')
                <div class="row">
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
                </div>
                <div class="row justify-content-center">
                    <div class="form-group col-md-4">
                        <label for="nombre">Nombre reserva</label>
                        <input id="nombre" 
                            type="text" 
                            name="nombre" 
                            class="form-control @error('nombre') is-invalid @enderror" 
                            value={{ $reserva->nombre_reserva}}
                        >
                        @error('nombre')
                            <span class="invalid_feedback d-block" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group col-md-4">
                        <label for="encargado">Encargado reserva</label>
                        <input id="encargado" 
                            type="text" 
                            name="encargado" 
                            class="form-control @error('encargado') is-invalid @enderror" 
                            value={{$reserva->encargado_reserva}}
                        >
                        @error('encargado')
                            <span class="invalid_feedback d-block" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group col-md-4">
                        <label for="tipo_publico">Público</label>
                    <input id="tipo_publico" 
                        type="text" 
                        name="tipo_publico" 
                        placeholder="Ej: todo público,sólo alumnos..."
                        class="form-control @error('tipo_publico') is-invalid @enderror" 
                        value="{{$reserva->tipo}}"
                    >
                    @error('tipo_publico')
                        <span class="invalid_feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                    </div>
                    
                </div>

                <div class="row justify-content-center">
                    <div class="form-group col-md-3">
                        <label for="dia_reserva">Día reserva</label>
                        <input id="dia_reserva"
                            type="date"
                            name="dia_reserva" 
                            min="{{$hoy}}"
                            class="form-control @error('dia_reserva') is-invalid @enderror" 
                            value={{$reserva->dia_reserva}}
                        >
                        @error('dia_reserva')
                            <span class="invalid_feedback d-block" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group col-md-3">
                        <label for="hora_inicio">Hora inicio</label>
                    <input id="hora_inicio"
                        type="string"
                        name="hora_inicio" 
                        placeholder="Ej: 17:00"
                        class="form-control @error('hora_inicio') is-invalid @enderror" 
                        value={{$reserva->hora_inicio}}
                    >
                    @error('hora_inicio')
                        <span class="invalid_feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                    </div>

                    <div class="form-group col-md-3">
                        <label for="hora_fin">Hora fin</label>
                    <input id="hora_fin"
                        type="string"
                        name="hora_fin" 
                        placeholder="Ej: 17:00"
                        class="form-control @error('hora_fin') is-invalid @enderror" 
                        value={{$reserva->hora_fin}}
                    >
                    @error('hora_fin')
                        <span class="invalid_feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                    </div>

                    <div class="form-group col-md-3">
                        <label for="sala">Sala</label>
                        <select
                            name="sala" 
                            class="form-control @error('sala') is-invalid @enderror" 
                            id="sala"            
                        >                  
    
                            <option value="">-- Seleccione una Opcion --</option>
                            @foreach($salas as $sala)
                                <option value="{{ $sala->id }}"  
                                {{ $sala->id == $sala->id ? 'selected' : '' }}
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

{{-- <div class="row">
                    <div class="row justify-content-center">
                        <div class="form-group col-md-3">
                            
                        </div>
                        
                        
                        <div class="form-group col-md-2">
                            
                        </div>
                </div>
                <div class="row">
                    
                    

                    
                </div> --}}