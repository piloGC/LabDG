@extends('adminlte::page')

@section('content_header')
    <p>[podrían ir las notificaciones aqui]</p>
@endsection

@section('content')

<body>
    <div id="app">
        <example-component></example-component>
        <eliminar-existencia></eliminar-existencia>
    </div>
     
    </body>

@endsection
{{-- 
@section('footer')
    <p class="text-center">Footer de prueba</p>
@stop --}}

@section('js')
     {{-- <script>
      Swal.fire(
            'Good job!',
            'You clicked the button!',
            'success'
        )
 </script>  --}}

 <script src="{{ asset('js/app.js')}}"></script> 
@endsection