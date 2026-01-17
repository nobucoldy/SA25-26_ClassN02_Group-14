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



{{-- ===== SCHEDULE WIDGET FIXED HEIGHT ===== --}}
<section class="py-5 bg-light">
    <div class="container">
        <h2 class="section-header text-center mb-4 text-dark">MOVIE SCHEDULE</h2>

        {{-- Card wrapper --}}
        <div class="schedule-card mx-auto d-flex" style="max-width: 900px; height: 500px; background: #fff; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.08); overflow:hidden;">

            {{-- Sidebar: Theater list --}}
            <div class="col-md-4 p-3 border-end" style="overflow-y:auto;">
                <input type="text" id="theaterSearch" class="form-control mb-3" placeholder="Search theater...">
                <div class="theater-list">
                    @foreach($theaters as $t)
                        <a href="{{ url()->current() }}?theater_id={{ $t->id }}&show_date={{ $selectedDate }}" 
                           class="theater-item d-flex align-items-center gap-2 mb-2 {{ $selectedTheaterId == $t->id ? 'active' : '' }}"
                           style="text-decoration:none; color:inherit; padding:8px; border-radius:6px; transition:0.2s;">
                            <span class="theater-dot" style="color:#28A745;">●</span>
                            <span>{{ $t->name }}</span>
                        </a>
                    @endforeach
                </div>
            </div>

            {{-- Main: Showtimes --}}
            <div class="col-md-8 p-3 d-flex flex-column" style="overflow-y:auto;">
                @if($selectedTheater)
                    {{-- Date scroller --}}
                    <div class="date-scroller mb-3 d-flex gap-2 overflow-auto flex-shrink-0">
                        @php
                            $dates = collect(range(0,6))->map(fn($i) => \Carbon\Carbon::today()->addDays($i));
                        @endphp
                        @foreach($dates as $date)
                            <a href="{{ url()->current() }}?theater_id={{ $selectedTheaterId }}&show_date={{ $date->toDateString() }}"
                               class="date-btn px-3 py-2 border rounded {{ $selectedDate == $date->toDateString() ? 'active' : '' }}"
                               style="text-decoration:none; text-align:center;">
                                <span>{{ $date->format('D') }}</span><br>
                                <strong>{{ $date->format('d') }}</strong>
                            </a>
                        @endforeach
                    </div>

                    {{-- Movie list with showtimes --}}
                    <div class="movie-list flex-grow-1 overflow-auto">
                        @forelse($showtimesGroupedByMovie as $movieId => $showtimes)
                            @php $movie = $showtimes->first()->movie; @endphp
                            <div class="movie-item d-flex gap-3 mb-3 p-2 border rounded">
                                <img src="{{ asset($movie->poster_url) }}" alt="{{ $movie->title }}" style="width:100px; height:150px; object-fit:cover; border-radius:6px;">
                                <div class="movie-info w-100">
                                    <h5 class="fw-bold mb-1">{{ $movie->title }}</h5>
                                    <p class="text-muted small mb-2">{{ $movie->genre }} | {{ $movie->duration }} mins</p>
                                    <div class="time-slot-container d-flex flex-wrap gap-2">
                                        @foreach($showtimes as $st)
                                            <a href="{{ route('booking.create', $st->id) }}" 
                                               class="time-slot px-3 py-1 border rounded bg-light text-dark">
                                                {{ \Carbon\Carbon::parse($st->start_time)->format('H:i') }}
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-5">
                                <i class="bi bi-calendar-x" style="font-size:3rem;color:#ccc;"></i>
                                <p class="text-muted mt-3">No showtimes available for this theater on selected date.</p>
                            </div>
                        @endforelse
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="bi bi-info-circle" style="font-size:3rem;color:#ccc;"></i>
                        <p class="text-muted mt-3">Please select a theater to view schedule.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>

<script>
    document.getElementById('theaterSearch').addEventListener('input', function(e){
        let term = e.target.value.toLowerCase();
        document.querySelectorAll('.theater-item').forEach(item=>{
            item.style.display = item.innerText.toLowerCase().includes(term) ? 'flex' : 'none';
        });
    });
</script>

<style>
    .date-btn.active { background:#DEFE98; border-color:#DEFE98; font-weight:bold; }
    .theater-item.active { background:#DEFE98; }
</style>


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