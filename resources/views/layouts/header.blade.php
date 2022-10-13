<header class="laundry-header-transparent">
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="{{url('/')}}">
                <h1>Laravel Base</h1>
            </a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-lg-auto align-items-center mr-lg-20 order-2 order-lg-1">
                    <li class="nav-item d-lg-none">
                        <a class="nav-link" href="{{url('/')}}">
                            <img src="{{ asset('public/assets/images/logo.svg') }}" alt="laundry" width="80%">
                        </a>
                    </li>
                    @guest
                    <li class="nav-item  ">
                        <a class="nav-link btn btn-bg" href="{{url('/register')}}">Sign-up</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link btn btn-bg " href="{{url('/login')}}">Log-in</a>
                    </li>
                    @endguest
                    @if (Auth::check())
                    <li class="nav-item dropdown ProfileDrop">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span>{{Auth::User()->name}}</span>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ url('/dashboard') }}">
                                <i class="far fa-tachometer"></i>
                                <span>Dashboard</span>
                            </a>
                            <a class="dropdown-item" href="{{ url('/dashboard/myprofile') }}">
                                <i class="far fa-user"></i>
                                <span>My Profile</span>
                            </a>
                            <!-- here goes logout-->
                            <a class="dropdown-item" href="" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="far fa-sign-out"></i> <span>{{ __('Logout') }}</span>
                            </a>
                            <form id="logout-form" action="" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
</header>