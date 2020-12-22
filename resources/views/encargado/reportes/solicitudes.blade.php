<div class="container-fluid ">
    <div class="row p-2">
        <div class="col-md-5">
            <h3 class="font-weight-bold text-uppercase m-2">Reporte solicitudes año {{Carbon\Carbon::parse($hoy)->format('Y')}}</h3>
        
                <div class="card table-responsive p-0">
                    <table class="table table-hover table-valign-middle">
                        <thead class="bg-olive text-light ">
                            <tr class="table-active">
                                <th>Estado solicitud</th>
                                <th>Cantidad</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            <tr>
                                <td>Entrantes</td>
                                <td>{{count($solicitudesEntrantes)}}</td>
                            </tr>
                            <tr>
                                <td>Aprobadas</td>
                                <td>{{count($solicitudesAceptadas)}}</td>
                            </tr>
                            <tr>
                                <td>En curso</td>
                                <td>{{count($solicitudesEnCurso)}}</td>
                            </tr>
                            <tr>
                                <td>Rechazadas</td>
                                <td>{{count($solicitudesRechazadas)}}</td>
                            </tr>
                            <tr>
                                <td>Canceladas</td>
                                <td>{{count($solicitudesCanceladas)}}</td>
                            </tr>
                            <tr>
                                <th>Total solicitudes</th>
                                <th>{{count($totalSolicitudes)}}</th>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        <div class="col-md-7 mt-5">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-5 m-2"><h3 class="card-title text-uppercase">Buscador de solicitudes</h3></div>
                        <div class="col-md-6">
                            <form action="{{route('buscar.show')}}">
                                <div class="input-group mb-3">
                                    <input type="search" name="nombre" class="form-control" placeholder="Ingrese nombre alumno" aria-describedby="basic-addon2">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-info" type="submit"><i class="fas fa-search"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>                    
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover">
                        <thead class="bg-info text-light ">
                            <tr  class="table-active">
                                <th>Solicitado por</th>
                                <th>Número solicitud</th>                                
                                <th>Estado</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)

                            @foreach ($user->solicitud->sortBy('estado') as $item)
                            <tr>
                                <td>{{$user->name}} {{$user->lastname}}</td>
                                <td>{{$item->id}}</td>
                                <td>{{$item->estado->nombre}}</td>
                                <td>
                                    <a href="{{action ('ListarSolicitudController@show',['listarSolicitud' => $item->id])}} " class="btn btn-outline-info" >Detalle</a>
                                </td>
                            </tr>
                                    
                            @endforeach
                                
                            @endforeach
                        </tbody>
                    </table>
                    <div class="col-12 mt-2 justify-content-end d-flex ">
                        {{$users->links()}}
                    </div>
                </div>
            </div>
            
    </div>
</div></div>