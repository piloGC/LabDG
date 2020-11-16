@extends('layouts.app')

@section('content')

        <h1 class="text-center mb-4">Solicitud #{{$solicitud->id}}</h1>


        <div class="container mt-2">
            <p>
                <h4 class=" text-primary">Equipo:</h4>
                {{-- <a class="text-dark" href="{{route('perfiles.show',['perfil' => $receta->autor->id])}}">
                {{$receta->autor->name}} --}}
                <span class="font-weight-bold text-primary">Nombre: </span>{{$solicitud->existencia->equipo->nombre}}
                <br>
                <span class="font-weight-bold text-primary">Modelo: </span>{{$solicitud->existencia->equipo->modelo}}
                <br>
                <span class="font-weight-bold text-primary">Número de equipo:</span>
                {{-- <a class="text-dark" href="{{route('perfiles.show',['perfil' => $receta->autor->id])}}">
                {{$receta->autor->name}} --}}
                {{$solicitud->existencia->codigo}}
            </p>

            <p>
                <h4 class=" text-primary">Motivo</h4>
                <div >
                    {{-- imprime codigo html por el input --}}
                     {!! $solicitud->motivo !!}
                </div>
                
            </p>
            <p>
                <h4 class=" text-primary">Asignatura:</h4> {{$solicitud->asignatura->nombre}}
                
            </p>
            

             <p>
                <h4 class=" text-primary">Solicitud creada el:</h4>
                
                @php
                    $fecha = $solicitud->created_at
                @endphp

                 <fecha-equipo fecha="{{$fecha}}"></fecha-equipo>
            </p> 
            <p>
                <h4 class=" text-primary">Desde:</h4>
                
                @php
                    $fecha = $solicitud->fecha_inicio
                @endphp

                 <fecha-equipo fecha="{{$fecha}}"></fecha-equipo>
            </p> 
            <p>
                <h4 class="text-primary">Hasta:</h4>
                
                @php
                    $fecha = $solicitud->fecha_fin
                @endphp

                 <fecha-equipo fecha="{{$fecha}}"></fecha-equipo>
            </p> 

            
    </div>

@endsection