@extends('adminlte::page')
@include('encargado.notificacion')
@section('content')
<div id="app">
    <h1 class="text-center ">Control de Reservas</h1>
    <a href="{{route('reservas.create')}}" class="btn btn-secondary">Agregar reserva</a>
    <div class="row justify-content-end mr-5">
        <form action="{{route('reservas.buscar')}}">
            <div class="input-group mb-3">
                <input type="search" name="reserva" class="form-control" placeholder="Nombre de reserva" aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <button class="btn btn-outline-info" type="submit"><i class="fas fa-search"></i></button>
                </div>
            </div>
        </form> 
       
    </div>
    <div class="container mx-auto bg-white">
        <div class="table-responsive">
        <table class="table table-hover">
            <thead class="bg-olive text-light ">
                <tr class="table-active">
                    <th scole="col">Nombre reserva</th>
                    <th scole="col">Encargado reserva</th>
                    <th scole="col">Dia reserva</th>
                    <th scole="col">Hora inicio</th>
                    <th scole="col">Hora fin</th>
                    <th scole="col">Público</th>
                    <th scole="col">Sala</th>
                    <th scole="col">Estado</th>
                    <th scole="col">Acciones</th>
                </tr>
            </thead>

            <tbody>

                @foreach($reservas as $reserva)
                <tr>
                    <td>{{$reserva->nombre_reserva}}</td>
                    <td>{{$reserva->encargado_reserva}}</td>
                    <td><fecha-index fecha="{{$reserva->dia_reserva}}"></fecha-index></td>
                    <td>{{$reserva->hora_inicio}}</td>
                    <td>{{$reserva->hora_fin}}</td>
                    <td>{{$reserva->tipo_publico}}</td>
                    <td>{{$reserva->sala->nombre}}</td>
                    <td> @if ($reserva->estado->id == 1)
                        <h5> <span class="badge badge-pill badge-info">{{$reserva->estado->nombre}}</span> </h5>
                         @endif
                         @if ($reserva->estado->id == 2)
                        <h5><span class="badge badge-pill badge-secondary">{{$reserva->estado->nombre}}</span></h5>
                         @endif
                         @if ($reserva->estado->id == 3)
                         <h5><span class="badge badge-pill badge-secondary">{{$reserva->estado->nombre}}</span></h5>
                          @endif</td>
                    <td>
                        <div class="btn-group mr-1" role="group" >
                            <a href="{{ route('reservas.edit', ['reserva'=> $reserva->id]) }}" class="btn btn-success  mb-2">Editar</a>
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