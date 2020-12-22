@section('content_header')
        <div class="container-fluid" id="app">
            <div class="row">
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-9">
                                    <h6>Notificaciones Pendientes</h6>
                                </div>
                                <div class="col-md-3">
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
                                                <div class="col">Número de solicitud: {{ $notification->data['solicitud'] }} </div>
                                                <div class="col"> Equipo: {{ $notification->data['equipo'] }} </div>
                                                <div class="col"> Estudiante: {{ $notification->data['nombre'] }} {{ $notification->data['apellido'] }} </div>
                                                <div class="col">
                                                    <fecha-index fecha="Fecha Solicitada: {{ $notification->data['fecha_inicio'] }}"></fecha-index> /  <fecha-index fecha="{{ $notification->data['fecha_fin'] }}"></fecha-index>  
                                                </div>
                                                <div class="col">{{ $notification->created_at->diffForHumans()}}</div>
                                                <div class="col"> <button type="submit"  class="mark-as-read btn btn-sm btn-dark" data-id="{{ $notification->id }}" >Marcar como Leida</button></div> 
                                            </div>
                                        </div>
                                    @empty
                                        <span class="ml-3 pull-right text-muted text-sm"> Sin Notificaciones Por Leer</span>          
                                    @endforelse
                            </div>  
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
                <div class="col-md-3">
                    <div class="small-box bg-light">
                        <div class="inner">
                            @if(count($reservas) == 1)
                                    <h3>{{count($reservas)}}</h3>
                                    <p>Reserva hoy</p>
                            @endif
                            @if(count($reservas) > 1)
                                    <h3>{{count($reservas)}}</h3>
                                    <p>Reservas hoy</p>
                            @endif
                            @if(count($reservas) == 0)
                                <h3 class="text-uppercase">No hay</h3>
                                <p>Reservas hoy</p>
                            @endif
                        </div>
                        <div class="icon">
                            <i class="fas fa-exclamation"></i>
                        </div>
                        @if(count($reservas) > 0)
                        <a href="{{route('reservas.hoy')}}" class="small-box-footer">
                            Más información
                            <i class="fas fa-arrow-circle-right"></i>
                        </a>  
                        @else
                        @endif
                        

                    </div>
                </div>
            </div>
    </div>
@stop