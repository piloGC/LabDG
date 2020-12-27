
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6 m-2"><h6 class="card-title text-uppercase">Buscar de solicitudes por nombre</h6></div>
                <div class="col-md-5">
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
    