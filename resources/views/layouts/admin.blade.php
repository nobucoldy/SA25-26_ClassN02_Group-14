<!DOCTYPE html>
<html>
<head>
    <title>Admin - Cinema</title>
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>

<nav class="navbar navbar-dark bg-dark px-3">
    <a class="navbar-brand" href="{{ route('admin.dashboard') }}">Cinema Admin</a>
    <div>
        <a class="text-white me-3" href="{{ route('admin.movies.index') }}">Movies</a>
        <a class="text-white me-3" href="{{ route('admin.showtimes.index') }}">Showtimes</a>
        <a class="text-white me-3" href="{{ route('admin.bookings.index') }}">Bookings</a>
        <a class="text-white" href="{{ route('admin.users.index') }}">Users</a>
    </div>
</nav>

<div class="container mt-4">
    @yield('content')
</div>

</body>
</html>
