@extends('layouts.app')


@section('content')

        <h1 class="text-center mb-4">Solicitud #{{$prestamo->id}}</h1>


        <div class="container mt-2">
            <p>
                <h2 class=" text-primary">Equipo:</h2>
                {{-- <a class="text-dark" href="{{route('perfiles.show',['perfil' => $receta->autor->id])}}">
                {{$receta->autor->name}} --}}
                [insertar equipo]
            </p>

            <p>
                <h2 class=" text-primary">Motivo</h2>
                <div >
                    {{-- imprime codigo html por el input --}}
                     {!! $prestamo->motivo !!}
                </div>
                
            </p>
            <p>
                <h2 class="text-primary">Asignatura:</h2>
                {{-- <a class="text-dark" href="{{route('perfiles.show',['perfil' => $receta->autor->id])}}">
                {{$receta->autor->name}} --}}
            </p>
            

             <p>
                <span class="font-weight-bold text-primary">Solicitud creada el:</span>
                
                @php
                    $fecha = $prestamo->created_at
                @endphp

                 <fecha-equipo fecha="{{$fecha}}"></fecha-equipo>
            </p> 
            <p>
                <span class="font-weight-bold text-primary">Desde:</span>
                
                @php
                    $fecha = $prestamo->fecha_inicio
                @endphp

                 <fecha-equipo fecha="{{$fecha}}"></fecha-equipo>
            </p> 
            <p>
                <span class="font-weight-bold text-primary">Hasta:</span>
                
                @php
                    $fecha = $prestamo->fecha_fin
                @endphp

                 <fecha-equipo fecha="{{$fecha}}"></fecha-equipo>
            </p> 

            
    </div>

@endsection