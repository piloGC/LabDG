@extends('layouts.app')

@section('content')
<body style="background-image:url({{ asset('/images/fondo19.png') }}) ">
<div class="container py-4">
<h1 class="text-center mb-3 titulos"> mis Sanciones</h1>

<hr>
<div class="row justify-content-center mt-4">
    <div class="container mx-auto bg-white">
    <div class="table-responsive">
    <table class="table table-hover">
        <thead class="bg-success text-light">
           <tr class="table-active">

            <th scole="col">Número solicitud</th>
            <th scole="col">Categoría</th>
            <th scole="col">Desde</th>
            <th scole="col">Hasta</th>
            <th scole="col">Estado</th>
            <th scole="col">Acciones</th>
            </tr> 
        </thead>
           <tbody>
            @foreach ($sanciones as $sancion)
               @foreach ($solicitudes as $solicitud)
                  
               @if ($solicitud->id == $sancion->prestamo->solicitud_id && $solicitud->user_id == Auth::id())
                       
               
               
            {{--  {{ dd(count($sanciones))}}  --}}
                    <tr>
                         <td>{{$sancion->prestamo->solicitud_id}}</td>
                        {{--  <td>{!! $sanciones->descripcion !!}</td>   --}}
                        <td>{{ $sancion->categoria->nombre}}</td>
                        <td><fecha-index fecha="{{$sancion->fecha_inicio}}">-</fecha-index></td>
                        <td><fecha-index fecha="{{$sancion->fecha_fin}}">-</fecha-index></td>
                        {{--  <td><fecha-equipo fecha="{{$sancion->fecha_inicio}}">-</fecha-equipo></td>
                        <td><fecha-equipo fecha="{{$sancion->fecha_fin}}">-</fecha-equipo></td>  --}}
                        <td>
                            @if ($sancion->estado->id == 1)
                            <h5> <span class="badge badge-pill badge-info text-white">{{$sancion->estado->nombre}}</span> </h5>
                             @endif
                             @if ($sancion->estado->id == 2)
                            <h5><span class="badge badge-pill badge-secondary">{{$sancion->estado->nombre}}</span></h5>
                             @endif    
                        </td> 
                        <td>
                            <a href="{{route ('sanciones.show',['sancion' => $sancion->id]) }}" class="btn btn-outline-primary mb-2 titulos">Detalle</a>
                        </td>
                    </tr> 
                    @endif 
                    @endforeach  
                    @endforeach                
            </tbody>
        </table>
    </div>
    </div>


</div>
  <div class="col-12 mt-4 justify-content-center d-flex">
    {{$sanciones->links()}}
</div>  
@endsection