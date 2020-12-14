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
            <i class="fas fa-user"></i>
        </a>
    </li>
@endsection