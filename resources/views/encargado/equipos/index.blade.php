@extends('adminlte::page')

@section('plugins.Sweetalert2', true)
@section('content')
    
    <h1 class="text-center ">Control de Equipos</h1>
    <a href="{{route('equipos.create')}}" class="btn btn-secondary">Agregar Equipo</a>
    <div class="container mx-auto bg-white">
        <div class="table-responsive">
        <table class="table table-hover">
            <thead class="bg-olive text-light ">
                <tr class="table-active">
                    <th scole="col">#</th>
                    <th scole="col">Categoria</th>
                    <th scole="col">Nombre</th>
                  {{--  <th scole="col">Marca</th>
                    <th scole="col">Modelo</th>
                    <th scole="col">Descripción</th> --}}
                    <th scole="col">Imagen</th>
                    <th scole="col">En Catalogo</th>
                    <th scole="col">Acciones</th>
                </tr>
            </thead>

            <tbody>

                @foreach($equipos as $equipo)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$equipo->categoria->nombre}}</td>
                    <td>{{$equipo->nombre}}</td>
                {{--    <td>{{$equipo->marca}}</td>
                    <td>{{$equipo->modelo}}</td>
                    <td>{{$equipo->descripcion}}</td> --}}
                    <td>{{--$equipo->imagen--}}
                        <img src="/storage/{{$equipo->imagen}}" style="width:100px" ></td>
                    <td>{{$equipo->catalogo->disponible}}</td>
                    <td>
                      {{--  <form action="{{ route('equipos.destroy',['equipo' => $equipo->id])}}"  method="post"> --}}
                        {{-- <a href="{{ route('equipos.edit', ['equipo'=> $equipo->id]) }}" class="btn btn-primary  mb-2">Editar</a>
                        <a href="{{ route('equipos.show', ['equipo'=> $equipo->id]) }}" class="btn btn-success  mb-2">Ver</a>
                        {{-- <eliminar-equipo equipo-id={{$equipo->id}}></eliminar-equipo> --}}
                        {{-- <a href=""><form action="{{ route('equipos.destroy', ['equipo'=> $equipo->id]) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger mb-2" type="submit">Eliminar</button>
                          </form>
                        </a>  --}}
                        <div class="btn-group mr-1" role="group">
                            <a href="{{ route('equipos.show', ['equipo'=> $equipo->id]) }}" class="btn btn-info  mb-2">Ver</a>
                            <a href="{{ route('equipos.edit', ['equipo'=> $equipo->id]) }}" class="btn btn-success  mb-2">Editar</a>
                            <a href=""><form action="{{ route('equipos.destroy', ['equipo'=> $equipo->id]) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger text-white" style="border-top-left-radius: 0;border-bottom-left-radius: 0" type="submit">Eliminar</button>
                              </form></a>
                          </div> 
                                                
                    </td>
                </tr>
            @endforeach    
            </tbody>
        </table>
        </div>
            
            <!--button type="button" class="btn btn-primary mr-2" > Agregar Equipo </!--button-->
            {{-- <a href="{{route('admin')}}" class="btn btn-primary mr-2">Volver a Inicio</a> --}}

    </div>



</div>
@stop



@section('js')
{{--  <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>  --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    @if(session('eliminar') == 'ok')
    <script>
        Swal.fire('Equipo eliminada', 'Se eliminó el equipo', 'success')
    </script>
@endif
<script>
$('.formulario-eliminar').submit(function(e)){
    e.preventDefault();

    Swal.fire({
        title: "¿Desea eliminar esta equipo?",
        text: "Una vez eliminada no se puede recuperar",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si",
        cancelButtonText: "No",
      }).then((result) => {
        if (result.value) {
            this.submit();

        }
      })
    }
</script>    
   
@stop

