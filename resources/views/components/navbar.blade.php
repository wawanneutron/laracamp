<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container">
        <a class="navbar-brand" href="/">
            <img src="{{ asset('/assets/images/logo.png') }}" alt="">
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
            @auth
                <div class="d-flex user-logged dropdown">
                    <a href="#" id="dropdownUser" data-bs-toggle="dropdown" aria-expanded="false">
                        Helo, {{ auth()->user()->name }}!
                        <img src="{{ auth()->user()->avatar }}"  class="user-photo rounded-circle shadow">
                        <ul class="dropdown-menu" aria-labelledby="dropdownUser" style="right: 0; left: auto;">
                            <li><a class="dropdown-item" href="{{ route('dashboard-laracamp') }}">My Dashboard</a></li>
                            <li>
                                <a class="dropdown-item" href="#" onclick="logout(event)">Sign Out</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="post">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                </form>
                            </li>
                        </ul>
                    </a>
                </div>
            @else
                <div class="d-flex">
                    <a href="/login" class="btn btn-master btn-secondary me-3">
                        Sign In
                    </a>
                    <a href="/login" class="btn btn-master btn-primary">
                        Sign Up
                    </a>
                </div>
            @endauth
        </div>
    </div>
</nav>

<script>
    function logout(event){
        const check = confirm('Yakin ingin keluar?');
        if (check) {
            document.getElementById('logout-form').submit();
        }
    }
</script>