@extends('layouts.app')

@section('content')
<body style="background-image:url({{ asset('../images/fondo10.png') }}) ">
    <div class="container py-4">
        <h1 class="text-center mb-3 titulos">reservas de salas</h1>
        <hr>

        @if (count($reservas) > 0)
        <h2 class="titulo-categoria text-uppercase mb-4">Actividades extracurriculares</h2>
        <div class="row">
            @foreach ($reservas as $reserva)
            <div class="col-md-3 mb-3">
                <div class="card shadow">
                    <div class="card-body">
                        <div>
                            <h2 class="titulos text-center">{{$reserva->nombre_reserva}}</h2>
                        </div>
                        <hr class="mt-2 mb-3">
                        
                        <div>
                             @if ((Carbon\Carbon::parse($reserva->dia_reserva)->format('Y-m-d')) == $hoy)
                             <h4 class="text-primary font-weight-bold text-center">HOY</h4>
                            @endif
                            @if((Carbon\Carbon::parse($reserva->dia_reserva)->format('Y-m-d')) > $hoy)
                            <span class="text-primary font-weight-bold">Día: </span>
                            <fecha-index fecha="{{$reserva->dia_reserva}}"></fecha-index>
                            @endif 
                            
                        </div>
                        <div>
                            <span class="text-primary font-weight-bold">Desde: </span>
                            {{$reserva->hora_inicio}} hrs.
                        </div>
                        <div>
                            <span class="text-primary font-weight-bold">Hasta: </span>
                            {{$reserva->hora_fin}} hrs.
                        </div>
                        
                        <div>
                            <span class="text-primary font-weight-bold">Encargado: </span>
                            {{$reserva->encargado_reserva}}

                        </div>
                        <div>
                            <span class="text-primary font-weight-bold">Lugar: </span>
                            {{$reserva->sala->nombre}}
                        </div>
                        <hr class="mt-2 mb-3">
                        <div>
                            <h6 class="text-primary text-uppercase text-center font-weight-bold">
                                {{$reserva->tipo_publico}}
                            </h6>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
        @else
        <h3 class="text-center titulos">No hay actividades externas...</h3>
        @endif
           
    </div>
</body>

@endsection