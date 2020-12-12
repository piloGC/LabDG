@extends('layouts.app')

@section('content')
<body style="background-image: url(../images/fondo1.jpg)">
    <div class="container py-4" >
        <div >
            <h1 class="text-center">{{$existencia->equipo->marca}} {{$existencia->equipo->modelo}}</h1>
            <div class="row justify-content-end mr-5">
                <h5 class="mr-2">Número de equipo: </h5>
                
                {{$existencia->codigo}}
            </div>
             
        </div>
        <hr>
        <h4 class="mb-0 font-weight-bold">Información del Equipo:</h4>
            <br>
            <div class="row">
                <div class="form-group col-md-3">
                    <label class="font-weight-bold">Categoría</label>
                    <input class="form-control" type="text" value= "{{$existencia->equipo->categoria->nombre}}" readonly>
                </div>
                <div class="form-group col-md-3">
                    <label class="font-weight-bold">Nombre equipo</label>
                    <input class="form-control" type="text" value="{{$existencia->equipo->nombre}}" readonly>
                </div>
                <div class="form-group col-md-3">
                    <label class="font-weight-bold">Marca</label>
                    <input class="form-control" type="text" value="{{$existencia->equipo->marca}}" readonly>
                </div>
                <div class="form-group col-md-3">
                    <label class="font-weight-bold">Modelo</label>
                    <input class="form-control" type="text" value="{{$existencia->equipo->modelo}}" readonly>
                </div>
                
                
            </div>
            <br>
        <div class="row">
            <div class="form-group col-md-3">
                <label class="font-weight-bold">Imagen</label>
                <br>
                <img src="/storage/{{$existencia->equipo->imagen}}" style="width:200px; border: 1px solid; border-color:black" >
            </div>
            <div class="form-group col-md-4">
                <label class="font-weight-bold">Descripción</label>
                {{-- <input class="form-control" type="text" value="{{$existencia->equipo->descripcion}}" style="width: 745px; height: 10em" readonly> --}}
                <div>{!! $existencia->equipo->categoria->descripcion !!}</div>
            </div>
            <div class="form-group col-md-4"></div>

        </div>
        
    </div>

</body>

@endsection