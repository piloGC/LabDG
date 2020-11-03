@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.0/trix.css"
        integrity="sha512-EQF8N0EBjfC+2N2mlaH4tNWoUXqun/APQIuFmT1B+ThTttH9V1bA0Ors2/UyeQ55/7MK5ZaVviDabKbjcsnzYg=="
        crossorigin="anonymous" />
@endsection

@section('content')
<div class="container">
<h1 class="text-center mb-5">Formulario de Solicitud</h1>
<div class="row justify-content-center mt-5">
    <div class="col-md-8">
        <form method="POST" action="{{ route('prestamos.store') }}"  novalidate>
            @csrf
              
            {{-- <div class="form-group">
                <label for="nombre">Nombre</label>
                <input id="nombre" 
                    type="text" 
                    name="nombre" 
                    class="form-control @error('nombre') is-invalid @enderror" 
                    value='Pilar' readonly
                >
                @error('nombre')
                    <span class="invalid_feedback d-block" role="alert">
                        <strong>{{$message}}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="apellido">Apellido</label>
                <input id="apellido" 
                    type="text" 
                    name="apellido" 
                    class="form-control @error('apellido') is-invalid @enderror" 
                    value='González' readonly
                >
                @error('apellido')
                    <span class="invalid_feedback d-block" role="alert">
                        <strong>{{$message}}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="telefono">Teléfono</label>
                <input id="telefono" 
                    type="text" 
                    name="telefono" 
                    class="form-control @error('telefono') is-invalid @enderror" 
                    value='956943632' readonly
                >
                @error('telefono')
                    <span class="invalid_feedback d-block" role="alert">
                        <strong>{{$message}}</strong>
                    </span>
                @enderror
            </div> --}}
            {{-- <div class="form-group">
                <label for="categoria">Categoría</label>
                <select name="categoria" id="categoria" class="form-control @error('categoria') is-invalid @enderror">
                    <option value="">-- Seleccione una opcion --</option>
                    @foreach ($categorias as $categoria)
                        <option value="{{ $categoria->id }}" {{ old('categoria') == $categoria->id ? 'selected' : '' }}>
                            {{ $categoria->nombre }}</option>
                    @endforeach
                </select>
                @error('categoria')
                <span class="invalid_feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="equipo">Equipo</label>
                <select name="equipo" id="equipo" class="form-control @error('equipo') is-invalid @enderror">
                    <option value="">-- Seleccione una opcion --</option>
                    @foreach ($equipos as $equipo)
                        <option value="{{ $equipo->id }}" {{ old('equipo') == $equipo->id ? 'selected' : '' }}>
                            {{ $equipo->nombre }}</option>
                    @endforeach
                </select>
                @error('equipo')
                <span class="invalid_feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>             --}}
             <div class="form-group">
                <label for="asignatura">Asignatura</label>
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
            <div class="form-group">
                <label for="motivo">Motivo solicitud</label>
                <input type="hidden" name="motivo" value="{{old('motivo')}}" id="motivo">
                <trix-editor class="form-control @error ('motivo') is-invalid @enderror"
                placeholder="Breve descripción del motivo de la solicitud" input="motivo"></trix-editor>
                @error('motivo')
                <span class="invalid_feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

             <div class="form-group">
                <label for="fecha_inicio">Desde</label>
                <input type="date"  value="{{old('fecha_inicio')}}"
                name="fecha_inicio" id="fecha_inicio" 
                class="form-control @error ('fecha_inicio') is-invalid @enderror">
                @error('fecha_inicio')
                <span class="invalid_feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div> 
            <div class="form-group">
                <label for="fecha_fin">Hasta</label>
                <input type="date"  value="{{old('fecha_fin')}}"
                name="fecha_fin" id="fecha_fin" 
                class="form-control @error ('fecha_fin') is-invalid @enderror">
                @error('fecha_fin')
                <span class="invalid_feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div> 

            <div class="form-group">
                {{-- <enviar-solicitud solicitud></enviar-solicitud> --}}
                <input type="submit" class="btn btn-primary" value="Enviar solicitud" >
            </div>
        </form>
    </div></div></div>
</div>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.0/trix.js"
 integrity="sha512-S9EzTi2CZYAFbOUZVkVVqzeVpq+wG+JBFzG0YlfWAR7O8d+3nC+TTJr1KD3h4uh9aLbfKIJzIyTWZp5N/61k1g==" crossorigin="anonymous" defer></script>
@endsection
