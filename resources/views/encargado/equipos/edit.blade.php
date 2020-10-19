@extends('adminlte::page')

@section('css')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.0/trix.css" integrity="sha512-EQF8N0EBjfC+2N2mlaH4tNWoUXqun/APQIuFmT1B+ThTttH9V1bA0Ors2/UyeQ55/7MK5ZaVviDabKbjcsnzYg==" crossorigin="anonymous" />
@endsection

@section('content')

    <h1 class="text-center mb-5">Editar Equipo {{$equipo->nombre}}</h1>

    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <form action="{{ route('equipos.update',['equipo' => $equipo->id])}}" method="POST" enctype="multipart/form-data" novalidate>
                <!--csrf_field()}}  token de acceso unico para -->
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="categoria">Categoria</label>

                    <select
                        name="categoria" 
                        class="form-control @error('categoria') is-invalid @enderror" 
                        id="categoria"        
                    >
                        <option value="">-- Seleccione una Opcion --</option>
                        @foreach($categorias as $categoria)
                        <option 
                           value="{{$categoria->id}}" {{$equipo->categoria_id == $categoria->id ? 'selected' : ''}}
                            >{{$categoria->nombre}}</option>
                        @endforeach
                    </select>

                    @error('categoria')
                        <span class="invalid_feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input id="nombre" 
                        type="text" 
                        name="nombre" 
                        class="form-control @error('nombre') is-invalid @enderror" 
                        placeholder="Ingrese Nombre Referido"
                        value="{{ $equipo->nombre}}"
                    >
                    @error('nombre')
                        <span class="invalid_feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="marca">Marca</label>
                    <input id="marca" 
                        type="text" 
                        name="marca" 
                        class="form-control @error('marca') is-invalid @enderror" 
                        placeholder="Ingrese Marca"
                        value="{{ $equipo->marca}}"
                    >
                    @error('marca')
                        <span class="invalid_feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="modelo">Modelo</label>
                    <input id="modelo"
                        type="text"
                        name="modelo" 
                        class="form-control @error('modelo') is-invalid @enderror" 
                        placeholder="Ingrese Modelo"
                        value="{{ $equipo->modelo}}"
                    >
                    @error('modelo')
                        <span class="invalid_feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group mt-3">
                    <label for="descripcion">Descripción</label>
                    <input id="descripcion" 
                    type="hidden" 
                    name="descripcion" 
                    value="{{ $equipo->descripcion }}"
                    >
                    <trix-editor 
                        class="form-control @error('descripcion') is-invalid @enderror" 
                        input="descripcion"
                    ></trix-editor>
                    @error('descripcion')
                    <span class="invalid_feedback d-block" role="alert">
                        <strong>{{$message}}</strong>
                    </span>
                @enderror

                </div>
                <div class="form-group">
                    <label for="imagen">Imagen</label>
                    <input id="imagen" 
                        type="file" 
                        name="imagen" 
                        class="form-control @error('imagen') is-invalid @enderror"  
                    >

                    <div class="mt-4">
                        <p> Imagen Actual: </p>
                        <img src="/storage/{{$equipo->imagen}}" style="width:300px" >
                    </div>


                    @error('imagen')
                        <span class="invalid_feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="catalogo">En Catalogo</label>
                    <select
                        name="catalogo" 
                        class="form-control @error('catalogo') is-invalid @enderror" 
                        id="catalogo"            
                    >
                    <option value="">-- Seleccione una Opcion --</option>
                        @foreach($catalogos as $catalogo)
                            <option 
                            value="{{ $catalogo->id }}"  
                                {{ $equipo->en_catalogo == $catalogo->id ? 'selected' : '' }}
                            >{{$catalogo->disponible}}</option>
                        @endforeach
                    </select>

                    @error('catalogo')
                        <span class="invalid_feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror



                </div>

                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Actualizar Equipo">
                    <a href="{{ url('equipos')}}"  class="btn btn-primary"> Cancelar </a>
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
