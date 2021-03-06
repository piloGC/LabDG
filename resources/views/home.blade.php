@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                    
                    <a href="{{ url('equipos')}}">
                        <button type="button" class="btn btn-primary mr-2" > Ver Equipo </button>
                    </a>
                    <a href="{{ url('salas')}}">
                        <button type="button" class="btn btn-primary mr-2" > Ver Salas </button>

                    <a href="{{ url('sanciones')}}">
                        <button type="button" class="btn btn-primary mr-2" > Ver Sanciones </button>
                    </a>
                    <a href="{{ url('existencias')}}">
                        <button type="button" class="btn btn-primary mr-2" > Ver Existencias </button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
