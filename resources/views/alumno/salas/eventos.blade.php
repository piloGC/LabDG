@extends('layouts.app')

@section('content')
<body style="background-image:url({{ asset('/images/fondo10.png') }}) ">
    <div class="container py-4">
        <h1 class="text-center mb-3 titulos">próximos eventos</h1>
        <hr>
        @if (count($eventos) > 0)
        @foreach ($eventos as $key => $grupo)
        <div class="container">
            <h2 class="titulo-categoria text-uppercase mb-4">
                  {{str_replace('-',' ',$key)}} 
            </h2>
            <div class="row">
                @foreach ($grupo as $eventos)

                    @foreach ($eventos as $evento)
                        <div class="col-md-3 mb-3">
                            <div class="card shadow">
                                {{-- <img class="card-img-top imagen-catalogo" src="/storage/{{$existencia->equipo->imagen}}" alt="imagen categoria" > --}}
                                
                                <div class="card-body">
                                    <div>
                                        <h3 class="titulos text-center">{{$evento->nombre_evento}}</h3>
                                    </div>
                                    <hr class="mt-2 mb-3">
                                    <div>
                                        <span class="text-primary font-weight-bold">Realizado por:</span>
                                        {{$evento->encargado_evento}}
                                    </div>
                                    <div>
                                        <span class="text-primary font-weight-bold">Hora inicio:</span>
                                        <formato-hora fecha="{{$evento->fecha_evento}}"></formato-hora>
                                    </div>

                                    <div>
                                        <span class="text-primary font-weight-bold">Lugar:</span>
                                        {{$evento->sala->nombre}}
                                    </div>
                                    {{-- <hr class="mt-2 mb-3"> --}}
                                    {{-- <div class="row justify-content-center">
                                        <a href="{{ route('catalogo.show', ['existencia'=> $existencia->id]) }}"  class="btn btn-outline-primary mr-2 ml-2 titulos">Detalle</a>
                                    <a href="{{ route('catalogo.create', ['existencia'=> $existencia->id]) }}" class="btn btn-outline-success mr-2 ml-2 titulos">Solicitar</a>
                                    </div> --}}
                                    
                                </div>
                            </div>
                        </div>
                        
                    @endforeach
                    </div></div></div>
                     </div>
                @endforeach
            @endforeach
        @else
        <h3 class="text-center titulos">No hay eventos próximos...</h3>
        @endif
           
    </div>
</body>

@endsection