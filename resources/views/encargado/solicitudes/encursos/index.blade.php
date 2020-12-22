@extends('adminlte::page')
@include('encargado.notificacion')
@section('content')
    <div id="app">
<h1 class="text-center mb-5">Solicitudes de préstamo En Curso</h1>
<div class="row justify-content-end mr-5">
    <form action="{{route('encursos.buscar')}}">
        <div class="input-group mb-3">
            <input type="search" name="solicitud" class="form-control" placeholder="Número de solicitud" aria-describedby="basic-addon2">
            <div class="input-group-append">
                <button class="btn btn-outline-info" type="submit"><i class="fas fa-search"></i></button>
            </div>
        </div>
    </form> 
   
</div>
<div class="container mx-auto bg-white">
    <div class="table-responsive">
    <table class="table table-hover ">
        <thead class="bg-info text-light ">
           <tr class="table-active">
            <th scole="col" >#</th>
            <th scole="col">Solicitado por</th> 
            <th scole="col">Equipo</th>
            <th scole="col">Desde</th>  
            <th scole="col">Hasta</th>
            <th scole="col">Acción</th>
            </tr> 
        </thead>
        <tbody>
            @foreach ($solicitudes as $solicitud)
            <tr >
                <td >{{$solicitud->id}}</td>
                <td>{{$solicitud->usuario->name}}{{$solicitud->usuario->lastname}}</td>
                <td>{{$solicitud->existencia->equipo->nombre}}</td>
                <td><fecha-index fecha="{{$solicitud->fecha_inicio}}"></fecha-index></td>
                <td><fecha-index fecha="{{$solicitud->fecha_fin}}"></fecha-index></td>
                 <td >
                     <div class="btn-group mr-1" role="group">
                        <a href="{{action ('ListarSolicitudController@show',['listarSolicitud' => $solicitud->id])}} " class="btn btn-info text-white" >Detalle</a>
                        
                        <a href="{{action ('PrestamoController@devolver',['prestamo' => $solicitud->id])}} " class="btn btn-success text-white">Devolver</a> 
                        
                        <a href="{{action ('SancionController@create',['prestamo' => $solicitud->id])}} " class="btn btn-danger text-white ">Liberar y Sancionar </a> 

                         {{-- <a href="#">
                            @include('encargado.prestamos.devolver')
                       </a> --}}
                      </div> 
                </td> 
            </tr>
            @endforeach
        </tbody>
    </table>
    </div>
</div>

<div class="col-12 mt-4 justify-content-center d-flex">
    {{$solicitudes->links()}}
</div>

</div>
@endsection

