@extends('adminlte::page')


@section('content')

    <div class="container">
        <h1 class="text-center mb-4">{{$equipo->nombre}}</h1>
        <hr>
        <div class="row">
            
            <div class="form-group col-md-4">
                <label>Categoría</label>
                <input class="form-control" type="text" value= "{{$equipo->categoria->nombre}}" readonly>
            </div>
            <div class="form-group col-md-4">
                <label>Marca</label>
                <input class="form-control" type="text" value="{{$equipo->marca}}" readonly>
            </div>
            <div class="form-group col-md-4">
                <label>Modelo</label>
                <input class="form-control" type="text" value="{{$equipo->modelo}}" readonly>
            </div>
            
        </div>
        <div class="row">
            
            <div class="form-group col-md-4">
                <label>Imagen</label>
                <div class="imagen-equipo">
                    <img src="/storage/{{ $equipo->imagen }}" class="w-50">
                </div>
            </div> 
            <div class="form-group col-md-4">
                <label>Descripción</label>
                <div class="form-control" style="width: 745px; height: 10em" readonly>
                    {{-- {!! $prestamo->motivo !!} --}}
                    {!! $equipo->descripcion !!}
                </div>
            </div>
                       
        </div>
        <div class="row">
            <div class="form-group col-md-4">
                <label>Fecha creación</label>
                <input class="form-control" type="text" value="{{ \Carbon\Carbon::parse($equipo->created_at)->isoFormat('DD [de] MMMM [del] YYYY')}} " readonly>
            </div>

            <div class="form-group col-md-4">
                <label>En catálogo</label>
                <input class="form-control" type="text" value="{{ $equipo->catalogo->disponible }}" readonly>
            </div>
        </div>
        <div class="form-group">
            <a href="{{ url('equipos')}}"  class="btn btn-primary"> Volver </a>
        </div>
    </div>
    
@endsection