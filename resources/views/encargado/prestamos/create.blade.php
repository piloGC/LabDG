{{-- @extends('adminlte::page')

@section('content')
<div class="container py-2">
    <h1 class="text-center mb-3">Nuevo préstamo</h1>
    <hr>
    <div class="row justify-content-center mt-3">
        <div class="col-md-12">
            <form action="{{ route('prestamos.store')}}" method="POST" enctype="multipart/form-data" novalidate>
                <!--csrf_field()}}  token de acceso unico para -->
                @csrf
                <div class="row">
                    <div class="form-group col-md-4">
                        <label for="solicitud">id solicitud</label>
                        <input type="text"  name="solicitud"
                         id="solicitud" class="form-control @error ('solicitud') is-invalid @enderror"
                         placeholder="Ingrese id solicitud" >
                        @error('solicitud')
                        <span class="invalid_feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group col-md-4">
                        <label for="fecha_retiro_equipo">Fecha retiro equipo</label>
                        <input type="date"  name="fecha_retiro_equipo"
                         id="fecha_retiro_equipo" class="form-control @error ('fecha_retiro_equipo') is-invalid @enderror">
                        @error('ffecha_retiro_equipo')
                        <span class="invalid_feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group col-md-4">
                        <label for="fecha_devolucion">Fecha devolucion</label>
                        <input type="date"  name="fecha_devolucion"
                         id="fecha_devolucion" class="form-control @error ('fecha_devolucion') is-invalid @enderror">
                        @error('fecha_devolucion')
                        <span class="invalid_feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group float-right mt-3">
                    <a href="{{ url('prestamos')}}"  class="btn btn-secondary"> Cancelar </a>
                    <input type="submit" class="btn btn-success" value="Agregar pretamo">
                </div>
            </form>
        </div>
    </div>

@endsection --}}

<form action="{{ route('prestamos.store')}}" method="POST" enctype="multipart/form-data" novalidate>
    <!--csrf_field()}}  token de acceso unico para -->
    @csrf
            <input type="text"  name="solicitud" id="solicitud" class="form-control" value="{{$solicitud->id}}" hidden >
            <input type="date"  name="fecha_retiro_equipo" id="fecha_retiro_equipo" class="form-control" value="{{$hoy->format('Y-m-d')}}" hidden>
            <input type="text"  name="disponibilidad" id="disponibilidad" class="form-control" value="{{$solicitud->existencia->disponibilidad->id}}" hidden>
            <input type="text"  name="existencia" id="existencia" class="form-control" value="{{$solicitud->existencia->codigo}}" hidden>
            <input type="text" name="estado" id="estado" class="form-control" value="1" hidden >
            @if($solicitud->fecha_inicio == $hoy->format('Y-m-d 00:00:00'))   
                <button class="btn btn-danger text-white" style="border-radius: 0" type="submit">Generar préstamo</button>
            @else
                <button class="btn btn-danger text-white" style="border-radius: 0;" type="submit" disabled>Generar préstamo</button>
             @endif
</form>