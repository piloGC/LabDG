    @extends('adminlte::page')

    @section('content')
    <div class="container py-2">
        <h1 class="text-center mb-5">Prestamo ID: {{$prestamo->id_prestamo}}</h1>

        <div class="row justify-content-center mt-3">
            <div class="col-md-12">
                <form action="{{ route('prestamo.update',['prestamo' => $prestamo->id_prestamo])}}" method="POST" enctype="multipart/form-data" novalidate>
                    <!--csrf_field()}}  token de acceso unico para -->
                    @csrf
                    @method('PUT')

                    <div class="row justify-content-center"> 
                        <div class="form-group col-md-4">
                            <label for="solicitud">Solicitud ID:</label>
                            <input type="text"  
                            name="solicitud" 
                            id="solicitud" 
                            class="form-control @error ('solicitud') is-invalid @enderror"
                            placeholder="Ingrese id solicitud" 
                            value="{{ $prestamo->id}}" readonly>
                        </div>
                        <div class="form-group col-md-4">
                                <label for="usuario"> Estudiante:</label>
                                <input type="text"  name="usuario" id="usuario" 
                                class="form-control @error ('usuario') is-invalid @enderror"
                                placeholder="Ingrese id usuario" 
                                value="{{ $prestamo->nombre }} {{ $prestamo->apellido }}" readonly>

                        </div>
                        <div class="form-group col-md-4">
                            <label for="rut"> Rut:</label>
                            <input type="text"  name="rut" id="rut" 
                            class="form-control @error ('rut') is-invalid @enderror"
                            placeholder="Ingrese id rut" 
                            value="{{ $prestamo->rut }} " readonly>

                        </div>
                    </div>
                    <div class="row justify-content-center"> 
                        <div class="form-group col-md-4">
                            <label for="equipo">Equipo ID:</label>
                            <input id="equipo" 
                                type="text" 
                                name="equipo" 
                                class="form-control @error('equipo') is-invalid @enderror" 
                                value="{{$prestamo->equipo}}" readonly>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="nombreEquipo">Modelo Equipo</label>
                            <input id="nombreEquipo" 
                                type="text" 
                                name="nombreEquipo" 
                                class="form-control @error('nombreEquipo') is-invalid @enderror" 
                                value="{{$prestamo->nombre_equipo}}" readonly>
                        </div>
                            <div class="form-group col-md-4">
                                <label for="fecha_devolucion">Fecha devolucion</label>
                                <input type="date"  name="fecha_devolucion"
                                id="fecha_devolucion" class="form-control @error ('fecha_devolucion') is-invalid @enderror"
                                value="{{ $hoyDevolucion}}" readonly>
                            </div>
                    </div>

                    <div class="form-group float-right mt-3">
                        {{-- @if($prestamo->fecha_fin == $hoyDevolucion) 
                            <a href="#" class="btn btn-warning" value="Sancionar" disabled> Sancionar no
                            <input type="submit" class="btn btn-success" value="Finalizar Prestamo">
                        @endif --}}
                        <a href="{{ url('listarSolicitud/encursos')}}" class="btn btn-secondary"> Cancelar </a>
                        <a href="{{ route('prestamo.sancionar', ['prestamo'=> $prestamo->id_prestamo]) }}" class="btn btn-danger" value="Sancionar" > Sancionar y Liberar </a>
                        <input type="submit" class="btn btn-success" value="Finalizar Prestamo">
                    </div>
                </form>
            </div>
        </div>

    @endsection



