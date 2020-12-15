@extends('adminlte::page')
@include('encargado.notificacion')
@section('content')
<div id="app">
    <h1 class="text-center ">Préstamos</h1>
{{-- <a href="{{route('prestamos.create')}}" class="btn btn-secondary">Agregar prestamo</a> --}}
    <div class="container mx-auto bg-white">
        <div class="table-responsive">
        <table class="table table-hover">
            <thead class="bg-olive text-light ">
           <tr class="table-active">
            <th scole="col">Código</th>
            <th scole="col">Fecha retiro</th>   
            <th scole="col">Fecha devolucion</th>  
            <th scole="col">Creación préstamo</th>
            <th scole="col">Solicitud</th>
            <th scole="col">Acción</th>
            </tr> 
        </thead>
        <tbody>
            @foreach ($prestamos as $prestamo)
            <tr>
                <td>{{$prestamo->id}}</td>
                <td><fecha-index fecha="{{$prestamo->fecha_retiro_equipo}}"></fecha-index></td>
                <td>
                    @if ($prestamo->fecha_devolucion == null)
                        <span>Fecha no disponible</span>
                    @else
                    <fecha-index fecha="{{$prestamo->fecha_devolucion}}"></fecha-index>
                    @endif
                </td>
                <td><fecha-index fecha="{{$prestamo->created_at}}"></fecha-index></td>
                <td>{{$prestamo->solicitud_id}}</td>
                <td >
                    <a href="{{ route('prestamos.show', ['prestamo'=> $prestamo->id]) }}" class="btn btn-info text-white mb-2">Detalle</a>
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