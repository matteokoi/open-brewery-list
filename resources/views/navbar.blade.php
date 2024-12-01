
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <!-- Search Form -->
        <form class="d-flex" role="search" method="GET" action="{{ route('search') }}">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="query">
            <button class="btn btn-outline-success btn-sm" type="submit">Search</button>
            <a href="{{ route('welcome') }}" type="submit" class="btn btn-outline-secondary btn-sm">Back</a>
        </form>

        <!-- User Info -->
        <div class="d-flex align-items-center ms-auto">
            @auth
                <span class="me-3">{{ auth()->user()->username }}</span>
                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger btn-sm">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="btn btn-outline-primary btn-sm">Login</a>
            @endauth
        </div>
    </div>
</nav>
