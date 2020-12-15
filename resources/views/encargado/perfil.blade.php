@extends('adminlte::page')
@include('encargado.notificacion')
@section('content')
<div class="container">
<h1 class="text-center text-uppercase text-bold mb-5">Información de Usuario</h1>
<hr>
    <div class="row ">
            
        <div class="form-group col-md-4">
            <h4>Nombres</h4>
            <span class="mt-3">{{auth()->user()->name}}</span>
        </div>
        <div class="form-group col-md-4">
            <h4>Apellidos</h4>
            <span class="mt-3">{{auth()->user()->lastname}}</span>
        </div>
        
        <div class="form-group col-md-4">
            <h4>Run</h4>
            <span class="mt-3">{{auth()->user()->run}}</span>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-4">
            <h4>Correo</h4>
            <span class="mt-3">{{auth()->user()->email}}</span>
        </div>
        
        <div class="form-group col-md-4">
            <h4>Teléfono</h4>
            <span class="mt-3">{{auth()->user()->phone}}</span>
        </div>
        
    </div>
</div>
@endsection
