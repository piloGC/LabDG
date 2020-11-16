@extends('layouts.app')

@section('content')

<div class="container py-4">
    <h1 class="text-center mb-3">Información de Usuario</h1>
    <hr>
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
@endsection
