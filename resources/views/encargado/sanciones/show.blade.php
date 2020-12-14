@extends('adminlte::page')



@section('content')

{{-- <h1>{{$sancion}}</h1> --}}
     <div class="container">
        <h1 class="text-center mb-4"> Sanción n° {{ $sancion->id}} </h1>

        <div class="descripcion">
            <h2 class="my-3 text-primary">Descripción</h2>
            {!! $sancion->descripcion !!}
        </div>

        <div class="descripcion">
            <h2 class="my-3 text-primary">Categoría</h2>
            {{ $sancion->categoria->nombre }}
        </div>

        <div class="descripcion">
            <h2 class="my-3 text-primary">Fecha inicio</h2>
            <fecha-equipo fecha="{{$sancion->fecha_inicio}}">-</fecha-equipo>
        </div>

        <div class="descripcion">
            <h2 class="my-3 text-primary">Fecha fin</h2>
            <fecha-equipo fecha="{{$sancion->fecha_fin}}">-</fecha-equipo>
        </div>
        
    </div> 

@endsection