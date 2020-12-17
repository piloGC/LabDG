@extends('layouts.app')


@section('content')
<body style="background-image:url('../images/fondo12.png')">
<div class="container py-4" >
    <h1 class="text-center mb-3 titulos">INFORMACIÓN DE USUARIO</h1>
    <hr>
    <div class="row justify-content-center">
            
        <div class="form-group col-md-4">
            <h3 class="titulos">Nombres</h3>
            <h4 class="mt-3">{{auth()->user()->name}}</h4>
        </div>
        <div class="form-group col-md-4">
            <h3 class="titulos">Apellidos</h3>
            <h4 class="mt-3">{{auth()->user()->lastname}}</h4>
        </div>
        
    </div>
    <div class="row justify-content-center">
        <div class="form-group col-md-4">
            <h3 class="titulos">Run</h3>
            <h4 class="mt-3">{{auth()->user()->run}}</h4>
        </div>
        <div class="form-group col-md-4">
            <h3 class="titulos">Correo</h3>
            <h4 class="mt-3">{{auth()->user()->email}}</h4>
        </div>
        
    </div>
    <div class="row justify-content-center">
            
        <div class="form-group col-md-4">
            <h3 class="titulos">Teléfono</h3>
            <h4 class="mt-3">{{auth()->user()->phone}}</h4>
        </div>
        <div class="form-group col-md-4">
            <h3 class="titulos">Carrera</h3>
            <h4 class="mt-3">{{auth()->user()->carrera}}</h4>
        </div>
        
    </div>
    <div class="row justify-content-center">
            
        <div class="form-group col-md-4">
            <h3 class="titulos">Año ingreso</h3>
            <h4 class="mt-3">{{auth()->user()->anio_ingreso}}</h4>
        </div>
        <div class="form-group col-md-4">
            <h3 class="titulos">Campus</h3>
            <h4 class="mt-3" >{{auth()->user()->campus}}</h4>
        </div>
        
    </div> 

</div>
</body>
@endsection
