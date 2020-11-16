@extends('adminlte::page')

@section('content')
<h1 class="text-center mb-5">Información de Usuario</h1>

<div class="container mx-auto ">
    <div class="row ">
            
        <div class="form-group col-md-4">
            <label>Nombres</label>
            <input class="form-control" type="text" value= "{{$usuario->name}}" readonly>
        </div>
        <div class="form-group col-md-4">
            <label>Apellidos</label>
            <input class="form-control" type="text" value= "{{$usuario->lastname}}" readonly>
        </div>
        <div class="form-group col-md-4">
            <label>Run</label>
            <input class="form-control" type="text" value=" {{$usuario->run}}" readonly>
        </div>
        
    </div>
    <div class="row ">
        
        <div class="form-group col-md-4">
            <label>Correo</label>
            <input class="form-control" type="text" value=" {{$usuario->email}}" readonly>
        </div>
        <div class="form-group col-md-4">
            <label>Teléfono</label>
            <input class="form-control" type="text" value= "{{$usuario->phone}}" readonly>
        </div>
        
    </div>
</div>
@endsection
