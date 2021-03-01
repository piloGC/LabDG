@section('content_top_nav_right')
    <li class="nav-item dropdown">
        <a class="nav-link" href="{{ route('admin') }}">     
            <i class="fas fa-bell"></i>
            @if (count(auth()->user()->unreadNotifications))
                <span class="badge badge-warning">{{ count(auth()->user()->unreadNotifications) }}</span>
            @endif
        </a>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link" href="{{ route('admin.perfil') }}" data-toggle="tooltip" data-placement="top" title="Mi perfil">     
            <i class="fas fa-user mr-2"></i>{{auth()->user()->name}}
        </a>
    </li>
@endsection

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.0/trix.css"
        integrity="sha512-EQF8N0EBjfC+2N2mlaH4tNWoUXqun/APQIuFmT1B+ThTttH9V1bA0Ors2/UyeQ55/7MK5ZaVviDabKbjcsnzYg=="
        crossorigin="anonymous" />
@endsection


@section('js')
 <script src="{{ asset('js/app.js')}}"></script> 


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


  <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.0/trix.js"
 integrity="sha512-S9EzTi2CZYAFbOUZVkVVqzeVpq+wG+JBFzG0YlfWAR7O8d+3nC+TTJr1KD3h4uh9aLbfKIJzIyTWZp5N/61k1g==" 
 crossorigin="anonymous" defer></script>
@endsection
