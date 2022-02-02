<nav class="navbar navbar-header navbar-expand navbar-light">
    <a class="sidebar-toggler"><span class="navbar-toggler-icon"></span></a>
    <button class="btn navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav d-flex align-items-center navbar-light ms-auto">
            <li class="dropdown">
                <a href="#" data-bs-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                    <div class="avatar me-1">
                        <i class="fas fa-user-cog"></i>
                    </div>
                    @auth
                    <div class="d-none d-md-block d-lg-inline-block">Hi, {{Auth::user()->name}}</div>
                    @endauth
                    @guest
                    <div class="d-none d-md-block d-lg-inline-block">Hi, My Friend</div>
                    @endguest
                </a>
                <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="#"><i data-feather="user"></i> Account</a>
                    <a class="dropdown-item" href="#"><i data-feather="mail"></i> Messages</a>
                    <a class="dropdown-item" href="#"><i data-feather="settings"></i> Settings</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{route('logout')}}"><i data-feather="log-out"></i> Logout</a>
                </div>
            </li>
        </ul>
    </div>
</nav>
