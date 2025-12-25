<!DOCTYPE html>
<html>
<head>
    <title>Cinema Booking</title>
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>

<nav class="navbar navbar-dark bg-dark px-3">
    <a class="navbar-brand" href="/">Cinema</a>

    <div class="d-flex gap-3">
        <a class="text-white text-decoration-none" href="/movies">Movies</a>

        @guest
            <a class="text-white text-decoration-none" href="/login">Login</a>
            <a class="text-white text-decoration-none" href="/register">Register</a>
        @endguest

        @auth
            <span class="text-white">
                Hello, {{ auth()->user()->name }}
            </span>

            <form method="POST" action="/logout" class="d-inline">
                @csrf
                <button class="btn btn-sm btn-danger">Logout</button>
            </form>
        @endauth
    </div>
</nav>

<div class="container mt-4">
    @yield('content')
</div>

</body>
</html>
