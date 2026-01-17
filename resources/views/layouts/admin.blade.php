<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin - Cinema</title>

    {{-- Bootstrap CSS --}}
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>

<body>

{{-- NAVBAR --}}
<nav class="navbar navbar-dark bg-dark px-3">
    <a class="navbar-brand d-flex align-items-center" href="{{ route('admin.dashboard') }}">
        <img src="{{ asset('storage/logo2.jpg') }}"
             alt="Logo"
             width="30"
             height="30"
             class="me-2 rounded-circle">
        BKL Cinema Admin
    </a>

    <div>
        <a class="text-white me-3" href="{{ route('admin.movies.index') }}">Movies</a>
        <a class="text-white me-3" href="{{ route('admin.showtimes.index') }}">Showtimes</a>
        <a class="text-white me-3" href="{{ route('admin.bookings.index') }}">Bookings</a>
        <a class="text-white" href="{{ route('admin.users.index') }}">Users</a>
    </div>
</nav>

{{-- TOAST --}}
<div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 9999">

    @if(session('success'))
        <div class="toast text-bg-success border-0"
             role="alert"
             data-bs-delay="2500">
            <div class="d-flex">
                <div class="toast-body">
                    ✅ {{ session('success') }}
                </div>
                <button type="button"
                        class="btn-close btn-close-white me-2 m-auto"
                        data-bs-dismiss="toast"></button>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="toast text-bg-danger border-0"
             role="alert"
             data-bs-delay="2500">
            <div class="d-flex">
                <div class="toast-body">
                    ❌ {{ session('error') }}
                </div>
                <button type="button"
                        class="btn-close btn-close-white me-2 m-auto"
                        data-bs-dismiss="toast"></button>
            </div>
        </div>
    @endif

</div>

{{-- CONTENT --}}
<div class="container mt-4">
    @yield('content')
</div>

{{-- Bootstrap JS --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

{{-- Toast Auto Show --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const toastElList = document.querySelectorAll('.toast')
        toastElList.forEach(function (toastEl) {
            const toast = new bootstrap.Toast(toastEl, {
                delay: 2500
            })
            toast.show()
        })
    })
</script>

</body>
</html>
