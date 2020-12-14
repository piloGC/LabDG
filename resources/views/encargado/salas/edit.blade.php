@extends('adminlte::page')
@include('encargado.notificacion')
@section('content')
<div class="container py-2">
    <h1 class="text-center mb-3">Editar {{$sala->nombre}}</h1>
<hr>
    <div class="row justify-content-center mt-3">
        <div class="col-md-12">
            <form action="{{ route('salas.update',['sala' => $sala->id])}}" method="POST" novalidate>
                <!--csrf_field()}}  token de acceso unico para -->
                @csrf
                @method('PUT')
<div class="row">
    <div class="form-group col-md-4">
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

    <div class="form-group col-md-4">
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

    <div class="form-group col-md-4">
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
</div>
                
<div class="row">
    <div class="form-group col-md-4">
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

    <div class="form-group col-md-4">
        <label for="internet">Internet</label>
        <input id="internet"
            type="text"
            name="internet" 
            class="form-control @error('internet') is-invalid @enderror" 
            placeholder="Ingrese si corresponde el servicio"
            value="{{ $sala->internet}}"
        >
        @error('internet')
            <span class="invalid_feedback d-block" role="alert">
                <strong>{{$message}}</strong>
            </span>
        @enderror
    </div>

    <div class="form-group col-md-4">
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
</div>
               

                <div class="form-group  float-right mt-3">
                    
                    <a href="{{ url('salas')}}"  class="btn btn-secondary"> Cancelar </a>
                    <input type="submit" class="btn btn-success" value="Actualizar Sala">
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

