@section('content_top_nav_right')
    <li class="nav-item dropdown">
        <a class="nav-link" href="/admin">     
            <i class="fas fa-bell"></i>
            @if (count(auth()->user()->unreadNotifications))
                <span class="badge badge-warning">{{ count(auth()->user()->unreadNotifications) }}</span>
            @endif
        </a>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link" href="/admin/perfil" data-toggle="tooltip" data-placement="top" title="Mi perfil">     
            <i class="fas fa-user mr-2"></i>{{auth()->user()->name}}
        </a>
    </li>
@endsection


@section('js')
 <script src="{{ asset('js/app.js')}}"></script> 
 <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.0/trix.js"
 integrity="sha512-S9EzTi2CZYAFbOUZVkVVqzeVpq+wG+JBFzG0YlfWAR7O8d+3nC+TTJr1KD3h4uh9aLbfKIJzIyTWZp5N/61k1g==" crossorigin="anonymous" defer></script>
 
@endsection
