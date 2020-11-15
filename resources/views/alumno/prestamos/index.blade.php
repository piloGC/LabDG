@extends('layouts.app')

@section('content')
    
<h1 class="text-center mb-5">Mis solicitudes</h1>

<div class="col-md-10 mx-auto bg-white p-3">
    <div class="table-responsive">
    <table class="table">
        <thead class="bg-primary text-light">
           <tr>
            <th scole="col">Código</th>
            <th scole="col">Equipo</th>
            <th scole="col">Asignatura</th>   
            <th scole="col">Desde</th>  
            <th scole="col">Hasta</th>
            <th scole="col">Acción</th>
            </tr> 
        </thead>
        <tbody>
            @foreach ($prestamos as $prestamo)
            <tr>
                <td>{{$prestamo->id}}</td>
                <td>[falta la relacion]</td>
                <td>{{$prestamo->asignatura->nombre}}</td>
                <td><fecha-equipo fecha="{{$prestamo->fecha_inicio}}">-</fecha-equipo></td>
                <td><fecha-equipo fecha="{{$prestamo->fecha_fin}}">-</fecha-equipo></td>

                <td >
                    <a href="{{action ('PrestamoController@show',['prestamo' => $prestamo->id])}} " class="btn btn-info text-white mr-1">Ver</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    </div></div>
</div>

<div class="col-12 mt-4 justify-content-center d-flex">
    {{$prestamos->links()}}
</div>
    
@endsection