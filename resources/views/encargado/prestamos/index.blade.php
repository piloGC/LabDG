@extends('adminlte::page')

@section('content')

<h1 class="text-center ">Prestamos</h1>
<a href="{{route('prestamos.create')}}" class="btn btn-secondary">Agregar prestamo</a>
    <div class="container mx-auto bg-white">
        <div class="table-responsive">
        <table class="table table-hover">
            <thead class="bg-olive text-light ">
           <tr class="table-active">
            <th scole="col">Código</th>
            <th scole="col">Fecha retiro</th>   
            <th scole="col">Fecha devolucion</th>  
            <th scole="col">Created at</th>
            <th scole="col">Acción</th>
            </tr> 
        </thead>
        <tbody>
            @foreach ($prestamos as $prestamo)
            <tr>
                <td>{{$prestamo->id}}</td>
                <td>{{$prestamo->fecha_retiro_equipo}}</td>
                <td>{{$prestamo->fecha_devolucion}}</td>
                <td>{{$prestamo->created_at}}</td>
                <td >
                    <a href="#" class="btn btn-primary text-white mb-2">Ver</a>
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