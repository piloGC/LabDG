@extends('layouts.app')

@section('content')
<body style="background-image:url({{ asset('/images/fondo10.png') }}) ">
    <div class="container py-4" id="app">
        <div>
            <h1 class="text-center titulos">HORARIOS</h1>
            <hr>
                <article class="bg-white">
                    <div class="row justify-content-center">
                        <div class="col-md-4">
                            <h5 class="text-uppercase"> <strong>Horario General</strong> </h5>
                            <p>
                                    Lunes a jueves 09:00 a 20:00 horas.
                                <br>
                                    Viernes 09:00 a 18:00 horas.
                            </p>
                        </div>
                        <div class="col-md-2"></div>
                        <div class="col-md-4">
                            <h5 class="text-uppercase"> <strong>¡Recuerda!</strong> </h5>
                            <p> <strong>NO</strong> puedes consumir alimentos ni líquidos en los laboratorios
                            </p>
                        </div>
                    </div>
                </article>
                <br><br>
                <div class="row justify-content-center">
                @foreach ($salas as $sala)
                <div class="col-md-3 mb-3">
                    <div class="card shadow">
                        <div class="card-body">
                            <div>
                                <h3 class="titulos text-center">{{$sala->nombre}}</h3>
                            </div>
                            <hr class="mt-2 mb-3">
                            <div>
                                @if ($sala->aire_acondicionado == 'Si')
                                <h6 class="text-primary font-weight-bold text-center">Aire acondicionado <i class="fas fa-check"></i></h6> 
                                @else
                                <h6 class="text-primary font-weight-bold text-center">Aire acondicionado <i class="fas fa-times"></i></h6> 
                                @endif

                                @if ($sala->internet == 'Si')
                                <h6 class="text-primary font-weight-bold text-center">Internet <i class="fas fa-check"></i></h6> 
                                @else
                                <h6 class="text-primary font-weight-bold text-center">Internet <i class="fas fa-times"></i></h6> 
                                @endif
                                
                            </div>
                            
                        </div>
                    </div>
                </div>

                @endforeach

            </div>
    
        </div>
    
        
    </div> 
</body>

@endsection