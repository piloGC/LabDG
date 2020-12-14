@extends('adminlte::page')

@include('encargado.notificacion')
@section('content_header')
    <div class="content">

        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">

                            <div class="row">
                                {{-- <div class="col-sm-2">
                                    <a class="nav-link" data-toggle="dropdown" href="#">     
                                        <i class="fas fa-bell"></i>
                                        @if (count(auth()->user()->unreadNotifications))
                                            <span class="badge badge-warning">{{ count(auth()->user()->unreadNotifications) }}</span>
                                        @endif
                                    </a>
                                </div> --}}
                                <div class="col-sm-10">
                                    <span class="dropdown-header">Notificaciones Pendientes</span>
                                </div>
                                <div class="col-sm-2">
                                    @if (count(auth()->user()->unreadNotifications)>0)
                                            <a href="{{ route('markAsRead') }}" class="btn btn-sm btn-dark">Marcar Todas como Leidas</a>
                                    @endif
                                </div>
                            </div>
                                
                        </div>
                        <div class="row">
                        {{--  <div class="col-sm-8">  --}}
                            <div class="card-body">
                                {{--  <span class="dropdown-header">Notificaciones Pendientes</span>  --}}
                                @forelse(auth()->user()->unreadNotifications as $notification)
                                        <div class="alert alert-default-danger">
                                            <div class="row">
                                                <div class="col-md-2">Solicitud ID: {{ $notification->data['solicitud'] }} </div>
                                                <div class="col-md-2"> Equipo: {{ $notification->data['equipo'] }} </div>
                                                <div class="col-md-2"> Estudiante: {{ $notification->data['nombre'] }} {{ $notification->data['apellido'] }} </div>
                                                <div class="col-md-3">Fecha Solicitada: {{ $notification->data['fecha_inicio'] }}  / {{ $notification->data['fecha_fin'] }} </div>
                                                <div class="col-md-1">{{ $notification->created_at->diffForHumans()}}</div>
                                                <div class="col-md-2-left"> <button type="submit"  class="mark-as-read btn btn-sm btn-dark" data-id="{{ $notification->id }}" >Marcar como Leida</button></div> 
                                            </div>
                                        </div>
                                    @empty
                                        <span class="ml-3 pull-right text-muted text-sm"> Sin Notificaciones Por Leer</span>          
                                    @endforelse
                            </div>  


                        {{--  </div>  --}}
                        {{--  <div class="col-sm-6">
                            <div class="card-body">
                                <span class="dropdown-header">Notificaciones Leidas</span> 
                                @forelse (auth()->user()->readNotifications as $notification)

                                    <div class="alert alert-default-warning">
                                        <div class="row">
                                            <div class="col-md-2">Solicitud ID: {{ $notification->data['solicitud'] }} </div>
                                            <div class="col-md-2"> Equipo ID: {{ $notification->data['existencia'] }} </div>
                                            <div class="col-md-6">Fecha Solicitada: {{ $notification->data['fecha_inicio'] }}  / {{ $notification->data['fecha_fin'] }} </div>
                                            <p>{{ $notification->created_at->diffForHumans() }}</p>
                                        </div>
                                    </div>
                                @empty
                                <span class="ml-3 pull-right text-muted text-sm">Sin Notificaciones Leidas</span>
                                @endforelse
                            </div>
                        </div>  --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@stop



@section('js')
<script>
  function sendMarkRequest(id = null){
    return $.ajax("{{ route('markNotification') }}", {
      method: 'POST',
      data: {
        _token: "{{ csrf_token() }}",
        id
      }
    });
  }
  $(function(){
    $('.mark-as-read').click(function(){
      let request = sendMarkRequest($(this).data('id'));
      request.done(() => {
        $(this).parents('div.alert').remove();
      });
      window.location.reload(); 
    });
  });
</script>
@stop

