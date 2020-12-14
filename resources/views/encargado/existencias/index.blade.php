@extends('adminlte::page')
@include('encargado.notificacion')
@section('content')

    <h1 class="text-center  mb-5">Equipos</h1>
     {{-- <a href="{{route('existencias.create')}}"class="btn btn-secondary">Agregar ítem</a>  --}}
    <div class="container mx-auto bg-white">
        <div class="table-responsive">
        <table class="table table-hover">
            <thead class="bg-olive text-light ">
                <tr class="table-active">
                    <th scole="col">#</th>
                    <th scole="col">Codigo</th>
                    <th scole="col">Fecha Adquisicion</th>
                    <th scole="col">Estado</th>
                    <th scole="col">Disponibilidad</th>
                    <th scole="col">Equipo</th>
                    <th scole="col">Acciones</th>
                </tr>
            </thead>

            <tbody>

                @foreach($existencias as $existencia)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$existencia->codigo}}</td>
                    <td>{{ \Carbon\Carbon::parse($existencia->fecha_adquisicion)->isoFormat('DD [de] MMMM [del] YYYY')}}</td>
                    <td>{{$existencia->estado->nombre}}</td>
                    <td>{{$existencia->disponibilidad->nombre}}</td>
                    <td>{{$existencia->equipo->nombre}}</td> 
                    {{-- <td>{{$existencia->equipo->nombre}}</td>  --}}
                    <td>
                        {{-- <a href="">
                            @if ($existencia->disponibilidad_id == 1)
                            @include('encargado.existencias.prestar')
                        @else
                            @if ($existencia->disponibilidad_id == 1)
                            @include('encargado.existencias.devolver')
                            @endif
                        @endif
                        </a> --}}
                        @if ($existencia->disponibilidad_id == 1)
                        <a href="{{ route('existencias.prestar', ['existencia'=> $existencia->id]) }}" class="btn btn-success">Prestar</a> 
                        @endif
                        @if ($existencia->disponibilidad_id == 2)
                        <a href="{{ route('existencias.devolver', ['existencia'=> $existencia->id]) }}" class="btn btn-danger">Devolver</a> 
                        @endif
                        {{-- <a href="{{ route('existencias.edit', ['existencia'=> $existencia->id]) }}" class="btn btn-primary  mb-2">Editar</a>
                        <a href=""><form action="{{ route('existencias.destroy', ['existencia'=> $existencia->id]) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger text-white" style="border-top-left-radius: 0;border-bottom-left-radius: 0" type="submit">Eliminar</button>
                          </form></a> --}}
                        {{-- <a href="{{ route('existencias.show', ['existencia'=> $existencia->id]) }}" class="btn btn-success  mb-2">Ver</a> --}}
            
                                                
                    </td>
                </tr>
            @endforeach    
            </tbody>
        </table>
        </div>


            <!--button type="button" class="btn btn-primary mr-2" > Agregar Equipo </!--button-->
            {{-- <a href="{{route('admin')}}"class="btn btn-primary mr-2">Volver a Inicio</a> --}}

    </div>



</div>
@endsection
