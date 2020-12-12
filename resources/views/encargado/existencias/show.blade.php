@extends('adminlte::page')

@section('content')
<div class="container py-2">
    <h1 class="text-center mb-3">Ítem {{$existencia->codigo}}</h1>
    <hr>
    <div class="row justify-content-center mt-3">
        <div class="col-md-12">
                <div class="row">
                    <div class="form-group col-md-4">
                        <label for="codigo">Codigo</label>
                        <input id="codigo" 
                            type="text" 
                            name="codigo" 
                            class="form-control @error('codigo') is-invalid @enderror" 
                            placeholder="Ingrese Codigo de Existencia"
                            value="{{ $existencia->codigo}}" readonly
                        >
                    </div>
                    <div class="form-group col-md-4">
                        <label for="fecha_adquisicion">Fecha Adquisicion</label>
                        <input type="date"  name="fecha_adquisicion" value="{{$fecha->format('Y-m-d')}}"
                         id="fecha_adquisicion" class="form-control" readonly>
                    </div>
    
                    <div class="form-group col-md-4">
                        <label for="estado">Estado</label>
                        <input
                            name="estado" 
                            class="form-control " 
                            id="estado"  value="{{$existencia->estado->nombre}}" readonly >
                    </div>
                </div>
               
                <div class="row">
                    <div class="form-group col-md-4">
                        <label for="disponibilidad">Disponibilidad</label>
                        <input
                            name="disponibilidad" 
                            class="form-control" 
                            id="disponibilidad"   value="{{$existencia->disponibilidad->nombre}}" readonly>
                    </div>
    
                    <div class="form-group col-md-4">
                        <label for="equipo">Equipo</label>
                        <input
                            name="equipo" 
                            class="form-control " 
                            id="equipo"  value="{{$existencia->equipo->nombre}}" readonly  >
                    </div>
                </div>
                
        </div>
        
    </div>
    <div class="form-group float-right">
        <a href="{{ url('existencias/items')}}"  class="btn btn-secondary"> Volver </a>
    </div>
</div>
@endsection
