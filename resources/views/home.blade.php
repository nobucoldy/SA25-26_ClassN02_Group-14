@extends('layouts.app')

@section('content')

    <header class="hero-section">
        <img src="https://i.ytimg.com/vi/YXtWPVFk5TQ/maxresdefault.jpg"
             class="movie-title-logo" alt="Avatar">
    </header>

    <section class="py-5 bg-black text-white">
        <div class="container text-center">
            <h2 class="section-header">PHIM ĐANG CHIẾU</h2>
            <div class="row">
                <div class="col-6 col-md-3 movie-card">
                    <img src="https://static1.colliderimages.com/wordpress/wp-content/uploads/2023/03/avatar-the-way-of-water-movie-poster.jpg" alt="Avatar 3">
                    <p class="movie-name">Avatar 3: Lửa và Tro Tàn</p>
                </div>
                <div class="col-6 col-md-3 movie-card">
                    <img src="https://image.tmdb.org/t/p/original/oAfIIrBDF5XGvyMRqS310YAt0dV.jpg" alt="Zootopia">
                    <p class="movie-name">ZOOTOPIA 2</p>
                </div>
                <div class="col-6 col-md-3 movie-card">
                    <img src="https://www.themoviedb.org/t/p/original/rtGDOeG9LzoerkDGZF9dnVeLppL.jpg" alt="Totoro">
                    <p class="movie-name">My Neighbor Totoro</p>
                </div>
                <div class="col-6 col-md-3 movie-card">
                    <img src="https://th.bing.com/th/id/OIP.g9uwyw7M26B95jOglUAqVQHaLH?o=7&cb=defcachec2rm=3&rs=1&pid=ImgDetMain&o=7&rm=3" alt="Tom Jerry">
                    <p class="movie-name">Tom & Jerry</p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5" style="background-color: #DEFE98;">
        <div class="container text-center">
            <h2 class="section-header text-dark">PHIM SẮP CHIẾU</h2>
            <div class="row">
                <div class="col-6 col-md-3 movie-card">
                    <img src="https://th.bing.com/th/id/OIP.g9uwyw7M26B95jOglUAqVQHaLH?o=7&cb=defcachec2rm=3&rs=1&pid=ImgDetMain&o=7&rm=3" alt="Zootopia">
                    <p class="movie-name text-dark">Avatar 3</p>
                </div>
                <div class="col-6 col-md-3 movie-card">
                    <img src="https://th.bing.com/th/id/OIP.g9uwyw7M26B95jOglUAqVQHaLH?o=7&cb=defcachec2rm=3&rs=1&pid=ImgDetMain&o=7&rm=3" alt="Zootopia">
                    <p class="movie-name text-dark">Zootopia 2</p>
                </div>
                <div class="col-6 col-md-3 movie-card">
                    <img src="https://th.bing.com/th/id/OIP.g9uwyw7M26B95jOglUAqVQHaLH?o=7&cb=defcachec2rm=3&rs=1&pid=ImgDetMain&o=7&rm=3" alt="Totoro">
                    <p class="movie-name text-dark">My Neighbor Totoro</p>
                </div>
                <div class="col-6 col-md-3 movie-card">
                    <img src="https://www.themoviedb.org/t/p/original/rtGDOeG9LzoerkDGZF9dnVeLppL.jpg" alt="Tom Jerry">
                    <p class="movie-name text-dark">Tom & Jerry</p>
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


@endsection
