@extends('layouts.app')

@section('title', 'Movie Reviews - BKL Cinema')

@section('content')
<style>
    /* Dark purple background color characteristic of Figma */
    .review-page { 
        background-color: #3b2d3d; 
        color: white; 
        padding: 40px 0; 
        min-height: 100vh;
    }
    
    .breadcrumb-custom {
        font-size: 0.85rem;
        margin-bottom: 25px;
        color: #a3a3a3;
    }

    .review-header {
        font-family: 'Inter', sans-serif;
        font-weight: 700;
        text-align: center;
        margin-bottom: 50px;
        font-size: 1.8rem;
        letter-spacing: 1px;
    }

    /* Large article cards (Avatar 3, Zootopia 2) */
    .review-card-large {
        position: relative;
        border-radius: 20px;
        overflow: hidden;
        margin-bottom: 30px;
        cursor: pointer;
        transition: 0.3s;
    }
    .review-card-large:hover { transform: scale(1.02); }
    .review-card-large img { width: 100%; aspect-ratio: 16/9; object-fit: cover; }
    
    .overlay-content {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        padding: 20px;
        background: linear-gradient(to top, rgba(0,0,0,0.9), transparent);
    }
    .title-large { font-weight: 700; font-size: 1.1rem; margin-bottom: 8px; }
    
    /* Small article grid */
    .review-card-small { margin-bottom: 30px; cursor: pointer; }
    .img-small-wrapper {
        background-color: #d9d9d9; /* Gray color like in the Figma */
        border-radius: 12px;
        aspect-ratio: 1/1;
        overflow: hidden;
        margin-bottom: 12px;
    }
    .img-small-wrapper img { width: 100%; height: 100%; object-fit: cover; }
    .title-small { font-size: 0.85rem; font-weight: 600; line-height: 1.4; color: #fff; }

    /* Rating badge red color */
    .rating-badge {
        background-color: #ff0000;
        color: white;
        padding: 2px 8px;
        border-radius: 4px;
        font-size: 0.7rem;
        display: inline-flex;
        align-items: center;
        gap: 4px;
        margin-top: 5px;
    }

    /* Load more button neon yellow color */
    .btn-load-more {
        background-color: #e2ff8d;
        color: #000;
        border: none;
        padding: 10px 35px;
        border-radius: 10px;
        font-weight: 700;
        font-size: 0.9rem;
        margin-top: 30px;
        transition: 0.3s;
    }
    .btn-load-more:hover { background-color: #39ff14; box-shadow: 0 0 15px rgba(57, 255, 20, 0.5); }
</style>

<div class="review-page">
    <div class="container">
        <div class="breadcrumb-custom">Home > Reviews</div>
        
        <h1 class="review-header">Reviews from BKL Cinema</h1>

        <div class="row">
            <div class="col-md-6">
                <div class="review-card-large">
                    <img src="https://m.media-amazon.com/images/M/MV5BMzVjZWUzOTUtYmZlNC00Y2VmLTlhMDktZTM4YmI3ZGRmN2EzXkEyXkFqcGdeQXVyMTEyMjM2NDc2._V1_.jpg" alt="Avatar 3">
                    <div class="overlay-content">
                        <div class="title-large">Avatar 3 Review: Blockbuster elevates cinematography standards</div>
                        <div class="rating-badge"><i class="bi bi-star-fill"></i> 9/10</div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="review-card-large">
                    <img src="https://m.media-amazon.com/images/M/MV5BOTMyMjEyNzIzMV5BMl5BanBnXkFtZTgwNzMzNjgzOTE@._V1_.jpg" alt="Zootopia 2">
                    <div class="overlay-content">
                        <div class="title-large">Zootopia 2 Review: Animated masterpiece dominates the box office</div>
                        <div class="rating-badge"><i class="bi bi-star-fill"></i> 8.5/10</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-3 col-6">
                <div class="review-card-small">
                    <div class="img-small-wrapper">
                        <img src="https://upload.wikimedia.org/wikipedia/vi/a/a9/B%E1%BB%91_gi%C3%A0_2021.jpg" alt="Bố Già">
                    </div>
                    <div class="title-small">The Father Review - A touching family film, dramatic and engaging</div>
                    <div class="rating-badge"><i class="bi bi-star-fill"></i> 8/10</div>
                </div>
            </div>

            @for ($i = 0; $i < 7; $i++)
            <div class="col-md-3 col-6">
                <div class="review-card-small">
                    <div class="img-small-wrapper"></div>
                    <div class="title-small" style="background: #555; height: 15px; width: 90%; border-radius: 4px;"></div>
                    <div class="title-small mt-2" style="background: #555; height: 15px; width: 60%; border-radius: 4px;"></div>
                </div>
            </div>
            @endfor
        </div>

        <div class="text-center mt-4">
            <button class=\"btn btn-load-more shadow-sm\">Load More</button>
        </div>
    </div>
</div>
@endsection