@extends('adminlte::page')

@section('css')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.0/trix.css" integrity="sha512-EQF8N0EBjfC+2N2mlaH4tNWoUXqun/APQIuFmT1B+ThTttH9V1bA0Ors2/UyeQ55/7MK5ZaVviDabKbjcsnzYg==" crossorigin="anonymous" />
@endsection

@section('content')
    <h1 class="text-center mb-5">Ingresar Existencia</h1>

    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <form action="{{ route('existencias.store')}}" method="POST" enctype="multipart/form-data" novalidate>
                <!--csrf_field()}}  token de acceso unico para -->
                @csrf

                <div class="form-group">
                    <label for="codigo">Codigo</label>
                    <input id="codigo" 
                        type="text" 
                        name="codigo" 
                        class="form-control @error('codigo') is-invalid @enderror" 
                        placeholder="Ingrese Codigo de Existencia"
                        value={{ old ('codigo') }}
                    >
                    @error('codigo')
                        <span class="invalid_feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="fecha_adquisicion">Fecha Adquisicion</label>
                    <input type="date"  name="fecha_adquisicion" value="{{old('fecha_adquisicion')}}"
                     id="fecha_adquisicion" class="form-control @error ('fecha_adquisicion') is-invalid @enderror">
                    @error('fecha_adquisicion')
                    <span class="invalid_feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="estado">Estado</label>
                    <select
                        name="estado" 
                        class="form-control @error('estado') is-invalid @enderror" 
                        id="estado"            
                    >
                        <option value="">-- Seleccione una Opcion --</option>
                        @foreach($estados as $estado)
                            <option value="{{ $estado->id }}"  
                            {{ old('estado') == $estado->id ? 'selected' : '' }}
                            >{{$estado->nombre}}</option>
                        @endforeach
                    </select>

                    @error('estado')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="disponibilidad">Disponibilidad</label>
                    <select
                        name="disponibilidad" 
                        class="form-control @error('disponibilidad') is-invalid @enderror" 
                        id="disponibilidad"            
                    >
                        <option value="">-- Seleccione una Opcion --</option>
                        @foreach($disponibilidads as $disponibilidad)
                            <option value="{{ $disponibilidad->id }}"  
                            {{ old('disponibilidad') == $disponibilidad->id ? 'selected' : '' }}
                            >{{$disponibilidad->nombre}}</option>
                        @endforeach
                    </select>

                    @error('disponibilidad')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="equipo">Equipo</label>
                    <select
                        name="equipo" 
                        class="form-control @error('equipo') is-invalid @enderror" 
                        id="equipo"            
                    >
                        <option value="">-- Seleccione una Opcion --</option>
                        @foreach($equipos as $equipo)
                            <option value="{{ $equipo->id }}"  
                            {{ old('equipo') == $equipo->id ? 'selected' : '' }}
                            >{{$equipo->nombre}}</option>
                        @endforeach
                    </select>

                    @error('equipo')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Agregar Existencia">
                    <a href="{{ url('existencias')}}"  class="btn btn-primary"> Cancelar </a>
                </div>
            </form>
        </div>
    </div>

@endsection

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.0/trix.js"
 integrity="sha512-S9EzTi2CZYAFbOUZVkVVqzeVpq+wG+JBFzG0YlfWAR7O8d+3nC+TTJr1KD3h4uh9aLbfKIJzIyTWZp5N/61k1g==" crossorigin="anonymous" defer></script>
@endsection
