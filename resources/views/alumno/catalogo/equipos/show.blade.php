@extends('layouts.app')

@section('content')
<body style="background-image: url(../images/fondo1.jpg)">
    <div class="container py-4" >
        <div >
            <h1 class="text-center">{{$existencia->equipo->nombre}}</h1>
            <div class="row justify-content-end mr-5">
                <h5 class="mr-2">Número de equipo: </h5>{{$existencia->codigo}}
            </div>
             
        </div>
        <hr>
        
    </div>

</body>

@endsection