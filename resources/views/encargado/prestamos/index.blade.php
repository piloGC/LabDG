@extends('adminlte::page')

@section('content')
    
<h1 class="text-center mb-5">Solicitudes de préstamo</h1>

<div class="col-md-10 mx-auto bg-white p-3">
    <div class="table-responsive">
    <table class="table">
        <thead class="bg-info text-light">
           <tr>
            <th scole="col">#</th>
            <th scole="col">Equipo</th>
            <th scole="col">N° de equipo</th>
            <th scole="col">Asignatura</th>   
            <th scole="col">Desde</th>  
            <th scole="col">Hasta</th>
            <th scole="col">Acción</th>
            </tr> 
        </thead>
        <tbody>
            @foreach ($solicitudes as $solicitud)
            <tr>
                <td>{{$solicitud->id}}</td>
                <td>{{$solicitud->existencia->equipo->nombre}}</td>
                <td>{{$solicitud->existencia->codigo}}</td>
                <td>{{$solicitud->asignatura->nombre}}</td>
                <td>{{ \Carbon\Carbon::parse($solicitud->fecha_inicio)->isoFormat('DD [de] MMMM [del] YYYY')}}</td>
                <td>{{ \Carbon\Carbon::parse($solicitud->fecha_inicio)->isoFormat('DD [de] MMMM [del] YYYY')}}</td>
                {{-- <td><fecha-equipo fecha="{{$solicitud->fecha_inicio}}">-</fecha-equipo></td>  --}}
                {{-- <td><fecha-equipo fecha="{{$solicitud->fecha_fin}}">-</fecha-equipo></td>  --}}

                 <td >
                    <a href="#" class="btn btn-info text-white mr-1">Ver</a>
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


@endsection

