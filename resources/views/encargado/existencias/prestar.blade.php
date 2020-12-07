@extends('adminlte::page')

@section('content')
<h1 class="text-center mb-5">Prestar equipo</h1>

    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <form action="{{ route('existencias.prestarUpdate',['existencia' => $existencia->id]) }}" method="POST" novalidate>
                <!--csrf_field()}}  token de acceso unico para -->
                @csrf
                @method('PUT') 
                <div class="row justify-content-center">
                    <div class="form-group col-md-3">
                        <label for="equipo">Equipo</label>
                        <input id="equipo" 
                            type="text" 
                            name="equipo" 
                            class="form-control @error('equipo') is-invalid @enderror" 
                            placeholder="Ingrese Codigo de Existencia"
                            value="{{ $existencia->equipo->nombre}}" readonly>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="codigo">Codigo</label>
                        <input id="codigo" 
                            type="text" 
                            name="codigo" 
                            class="form-control @error('codigo') is-invalid @enderror" 
                            placeholder="Ingrese Codigo de Existencia"
                            value="{{ $existencia->codigo}}" readonly>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="disponibilidad">Disponibilidad</label>
                        <input type="text" name="disponibilidad" id="disponibilidad" 
                        class="form-control @error('codigo') is-invalid @enderror"
                        value="{{$existencia->disponibilidad->nombre}}" readonly>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="form-group col-md-3"></div>
                    <div class="form-group col-md-3">
                        <label for="solicitud">Solicitud</label>
                        <input id="solicitud" 
                            type="text" 
                            name="solicitud" 
                            class="form-control @error('solicitud') is-invalid @enderror" 
                            placeholder="Ingrese código de solicitud" >
                    </div>

                    <div class="form-group col-md-3">
                        <label for="fecha_retiro_equipo">Fecha retiro equipo</label>
                        <input type="date"  name="fecha_retiro_equipo" 
                         value="{{$hoy}}" id="fecha_retiro_equipo" 
                         class="form-control @error ('fecha_retiro_equipo') is-invalid @enderror" readonly>
                        @error('fecha_retiro_equipo')
                        <span class="invalid_feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
    
                    
                </div>
                <div class="form-group float-right">
                    <a href="{{ url('existencias')}}"  class="btn btn-secondary"> Cancelar </a>
                    <input type="submit" class="btn btn-success " value="Prestar equipo">
                </div>
            </form>
        </div>
    </div>
@endsection
