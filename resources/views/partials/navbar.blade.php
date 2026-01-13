<nav class="navbar navbar-expand-lg navbar-dark sticky-top">
    <div class="container">
        <a class="logo-group" href="/">
            <div class="logo-circle">
                <span class="bkl">BKL</span>
                <span class="cinema">CINEMA</span>
            </div>
            <div class="pick-ticket">Pick A Ticket</div>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                {{-- SỬA TẠI ĐÂY: Trỏ link về trang lịch chiếu --}}
                <li class="nav-item">
                    <a class="nav-link" href="/schedule">Lịch chiếu</a>
                </li>

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

            {{-- KIỂM TRA ĐĂNG NHẬP --}}
            @auth
                <div class="dropdown">
                    <a href="#"
                       class="d-flex align-items-center gap-2 text-white text-decoration-none dropdown-toggle"
                       role="button"
                       data-bs-toggle="dropdown"
                       aria-expanded="false">

                        {{-- Hiển thị avatar thực tế từ storage --}}
                        <img src="{{ Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : 'https://cdn-icons-png.flaticon.com/512/149/149071.png' }}"
                             class="user-avatar"
                             style="width:32px; height:32px; border-radius:50%; object-fit: cover;">
                        
                        <span class="small">{{ Auth::user()->name }}</span>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-end shadow">
                        <li>
                            <a class="dropdown-item" href="{{ route('profile.index') }}">
                                👤 Tài khoản
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button class="dropdown-item text-danger border-0 bg-transparent w-100 text-start">
                                    🚪 Đăng xuất
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            @else
                {{-- Nếu chưa đăng nhập thì hiện nút Đăng nhập --}}
                <a href="{{ route('login') }}" class="btn btn-outline-light btn-sm px-3" style="border-radius: 20px;">
                    Đăng nhập
                </a>
            @endauth
        </div>
    </div>
</nav>