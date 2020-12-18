@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.0/trix.css"
        integrity="sha512-EQF8N0EBjfC+2N2mlaH4tNWoUXqun/APQIuFmT1B+ThTttH9V1bA0Ors2/UyeQ55/7MK5ZaVviDabKbjcsnzYg=="
        crossorigin="anonymous" />
@endsection

@section('content')
 <body style="background-image:url({{ asset('../images/fondo2.png') }})"> 
<div class="container py-4">
     
<h1 class="text-center mb-3 titulos">Formulario de Solicitud</h1>
<div class="row justify-content-end mr-5">
    <a href="" data-toggle="modal" data-target="#preguntas" style="color:black;text-decoration:none">
        <i class="far fa-question-circle" 
        data-toggle="tooltip" data-placement="top" 
        title="Preguntas frecuentes"></i> Resuelve tus dudas!
    </a>
</div>
<hr>
<div class="row justify-content-center mt-4">
    <div class="col-md-12">
        <form method="POST" action="{{ route('solicitud.store') }}"  novalidate>
            @csrf
            <div class="row">
             <div class="form-group col-md-4">
                <label for="nombre">Nombre</label>
                <input id="nombre" 
                    type="text" 
                    name="nombre" 
                    class="form-control @error('nombre') is-invalid @enderror" 
                    value="{{auth()->user()->name}}" readonly
                >
                @error('nombre')
                    <span class="invalid_feedback d-block" role="alert">
                        <strong>{{$message}}</strong>
                    </span>
                @enderror
            </div>             
            <div class="form-group col-md-4">
                <label for="apellido">Apellidos</label>
                <input 
                    type="text" 
                    name="apellido" 
                    class="form-control @error('apellido') is-invalid @enderror" 
                    value="{{auth()->user()->lastname}}" readonly
                >
                @error('apellido')
                    <span class="invalid_feedback d-block" role="alert">
                        <strong>{{$message}}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group col-md-4">
                <label for="telefono">Correo</label>
                <input 
                    type="text" 
                    name="telefono" 
                    class="form-control @error('telefono') is-invalid @enderror" 
                    value="{{auth()->user()->email}}" readonly
                >
                @error('telefono')
                    <span class="invalid_feedback d-block" role="alert">
                        <strong>{{$message}}</strong>
                    </span>
                @enderror
            </div> 
        </div>
        <div class="row">
            <div class="form-group col-md-4 mt-3">
                <label >Categoria</label>
                <input type="text"  class="form-control" value="{{$existencia->equipo->categoria->nombre}}" readonly>
            </div>
            <div class="form-group col-md-4 mt-3">
                <label >Equipo</label>
                <input type="text" class="form-control" value="{{$existencia->equipo->marca}}" readonly>
            </div>
            <div class="form-group col-md-4 mt-3">
                <label for="existencia">Número de equipo</label>
                <input type="text" id="existencia" name="existencia" class="form-control" value="{{$existencia->id}}" hidden>
                <input type="text" class="form-control" value="{{$existencia->codigo}}" readonly>
                
            </div>
        </div>
              
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
                <input type="date"  value="{{old('fecha_inicio')}}"
                name="fecha_inicio" id="fecha_inicio" min="{{$hoy->format('Y-m-d')}}"
                class="form-control @error ('fecha_inicio') is-invalid @enderror">
                @error('fecha_inicio')
                <span class="invalid_feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div> 
            <div class="form-group col-md-4 mt-3">
                <label for="fecha_fin">Hasta:</label>
                <input type="date"  value="{{old('fecha_fin')}}"
                name="fecha_fin" id="fecha_fin" min="{{$hoy->format('Y-m-d')}}"
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
                <div class="form-group float-right">
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
            <div class="form-group">
                <input type="checkbox" name="condiciones" value="on" 
                {{ old('condiciones') == 'on' ? 'checked' : '' }}>
                He leído y acepto los <a href="" data-toggle="modal" data-target="#condicion" >Términos y Condiciones</a> de solicitud
                @error('condiciones')
                   <span class="invalid_feedback d-block" role="alert">
                       <strong class="text-danger">Debes aceptar los términos y condiciones</strong>
                   </span>
                   @enderror 
            </div>
            
            <div class="form-group float-right">
                <a href="{{ url('/')}}"  class="btn btn-secondary"> Cancelar </a>
                <input type="submit" class="btn btn-success" value="Enviar solicitud" > 
           </div>
        </form>
    </div></div></div>
</div>

@include('alumno.solicitudes.modal')

</body>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.0/trix.js"
 integrity="sha512-S9EzTi2CZYAFbOUZVkVVqzeVpq+wG+JBFzG0YlfWAR7O8d+3nC+TTJr1KD3h4uh9aLbfKIJzIyTWZp5N/61k1g==" crossorigin="anonymous" defer></script>
 @endsection



