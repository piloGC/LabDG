@extends('layouts.app')

@section('content')
<body style="background-image:url('../images/fondo10.png') ">
    <div class="container py-4">
        <h1 class="text-center mb-3 titulos">Horario Laboratorio A</h1>
        <hr>
        <div class="table-responsive bg-white">
            <table id="tablaHorarios" class="table table-hover table-bordered">
                <thead class="text-light" style="background-color: #A569BD"> 
                    <tr class="table-active">
                        <th >Horario</th>
                        <th >Lunes</th>
                        <th >Martes</th>
                        <th >Miércoles</th>
                        <th >Jueves</th>
                        <th >Viernes</th>
                    </tr>
                    
                </thead>
                    <td   >08:10 - 08:50</td>
                    <td    >Disponible</td>                    
                    <td    >Disponible</td>
                    <td    >Disponible</td>
                    <td    >Disponible</td>
                    <td    >Disponible</td>
                </tr>
                    <td  >08:50 - 09:30</td>
                    <td     >Disponible</td>
                    <td    >Disponible</td>
                    <td    >Disponible</td>
                    <td    >Disponible</td>
                    <td    >Disponible</td>
                </tr>
                
                    <td   >09:40 - 10:20</td>
                    <td    >Disponible</td>
                    <td    >Disponible</td>
                    <td    >Disponible</td>
                    <td    >Disponible</td>
                    <td    >Disponible</td>
                </tr>
                
                    <td   >10:20 - 11:00</td>
                    <td    >Disponible</td>
                    <td    >Disponible</td>
                    <td    >Disponible</td>
                    <td    >Disponible</td>
                    <td    >Disponible</td>
                </tr>
                
                    <td   >11:10 - 11:50</td>
                    <td    >Disponible</td>
                    <td    >Disponible</td>
                    <td    >Disponible</td>
                    <td    >Disponible</td>
                    <td    >Disponible</td>
                </tr>
                
                    <td   >11:50 - 12:30</td>
                    <td    >Disponible</td>
                    <td    >Disponible</td>
                    <td    >Disponible</td>
                    <td    >Disponible</td>
                    <td    >Disponible</td>
                </tr>
                
                    <td  >12:40 - 13:20</td>
                    <td    ></td>
                    <td    ></td>
                    <td    ></td>
                    <td    ></td>
                    <td    ></td>
                </tr>
                
                    <td   >13:20 - 14:00</td>
                    <td    ></td>
                    <td    ></td>
                    <td    ></td>
                    <td    ></td>
                    <td    ></td>
                </tr>
                
                    <td   >14:10 - 14:50</td>
                    <td >Disponible</td>
                    <td >Disponible</td>
                    <td >Disponible</td>
                    <td >Disponible</td>
                    <td >Disponible</td>
                </tr>
                
                    <td  >14:50 - 15:30</td>
                    <td >Disponible</td>
                    <td >Disponible</td>
                    <td >Disponible</td>
                    <td >Disponible</td>
                    <td >Disponible</td>
                </tr>
                
                    <td  >15:40 - 16:20</td>
                    <td >Disponible</td>
                    <td >Disponible</td>
                    <td >Disponible</td>
                    <td >Disponible</td>
                    <td >Disponible</td>
                </tr>
                
                    <td   >16:20 - 17:00</td>
                    <td >Disponible</td>
                    <td >Disponible</td>
                    <td >Disponible</td>
                    <td >Disponible</td>
                    <td >Disponible</td>
                </tr>
                
                    <td   >17:10 - 17:50</td>
                    <td >Disponible</td>
                    <td >Disponible</td>
                    <td >Disponible</td>
                    <td >Disponible</td>
                    <td >Disponible</td>
                </tr>
                
                    <td   >17:50 - 18:30</td>
                    <td >Disponible</td>
                    <td >Disponible</td>
                    <td >Disponible</td>
                    <td >Disponible</td>
                    <td >Disponible</td>
                </tr>
                
                    <td  >18:30 - 19:20</td>
                    <td ></td>
                    <td ></td>
                    <td ></td>
                    <td ></td>
                    <td ></td>
                </tr>
                
                    <td  >19:20 - 20:00</td>
                    <td ></td>
                    <td ></td>
                    <td ></td>
                    <td ></td>
                    <td ></td>
                </tr>
        </div>
    </div>
</body>
@endsection


@section('scripts')
<script>$('#classModal').modal('show')</script>
@endsection