@extends('layouts.app')
@section('content')

    <h1 class="text-center mb-5">Editar Sala {{$sala->nombre}}</h1>

    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <form action="{{ route('salas.update',['sala' => $sala->id])}}" method="POST" novalidate>
                <!--csrf_field()}}  token de acceso unico para -->
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="codigo_interno">Codigo</label>
                    <input id="codigo_interno" 
                        type="text" 
                        name="codigo_interno" 
                        class="form-control @error('codigo_interno') is-invalid @enderror" 
                        placeholder="Ingrese Codigo Referido Interno"
                        value="{{ $sala->codigo_interno}}"
                    >
                    @error('codigo_interno')
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
                        placeholder="Ingrese Nombre"
                        value="{{ $sala->nombre}}"
                    >
                    @error('nombre')
                        <span class="invalid_feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="estado">Estado</label>
                    <input id="estado"
                        type="text"
                        name="estado" 
                        class="form-control @error('estado') is-invalid @enderror" 
                        placeholder="Ingrese el Estado correspondiente"
                        value="{{ $sala->estado}}"
                    >
                    @error('estado')
                        <span class="invalid_feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="capacidad">Capacidad</label>
                    <input id="capacidad"
                        type="text"
                        name="capacidad" 
                        class="form-control @error('capacidad') is-invalid @enderror" 
                        placeholder="Ingrese capacidad de alumnos"
                        value="{{ $sala->capacidad}}"
                    >
                    @error('capacidad')
                        <span class="invalid_feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="internett">Internet</label>
                    <input id="internett"
                        type="text"
                        name="internett" 
                        class="form-control @error('internett') is-invalid @enderror" 
                        placeholder="Ingrese si corresponde el servicio"
                        value="{{ $sala->internett}}"
                    >
                    @error('internett')
                        <span class="invalid_feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="aire_acondicionado">Aire Acondicionado</label>
                    <input id="aire_acondicionado"
                        type="text"
                        name="aire_acondicionado" 
                        class="form-control @error('aire_acondicionado') is-invalid @enderror" 
                        placeholder="Ingrese si corresponde el servicio"
                        value="{{ $sala->aire_acondicionado}}"
                    >
                    @error('aire_acondicionado')
                        <span class="invalid_feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                </div>




                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Actualizar Sala">
                    <a href="{{ url('salas')}}"  class="btn btn-primary"> Cancelar </a>
                </div>
            </form>
        </div>
    </div>

@endsection

