@extends('layouts.app')

@section('title', 'Movie Reviews - BKL Cinema')

@section('content')
<style>
    /* --- BREADCRUMB: Đã sửa màu trắng sáng để nhìn thấy được trên nền tím --- */
    .breadcrumb-container {
        height: 50px; display: flex; align-items: center; justify-content: center;
        background: transparent !important; border: none !important;
    }
    .breadcrumb { margin: 0; padding: 0; font-size: 13px; display: flex; align-items: center; list-style: none; }
    .breadcrumb-item + .breadcrumb-item::before { content: ">" !important; color: #a3a3a3; padding: 0 10px; }
    .breadcrumb-item a { color: #a3a3a3 !important; text-decoration: none; }
    .breadcrumb-item.active { color: #ffffff !important; font-weight: 600; } /* Đổi từ #000 sang #fff */

    .review-page { background-color: #3b2d3d; color: white; padding: 20px 0 60px 0; min-height: 100vh; }
    .review-header { font-weight: 700; text-align: center; margin-bottom: 50px; font-size: 1.8rem; text-transform: uppercase; }

    /* Card Layout */
    .review-card-large { position: relative; border-radius: 20px; overflow: hidden; margin-bottom: 30px; transition: 0.3s; box-shadow: 0 10px 30px rgba(0,0,0,0.3); }
    .review-card-large:hover { transform: translateY(-5px); }
    .review-card-large img { width: 100%; aspect-ratio: 16/9; object-fit: cover; }
    
    .overlay-content { position: absolute; bottom: 0; left: 0; right: 0; padding: 20px; background: linear-gradient(to top, rgba(0,0,0,0.9), transparent); }
    
    .review-card-small { margin-bottom: 30px; transition: 0.3s; }
    .review-card-small:hover { transform: translateY(-5px); }
    .img-small-wrapper { background-color: #d9d9d9; border-radius: 12px; aspect-ratio: 1/1; overflow: hidden; margin-bottom: 12px; }
    .img-small-wrapper img { width: 100%; height: 100%; object-fit: cover; }
    
    .rating-badge { background-color: #ff0000; color: white; padding: 2px 8px; border-radius: 4px; font-size: 0.7rem; display: inline-flex; align-items: center; gap: 4px; margin-top: 5px; }
    .btn-load-more { background-color: #DEFE98; color: #000; border: none; padding: 10px 35px; border-radius: 10px; font-weight: 700; transition: 0.3s; }
    .btn-load-more:hover { background-color: #ff69b4; color: white; }
</style>

{{-- BREADCRUMB --}}
<div class="breadcrumb-container" style="background-color: #3b2d3d;">
    <div class="container text-center">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active">Reviews</li>
            </ol>
        </nav>
    </div>
</div>

<div class="review-page">
    <div class="container">
        <h1 class="review-header">Reviews from BKL Cinema</h1>

        <div class="row mt-4">
    @forelse($reviews as $review)
        <div class="col-md-3 col-6">
            <div class="review-card-small">
                <div class="img-small-wrapper">
                    {{-- Kiểm tra và hiện ảnh --}}
                    @if($review->image)
                        <img src="{{ asset('storage/' . $review->image) }}" alt="{{ $review->title }}">
                    @else
                        <img src="https://via.placeholder.com/300" alt="No Image">
                    @endif
                </div>
                <div class="title-small">{{ $review->title }}</div>
                <div class="rating-badge mt-2">
                    <i class="bi bi-star-fill"></i> {{ $review->rating }}/10
                </div>
            </div>
        </div>
    @empty
        <div class="col-12 text-center">
            <p class="text-muted">Chưa có bài review nào trong Database.</p>
        </div>
    @endforelse
</div>

        <div class="text-center mt-4">
            <button class="btn btn-load-more shadow-sm">Load More</button>
        </div>
    </div>
</div>
@endsection