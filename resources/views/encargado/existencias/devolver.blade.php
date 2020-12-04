@extends('adminlte::page')

@section('content')
<h1 class="text-center mb-5">Devolver equipo</h1>

    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <form action="#" method="POST" enctype="multipart/form-data" novalidate>
                <!--csrf_field()}}  token de acceso unico para -->
                {{-- @csrf
                @method('PUT') --}}

                <div class="row justify-content-center">
                    <div class="form-group col-md-3">
                        <label for="equipo">Equipo</label>
                        <input id="equipo" 
                            type="text" 
                            name="equipo" 
                            class="form-control @error('equipo') is-invalid @enderror" 
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
                        <select
                            name="disponibilidad" 
                            class="form-control @error('disponibilidad') is-invalid @enderror" 
                            id="disponibilidad"            
                        >
                            <option value="">-- Seleccione una Opcion --</option>
                            @foreach($disponibilidads as $disponibilidad)
                                <option value="{{ $disponibilidad->id }}"  
                                {{ $existencia->disponibilidad_id  == $disponibilidad->id ? 'selected' : '' }}
                                >{{$disponibilidad->nombre}}</option>
                            @endforeach
                        </select>
    
                        @error('disponibilidad')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                        @enderror
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
                            placeholder="Ingrese código de solicitud" readonly>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="fecha_devolucion">Fecha devolución</label>
                        <input type="date"  name="fecha_devolucion" 
                        {{-- value="{{$fecha->format('Y-m-d')}}" --}}
                         id="fecha_devolucion" class="form-control @error ('fecha_devolucion') is-invalid @enderror">
                        @error('fecha_devolucion')
                        <span class="invalid_feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
    
                    
                </div>
                <div class="form-group float-right">
                    <a href="{{ url('existencias')}}"  class="btn btn-secondary"> Cancelar </a>
                    <a href="#" type="submit" class="btn btn-success " >Devolver equipo</a>
                </div>
            </form>
        </div>
    </div>
@endsection

