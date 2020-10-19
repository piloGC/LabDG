@extends('layouts.app')

@section('content')
  
<div class="container">

    <a href="{{route('sanciones.create')}}" class="btn btn-success mt-5">Agregar sanción</a>

    <h1 class="text-center mb-5">Sanciones</h1>
    <div class="col-md-10 mx-auto bg-white p-3">
        <div class="table-responsive">
        <table class="table table-light">
            <thead class="bg-primary text-white">
                <tr>
                    <th scole="col">#</th>
                    <th scole="col">Categoria</th>
                    <th scole="col">Descripción</th>
                    <th scole="col">Fecha inicio</th>
                    <th scole="col">Fecha fin</th>
                    <th scole="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sanciones as $sancion)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$sancion->categoria->nombre}}</td>
                        <td>{!! $sancion->descripcion !!}</td>
                        <td><fecha-equipo fecha="{{$sancion->fecha_inicio}}">-</fecha-equipo></td>
                        <td><fecha-equipo fecha="{{$sancion->fecha_fin}}">-</fecha-equipo></td>
                        {{-- <th>{{$sancion->fecha_fin}}</th> --}}
                        <td>
                            <a href="{{route ('sanciones.edit',['sancion' => $sancion->id]) }}" class="btn btn-success text-white mr-1">Editar</a>
                            <a href="{{route ('sanciones.show',['sancion' => $sancion->id]) }}" class="btn btn-info text-white mr-1">Ver</a>
                            <eliminar-sancion sancion-id={{$sancion->id}}></eliminar-sancion>

                        </td>
                    </tr>                    
                @endforeach
            </tbody>
        </table>
    </div>
    </div>


</div>

@endsection