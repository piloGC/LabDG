@extends('adminlte::page')

@section('css')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.0/trix.css" integrity="sha512-EQF8N0EBjfC+2N2mlaH4tNWoUXqun/APQIuFmT1B+ThTttH9V1bA0Ors2/UyeQ55/7MK5ZaVviDabKbjcsnzYg==" crossorigin="anonymous" />
@endsection

@section('content')
<div class="container py-2">
    <h1 class="text-center mb-3">Registrar Nuevo Equipo</h1>
    <hr>
    <div class="row justify-content-center mt-3">
        <div class="col-md-12">

            <form action="{{ route('equipos.store')}}" method="POST" enctype="multipart/form-data" novalidate>
                <!--csrf_field()}}  token de acceso unico para -->
                @csrf
                <div class="row">
                    <div class="form-group col-md-3">
                        <label for="categoria">Categoria</label>

                        <select
                            name="categoria" 
                            class="form-control @error('categoria') is-invalid @enderror" 
                            id="categoria"        
                        >
                            <option value="">-- Seleccione una Opcion --</option>
                            @foreach($categorias as $categoria)
                            <option 
                                value="{{ $categoria->id }}" 
                                {{ old('categoria') == $categoria->id ? 'selected' : '' }} 
                                >{{$categoria->nombre}}</option>
                            @endforeach
                        </select>

                        @error('categoria')
                            <span class="invalid_feedback d-block" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group col-md-3">
                        <label for="nombre">Nombre</label>
                    <input id="nombre" 
                        type="text" 
                        name="nombre" 
                        class="form-control @error('nombre') is-invalid @enderror" 
                        placeholder="Ingrese Nombre Referido"
                        value={{ old ('nombre') }}
                    >
                    @error('nombre')
                        <span class="invalid_feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                    </div>
                    <div class="form-group col-md-3">
                        <label for="marca">Marca</label>
                    <input id="marca" 
                        type="text" 
                        name="marca" 
                        class="form-control @error('marca') is-invalid @enderror" 
                        placeholder="Ingrese Marca"
                        value={{old ('marca')}}
                    >
                    @error('marca')
                        <span class="invalid_feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                    </div>
                    <div class="form-group col-md-3">
                        <label for="modelo">Modelo</label>
                    <input id="modelo"
                        type="text"
                        name="modelo" 
                        class="form-control @error('modelo') is-invalid @enderror" 
                        placeholder="Ingrese Modelo"
                        value={{old ('modelo')}}
                    >
                    @error('modelo')
                        <span class="invalid_feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="form-group mt-4">
                        <label for="descripcion">Descripción</label>
                        <input id="descripcion" 
                        type="hidden" 
                        name="descripcion" 
                        value="{{old ('descripcion')}}"
                        >
                        <trix-editor 
                            class="form-control @error('descripcion') is-invalid @enderror" 
                            placeholder="Ingrese descripción del equipo"
                            input="descripcion">
                        </trix-editor>
    
                        @error('descripcion')
                            <span class="invalid_feedback d-block" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                        @enderror
    
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-4">
                        <label for="imagen">Imagen</label>
                    <input id="imagen" 
                        type="file" 
                        name="imagen" 
                        class="form-control @error('imagen') is-invalid @enderror"  
                    >
                    @error('imagen')
                        <span class="invalid_feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                    </div>
                    <div class="form-group col-md-3">
                        <label for="catalogo">En Catalogo</label>
                        <select
                            name="catalogo" 
                            class="form-control @error('catalogo') is-invalid @enderror" 
                            id="catalogo"            
                        >                  
    
                            <option value="">-- Seleccione una Opcion --</option>
                            @foreach($catalogos as $catalogo)
                                <option value="{{ $catalogo->id }}"  
                                {{ old('catalogo') == $catalogo->id ? 'selected' : '' }}
                                >{{$catalogo->disponible}}</option>
                            @endforeach
                        </select>
    
                        @error('catalogo')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group float-right mt-3">
                    <a href="{{ url('equipos')}}"  class="btn btn-secondary"> Cancelar </a>
                    <input type="submit" class="btn btn-success" value="Agregar Equipo">
                </div>
            </form>
        </div>
    </div>

@endsection

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.0/trix.js"
 integrity="sha512-S9EzTi2CZYAFbOUZVkVVqzeVpq+wG+JBFzG0YlfWAR7O8d+3nC+TTJr1KD3h4uh9aLbfKIJzIyTWZp5N/61k1g==" crossorigin="anonymous" defer></script>
@endsection
