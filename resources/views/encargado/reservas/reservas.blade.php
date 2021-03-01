@extends('adminlte::page')
@include('encargado.notificacion')
@section('content')
<div id="app">
    <h1 class="text-center ">Reservas de hoy</h1>
    <br>
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
            @endforeach    
            </tbody>
        </table>
        </div>
    </div>
     <div class="col-12 mt-4 justify-content-center d-flex">
        {{$reservas->links()}}
    </div> 
</div>

@endsection