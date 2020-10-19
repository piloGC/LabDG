@extends('adminlte::page')


@section('content')

    <article class="contenido-equipo bg-white p-5 shadow">
        <h1 class="text-center mb-4"> {{ $equipo->nombre}} </h1>

        <div class="imagen-equipo">
            <img src="/storage/{{ $equipo->imagen }}" class="w-25">
        </div>
        
        <div class="equipo-meta mt-3">
            <p>
                <span class="font-weight-bold text-primary"> Categoria: </span>
                {{$equipo->categoria->nombre}}
                {{--$equipo->categoria_id--}}
            </p>
            <p>
                <span class="font-weight-bold text-primary"> Marca: </span>
                {{$equipo->marca}}
            </p>
            <p>
                <span class="font-weight-bold text-primary"> Modelo: </span>
                {{$equipo->modelo}}
            </p>
            <div class="descripcion">
                <h2 class="my-3 text-primary">Descripcion</h2>
                {!! $equipo->descripcion !!}
            </div>
            <p>
                <span class="font-weight-bold text-primary"> Fecha: </span>
                    @php
                        $fecha = $equipo->created_at
                    @endphp
                        <fecha-equipo fecha="{{$fecha}}"></fecha-equipo> {{--pasando fecha a vue para cambiar formato--}}

            </p>
            

            <p>
                <span class="font-weight-bold text-primary"> En Catalogo: </span>
                {{ $equipo->catalogo->disponible }}
            </p>


        </div>
        <div class="form-group">
            <a href="{{ url('equipos')}}"  class="btn btn-primary"> Volver </a>
        </div>
    </article>

@endsection