<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">
            <img src="{{ asset('laracamp-template/assets/images/logo.png') }}" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Program</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Mentor</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Pricing</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Business</a>
                </li>
            </ul>

            {{-- Jika User Login --}}
            @auth
                <div class="d-flex user-logged nav-item dropdown no-arrow">
                    <a href="#" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                        Halo, {{ \Illuminate\Support\Str::of(Auth::user()->name)->words(1, '') }}!
                        @if (Auth::user()->avatar)
                            <img src="{{ Auth::user()->avatar }}" class="user-photo rounded-circle" alt="">
                        @else
                            <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}" class="user-photo rounded-circle" alt="">
                        @endif
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink" style="right: 0; left: auto">
                            <li>
                                <a href="{{ route('dashboard') }}" class="dropdown-item">
                                    My Dashboard
                                </a>
                            </li>
                            <li>
                                <a href="#" class="dropdown-item">
                                    Settings
                                </a>
                            </li>
                            <hr>
                            <li>
                                <a href="#" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit()">
                                    Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                </form>
                            </li>
                        </ul>
                    </a>
                </div>
            @endauth

            {{-- Jika Belum Login --}}
            @guest
                <div class="d-flex">
                    <a href="{{ route('login') }}" class="btn btn-master btn-secondary me-3">
                        Sign In
                    </a>
                    <a href="{{ route('login') }}" class="btn btn-master btn-primary">
                        Sign Up
                    </a>
                </div>
            @endguest
        </div>
    </div>
</nav>