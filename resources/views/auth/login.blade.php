
 <meta name="viewport" content="width=device-width, initial-scale=1">
<link href="{{ asset('css/app.css') }}" rel="stylesheet">

<!------ Include the above in your HEAD tag ---------->
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<body style="background-image:url({{ asset('/images/fondo11.png') }})">
    <div class="container login-container">
      <div class="row ">
        <div class="col-md-6 ads">
          <h1><span id="fl">Laboratorio </span><span id="sl">Diseño Gráfico</span></h1>
        </div>
        <div class="col-md-6 login-form bg-white">
            <h3>Bienvenido!</h3>
            {{-- <h3>Iniciar Sesión</h3> --}}
           <p><small>Utilice las credenciales proporcionadas</small></p> 
          <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group row">
                <label for="run" class="col-md-4 col-form-label text-md-right">{{ __('Run') }}</label>
                
                <div class="col-md-6">
                    <input id="run" type="text" 
                     placeholder="Ingrese con puntos y guión"
                    class="form-control @error('run') is-invalid @enderror" 
                    name="run" value="{{ old('run') }}" required autocomplete="run" autofocus>
                   
                    @error('run')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                <div class="col-md-6">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <!--div class="form-group row">
                <div class="col-md-6 offset-md-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                        <label class="form-check-label" for="remember">
                            {{ __('Remember Me') }}
                        </label>
                    </div>
                </div>
            </!--div-->

            <div class="form-group row ">
                <div class="col-md-8 offset-md-4">
                    <button type="submit" class="btn btn-outline-info">
                        {{ __('Ingresar') }}
                    </button>

                   
                </div>
            </div>
        </form>


        
        </div>
      </div>
    </div>