@extends('layouts.app')

@section('content')
<body style="background-image:url('../images/fondo9.png')">
<div class="container py-4" >
    <h1 class="text-center mb-3">Información de Usuario</h1>
    <hr>
        {{-- <div class="row ">
            <div class="col">
                <h1 class="text-center">Nombres</h1>
            </div>
            <div class=" col">
                <h3 class="text-center font-weight-bold mt-2">-></h3>
            </div>
            <div class="col mt-2">
                <h3 class="text-center">{{$usuario->name}}</h3>
            </div>
            <div class=" col"></div>
            <div class=" col"></div>
        </div> --}}
     <div class="row justify-content-center">
            
        <div class="form-group col-md-4">
            <label>Nombres</label>
            <input class="form-control" type="text" value= "{{$usuario->name}}" readonly>
        </div>
        <div class="form-group col-md-4">
            <label>Apellidos</label>
            <input class="form-control" type="text" value= "{{$usuario->lastname}}" readonly>
        </div>
        
    </div>
    <div class="row justify-content-center">
        <div class="form-group col-md-4">
            <label>Run</label>
            <input class="form-control" type="text" value=" {{$usuario->run}}" readonly>
        </div>
        <div class="form-group col-md-4">
            <label>Correo</label>
            <input class="form-control" type="text" value=" {{$usuario->email}}" readonly>
        </div>
        
    </div>
    <div class="row justify-content-center">
            
        <div class="form-group col-md-4">
            <label>Teléfono</label>
            <input class="form-control" type="text" value= "{{$usuario->phone}}" readonly>
        </div>
        <div class="form-group col-md-4">
            <label>Carrera</label>
            <input class="form-control" type="text" value=" {{$usuario->carrera}}" readonly>
        </div>
        
    </div>
    <div class="row justify-content-center">
            
        <div class="form-group col-md-4">
            <label>Año ingreso</label>
            <input class="form-control" type="text" value= "{{$usuario->anio_ingreso}}" readonly>
        </div>
        <div class="form-group col-md-4">
            <label>Campus</label>
            <input class="form-control" type="text" value=" {{$usuario->campus}}" readonly>
        </div>
        
    </div> 

</div>
</body>
@endsection
