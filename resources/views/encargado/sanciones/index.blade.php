@extends('adminlte::page')

@section('css')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.0/trix.css" integrity="sha512-EQF8N0EBjfC+2N2mlaH4tNWoUXqun/APQIuFmT1B+ThTttH9V1bA0Ors2/UyeQ55/7MK5ZaVviDabKbjcsnzYg==" crossorigin="anonymous" />
@endsection


@section('content')
  
<div class="container">
    <h1 class="text-center mb-5">Sanciones</h1>
    <div class="col-md-10 mx-auto bg-white p-3">
        <div class="table-responsive">
        <table class="table table-hover table-light">
            <thead class="bg-primary text-white">
                <tr>
                    <th scole="col">#</th>
                    <th scole="col">Prestamo ID</th>
                    <th scole="col">Descripción</th>
                    <th scole="col">Desde</th>
                    <th scole="col">Hasta</th>
                    <th scole="col">Estado</th>
                    <th scole="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sanciones as $sancion)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>
                        {{$id = $sancion->prestamo_id}}</td>
                        <td>{!! $sancion->descripcion !!}</td>
                        <td>{{$sancion->fecha_inicio}}</td>
                        <td>{{$sancion->fecha_fin}}</td>
                        <td>{{$sancion->estado->nombre}}</td>
                        {{-- <th>{{$sancion->fecha_fin}}</th> --}}
                        <td>
                            {{-- <a href="{{route ('sanciones.edit',['sancion' => $sancion->id]) }}" class="btn btn-success text-white mr-1">Editar</a> --}}
                            <a href="{{route ('sanciones.show',['sancion' => $sancion->id]) }}" class="btn btn-info text-white mr-1">Ver Detalle</a>
                            {{-- <eliminar-sancion sancion-id={{$sancion->id}}></eliminar-sancion> --}}

                        </td>
                    </tr>                    
                @endforeach
            </tbody>
        </table>
    </div>
    </div>


</div>

@endsection