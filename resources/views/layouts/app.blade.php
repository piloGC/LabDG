<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Sistema de Préstamos DG</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <!-- Fonts -->

    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- cargar hoja de estilos-->
    @yield('styles')

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm" >
            <div class="container">
                <a class="navbar-brand" href="/">
                    {{-- {{ config('app.name', 'Laravel') }} --}}
                    <img src="../../vendor/img/LOGOH.png" alt="Logo" height="70px">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item  ">
                            <a class="nav-link1 text-dark" href="/"><b>INICIO</b></a>
                        </li>
                        <li class="nav-item  dropdown">
                            <a class="nav-link2 text-dark" href="/catalogo" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <b>CATÁLOGO</b>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">                                
                                <a class="dropdown-item" href="{{route('catalogo.fotograficas')}}">Cámaras fotográficas</a>
                                <a class="dropdown-item" href="{{route('catalogo.videos')}}">Cámaras de video</a>
                                <a class="dropdown-item" href="{{route('catalogo.tripodes')}}">Trípodes</a>
                                <a class="dropdown-item" href="{{route('catalogo.tabletas')}}">Tabletas</a>
                                <a class="dropdown-item" href="{{route('catalogo.lectores')}}">Lectores de DVD</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{route('catalogo.equipos')}}">Todos los equipos</a>
                              </div>
                            
                        </li>
                        <li class="nav-item  ">
                            <a class="nav-link3 text-dark" href="{{ route('solicitud.create') }}"><b>SOLICITUD DE PRÉSTAMO</b></a>
                        </li>
                        <li class="nav-item  ">
                            <a class="nav-link4 text-dark" href="#"><b>HORARIOS</b></a>
                        </li>
                        <li class="nav-item  ">
                            <a class="nav-link5 text-dark" href="{{ route('reglamentos.index') }}"><b>REGLAMENTO</b></a>
                        </li>

                          
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="/perfil">
                                        {{ __('Mi Perfil') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('solicitud.index') }}">
                                        {{ __('Mis Solicitudes') }}
                                    </a>
                                    <a class="dropdown-item" href="#">
                                        {{ __('Mis Sanciones') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Cerrar Sesion') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <main >
            <div class="container-fluid">
                @if (session('mensaje'))
                    <div class="row mb-2 ">
                        <div class="col-lg-12 py-2">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <h3>{{session('mensaje')}}</h3>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            @yield('content')
        </main>
    </div>
    <script src="/us/app.js"></script>
    @yield('scripts')
</body>
</html>
