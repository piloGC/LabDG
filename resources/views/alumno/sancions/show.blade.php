@extends('layouts.app')

@section('content')
<body style="background-image:url({{ asset('/images/fondo17.jpg') }}) ">
    <div class="container py-4" id="app">
        <div>
            <h1 class="text-center titulos">Sancion #{{ $sancion->id}}</h1>
    <div class="row justify-content-end mr-5">
        <h5 class="">Estado: 
           @if ($sancion->estado->id == 1)
               <span class="badge badge-pill badge-info text-white">{{$sancion->estado->nombre}}</span> 
           @endif
           @if ($sancion->estado->id == 2)
               <span class="badge badge-pill badge-secondary">{{$sancion->estado->nombre}}</span>
           @endif
       </h5> 
   </div>
<hr>
<h3 class="mb-4 titulo-categoria">Detalle de sanción:</h3>
        <br>
        <div class="row">
            <div class="form-group col-md-4">
                <h4 class="titulos">número solicitud</h4>
                <h5 class="mt-3 titulos btn btn-outline-info">
                    <a href="{{action ('SolicitudController@show',['solicitud' => $sancion->prestamo->solicitud_id])}}" 
                        style="color:black">{{Str::words(strip_tags($sancion->prestamo->solicitud_id),9)}}</a>
                </h5>
            </div> 
            <div class="form-group col-md-4">
                <h4 class="titulos">Desde</h4>
                <fecha-formato fecha="{{$sancion->fecha_inicio}}"></fecha-formato>
            </div>
            <div class="form-group col-md-4">
                <h4 class="titulos">Hasta</h4>
                <fecha-formato fecha="{{$sancion->fecha_fin}}"></fecha-formato>
            </div>
        </div>
        <br>
        <div class="row">
            
            <div class="form-group col-md-4">
                <h4 class="titulos">Categoría sanción</h4>
                <h5 class="mt-3">{{ $sancion->categoria->nombre }}</h5>
            </div>   
            <div class="form-group col-md-7">
                <h4 class="titulos">Descripción sanción</h4>
                <div><h5 class="mt-3">{!! $sancion->descripcion !!}</h5></div>
            </div>
        </div>
        <br>

        {{-- <div class="row">
            <div class="form-group col-md-3">
                <h4 >Estudiante</h4>
                <span class="mt-3">{{ $sancion->alumnoNombre }} {{ $sancion->alumnoApellido }}</span>
            </div>   
            <div class="form-group col-md-7">
                <h4 >Rut</h4>
                {!! $sancion->rutAlumno !!}
            </div>
        </div> --}}
        </div>
    
        
    </div> 
</body>
@endsection