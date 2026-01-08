<nav class="navbar navbar-expand-lg navbar-dark sticky-top">
    <div class="container">
        <a class="logo-group" href="/">
            <div class="logo-circle">
                <span class="bkl">BKL</span>
                <span class="cinema">CINEMA</span>
            </div>
            <div class="pick-ticket">Pick A Ticket</div>
        </a>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item"><a class="nav-link" href="#">Lịch chiếu</a></li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                        Phim
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('movies.status') }}">Phim đang chiếu</a></li>
                        <li><a class="dropdown-item" href="{{ route('movies.upcoming') }}">Phim sắp chiếu</a></li>
                    </ul>
                </li>

                <li class="nav-item"><a class="nav-link" href="#">Rạp phim</a></li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('reviews.index') }}">Đánh giá</a>
                </li>
            </ul>

            <div class="d-flex align-items-center gap-2">
                @guest
                    <a href="{{ route('login') }}" class="login-link">Đăng nhập</a>
                @else
                    <span class="text-white small me-1">{{ Auth::user()->name }}</span>
                    <img src="https://i.pravatar.cc/100" class="user-avatar">
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-link nav-link p-0" style="font-size:12px">Thoát</button>
                    </form>
                @endguest
            </div>
        </div>
    </div>
</nav>
