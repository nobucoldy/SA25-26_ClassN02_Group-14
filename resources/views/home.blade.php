@extends('layouts.app')

@section('content')

<header class="hero-section">
    <img src="https://i.ytimg.com/vi/YXtWPVFk5TQ/maxresdefault.jpg"
         class="movie-title-logo" alt="Avatar">
</header>

{{-- ===== PHIM ĐANG CHIẾU ===== --}}
<section class="py-5 bg-black text-white">
    <div class="container text-center">
        <h2 class="section-header mb-4">PHIM ĐANG CHIẾU</h2>

        <div class="swiper-container-wrapper position-relative px-5">
            <div class="swiper mySwiper">
                <div class="swiper-wrapper">
                    @foreach($showingMovies as $movie)
                        <div class="swiper-slide">
                            <img src="{{ asset('storage/' . $movie->poster_url) }}"
                                 alt="{{ $movie->title }}"
                                 class="img-fluid rounded mb-2">
                            <p class="movie-name">{{ $movie->title }}</p>
                        </div>
                    @endforeach
                </div>
                <div class="swiper-pagination"></div>
            </div>

            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </div>
</section>

{{-- ===== PHIM SẮP CHIẾU ===== --}}
<section class="py-5" style="background-color: #DEFE98;">
    <div class="container text-center">
        <h2 class="section-header text-dark mb-4">PHIM SẮP CHIẾU</h2>

        <div class="swiper-container-wrapper position-relative px-5">
            <div class="swiper mySwiperUpcoming">
                <div class="swiper-wrapper">
                    @foreach($upcomingMovies as $movie)
                        <div class="swiper-slide movie-card">
                            <img src="{{ asset('storage/' . $movie->poster_url) }}"
                                 alt="{{ $movie->title }}">
                            <p class="movie-name text-dark">{{ $movie->title }}</p>
                        </div>
                    @endforeach
                </div>
                <div class="swiper-pagination"></div>
            </div>

            <div class="swiper-button-next upcoming-next"></div>
            <div class="swiper-button-prev upcoming-prev"></div>
        </div>
    </div>
</section>

{{-- ===== LỊCH CHIẾU ===== --}}
<section class="py-5 bg-light">
    <div class="container">
        <h2 class="section-header text-center mb-5 text-dark">LỊCH CHIẾU PHIM</h2>

        <div class="row g-0">
            <div class="col-md-4 p-3 bg-white">
                <input type="text" class="form-control mb-3" placeholder="Tìm kiếm rạp...">
                <div class="theater-list">
                    <div class="theater-item"><span class="text-danger">●</span> CGV Vincom Royal</div>
                    <div class="theater-item"><span class="text-warning">●</span> Lotte Cinema</div>
                    <div class="theater-item"><span class="text-success">●</span> BKL Cinema Hà Đông</div>
                    <div class="theater-item"><span class="text-primary">●</span> Beta Cinema</div>
                </div>
            </div>

            <div class="col-md-8 d-flex align-items-center justify-content-center bg-white">
                <div class="text-center py-5">
                    <img src="https://img.icons8.com/clouds/150/video.png" alt="">
                    <p class="text-muted mt-3">Vui lòng chọn rạp để xem lịch chiếu hôm nay.</p>
                    <span class="badge bg-danger">Nobucoldy</span>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('css/movie-carousel.css') }}">
@endpush

@push('scripts')
<script src="{{ asset('js/movie-carousel.js') }}"></script>
@endpush
