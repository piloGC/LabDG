@extends('adminlte::page')

@section('content')
<div class="container">


    <h1 class="text-center mb-5"> Salas de Laboratorio DST</h1>
    <div class="col-md-10 mx-auto bg-white p-3">
        <div class="table-responsive">
        <table class="table table-light">
            <thead class="bg-primary text-blue">
            <!--thead class="thead-light"-->
                <tr>
                    <th scole="col">#</th>
                    <th scole="col">Nombre</th>
                    <th scole="col">Estado</th>
                    <th scole="col">Capacidad</th>
                    <th scole="col">Acciones</th>
                </tr>
            </thead>

            <tbody>

                @foreach($salas as $sala)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$sala->nombre}}</td>
                    <td>{{$sala->estado}}</td>
                    <td>{{$sala->capacidad}}</td>
                    <td>
                        <a href="{{ route('salas.edit', ['sala'=> $sala->id]) }}" class="btn btn-primary  mb-2">Editar</a>
                        <a href="{{ route('salas.show', ['sala'=> $sala->id]) }}" class="btn btn-success  mb-2">Ver</a>
                        <eliminar-sala sala-id={{$sala->id}}></eliminar-sala>
                                                
                    </td>
                </tr>
            @endforeach    
            </tbody>
        </table>
        </div>
        <a href="{{route('salas.create')}}"class="btn btn-primary mr-2">Agregar Sala</a>
        <a href="{{route('admin')}}"class="btn btn-primary mr-2">Volver a Inicio</a>
            <!--button type="button" class="btn btn-primary mr-2" > Agregar Equipo </!--button-->


    </div>



</div>
@endsection
