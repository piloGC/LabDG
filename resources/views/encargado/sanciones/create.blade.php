@extends('adminlte::page')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.0/trix.css"
        integrity="sha512-EQF8N0EBjfC+2N2mlaH4tNWoUXqun/APQIuFmT1B+ThTttH9V1bA0Ors2/UyeQ55/7MK5ZaVviDabKbjcsnzYg=="
        crossorigin="anonymous" />
@endsection
@section('css')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.0/trix.css" integrity="sha512-EQF8N0EBjfC+2N2mlaH4tNWoUXqun/APQIuFmT1B+ThTttH9V1bA0Ors2/UyeQ55/7MK5ZaVviDabKbjcsnzYg==" crossorigin="anonymous" />
@endsection
@include('encargado.notificacion')
@section('content')
    <h3 class="text-center mb-5">Información Sancion</h3>
    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <form method="POST" action="{{ route('sanciones.store') }}"  novalidate>
                @csrf


                <div class="row justify-content-center"> 
                    <div class="form-group col-md-2">
                        <label for="solicitud">Solicitud ID:</label>
                        <input type="text"  
                        name="solicitud" 
                        id="solicitud" 
                        class="form-control @error ('solicitud') is-invalid @enderror"
                        placeholder="Ingrese id solicitud" 
                        value="{{ $prestamo->solicitud_id}}" readonly>
                    </div>

                    <div class="form-group col-md-2">
                        <label for="prestamo">Prestamo ID:</label>
                        <input type="text"  
                        name="prestamo" 
                        id="prestamo" 
                        class="form-control @error ('prestamo') is-invalid @enderror"
                        placeholder="Ingrese id prestamo" 
                        value="{{ $prestamo->id}}" readonly>
                    </div>
                    <div class="form-group col-md-4">
                            <label for="usuario"> Estudiante:</label>
                            <input type="text"  name="usuario" id="usuario" 
                            class="form-control @error ('usuario') is-invalid @enderror"
                            placeholder="Ingrese id usuario" 
                            value="{{ $prestamo->nombre }} {{ $prestamo->apellido }}" readonly>

                    </div>
                    <div class="form-group col-md-4">
                        <label for="rut"> Rut:</label>
                        <input type="text"  name="rut" id="rut" 
                        class="form-control @error ('rut') is-invalid @enderror"
                        placeholder="Ingrese id rut" 
                        value="{{ $prestamo->rut }} " readonly>

                    </div>
                </div>
                <div class="row justify-content-center"> 
                    <div class="form-group col-md-4">
                        <label for="categoria">Categoria</label>
                        <select
                            name="categoria" id="categoria"
                            class="form-control @error('categoria') is-invalid @enderror">
                            <option value="">-- Seleccione una Opcion --</option>
                            
                            @foreach($categorias as $categoria)
                                <option 
                                value="{{ $categoria->id }}" {{ old('categoria') == $categoria->id ? 'selected' : '' }} 
                                >{{$categoria->nombre}}</option>
                            @endforeach
                        </select>

                        @error('categoria')
                            <span class="invalid_feedback d-block" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                        @enderror
                    </div>



                    <div class="form-group col-md-4">
                        <label for="fecha_inicio_sancion">Desde:</label>
                        <input type="date"  name="fecha_inicio_sancion" value="{{$hoySancion->format('Y-m-d')}}"
                         id="fecha_inicio_sancion" min="{{$hoySancion->format('Y-m-d')}}"
                         class="form-control @error ('fecha_inicio_sancion') is-invalid @enderror">
                        @error('fecha_inicio_sancion')
                        <span class="invalid_feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group col-md-4">
                        <label for="fecha_fin_sancion">Hasta:</label>
                        <input type="date"  value="{{old('fecha_fin')}}"
                        name="fecha_fin_sancion" id="fecha_fin_sancion"  min="{{$hoySancion->format('Y-m-d')}}"
                        class="form-control @error ('fecha_fin_sancion') is-invalid @enderror">
                        @error('fecha_fin_sancion')
                        <span class="invalid_feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="row justify-content-center"> 
                    <div class="form-group col-md">
                        <label for="descripcion">Descripcion</label>
                        <input type="hidden" name="descripcion" id="descripcion" value="{{old('descripcion')}}" >
                        <trix-editor class="form-control @error('descripcion') is-invalid @enderror"
                        placeholder="Breve descripción del motivo de la solicitud" input="descripcion"></trix-editor>
                        @error('descripcion')
                            <span class="invalid_feedback d-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                
                <div class="form-group float-right">
                    <input type="submit"  class="btn btn-success" value="Agregar sancion">
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