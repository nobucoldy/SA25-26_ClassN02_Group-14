@extends('layouts.app')

@section('content')

{{-- LOGIN SUCCESS TOAST NOTIFICATION --}}
<div id="home-toast-container" style="position: fixed; top: 20px; right: 20px; z-index: 999999; display: flex; flex-direction: column; gap: 12px; pointer-events: none;">
    @if (session('success'))
    <div class="custom-toast-success" id="successToast" style="pointer-events: auto; background: #1e293b; color: white; padding: 16px 20px; border-radius: 12px; min-width: 320px; box-shadow: 0 10px 30px rgba(0,0,0,0.5); display: flex; align-items: center; justify-content: space-between; border-left: 5px solid #DEFE98; position: relative; overflow: hidden; animation: slideInIn 0.4s ease forwards;">
        <div style="display: flex; align-items: center; gap: 12px;">
            <i class="bi bi-check-circle-fill" style="color: #DEFE98; font-size: 1.2rem;"></i>
            <span style="font-weight: 500;">{{ session('success') }}</span>
        </div>
        <button onclick="closeHomeToast()" style="background: none; border: none; color: #94a3b8; cursor: pointer; font-size: 1.2rem; outline: none;">✕</button>
        {{-- Running time bar --}}
        <div style="position: absolute; bottom: 0; left: 0; height: 4px; background: #DEFE98; width: 100%; animation: toastProgress 3s linear forwards;"></div>
    </div>
    @endif
</div>

<style>
    @keyframes slideInIn {
        from { opacity: 0; transform: translateX(100%); }
        to { opacity: 1; transform: translateX(0); }
    }
    @keyframes toastProgress {
        from { width: 100%; }
        to { width: 0%; }
    }
</style>

<header class="hero-section">
    {{-- Banner content --}}
</header>

<div class="section-gap bg-light"></div>

{{-- ===== NOW SHOWING MOVIES ===== --}}
<section class="py-5 bg-black text-white">
    <div class="container text-center">
        <h2 class="section-header mb-4">NOW SHOWING</h2>

        <div class="swiper-container-wrapper position-relative px-5">
            <div class="swiper mySwiper">
                <div class="swiper-wrapper">
                    @foreach($showingMovies as $movie)
                        <div class="swiper-slide">
                            <a href="{{ route('movies.show', $movie->id) }}" class="text-decoration-none text-white">
                                <img src="{{ asset('storage/' . $movie->poster_url) }}" alt="{{ $movie->title }}">
                                <p class="movie-name">{{ $movie->title }}</p>
                            </a>
                        </div>
                    @endforeach
                </div>
                {{-- Pagination dots --}}
                <div class="swiper-pagination"></div>
            </div>

            {{-- Navigation buttons - Custom class configuration --}}
            <div class="swiper-button-next main-next"></div>
            <div class="swiper-button-prev main-prev"></div>
        </div>
    </div>
</section>

{{-- ===== COMING SOON MOVIES ===== --}}
<section class="py-5" style="background-color: #DEFE98;">
    <div class="container text-center">
        <h2 class="section-header text-dark mb-4">COMING SOON</h2>

        <div class="swiper-container-wrapper position-relative px-5">
            <div class="swiper mySwiperUpcoming">
                <div class="swiper-wrapper">
                    @foreach($upcomingMovies as $movie)
                        <div class="swiper-slide">
                            <a href="{{ route('movies.show', $movie->id) }}" class="text-decoration-none text-white">
                                <img src="{{ asset('storage/' . $movie->poster_url) }}" alt="{{ $movie->title }}">
                                <p class="movie-name text-dark">{{ $movie->title }}</p>
                            </a>
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

<div class="section-gap bg-light"></div>



{{-- ===== SCHEDULE ===== --}}
<section class="py-5 bg-light">
    <div class="container">
        <h2 class="section-header text-center mb-5 text-dark">MOVIE SCHEDULE</h2>

        <div class="row g-0">
            <div class="col-md-4 p-3 bg-white">
                <input type="text" class="form-control mb-3" placeholder="Search theater...">
                <div class="theater-list">
                    <div class="theater-item"><span class="text-danger">●</span> CGV Vincom Royal</div>
                    <div class="theater-item"><span class="text-warning">●</span> Lotte Cinema</div>
                    <div class="theater-item"><span class="text-success">●</span> BKL Cinema Ha Dong</div>
                    <div class="theater-item"><span class="text-primary">●</span> Beta Cinema</div>
                </div>
            </div>

            <div class="col-md-8 d-flex align-items-center justify-content-center bg-white">
                <div class="text-center py-5">
                    <img src="https://img.icons8.com/clouds/150/video.png" alt="">
                    <p class="text-muted mt-3">Please select a theater to view today's schedule.</p>
                    <span class="badge bg-danger">Nobucoldy vs Ekietej</span>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- SCRIPT TO HANDLE CLOSING TOAST --}}
<script>
    function closeHomeToast() {
        const toast = document.getElementById('successToast');
        if (toast) {
            toast.style.transform = "translateX(120%)";
            toast.style.opacity = "0";
            toast.style.transition = "0.4s ease";
            setTimeout(() => toast.remove(), 400);
        }
    }

    // Auto close after 3 seconds if notification exists
    document.addEventListener('DOMContentLoaded', function() {
        if (document.getElementById('successToast')) {
            setTimeout(closeHomeToast, 3000);
        }
    });
</script>

@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('css/movie-carousel.css') }}">
{{-- Add Icon library if Layout does not have it --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
@endpush

@push('scripts')
<script src="{{ asset('js/movie-carousel.js') }}"></script>
@endpush