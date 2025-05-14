<!-- Header / Navbar -->
<nav class="custom-nav-cls navbar navbar-expand-lg navbar-dark bg-transparent py-3">
    <div class="container">
        <a class="navbar-brand text-warning" href="{{ route('home') }}"><img
                src="{{ asset('web/images/logo-location-finder.png') }}" alt=""></a>
        <button class="cus-cls-toggle navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="cus-nav-links collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="nav-ul-cus navbar-nav align-items-center">
                <li class="nav-item"><a class="nav-link text-white" href="{{ route('home') }}">Home</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="{{ route('faqs') }}">Faqs</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="{{ route('find.location') }}">Find
                        Location</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="{{ route('contact-us') }}">Contact Us</a></li>
                @auth
                    <li class="nav-item mx-2">
                        <a href="{{ route('dashboard') }}" class="btn btn-outline">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('logout') }}" class="btn btn-bg"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                    </li>   
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                @else
                {{-- <div class="signin-singup"> --}}
                    <li class="singup nav-item mx-2">
                        <a href="{{ route('register.form') }}" class="btn btn-outline">Sign up</a>
                    </li>
                    <li class="signin nav-item">
                        <a href="{{ route('login.form') }}" class="btn btn-bg">Log In</a>
                    </li>
                {{-- </div> --}}
                @endauth
            </ul>
        </div>
    </div>
</nav>
