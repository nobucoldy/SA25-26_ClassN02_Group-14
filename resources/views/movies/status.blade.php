@extends('layouts.app')

@section('content')
<style>
    .movie-list-page {
        background-color: #efe6f5; 
        width: 100vw;
        min-height: 100vh;
        padding: 50px 0;
        margin-left: calc(-50vw + 50%);
        margin-right: calc(-50vw + 50%);
    }
    .filter-bar { display: flex; justify-content: space-between; align-items: center; margin-bottom: 40px; }
    .movie-grid-system { display: grid; grid-template-columns: repeat(4, 1fr); gap: 30px; }
    @media (max-width: 992px) { .movie-grid-system { grid-template-columns: repeat(2, 1fr); } }

    .movie-item-box {
        background: white; border-radius: 20px; overflow: hidden;
        box-shadow: 0 10px 25px rgba(0,0,0,0.06); transition: 0.3s;
        text-decoration: none !important; display: block;
    }
    .movie-item-box:hover { transform: translateY(-10px); }
    .poster-container { position: relative; width: 100%; aspect-ratio: 2/3; }
    .poster-container img { width: 100%; height: 100%; object-fit: cover; }

    .red-label {
        position: absolute; bottom: 15px; right: 15px; background: #ff3131;
        color: white; font-size: 0.7rem; font-weight: bold;
        padding: 4px 12px; border-radius: 6px; text-transform: uppercase;
    }
    .movie-footer-info { padding: 15px; text-align: center; }
    .movie-footer-info h6 { font-weight: 700; color: #333; text-transform: uppercase; margin: 0; font-size: 0.9rem; }
    
    /* Style mới cho ngày tháng thực tế */
    .real-time-sub { color: #888; font-size: 1rem; margin-top: 5px; }
</style>

<div class="movie-list-page">
    <div class="container">
        <div class="filter-bar">
            <div>
                <h2 class="fw-bold m-0">PHIM ĐANG CHIẾU</h2>
                {{-- Dòng này sẽ tự cập nhật ngày tháng theo thời gian thực mỗi khi load trang --}}
                <div class="real-time-sub">
                    Lịch chiếu hôm nay, {{ \Carbon\Carbon::now()->translatedFormat('d/m/Y') }}
                </div>
            </div>
            <select class="form-select" style="width: auto; border-radius: 8px;">
                <option>Tất cả</option>
            </select>
        </div>

        <div class="movie-grid-system">
            @forelse($movies as $movie)
                <a href="{{ route('movies.show', $movie->id) }}" class="movie-item-box">
                    <div class="poster-container">
                        <img src="{{ asset('storage/' . $movie->poster_url) }}" alt="{{ $movie->title }}">
                        <div class="red-label">Đang chiếu</div>
                    </div>
                    <div class="movie-footer-info">
                        <h6>{{ $movie->title }}</h6>
                    </div>
                </a>
            @empty
                <div class="text-center w-100 py-5">
                    <p class="text-muted">Chưa có dữ liệu phim đang chiếu cho ngày hôm nay.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection