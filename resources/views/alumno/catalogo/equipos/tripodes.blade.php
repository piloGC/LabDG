@extends('layouts.app')

@section('content')
<body style="background-image: url(../images/fondo14.png)">
    <div class="container py-4" >
        <h1 class="text-center mb-3">TRÍPODES</h1>
        <hr>
        
        @if (count($existencias) > 0)
        @foreach ($existencias as $key => $grupo)
        
        <div class="container">
            <h2 class="titulo-categoria text-uppercase mt-5 mb-4">
                {{str_replace('-',' ',$key)}}
            </h2>
            <div class="row">
                @foreach ($grupo as $existencias)
                    @foreach ($existencias as $existencia)
                        <div class="col-md-4 ">
                            <div class="card shadow">
                                <img src="https://source.unsplash.com/lfRlv3nuf78/200x125" alt="imagen categoria" >
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
                                        <a href="{{ route('catalogo.show', ['existencia'=> $existencia->id]) }}"  class="btn btn-outline-info mr-2 ml-2">Ver</a>
                                    <a href="{{ route('catalogo.create', ['existencia'=> $existencia->id]) }}" class="btn btn-outline-success mr-2 ml-2">Solicitar</a>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endforeach
            </div></div></div>
        </div>
    @endforeach
        @else
            <h1 class="text-center">No hay equipos aun...</h1>
        @endif
@endsection