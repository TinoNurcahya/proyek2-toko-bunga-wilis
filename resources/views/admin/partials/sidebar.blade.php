<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <span class="navbar-brand ml-2 font-weight-bold">Willis Garden - Admin</span>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item"><a class="nav-link" href="#"><i class="fas fa-search"></i></a></li>
        <li class="nav-item"><a class="nav-link" href="#"><i class="fas fa-cog"></i></a></li>
        <li class="nav-item"><a class="nav-link" href="#"><i class="far fa-bell"></i></a></li>
        <li class="nav-item">
            <form method="POST" action="{{ route('logout') }}">@csrf
                <button class="btn btn-danger btn-sm">Logout</button>
            </form>
        </li>
    </ul>
</nav>
