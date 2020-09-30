@extends('layouts.app')

@section('content')
<div class="container">


    <h1 class="text-center mb-5"> Equipos</h1>
    <div class="col-md-10 mx-auto bg-white p-3">
        <table class="table table-light">
            <thead class="bg-primary text-blue">
            <!--thead class="thead-light"-->
                <tr>
                    <th scole="col">#</th>
                    <th scole="col">Categoria</th>
                    <th scole="col">Nombre</th>
                  {{--  <th scole="col">Marca</th>
                    <th scole="col">Modelo</th>
                    <th scole="col">Descripción</th> --}}
                    <th scole="col">Imagen</th>
                    <th scole="col">En Catalogo</th>
                    <th scole="col">Acciones</th>
                </tr>
            </thead>

            <tbody>

                @foreach($equipos as $equipo)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$equipo->categoria->nombre}}</td>
                    <td>{{$equipo->nombre}}</td>
                {{--    <td>{{$equipo->marca}}</td>
                    <td>{{$equipo->modelo}}</td>
                    <td>{{$equipo->descripcion}}</td> --}}
                    <td>{{--$equipo->imagen--}}
                        <img src="/storage/{{$equipo->imagen}}" style="width:100px" ></td>
                    <td>{{$equipo->catalogo->disponible}}</td>
                    <td>
                      {{--  <form action="{{ route('equipos.destroy',['equipo' => $equipo->id])}}"  method="post"> --}}
                        <a href="{{ route('equipos.edit', ['equipo'=> $equipo->id]) }}" class="btn btn-primary  mb-2">Editar</a>
                        <a href="{{ route('equipos.show', ['equipo'=> $equipo->id]) }}" class="btn btn-success  mb-2">Ver</a>
                        <eliminar-equipo equipo-id={{$equipo->id}}></eliminar-equipo>
                                                
                    </td>
                </tr>
            @endforeach    
            </tbody>
        </table>

        <a href="{{route('equipos.create')}}"class="btn btn-primary mr-2">Agregar Equipo</a>
            <!--button type="button" class="btn btn-primary mr-2" > Agregar Equipo </!--button-->


    </div>



</div>
@endsection
