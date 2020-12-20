@extends('layouts.app')

@section('content')
<body style="background-image: url({{ asset('../images/fondo13.png') }})">

<div class="container py-4">

      <div class="row justify-content-center">
        <a class="card col-md-3 m-2" style="text-decoration:none;" href="{{route('catalogo.fotograficas')}}">
            <div class="card-body">
                <img class="card-img-top" src="{{ asset('../images/camara-fotografica.jpeg') }}">         
            </div>
            <div class="card-footer"><h5 class="text-center color-texto2 titulos" >CÁMARA FOTOGRÁFICA</h5></div> 
        </a> 
        <a class="card col-md-3 m-2" style="text-decoration:none;" href="{{route('catalogo.videos')}}">
            <div class="card-body">
                <img class="card-img-top" src="{{ asset('../images/camara-video.jpg') }}"> 
            </div>
            <div class="card-footer"><h5 class="text-center color-texto titulos" >CÁMARA DE VIDEO</h5></div> 
        </a>
        <a class="card col-md-3 m-2" style="text-decoration:none;" href="{{route('catalogo.tripodes')}}">
            <div class="card-body">
                <img class="card-img-top" src="{{ asset('../images/tripode.jpg') }}"> 
            </div>
            <div class="card-footer"><h5 class="text-center color-texto2 titulos" >TRÍPODE</h5></div> 
        </a> 
      </div>
      <div class="row justify-content-center">
        <a class="card col-md-3 m-2" style="text-decoration:none;" href="{{route('catalogo.tabletas')}}">
            <div class="card-body">
                <img class="card-img-top" src="{{ asset('../images/tableta.jpg') }}"> 
            </div>
            <div class="card-footer"><h5 class="text-center color-texto3 titulos" >TABLETA</h5></div> 
        </a> 
        <a class="card col-md-3 m-2" style="text-decoration:none;" href="{{route('catalogo.lectores')}}">
            <div class="card-body">
                <img class="card-img-top" src="{{ asset('../images/lector.jpg') }}"> 
            </div>
            <div class="card-footer"><h5 class="text-center color-texto titulos" >LECTOR CD</h5></div> 
        </a> 
      </div>
</div>
</body>  
@endsection