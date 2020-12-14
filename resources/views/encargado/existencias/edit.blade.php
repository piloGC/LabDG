@extends('adminlte::page')

@section('css')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.0/trix.css" integrity="sha512-EQF8N0EBjfC+2N2mlaH4tNWoUXqun/APQIuFmT1B+ThTttH9V1bA0Ors2/UyeQ55/7MK5ZaVviDabKbjcsnzYg==" crossorigin="anonymous" />
@endsection
@include('encargado.notificacion')
@section('content')
<div class="container py-2">
    <h1 class="text-center mb-3">Editar Existencia {{$existencia->nombre}}</h1>
    <hr>
    <div class="row justify-content-center mt-3">
        <div class="col-md-12">
            <form action="{{ route('existencias.update',['existencia' => $existencia->id])}}" method="POST" enctype="multipart/form-data" novalidate>
                <!--csrf_field()}}  token de acceso unico para -->
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="form-group col-md-4">
                        <label for="codigo">Codigo</label>
                        <input id="codigo" 
                            type="text" 
                            name="codigo" 
                            class="form-control @error('codigo') is-invalid @enderror" 
                            placeholder="Ingrese Codigo de Existencia"
                            value="{{ $existencia->codigo}}" readonly
                        >
                        @error('codigo')
                            <span class="invalid_feedback d-block" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group col-md-4">
                        <label for="fecha_adquisicion">Fecha Adquisicion</label>
                        <input type="date"  name="fecha_adquisicion" value="{{$fecha->format('Y-m-d')}}"
                         id="fecha_adquisicion" class="form-control @error ('fecha_adquisicion') is-invalid @enderror">
                        @error('fecha_adquisicion')
                        <span class="invalid_feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
    
                    <div class="form-group col-md-4">
                        <label for="estado">Estado</label>
                        <select
                            name="estado" 
                            class="form-control @error('estado') is-invalid @enderror" 
                            id="estado"            
                        >
                            <option value="">-- Seleccione una Opcion --</option>
                            @foreach($estados as $estado)
                                <option value="{{ $estado->id }}" {{ $existencia->estado_id == $estado->id ? 'selected' : '' }}
                                >{{$estado->nombre}}</option>
                            @endforeach
                        </select>
    
                        @error('estado')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
               
                <div class="row">
                    <div class="form-group col-md-4">
                        <label for="disponibilidad">Disponibilidad</label>
                        <select
                            name="disponibilidad" 
                            class="form-control @error('disponibilidad') is-invalid @enderror" 
                            id="disponibilidad"            
                        >
                            <option value="">-- Seleccione una Opcion --</option>
                            @foreach($disponibilidads as $disponibilidad)
                                <option value="{{ $disponibilidad->id }}"  
                                {{ $existencia->disponibilidad_id  == $disponibilidad->id ? 'selected' : '' }}
                                >{{$disponibilidad->nombre}}</option>
                            @endforeach
                        </select>
    
                        @error('disponibilidad')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                        @enderror
                    </div>
    
                    <div class="form-group col-md-4">
                        <label for="equipo">Equipo</label>
                        <select
                            name="equipo" 
                            class="form-control @error('equipo') is-invalid @enderror" 
                            id="equipo"            
                        >
                            <option value="">-- Seleccione una Opcion --</option>
                            @foreach($equipos as $equipo)
                                <option value="{{ $equipo->id }}"  
                                {{ $existencia->equipo_id  == $equipo->id ? 'selected' : '' }}
                                >{{$equipo->nombre}}</option>
                            @endforeach
                        </select>
    
                        @error('equipo')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                

                <div class="form-group float-right mt-3">
                    <a href="{{ url('existencias')}}"  class="btn btn-secondary"> Cancelar </a>
                    <input type="submit" class="btn btn-success" value="Actualizar item">
                    
                </div>
            </form>
            {{-- @include('encargado.prestamos.crear') --}}
        </div>
        
    </div>
</div>
@endsection

{{-- @section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.0/trix.js"
 integrity="sha512-S9EzTi2CZYAFbOUZVkVVqzeVpq+wG+JBFzG0YlfWAR7O8d+3nC+TTJr1KD3h4uh9aLbfKIJzIyTWZp5N/61k1g==" crossorigin="anonymous" defer></script>
@endsection --}}
