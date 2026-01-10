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
                    <a class="nav-link" href="{{ route('review.index') }}">Đánh giá</a>
                </li>
            </ul>

            <div class="dropdown">
    <a href="#"
       class="d-flex align-items-center gap-2 text-white text-decoration-none dropdown-toggle"
       role="button"
       data-bs-toggle="dropdown"
       aria-expanded="false">

        <img src="https://i.pravatar.cc/100"
             class="user-avatar"
             style="width:32px;height:32px;border-radius:50%">
        <span class="small">{{ Auth::user()->name }}</span>
    </a>

    <ul class="dropdown-menu dropdown-menu-end">
        <li>
            <a class="dropdown-item" href="{{ route('profile.index') }}">
                👤 Tài khoản
            </a>
        </li>
        <li><hr class="dropdown-divider"></li>
        <li>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="dropdown-item text-danger">
                    🚪 Đăng xuất
                </button>
            </form>
        </li>
    </ul>
</div>

        </div>
    </div>
</nav>
