@extends('layouts.app')

@section('content')
 <body style="background-image:url('../images/inicio2.png')">
     {{-- <div class="jumbotron jumbotron-fluid" style="height: 15em;background-image:url('../images/inicio2.png')">  
      <h1 class="display-4 ml-3 text-uppercase font-weight-bold ">Laboratorio de Computación y Multimedia</h1>
    <h3 class=" ml-3 font-weight-bold" >Escuela de Diseño Gráfico</h3>  
    <h4 class=" ml-3 font-weight-bold">Hola {{$usuario->name}} !</h4> 
 </div>   --}}
     <div class="container py-4 m-0 ">
      <div class="row">
        <div class=" mx-auto">
            <h1 class=" ml-3 text-uppercase font-weight-bold" style="font-size: 48px;">Laboratorio de Computación y Multimedia</h1>
            <h3 class="ml-3 font-weight-bold" >Escuela de Diseño Gráfico</h3>
            <h4 class="ml-3 font-weight-bold">Hola {{$usuario->name}} !</h4>
          </div>
        </div>
      </div>
      <hr class="shadow-sm">
    </div>  
<div class="container">
    <div class="row justify-content-center">
      <a class="card col-md-3 m-4 border-card3" style="text-decoration:none;" href="{{route('catalogo.categorias')}}">
        <div class="card-body">
          <img src="https://source.unsplash.com/lfRlv3nuf78/225x200"> 
        </div>
        <div class="card-footer"><h5 class="text-center color-texto3" >CATÁLOGO</h5></div> 
      </a>
      <a class="card col-md-3 m-4 border-card" style="text-decoration:none;" href="{{route('solicitud.create')}}">
        <div class="card-body">
          <img src="https://source.unsplash.com/lfRlv3nuf78/225x200"> 
        </div>
        <div class="card-footer"><h5 class="text-center color-texto2" >SOLICITAR EQUIPO</h5></div> 
      </a>
      <a class="card col-md-3 m-4 border-card2" style="text-decoration:none;" >
        <div class="card-body ">
          <img src="https://source.unsplash.com/lfRlv3nuf78/225x200" > 
        </div>
        <div class="card-footer"><h5 class="text-center color-texto" >HORARIOS</h5></div> 
      </a>
    </div></div>
</body>
@endsection