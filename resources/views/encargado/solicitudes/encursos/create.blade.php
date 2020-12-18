@extends('adminlte::page')

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.0/trix.css"
        integrity="sha512-EQF8N0EBjfC+2N2mlaH4tNWoUXqun/APQIuFmT1B+ThTttH9V1bA0Ors2/UyeQ55/7MK5ZaVviDabKbjcsnzYg=="
        crossorigin="anonymous" />
@endsection

@include('encargado.notificacion')
@section('content')
<div class="container py-2" id="app">
    <h1 class="text-center mb-3">Formulario de Solicitud</h1>
    <hr>
    <div class="row justify-content-center mt-3">
        <div class="col-md-12">
        <form action="{{ route('listarSolicitud.store')}}"  method="POST" novalidate>
            @csrf
             <div class="row">
            <div class="form-group col-md-4">
                <label for="run">Run solicitante</label>
                <input 
                value="{{old('run')}}"
                    type="text" 
                    name="run" 
                    id="run"
                    class="form-control @error('run') is-invalid @enderror"  >
                @error('run')
                    <span class="invalid_feedback d-block" role="alert">
                        <strong>{{$message}}</strong>
                    </span>
                @enderror
            </div> 
        </div> 
        
        <dropdown-solicitud ruta-cat="{{route('dropdown.categorias')}}" ruta-equipo="{{route('dropdown.equipos')}}"
        ruta-existencia="{{route('dropdown.existencias')}}"></dropdown-solicitud>

            <div class="row">
             <div class="form-group col-md-4 mt-3">
                <label for="asignatura">Asignatura:</label>
                <select name="asignatura" id="asignatura" class="form-control @error('asignatura') is-invalid @enderror">
                    <option value="">-- Seleccione una opcion --</option>
                    @foreach ($asignaturas as $asignatura)
                        <option value="{{ $asignatura->id }}" {{ old('asignatura') == $asignatura->id ? 'selected' : '' }}>
                            {{ $asignatura->nombre }}</option>
                    @endforeach
                </select>
                @error('asignatura')
                <span class="invalid_feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div> 
            
             <div class="form-group col-md-4 mt-3">
                <label for="fecha_inicio">Desde:</label>
                <input type="date"  value="{{$hoy}}"
                name="fecha_inicio" id="fecha_inicio" 
                class="form-control @error ('fecha_inicio') is-invalid @enderror" readonly>
                @error('fecha_inicio') 
                <span class="invalid_feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div> 
            <div class="form-group col-md-4 mt-3">
                <label for="fecha_fin">Hasta:</label>
                <input type="date"  value="{{old('fecha_fin')}}"
                name="fecha_fin" id="fecha_fin" min="{{$hoy}}"
                class="form-control @error ('fecha_fin') is-invalid @enderror">
                @error('fecha_fin')
                <span class="invalid_feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
            <div class="form-group mt-3">
                <label for="motivo">Motivo solicitud:</label>
                <input type="hidden" name="motivo" value="{{old('motivo')}}" id="motivo">
                <trix-editor class="form-control @error ('motivo') is-invalid @enderror"
                placeholder="Breve descripción del motivo de la solicitud" input="motivo"></trix-editor>
                @error('motivo')
                <span class="invalid_feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="row">
                <div class="form-group col-md-4 mt-3">
                   <select type="hidden" name="estado" hidden id="estado" class="form-control 
                   @error('estado') is-invalid @enderror">
                       @foreach ($estados as $estado)
                           <option value="{{ $estado->id }}"  {{ old('estado') == $estado->id ? 'selected' : '' }}>
                               {{ $estado->nombre }}</option>   
                       @endforeach
                   </select>
                   @error('estado')
                   <span class="invalid_feedback d-block" role="alert">
                       <strong>{{ $message }}</strong>
                   </span>
                   @enderror
               </div> 
            </div>
               {{-- <div class="form-group col-md-4 mt-3"></div>
               <div class="form-group col-md-1 mt-3"></div> --}}
               <div class="form-group float-right col-md-3">
                {{-- <enviar-solicitud solicitud></enviar-solicitud>  --}}
                <a href="{{ url('/')}}"  class="btn btn-secondary"> Cancelar </a>
                <input type="submit" class="btn btn-success" value="Enviar solicitud" > 
                </div>
            </div>
    </div>
        </form>
    </div>
</div>
@endsection

