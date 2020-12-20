@extends('layouts.app')

@section('content')
 <body style="background-image:url({{ asset('/images/fondo18.png') }})">
     {{-- <div class="jumbotron jumbotron-fluid" style="height: 15em;background-image:url('../images/inicio2.png')">  
      <h1 class="display-4 ml-3 text-uppercase font-weight-bold ">Laboratorio de Computación y Multimedia</h1>
    <h3 class=" ml-3 font-weight-bold" >Escuela de Diseño Gráfico</h3>  
    <h4 class=" ml-3 font-weight-bold">Hola {{$usuario->name}} !</h4> #006666
 </div>   --}}
     <div class="container py-4 m-0 ">
      <div class="row">
        <div class=" mx-auto">
            <h1 class=" ml-3 text-uppercase font-weight-bold titulos" style="font-size: 48px;color:#006666;-webkit-text-stroke: black;">Laboratorio de Computación y Multimedia</h1>
            <h3 class="ml-3 font-weight-bold titulos" style="color:#006666;-webkit-text-stroke: black;">Escuela de Diseño Gráfico</h3>
            <h4 class="ml-3 font-weight-bold titulos" style="color:#006666">Hola {{$usuario->name}} !</h4>
          </div>
        </div>
      </div>
      <hr class="shadow-sm">
    </div>  
<div class="container">
    <div class="row justify-content-center">

      <div class="card col-md-3 m-2" style="width: 18rem;">
        <img class="card-img-top" src="{{ asset('/images/catalogo.jpg') }}" alt="Card image cap">
        <div class="card-body">
          <p class="card-text text-center">
            ¡Encontrarás todos los equipos disponibles para solicitar!
          </p>
          <a href="{{route('catalogo.categorias')}}" class="btn btn-outline-primary btn-block titulos"> VER CATÁLOGO</a>
        </div>
      </div>
      <div class="card col-md-3 m-2" style="width: 18rem;">
         <img class="card-img-top " src="{{ asset('/images/solicitud.jpeg') }}" alt="Card image cap"> 
        <div class="card-body">
          <p class="card-text text-center">
            ¡Llena el formulario y solicita el equipo que necesitas!
          </p>
          <a href="{{route('solicitud.create')}}" class="btn btn-outline-success btn-block titulos"> SOLICITAR EQUIPO</a>
        </div>
      </div>

      <div class="card col-md-3 m-2" style="width: 18rem;">
        <img class="card-img-top" src="{{ asset('/images/reglas.jpg') }}" alt="Card image cap">
        <div class="card-body">
          <p class="card-text text-center">
            Recuerda leer el reglamento y evita problemas
          </p>
          <a href="{{route('reglamentos.index')}}" class="btn btn-outline-danger btn-block titulos"> REGLAMENTO</a>
        </div>
      </div>
    </div></div>
</body>
@endsection