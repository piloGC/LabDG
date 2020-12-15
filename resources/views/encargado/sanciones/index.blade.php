@extends('adminlte::page')

@section('css')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.0/trix.css" integrity="sha512-EQF8N0EBjfC+2N2mlaH4tNWoUXqun/APQIuFmT1B+ThTttH9V1bA0Ors2/UyeQ55/7MK5ZaVviDabKbjcsnzYg==" crossorigin="anonymous" />
@endsection

@include('encargado.notificacion')
@section('content')
<div id="app">
<h1 class="text-center ">Sanciones</h1>
{{-- <a href="{{route('prestamos.create')}}" class="btn btn-secondary">Agregar prestamo</a> --}}
    <div class="container mx-auto bg-white">
        <div class="table-responsive">
        <table class="table table-hover">
            <thead class="bg-olive text-light ">
           <tr class="table-active">
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
                        <td>
                            <fecha-index fecha="{{$sancion->fecha_inicio}}"></fecha-index>
                            <br>
                            <formato-hora fecha="{{$sancion->fecha_inicio}}"></formato-hora>

                        </td>
                        <td>
                            <fecha-index fecha="{{$sancion->fecha_fin}}"></fecha-index>
                            <br>
                            <formato-hora fecha="{{$sancion->fecha_fin}}"></formato-hora>
                        </td>
                        <td>{{$sancion->estado->nombre}}</td>
                        {{-- <th>{{$sancion->fecha_fin}}</th> --}}
                        <td>
                            {{-- <a href="{{route ('sanciones.edit',['sancion' => $sancion->id]) }}" class="btn btn-success text-white mr-1">Editar</a> --}}
                            <a href="{{route ('sanciones.show',['sancion' => $sancion->id]) }}" class="btn btn-info text-white mr-1">Detalle</a>
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