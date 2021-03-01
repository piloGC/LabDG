@extends('adminlte::page')

@section('css')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.0/trix.css" integrity="sha512-EQF8N0EBjfC+2N2mlaH4tNWoUXqun/APQIuFmT1B+ThTttH9V1bA0Ors2/UyeQ55/7MK5ZaVviDabKbjcsnzYg==" crossorigin="anonymous" />
@endsection
@include('encargado.notificacion')
@section('content')
    <h1 class="text-center mb-5">Rechazar solicitud #{{$listarSolicitud->id}}</h1>

    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <form method ="POST" action="{{action ('ListarSolicitudController@cambiarEstadoRechazada',['listarSolicitud' => $listarSolicitud->id])}}" novalidate>
                @csrf
                @method('PUT')
                
                <div class="form-group">
                    <label for="motivo_estado">Motivo</label>
                    <input type="hidden" name="motivo_estado"  id="motivo_estado">
                    <trix-editor class="form-control @error ('motivo_estado') is-invalid @enderror"
                    placeholder="Breve descripción del motivo de la sanción" input="motivo_estado" style="overflow-y:auto"></trix-editor>
                    
                    @error('motivo_estado')
                    <span class="invalid_feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                    <div class="form-group float-right">
                        <a href="{{ url('/listarSolicitud/entrantes')}}"  class="btn btn-secondary"> Volver </a>
                        <input type="submit" class="btn btn-success" value="Rechazar solicitud">
                    </div>
            </form>
        </div>
    </div>
@endsection
