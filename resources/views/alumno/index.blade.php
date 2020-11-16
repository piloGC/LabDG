@extends('layouts.app')

@section('content')
  <div class="jumbotron jumbotron-fluid" >
  {{-- style="background-image:url(https://source.unsplash.com/vC8wj_Kphak/1750x990); opacity: 0.5"> --}}
    <h2 class="display-4 ml-3 text-black">Laboratorio de Computación y Multimedia</h2>
    <h3 class=" ml-3" >Escuela de Diseño Gráfico</h3>
    <h4 class=" ml-3">Hola {{$usuario->name}} !</h4>
  </div>

  <div class="container">
    <div class="row justify-content-center">
      <a class="card col-md-3 m-4 border-card" style="text-decoration:none;">
        <div class="card-body">
          <img src="https://source.unsplash.com/lfRlv3nuf78/225x200"> 
        </div>
        <div class="card-footer"><h5 class="text-center color-texto" >CATÁLOGO</h5></div> 
      </a>
      <a class="card col-md-3 m-4 border-card2" style="text-decoration:none;" href="{{route('solicitud.create')}}">
        <div class="card-body">
          <img src="https://source.unsplash.com/lfRlv3nuf78/225x200"> 
        </div>
        <div class="card-footer"><h5 class="text-center color-texto2" >SOLICITAR EQUIPO</h5></div> 
      </a>
      <a class="card col-md-3 m-4 border-card3" style="text-decoration:none;" >
        <div class="card-body ">
          <img src="https://source.unsplash.com/lfRlv3nuf78/225x200"> 
        </div>
        <div class="card-footer"><h5 class="text-center color-texto3" >HORARIOS</h5></div> 
      </a>
    </div>
  </div>
  
@endsection