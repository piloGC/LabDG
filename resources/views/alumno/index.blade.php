@extends('layouts.app')
@section('content')
 <body style="background-image:url({{ asset('/images/fondo18.png') }})">
     {{-- <div class="jumbotron jumbotron-fluid" style="height: 15em;background-image:url('../images/inicio2.png')">  
      <h1 class="display-4 ml-3 text-uppercase font-weight-bold ">Laboratorio de Computación y Multimedia</h1>
    <h3 class=" ml-3 font-weight-bold" >Escuela de Diseño Gráfico</h3>  
    <h4 class=" ml-3 font-weight-bold">Hola {{$usuario->name}} !</h4> #006666
 </div>   --}}
     {{-- <div class="container py-4 m-0 ">
      <div class="row">
        <div class=" mx-auto">
            <h1 class=" ml-3 text-uppercase font-weight-bold titulos" style="font-size: 48px;color:#006666;-webkit-text-stroke: black;">Laboratorio de Computación y Multimedia</h1>
            <h3 class="ml-3 font-weight-bold titulos" style="color:#006666;-webkit-text-stroke: black;">Escuela de Diseño Gráfico</h3>
            <h4 class="ml-3 font-weight-bold titulos" style="color:#006666">Hola {{$usuario->name}} !</h4>
          </div>
        </div>
      </div>
      <hr class="shadow-sm">
    </div>   --}}
    <div id="carouselIndex" class="carousel slide py-2" data-ride="carousel" data-interval="3500">
      <ol class="carousel-indicators">
        <li data-target="#carouselIndex" data-slide-to="0" class="active"></li>
        <li data-target="#carouselIndex" data-slide-to="1"></li>
      </ol>
      <div class="carousel-inner mx-auto" >
        <div class="carousel-item active" >
          <div class="row p-4 justify-content-center bg-white" 
          {{-- style="background-image:url({{ asset('../images/fondo9.png') }})" --}}
          >
            <div >
                <h1 class=" ml-3 text-uppercase font-weight-bold titulos text-center" style="font-size: 47px;color:#006666;-webkit-text-stroke: black;">Laboratorio de Computación y Multimedia</h1>
                 <h3 class="ml-3 font-weight-bold titulos text-center" style="color:#006666;-webkit-text-stroke: black;">Escuela de Diseño Gráfico</h3> 
                 {{-- <h3 class="ml-3 font-weight-bold titulos" style="color:#006666">Hola {{$usuario->name}} !</h3>   --}}
              </div>
            </div>
        </div>
        
        <div class="carousel-item" >
          <div class="row p-4 justify-content-center bg-white" 
          {{-- style="background-image:url({{ asset('../images/fondo9.png') }})"  --}}
           >
            <div   >
              @if (count($reservas) > 0)

              @if (count($reservas) == 1)
                <h1 class=" ml-3 text-uppercase font-weight-bold titulos text-center" style="font-size: 47px;color:#006666;-webkit-text-stroke: black;">Hay {{count($reservas)}} reserva en el laboratorio hoy</h1>
                <a href="{{route('reservas.salas') }}"><h3 class="ml-3 font-weight-bold titulos text-center" style="color:#006666;-webkit-text-stroke: black;">¡Revisa aquí!</h3></a>
              @else

              <h1 class=" ml-3 text-uppercase font-weight-bold titulos text-center" style="font-size: 47px;color:#006666;-webkit-text-stroke: black;">Hay {{count($reservas)}} reservas en el laboratorio hoy</h1>
                <a href="{{route('reservas.salas') }}"><h3 class="ml-3 font-weight-bold titulos text-center" style="color:#006666;-webkit-text-stroke: black;">¡Revisa aquí!</h3></a>
                
              @endif

              @else
               <h1 class=" ml-3 text-uppercase font-weight-bold titulos text-center" style="font-size: 47px;color:#006666;-webkit-text-stroke: black;">No hay reservas en el laboratorio hoy</h1>
          <a href="{{route('reservas.salas') }}"><h3 class="ml-3 font-weight-bold titulos text-center" style="color:#006666;-webkit-text-stroke: black;">¡Revisa las próximas reservas aquí!</h3></a>
              
              @endif
                
              </div>
            </div>
        </div>
      </div>
      <a class="carousel-control-prev" href="#carouselIndex" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Anterior</span>
      </a>
      <a class="carousel-control-next" href="#carouselIndex" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Siguiente</span>
      </a>
    </div>
<br><br>
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
