@extends('adminlte::page')



@section('content')


    <article class="contenido-equipo bg-white p-5 shadow">
        <h1 class="text-center mb-4"> {{ $sala->nombre}} </h1>
        
        <div class="equipo-meta mt-3">
            <p>
                <span class="font-weight-bold text-primary"> Codigo : </span>
                {{$sala->codigo_interno}}
            </p>     
            <p>
                <span class="font-weight-bold text-primary"> Nombre: </span>
                {{$sala->nombre}}
            </p>
            <p>
                <span class="font-weight-bold text-primary"> Estado: </span>
                {{$sala->estado}}
            </p> 
            <p>
                <span class="font-weight-bold text-primary"> Capacidad: </span>
                {{$sala->capacidad}}
            </p>
               
            <p>
                <span class="font-weight-bold text-primary"> Internet: </span>
                {{$sala->internett}}
            </p>    
            <p>
                <span class="font-weight-bold text-primary"> Aire Acondicionado: </span>
                {{$sala->aire_acondicionado}}
            </p>          
            

        </div>
        <div class="form-group">
            <a href="{{ url('salas')}}"  class="btn btn-primary"> Volver </a>
        </div>
    </article>

@endsection