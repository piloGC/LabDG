@extends('adminlte::page')

@section('content')
<div id="app">
    <h1 class="text-center ">Salas de Laboratorio DST</h1>
    <a href="{{route('salas.create')}}"class="btn btn-secondary">Agregar Sala</a>
    <div class="container mx-auto bg-white">
        <div class="table-responsive">
        <table class="table table-hover">
            <thead class="bg-olive text-light ">
                <tr class="table-active">
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
                        <div class="btn-group mr-1" role="group">
                            <a href="{{ route('salas.show', ['sala'=> $sala->id]) }}" class="btn btn-info  mb-2">Ver</a>
                            <a href="{{ route('salas.edit', ['sala'=> $sala->id]) }}" class="btn btn-success  mb-2">Editar</a>
                            <eliminar-sala sala-id={{$sala->id}}></eliminar-sala>
                        </div>                       
                    </td>
                </tr>
            @endforeach    
            </tbody>
        </table>
        </div>
        
        {{-- <a href="{{route('admin')}}"class="btn btn-primary mr-2">Volver a Inicio</a> --}}
            <!--button type="button" class="btn btn-primary mr-2" > Agregar Equipo </!--button-->


    </div>
</div>
@endsection

@section('js')
 <script src="{{ asset('js/app.js')}}" ></script> 
 
@endsection