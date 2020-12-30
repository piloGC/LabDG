@extends('adminlte::page')

@include('encargado.notificacion')
@include('encargado.cabecera')
@section('content')
<div class="row justify-content-center mt-4">
  {{-- <div class="container-fluid ">
    <div class="row p-2"> --}}
        <div class="col-md-6 ">
  <div class="card ">
    <div class="card-header"> 
      <h4 class="font-weight-bold text-uppercase float-left mb-0">reporte solicitudes</h4>
        <ul class="nav nav-tabs card-header-tabs pull-right float-right"  id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="mensual-tab" data-toggle="tab" href="#mensual" role="tab" aria-controls="mensual" aria-selected="true">Mensual</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="anual-tab" data-toggle="tab" href="#anual" role="tab" aria-controls="anual" aria-selected="false">Anual</a>
            </li>
        </ul>
    </div>
  
    <div class="card-body">
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="mensual" role="tabpanel" aria-labelledby="mensual-tab">@include('encargado.reportes.solicitudesMes')</div>
            <div class="tab-pane fade" id="anual" role="tabpanel" aria-labelledby="anual-tab">@include('encargado.reportes.solicitudesAnio')</div>
        </div>
    {{-- </div>
  </div> --}}
</div></div></div>
<div class="col-md-6 ">@include('encargado.reportes.buscarSolicitud')</div>

</div>

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

