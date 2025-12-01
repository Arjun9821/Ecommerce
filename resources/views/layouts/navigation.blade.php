<nav class="navbar navbar-expand-lg" style="background-color: #ff6600;">
    <div class="container">
        <!-- Logo + Website Name -->
        <a class="navbar-brand d-flex align-items-center text-white" href="{{ route('welcome') }}">
            <img src="{{ asset('images/logo.jpg') }}" alt="Click&Collect" style="height:50px;">
            <span class="ms-2 fw-bold text-white">Click&Collect</span>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" 
                data-bs-target="#navbarSupportedContent"
                style="border-color: white;">
            <span class="navbar-toggler-icon" style="filter: brightness(0) invert(1);"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto">

                <li class="nav-item">
                    <a class="nav-link text-white fw-semibold" href="{{ route('welcome') }}">Home</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-white fw-semibold" href="{{ route('shop.index') }}">Shop</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-white fw-semibold" href="{{ route('contact') }}">Contact</a>
                </li>

                @auth
                    <li class="nav-item">
                        <a class="nav-link text-white fw-semibold" href="{{ route('user.dashboard') }}">Dashboard</a>
                    </li>

                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="nav-link btn btn-link text-white fw-semibold" 
                                    type="submit" style="text-decoration:none;">
                                Logout
                            </button>
                        </form>
                    </li>

                @else
                    <li class="nav-item">
                        <a class="nav-link text-white fw-semibold" href="{{ route('login') }}">Login</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-white fw-semibold" href="{{ route('register') }}">Register</a>
                    </li>
                @endauth

            </ul>
        </div>
    </div>
</nav>
