<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'BKL Cinema - Giao diện Tổng thể')</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&family=Oswald:wght@700&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        :root {
            --bkl-red: #ff0000;
            --bkl-yellow: #ffeb3b;
            --dark-bg: #000000;
            --gray-section: #a3a3a3;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #fff;
            margin: 0;
            color: #333;
        }

        /* --- 1. NAVBAR --- */
        .navbar {
            background-color: var(--dark-bg) !important;
            padding: 10px 0;
            border-bottom: 1px solid #222;
        }

        .logo-group {
            display: flex;
            align-items: center;
            text-decoration: none !important;
        }

        .logo-circle {
            width: 45px;
            height: 45px;
            background-color: var(--bkl-red);
            border-radius: 50%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            line-height: 1;
        }

        .logo-circle .bkl { color: var(--bkl-yellow); font-family: 'Oswald'; font-size: 14px; font-weight: bold; }
        .logo-circle .cinema { color: #fff; font-size: 7px; text-transform: uppercase; }

        .pick-ticket {
            color: var(--bkl-yellow);
            font-family: 'Oswald';
            font-size: 14px;
            text-transform: uppercase;
            width: 40px;
            margin-left: 10px;
            line-height: 1.1;
        }

        .nav-link {
            color: #fff !important;
            font-size: 14px;
            font-weight: 300;
            margin: 0 10px;
            transition: 0.3s;
        }

        .nav-link:hover { color: var(--bkl-yellow) !important; }

        /* --- HIỆU ỨNG HOVER DROPDOWN PHIM --- */
        @media (min-width: 992px) {
            .nav-item.dropdown:hover .dropdown-menu {
                display: block;
                margin-top: 0;
            }
        }
        
        .dropdown-menu {
            background-color: #1a1a1a;
            border: 1px solid #333;
            border-radius: 8px;
            padding: 10px 0;
        }

        .dropdown-item {
            color: #fff;
            font-size: 13px;
            padding: 8px 20px;
            transition: 0.2s;
        }

        .dropdown-item:hover {
            background-color: var(--bkl-red);
            color: #fff;
        }

        .login-link {
            color: #fff !important;
            text-decoration: none !important;
            font-size: 14px;
            font-weight: 400;
            transition: 0.3s;
            cursor: pointer;
        }

        .login-link:hover { color: var(--bkl-yellow) !important; }

        .user-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            object-fit: cover;
            border: 1px solid #fff;
            cursor: pointer;
        }

        /* --- 2. HERO BANNER --- */
        .hero-section {
            height: 65vh;
            background: linear-gradient(to bottom, rgba(0,0,0,0) 50%, rgba(0,0,0,0.9) 100%), 
                        url('https://images8.alphacoders.com/124/1248358.jpg');
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: flex-end;
            justify-content: center;
            padding-bottom: 40px;
            border-top: 4px solid #00d2ff;
        }

        .movie-title-logo {
            width: 100%;
            max-width: 400px;
            filter: drop-shadow(0 0 15px rgba(0,210,255,0.8));
        }

        /* --- 3. MOVIE CARDS --- */
        .section-header {
            font-family: 'Oswald';
            text-transform: uppercase;
            letter-spacing: 2px;
            font-size: 1.6rem;
            margin-bottom: 40px;
        }

        .movie-card {
            transition: transform 0.4s ease;
            cursor: pointer;
            margin-bottom: 30px;
        }

        .movie-card:hover { transform: scale(1.05); }

        .movie-card img {
            width: 100%;
            aspect-ratio: 2/3;
            object-fit: cover;
            border-radius: 6px;
            box-shadow: 0 15px 30px rgba(0,0,0,0.5);
        }

        .movie-name {
            font-size: 13px;
            font-weight: 600;
            margin-top: 15px;
            text-align: center;
        }

        /* --- 4. SCHEDULE SECTION --- */
        .schedule-container {
            background: #fff;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 25px rgba(0,0,0,0.1);
            max-width: 950px;
            margin: 0 auto;
        }

        .schedule-sidebar {
            background: #fafafa;
            border-right: 1px solid #eee;
            padding: 25px;
        }

        .theater-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px;
            font-size: 14px;
            cursor: pointer;
            border-radius: 8px;
            transition: 0.2s;
        }

        .theater-item:hover { background: #f0f0f0; }

        /* --- 5. FOOTER --- */
        .footer {
            background-color: var(--dark-bg);
            padding: 40px 0;
            border-top: 1px solid #222;
        }

        .social-icons i {
            color: #fff;
            font-size: 22px;
            margin-left: 25px;
            transition: 0.3s;
            cursor: pointer;
        }

        .social-icons i:hover { color: var(--bkl-red); }
    </style>
</head>
<body>

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
                        <a class="nav-link dropdown-toggle" href="#" id="movieDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Phim
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="movieDropdown">
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
                        <img src="https://i.pravatar.cc/100" class="user-avatar" alt="User">
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-link nav-link p-0" style="font-size: 12px; text-decoration: none;">Thoát</button>
                        </form>
                    @endguest
                </div>
            </div>
        </div>
    </nav>

    @if(Request::is('/'))
        {{-- CHỈ HIỂN THỊ CÁC PHẦN TRANG CHỦ KHI ĐÚNG ĐỊA CHỈ "/" --}}
        <header class="hero-section">
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/b0/Avatar-Te-Vaka-Logo.svg/1200px-Avatar-Te-Vaka-Logo.svg.png" class="movie-title-logo" alt="Avatar">
        </header>

        <section class="py-5 bg-black text-white">
            <div class="container text-center">
                <h2 class="section-header">PHIM ĐANG CHIẾU</h2>
                <div class="row">
                    <div class="col-6 col-md-3 movie-card">
                        <img src="https://m.media-amazon.com/images/M/MV5BMzVjZWUzOTUtYmZlNC00Y2VmLTlhMDktZTM4YmI3ZGRmN2EzXkEyXkFqcGdeQXVyMTEyMjM2NDc2._V1_.jpg" alt="Avatar 3">
                        <p class="movie-name">Avatar 3: Lửa và Tro Tàn</p>
                    </div>
                    <div class="col-6 col-md-3 movie-card">
                        <img src="https://m.media-amazon.com/images/M/MV5BOTMyMjEyNzIzMV5BMl5BanBnXkFtZTgwNzMzNjgzOTE@._V1_.jpg" alt="Zootopia">
                        <p class="movie-name">ZOOTOPIA 2</p>
                    </div>
                    <div class="col-6 col-md-3 movie-card">
                        <img src="https://m.media-amazon.com/images/M/MV5BYjFkMTlkYWUtZWFhNy00M2FmLThiY2YtYmI3ZTk2YmI5NWEwXkEyXkFqcGdeQXVyMTUzMTg2ODkz._V1_.jpg" alt="Totoro">
                        <p class="movie-name">My Neighbor Totoro</p>
                    </div>
                    <div class="col-6 col-md-3 movie-card">
                        <img src="https://m.media-amazon.com/images/M/MV5BYzE3ODhiNzAtOWY4MS00YzNlLThmY2ItZDRkY2RhYWI1ZTAyXkEyXkFqcGdeQXVyMTMxODk2OTU@._V1_.jpg" alt="Tom Jerry">
                        <p class="movie-name">Tom & Jerry</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-5" style="background-color: var(--gray-section);">
            <div class="container text-center">
                <h2 class="section-header text-white">PHIM SẮP CHIẾU</h2>
                <div class="row">
                    <div class="col-6 col-md-3 movie-card">
                        <img src="https://m.media-amazon.com/images/M/MV5BMzVjZWUzOTUtYmZlNC00Y2VmLTlhMDktZTM4YmI3ZGRmN2EzXkEyXkFqcGdeQXVyMTEyMjM2NDc2._V1_.jpg" alt="Avatar 3">
                        <p class="movie-name text-white">Avatar 3</p>
                    </div>
                    <div class="col-6 col-md-3 movie-card">
                        <img src="https://m.media-amazon.com/images/M/MV5BOTMyMjEyNzIzMV5BMl5BanBnXkFtZTgwNzMzNjgzOTE@._V1_.jpg" alt="Zootopia">
                        <p class="movie-name text-white">Zootopia 2</p>
                    </div>
                    <div class="col-6 col-md-3 movie-card">
                        <img src="https://m.media-amazon.com/images/M/MV5BYjFkMTlkYWUtZWFhNy00M2FmLThiY2YtYmI3ZTk2YmI5NWEwXkEyXkFqcGdeQXVyMTUzMTg2ODkz._V1_.jpg" alt="Totoro">
                        <p class="movie-name text-white">My Neighbor Totoro</p>
                    </div>
                    <div class="col-6 col-md-3 movie-card">
                        <img src="https://m.media-amazon.com/images/M/MV5BYzE3ODhiNzAtOWY4MS00YzNlLThmY2ItZDRkY2RhYWI1ZTAyXkEyXkFqcGdeQXVyMTMxODk2OTU@._V1_.jpg" alt="Tom Jerry">
                        <p class="movie-name text-white">Tom & Jerry</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-5 bg-light">
            <div class="container">
                <h2 class="section-header text-center mb-5" style="color: #333;">LỊCH CHIẾU PHIM</h2>
                <div class="schedule-container">
                    <div class="row g-0">
                        <div class="col-md-4 schedule-sidebar">
                            <input type="text" class="form-control mb-3" placeholder="Tìm kiếm rạp...">
                            <div class="theater-list">
                                <div class="theater-item"><span style="color:red">●</span> CGV Vincom Royal</div>
                                <div class="theater-item"><span style="color:orange">●</span> Lotte Cinema</div>
                                <div class="theater-item"><span style="color:yellow; text-shadow: 0 0 1px #000;">●</span> BKL Cinema Hà Đông</div>
                                <div class="theater-item"><span style="color:green">●</span> Beta Cinema</div>
                            </div>
                        </div>
                        <div class="col-md-8 d-flex align-items-center justify-content-center py-5 bg-white">
                            <div class="text-center">
                                 <img src="https://img.icons8.com/clouds/150/video.png" alt="Empty">
                                 <p class="text-muted">Vui lòng chọn rạp để xem lịch chiếu hôm nay.</p>
                                 <div class="badge bg-danger p-2" style="cursor: pointer;">Nobucoldy</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        @yield('content')

    @else
        {{-- KHI Ở TRANG KHÁC: CHỈ HIỂN THỊ NỘI DUNG RIÊNG --}}
        <div style="min-height: 85vh; width: 100%;">
            @yield('content')
        </div>
    @endif

    <footer class="footer">
        <div class="container d-flex justify-content-between align-items-center">
            <a class="logo-group" href="/">
                <div class="logo-circle">
                    <span class="bkl">BKL</span>
                    <span class="cinema">CINEMA</span>
                </div>
            </a>
            <div class="social-icons">
                <i class="bi bi-facebook"></i>
                <i class="bi bi-instagram"></i>
                <i class="bi bi-tiktok"></i>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>