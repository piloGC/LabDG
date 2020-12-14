@extends('adminlte::page')

@section('css')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.0/trix.css" integrity="sha512-EQF8N0EBjfC+2N2mlaH4tNWoUXqun/APQIuFmT1B+ThTttH9V1bA0Ors2/UyeQ55/7MK5ZaVviDabKbjcsnzYg==" crossorigin="anonymous" />
@endsection

@section('content')
    <h1 class="text-center mb-5">Editar sancion n° {{$sancion->id}}</h1>

    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <form method ="POST" action="{{route('sanciones.update',['sancion'=> $sancion->id])}}" novalidate>
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="categoria">Categoria</label>
                    <select name="categoria" id="categoria" class="form-control @error('categoria') is-invalid @enderror">
                        <option value="">-- Seleccione una opcion --</option>
                        @foreach ($categorias as $categoria)
                            <option value="{{ $categoria->id }}" {{ $sancion->categoria->id == $categoria->id ? 'selected' : '' }}>
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
                    <label for="descripcion">Descripcion</label>
                    <input type="hidden" name="descripcion" value="{{$sancion->descripcion}}" id="descripcion">
                    <trix-editor class="form-control @error ('descripcion') is-invalid @enderror"
                    placeholder="Breve descripción del motivo de la sanción" input="descripcion"></trix-editor>
                    
                    @error('descripcion')
                    <span class="invalid_feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                    <div class="form-group">
                        <label for="fecha_inicio">Fecha inicio</label>
                        <input type="date" value="{{$sancion->fecha_inicio}}"
                        name="fecha_inicio" 
                        id="fecha_inicio" 
                        class="form-control @error ('fecha_inicio') is-invalid @enderror">
                                          
                        @error('fecha_inicio')
                        <span class="invalid_feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="fecha_fin">Fecha fin</label>
                        <input type="date" value="{{$sancion->fecha_fin}}"
                        name="fecha_fin" id="fecha_fin" class="form-control @error ('fecha_fin') is-invalid @enderror">
                        @error('fecha_fin')
                        <span class="invalid_feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <input type="submit" class="btn btn-success" value="Actualizar sancion">
                    </div>

                </div>
            </form>
        </div>
    </div>
@endsection

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.0/trix.js"
 integrity="sha512-S9EzTi2CZYAFbOUZVkVVqzeVpq+wG+JBFzG0YlfWAR7O8d+3nC+TTJr1KD3h4uh9aLbfKIJzIyTWZp5N/61k1g==" 
 crossorigin="anonymous" defer></script>
@endsection 