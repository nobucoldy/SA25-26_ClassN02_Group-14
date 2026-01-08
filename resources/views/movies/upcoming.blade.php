@extends('layouts.app')

@section('content')
<style>
    .upcoming-page { background-color: #efe6f5; width: 100%; min-height: 100vh; padding: 50px 0; }
    .movie-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 25px; }
    @media (max-width: 992px) { .movie-grid { grid-template-columns: repeat(2, 1fr); } }

    .movie-card {
        background: white; border-radius: 20px; overflow: hidden;
        box-shadow: 0 10px 25px rgba(0,0,0,0.05); transition: 0.3s;
        text-decoration: none !important; display: block;
    }
    .movie-card:hover { transform: translateY(-10px); }
    .poster-box { position: relative; width: 100%; aspect-ratio: 2/3; }
    .poster-box img { width: 100%; height: 100%; object-fit: cover; }

    .badge-upcoming {
        position: absolute; bottom: 12px; right: 12px; background: #007bff;
        color: white; font-size: 0.7rem; font-weight: bold;
        padding: 4px 12px; border-radius: 6px;
    }
    .movie-info { padding: 15px; text-align: center; }
    .movie-info h6 { font-weight: 700; color: #333; text-transform: uppercase; margin: 0; }
</style>

<div class="upcoming-page">
    <div class="container">
        <h2 class="fw-bold mb-4">PHIM SẮP CHIẾU</h2>
        <div class="movie-grid">
            @forelse($movies as $movie)
                <a href="{{ route('movies.show', $movie->id) }}" class="movie-card">
                    <div class="poster-box">
                        <img src="{{ asset($movie->poster_url) }}" alt="{{ $movie->title }}">
                        <div class="badge-upcoming">Sắp chiếu</div>
                    </div>
                    <div class="movie-info">
                        <h6>{{ $movie->title }}</h6>
                    </div>
                </a>
            @empty
                <div class="text-center w-100 py-5">
                    <p class="text-muted">Hiện chưa có phim sắp chiếu.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection