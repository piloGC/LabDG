@extends('adminlte::page')

@include('encargado.notificacion')
@include('encargado.cabecera')
@section('content')
<div class="row justify-content-center">@include('encargado.reportes.solicitudes')</div>
<div class="row justify-content-center mt-2">@include('encargado.reportes.sanciones')</div>


@endsection


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

