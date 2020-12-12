@extends('layouts.app')

@section('content')
<body style="background-image:url('../images/fondo10.png') ">
<div class="container py-4">
<h1 class="text-center mb-3">Mis solicitudes</h1>
<hr>
<div class="row justify-content-center mt-4">
    <div class="container mx-auto bg-white">
    <div class="table-responsive">
    <table class="table table-hover">
        <thead class="bg-success text-light">
           <tr class="table-active">
            <th scole="col">Código</th>
            <th scole="col">Equipo</th>  
            <th scole="col">Desde</th>  
            <th scole="col">Hasta</th>
            <th scole="col">Estado</th>
            <th scole="col">Acción</th>
            </tr> 
        </thead>
        <tbody>
            @foreach ($solicitudes as $solicitud)
            <tr>
                <td>{{$solicitud->id}}</td>
                <td>{{$solicitud->existencia->codigo}}</td>
                <td><fecha-equipo fecha="{{$solicitud->fecha_inicio}}">-</fecha-equipo></td>
                <td><fecha-equipo fecha="{{$solicitud->fecha_fin}}">-</fecha-equipo></td>
                <td>
                    @if ($solicitud->estado->id == 1)
                   <h5> <span class="badge badge-pill badge-warning">{{$solicitud->estado->nombre}}</span> </h5>
                    @endif
                    @if ($solicitud->estado->id == 2)
                   <h5><span class="badge badge-pill badge-success">{{$solicitud->estado->nombre}}</span></h5>
                    @endif
                    @if ($solicitud->estado->id == 3)
                   <h5><span class="badge badge-pill badge-danger">{{$solicitud->estado->nombre}}</span></h5>
                    @endif
                    @if ($solicitud->estado->id == 4)
                    <h5><span class="badge badge-pill badge-info text-white">{{$solicitud->estado->nombre}}</span></h5>
                     @endif
                    @if ($solicitud->estado->id == 5)
                   <h5><span class="badge badge-pill badge-secondary">{{$solicitud->estado->nombre}}</span></h5>
                    @endif
                    
                <td >
                    <a href="{{action ('SolicitudController@show',['solicitud' => $solicitud->id])}} " class="btn btn-outline-info mb-2">Detalle</a>
                    <a href="# " class="btn btn-outline-success mb-2" id="edit" 
                    {{-- onclick="ocultar()" value="ocultar" --}}
                    >Editar</a>  
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    </div></div>
</div>

<div class="col-12 mt-4 justify-content-center d-flex">
    {{$solicitudes->links()}}
</div>
</body>
    
@endsection

 {{-- @section('scripts')
    <script>
        function ocultar(){
            document.getElementById('edit').style.display="none";
        }
    </script>
@endsection --}}