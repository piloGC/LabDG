@extends('layouts.app')

@section('content')
<body style="background-image: url({{ asset('/images/fondo1.jpg') }})">
    <div class="container py-4" >
        <div >
            <h1 class="text-center titulos">{{$existencia->equipo->marca}} {{$existencia->equipo->modelo}}</h1>
            <div class="row justify-content-end mr-5">
                <h5 class="mr-2">Número de equipo: </h5>
                <h5>{{$existencia->codigo}}</h5>
                
            </div>
             
        </div>
        <hr>
        <h3 class="mb-4 titulo-categoria">Información del Equipo:</h3>
            <br>
            <div class="row">
                <div class="form-group col-md-3">
                    <h4 class="titulos">Categoría</h4>
                    <h5 class="mt-3">{{$existencia->equipo->categoria->nombre}}</h5>
                </div>
                <div class="form-group col-md-3">
                    <h4 class="titulos">Nombre equipo</h4>
                    <h5 class="mt-3">{{$existencia->equipo->nombre}}</h5>
                </div>
                <div class="form-group col-md-3">
                    <h4 class="titulos">Marca</h4>
                    <h5 class="mt-3">{{$existencia->equipo->marca}}</h5>
                </div>
                <div class="form-group col-md-3">
                    <h4 class="titulos">Modelo</h4>
                    <h5 class="mt-3">{{$existencia->equipo->modelo}}</h5>
                </div>
                
                
            </div>
            <br>
        <div class="row">
            <div class="form-group col-md-3">
                <h4 class="titulos">Imagen referencial</h4>
                <br>
                <img src="../storage/{{$existencia->equipo->imagen}}" style="width:200px; border: 1px solid; border-color:black" alt="imagen no diponible">
            </div>
            <div class="form-group col-md-8">
                <h4 class="titulos">Descripción</h4>
                <div><h5>{!! $existencia->equipo->descripcion !!}</h5></div>
            </div>
            {{-- <div class="form-group col-md-4"></div> --}}

        </div>
        
    </div>

</body>

@endsection