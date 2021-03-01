@extends('layouts.app')

@section('content')
<body style="background-image: url({{ asset('../images/fondo13.png') }})">
    <div class="container py-4" >
        <h1 class="text-center mb-3 titulos">TODOS LOS EQUIPOS</h1>
        <hr>
        @if (count($existencias) > 0)
        @foreach ($existencias as $key => $grupo)
        <div class="container">
            <h2 class="titulo-categoria text-uppercase mb-4">
                {{str_replace('-',' ',$key)}}
            </h2>
            <div class="row">
                @foreach ($grupo as $existencias)
                @if(count($existencias) > 0)

                    @foreach ($existencias as $existencia)
                        <div class="col-md-3 mb-3">
                            <div class="card shadow">
                                <img class="card-img-top imagen-catalogo" src="/storage/{{$existencia->equipo->imagen}}" alt="imagen categoria" >
                                <div class="card-body">
                                    <div>
                                        <span class="text-primary font-weight-bold">Categoría: </span>
                                        {{$existencia->equipo->categoria->nombre}}
                                    </div>
                                    <div>
                                        <span class="text-primary font-weight-bold">Número de equipo:  </span>
                                            {{$existencia->codigo}}
                                    </div>
                                    <hr class="mt-2 mb-3">
                                    <div class="row justify-content-center">
                                        <a href="{{ route('catalogo.show', ['existencia'=> $existencia->id]) }}"  class="btn btn-outline-primary mr-2 ml-2 titulos">Detalle</a>
                                    <a href="{{ route('catalogo.create', ['existencia'=> $existencia->id]) }}" class="btn btn-outline-success mr-2 ml-2 titulos">Solicitar</a>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        
                    @endforeach
                    @else
                    <h3 class="text-center titulos">No hay equipos disponibles...</h3>
                    @endif
            </div></div></div>
        </div>
                @endforeach
            @endforeach
        @else
        <h3 class="text-center titulos">No hay equipos disponibles...</h3>
        @endif
</body>
@endsection