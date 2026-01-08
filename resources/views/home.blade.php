@extends('layouts.app')

@section('content')

    <header class="hero-section">
        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/b0/Avatar-Te-Vaka-Logo.svg/1200px-Avatar-Te-Vaka-Logo.svg.png"
             class="movie-title-logo" alt="Avatar">
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


@endsection
