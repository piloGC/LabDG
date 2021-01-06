@extends('adminlte::page')

@include('encargado.notificacion')
@section('content')

    <div class="container">
        <h1 class="text-center text-uppercase text-bold">{{$equipo->marca}} {{$equipo->modelo}}</h1>
        <div class="row justify-content-end mr-5">
            <h5 class="">En catálogo: 
               @if ($equipo->catalogo->id == 1)
                   <span class="badge badge-pill badge-success">{{$equipo->catalogo->disponible}}</span> 
               @endif
               @if ($equipo->catalogo->id == 2)
                   <span class="badge badge-pill badge-danger">{{$equipo->catalogo->disponible}}</span>
               @endif
           </h5> 
           
       </div>
         
    
    <hr>
    <h3 class="text-bold text-uppercase">Información del Equipo:</h3>
        <br>
        <div class="row">
            <div class="form-group col-md-3">
                <h4 >Categoría</h4>
                <span class="mt-3">{{$equipo->categoria->nombre}}</span>
            </div>
            <div class="form-group col-md-3">
                <h4 >Nombre equipo</h4>
                <span class="mt-3">{{$equipo->nombre}}</span>
            </div>
            <div class="form-group col-md-3">
                <h4 >Marca</h4>
                <span class="mt-3">{{$equipo->marca}}</span>
            </div>
            <div class="form-group col-md-3">
                <h4 >Modelo</h4>
                <span class="mt-3">{{$equipo->modelo}}</span>
            </div>
            
            
        </div>
        <br>
    <div class="row">
        <div class="form-group col-md-3">
            <h4 >Imagen referencial</h4>
            <br>
            <img src="../storage/{{$equipo->imagen}}" style="width:200px; border: 1px solid; border-color:black" >
        </div>
        <div class="form-group col-md-8">
            <h4 >Descripción</h4>
            <div><span>{!! $equipo->descripcion !!}</span></div>
        </div>
        {{-- <div class="form-group col-md-4"></div> --}}

    </div>
</div>
@endsection