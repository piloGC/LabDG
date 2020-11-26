@extends('layouts.app')

@section('content')
<body style="background-image: url(../images/fondo13.png)">

<div class="container py-4">

      <div class="row justify-content-center">
        <a class="card col-md-3 m-2 " style="text-decoration:none;" href="{{route('catalogo.equipos')}}">
            <div class="card-body">
                <img src="https://source.unsplash.com/lfRlv3nuf78/225x200"> 
            </div>
            <div class="card-footer"><h5 class="text-center color-texto" >VER TODO</h5></div> 
        </a>
        <a class="card col-md-3 m-2" style="text-decoration:none;" href="{{route('catalogo.fotograficas')}}">
            <div class="card-body">
                <img src="https://source.unsplash.com/lfRlv3nuf78/225x200">             </div>
            <div class="card-footer"><h5 class="text-center color-texto" >CÁMARA FOTOGRÁFICA</h5></div> 
        </a> 
        <a class="card col-md-3 m-2" style="text-decoration:none;" href="{{route('catalogo.videos')}}">
            <div class="card-body">
                <img src="https://source.unsplash.com/lfRlv3nuf78/225x200"> 
            </div>
            <div class="card-footer"><h5 class="text-center color-texto" >CÁMARA DE VIDEO</h5></div> 
        </a>
      </div>
      <div class="row justify-content-center">
        <a class="card col-md-3 m-2" style="text-decoration:none;" href="{{route('catalogo.tripodes')}}">
            <div class="card-body">
                <img src="https://source.unsplash.com/lfRlv3nuf78/225x200"> 
            </div>
            <div class="card-footer"><h5 class="text-center color-texto" >TRÍPODE</h5></div> 
        </a> 
        <a class="card col-md-3 m-2" style="text-decoration:none;" href="{{route('catalogo.tabletas')}}">
            <div class="card-body">
                <img src="https://source.unsplash.com/lfRlv3nuf78/225x200"> 
            </div>
            <div class="card-footer"><h5 class="text-center color-texto" >TABLETA</h5></div> 
        </a> 
        <a class="card col-md-3 m-2" style="text-decoration:none;" href="{{route('catalogo.lectores')}}">
            <div class="card-body">
                <img src="https://source.unsplash.com/lfRlv3nuf78/225x200"> 
            </div>
            <div class="card-footer"><h5 class="text-center color-texto" >LECTOR CD</h5></div> 
        </a> 
      </div>
</div>
</body>  
@endsection