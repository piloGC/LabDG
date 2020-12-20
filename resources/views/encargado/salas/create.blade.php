@extends('adminlte::page')
@include('encargado.notificacion')
@section('content')
    <div class="container py-2">
        <h1 class="text-center mb-3">Registrar Nueva Sala DST</h1>
        <hr>
        <div class="row justify-content-center mt-3">
            <div class="col-md-12">
                <form action="{{ route('salas.store')}}" method="POST"  novalidate>
                    <!--csrf_field()}}  token de acceso unico para -->
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label for="codigo_interno">Codigo</label>
                            <input id="codigo_interno" 
                                type="text" 
                                name="codigo_interno" 
                                class="form-control @error('codigo_interno') is-invalid @enderror" 
                                placeholder="Ingrese Codigo Referido Interno"
                                value={{ old ('codigo_interno') }}
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
                                value={{old ('nombre')}}
                            >
                            @error('nombre')
                                <span class="invalid_feedback d-block" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label for="estado">Estado</label>
                            <label for="estado">Internet</label>
                            <select name="estado" id="estado" class="form-control @error('estado') is-invalid @enderror" >
                                <option value="0">-- Seleccione una opción --</option>
                                <option value="Disponible"  {{ old('estado') == "Disponible" ? 'selected' : '' }}>Disponible</option>
                                <option value="No disponible"  {{ old('estado') == "No disponible" ? 'selected' : '' }}>No disponible</option>
                              </select>
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
                        value={{old ('capacidad')}}
                    >
                    @error('capacidad')
                        <span class="invalid_feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label for="internet">Internet</label>
                            <select name="internet" id="internet" class="form-control @error('internet') is-invalid @enderror" >
                                <option value="0">-- Seleccione una opción --</option>
                                <option value="Si"  {{ old('internet') == "Si" ? 'selected' : '' }}>Si</option>
                                <option value="No"  {{ old('internet') == "No" ? 'selected' : '' }}>No</option>
                              </select>
                            @error('internet')
                                <span class="invalid_feedback d-block" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label for="aire_acondicionado">Aire Acondicionado</label>
                    {{-- <input id="aire_acondicionado"
                        type="text"
                        name="aire_acondicionado" 
                        class="form-control @error('aire_acondicionado') is-invalid @enderror" 
                        placeholder="Ingrese si corresponde el servicio"
                        value={{old ('aire_acondicionado')}}
                    > --}}
                    <select name="aire_acondicionado" id="aire_acondicionado" class="form-control @error('aire_acondicionado') is-invalid @enderror" >
                        <option value="0">-- Seleccione una opción --</option>
                        <option value="Si"  {{ old('aire_acondicionado') == "Si" ? 'selected' : '' }}>Si</option>
                        <option value="No"  {{ old('aire_acondicionado') == "No" ? 'selected' : '' }}>No</option>
                      </select>
                    @error('aire_acondicionado')
                        <span class="invalid_feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                        </div>
                    </div>
                    <div class="form-group float-right mt-3">
                        <a href="{{ url('salas')}}"  class="btn btn-secondary"> Cancelar </a>
                        <input type="submit" class="btn btn-success" value="Agregar Sala">
                    </div>
                </form>
            </div>
        </div>
@endsection

