@extends('adminlte::page')
@include('encargado.notificacion')
@section('content')
<div id="app">
    <h1 class="text-center ">Control de Reservas</h1>
    <a href="{{route('reservas.create')}}" class="btn btn-secondary">Agregar reserva</a>
    <div class="container mx-auto bg-white">
        <div class="table-responsive">
        <table class="table table-hover">
            <thead class="bg-olive text-light ">
                <tr class="table-active">
                    <th scole="col">#</th>
                    <th scole="col">Nombre evento</th>
                    <th scole="col">Encargado evento</th>
                    <th scole="col">Fecha y Hora</th>
                    <th scole="col">Estado</th>
                    <th scole="col">Acciones</th>
                </tr>
            </thead>

            <tbody>

                @foreach($reservas as $reserva)
                <tr>
                    <td>{{$reserva->id}}</td>
                    <td>{{$reserva->nombre_evento}}</td>
                    <td>{{$reserva->encargado_evento}}</td>
                    <td>
                        <fecha-index fecha="{{$reserva->fecha_evento}}"></fecha-index>
                            <br>
                        <formato-hora fecha="{{$reserva->fecha_evento}}"></formato-hora>
                    </td>
                    <td> @if ($reserva->estado->id == 1)
                        <h5> <span class="badge badge-pill badge-info">{{$reserva->estado->nombre}}</span> </h5>
                         @endif
                         @if ($reserva->estado->id == 2)
                        <h5><span class="badge badge-pill badge-success">{{$reserva->estado->nombre}}</span></h5>
                         @endif
                         @if ($reserva->estado->id == 3)
                        <h5><span class="badge badge-pill badge-secondary">{{$reserva->estado->nombre}}</span></h5>
                         @endif
                         @if ($reserva->estado->id == 4)
                         <h5><span class="badge badge-pill badge-secondary">{{$reserva->estado->nombre}}</span></h5>
                          @endif</td>
                    <td>
                        <div class="btn-group mr-1" role="group" >
                            <a href="{{ route('reservas.edit', ['reserva'=> $reserva->id]) }}" class="btn btn-success  mb-2">Editar</a>
                            <a href="{{ route('form.fecha', ['reserva'=> $reserva->id]) }}" class="btn btn-secondary  mb-2">Cambiar fecha</a>
                              {{-- <eliminar-equipo reserva-id={{$reserva->id}} ruta-equipo="{{route('reserva.destroy')}}"></eliminar-equipo> --}}
                          </div> 
                                                
                    </td>
                </tr>
            @endforeach    
            </tbody>
        </table>
        </div>
            
            <!--button type="button" class="btn btn-primary mr-2" > Agregar Equipo </!--button-->
            {{-- <a href="{{route('admin')}}" class="btn btn-primary mr-2">Volver a Inicio</a> --}}

    </div>
     <div class="col-12 mt-4 justify-content-center d-flex">
        {{$reservas->links()}}
    </div> 
</div>
@endsection