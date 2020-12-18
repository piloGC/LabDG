@extends('adminlte::page')
@include('encargado.notificacion')
@section('content')
<div class="container py-2">
    <h1 class="text-center mb-3">Registrar Nueva Reserva</h1>
    <hr>
    <div class="row justify-content-center mt-3">
        <div class="col-md-12">

            <form action="{{ route('reservas.store')}}" method="POST" enctype="multipart/form-data" novalidate>
                <!--csrf_field()}}  token de acceso unico para -->
                @csrf
                <div class="row justify-content-center">
                    <div class="form-group col-md-4">
                        <label for="nombre">Nombre evento</label>
                    <input id="nombre" 
                        type="text" 
                        name="nombre" 
                        class="form-control @error('nombre') is-invalid @enderror" 
                        value={{ old ('nombre') }}
                    >
                    @error('nombre')
                        <span class="invalid_feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                    </div>
                    <div class="form-group col-md-4">
                        <label for="encargado">Encargado evento</label>
                    <input id="encargado" 
                        type="text" 
                        name="encargado" 
                        class="form-control @error('encargado') is-invalid @enderror" 
                        value={{old ('encargado')}}
                    >
                    @error('encargado')
                        <span class="invalid_feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                    </div>

                </div>
                <div class="row justify-content-center">
                    
                    <div class="form-group col-md-4">
                        <label for="fecha">Fecha evento</label>
                    <input id="fecha"
                        type="datetime-local"
                        name="fecha" 
                        class="form-control @error('fecha') is-invalid @enderror" 
                        placeholder="Ingrese fecha"
                        value={{old ('fecha')}}
                    >
                    @error('fecha')
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
                                <option value="{{ $sala->id }}"  
                                {{ old('sala') == $sala->id ? 'selected' : '' }}
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
                    <input type="submit" class="btn btn-success" value="Agregar reserva">
                </div>
            </form>
        </div>
    </div>

@endsection

