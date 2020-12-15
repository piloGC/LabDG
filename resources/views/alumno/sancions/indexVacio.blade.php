@extends('layouts.app')

@section('content')
<body style="background-image:url('../images/fondo10.png') ">
<div class="container py-4">
<h1 class="text-center mb-3 titulos">Sancion</h1>

<hr>
<div class="row justify-content-center mt-4">
    <div class="container mx-auto bg-white">
    <div class="table-responsive">
    <table class="table table-hover">
        <thead class="bg-success text-light">
           <tr class="table-active">

            <th scole="col">ID Solicitud</th>
            <th scole="col">Descripcion</th>
            <th scole="col">Desde</th>
            <th scole="col">Hasta</th>
            <th scole="col">Estado</th>
            <th scole="col">Acciones</th>
            </tr> 
        </thead>
            <tbody>

            </tbody>
        </table>
    </div>
    </div>


</div>

@endsection