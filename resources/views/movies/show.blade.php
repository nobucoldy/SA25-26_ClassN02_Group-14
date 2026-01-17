@extends('layouts.app')

@section('content')
<style>
    /* --- GIỮ NGUYÊN TOÀN BỘ STYLE GỐC CỦA CẬU --- */
    .movie-detail-page { background-color: #efe6f5; padding: 40px 0; min-height: 100vh; }
    .main-card {
        background: white; border-radius: 30px; padding: 40px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05); margin-bottom: 30px;
    }
    .movie-poster { width: 100%; border-radius: 15px; height: 500px; object-fit: cover; }
    .movie-info-header h2 { font-weight: 800; text-transform: uppercase; color: #1a1a1a; }
    .badge-t13 { background: #9c27b0; color: white; padding: 3px 10px; border-radius: 5px; font-size: 0.8rem; }
    .schedule-title { text-align: center; font-family: 'Oswald'; text-transform: uppercase; margin: 40px 0; font-size: 2rem; }
    .date-picker { display: flex; justify-content: center; gap: 10px; margin-bottom: 30px; }
    .date-item {
        background: #e0e0e0; padding: 10px 15px; border-radius: 12px; text-align: center;
        min-width: 90px; cursor: pointer; transition: 0.3s; display: flex; flex-direction: column;
    }
    .date-item.active { background: #90ff00; font-weight: bold; box-shadow: 0 4px 10px rgba(144,255,0,0.3); }
    .cinema-accordion { background: white; border-radius: 20px; margin-bottom: 15px; border: 1px solid #eee; overflow: hidden; }
    .time-slot { 
        background: #f8f8f8; border: 1px solid #e0e0e0; padding: 8px 18px; border-radius: 10px;
        font-size: 0.9rem; font-weight: 600; text-decoration: none; color: #333 !important; margin-right: 12px;
        transition: 0.2s; display: inline-block; margin-bottom: 10px;
    }
    .time-slot:hover { background: #90ff00; transform: translateY(-3px); color: black !important; border-color: #90ff00; }

    /* --- TOAST GỐC --- */
    #toast-container { position: fixed; top: 80px; right: 20px; z-index: 9999; }
    .custom-toast {
        background: #1a1a1a; color: white; padding: 12px 20px; border-radius: 12px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.3); margin-bottom: 12px;
        border-left: 6px solid #90ff00; display: flex; align-items: center;
        justify-content: space-between; gap: 15px; min-width: 320px;
        animation: toastIn 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
    }
    .toast-content { display: flex; align-items: center; gap: 10px; }
    .toast-close { cursor: pointer; font-size: 1.5rem; color: #888; line-height: 1; transition: 0.2s; }
    .toast-close:hover { color: white; }

    @keyframes toastIn { from { transform: translateX(100%); opacity: 0; } to { transform: translateX(0); opacity: 1; } }
    .toast-fade-out { opacity: 0; transform: translateX(100%); transition: 0.5s; }
    .d-none { display: none !important; }

    /* --- NÂNG CẤP KHUNG TRAILER TRẮNG HIỆN ĐẠI (THEO ẢNH MẪU) --- */
    .modal-backdrop.show {
        backdrop-filter: blur(8px);
        background-color: rgba(0, 0, 0, 0.8);
    }

    #trailerModal .modal-content {
        background: #DEFE98; /* Khung trắng theo yêu cầu */
        border: none;
        border-radius: 30px; /* Bo tròn dày */
        padding: 20px; /* Tạo khoảng trắng viền xung quanh */
        box-shadow: 0 20px 60px rgba(0,0,0,0.4);
        position: relative;
    }

    /* Tiêu đề phim bên trong khung trắng */
    .modal-header-custom {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
        padding: 0 10px;
    }

    .modal-header-custom h5 {
        font-weight: 800;
        text-transform: uppercase;
        margin: 0;
        color: #1a1a1a;
    }

    /* Nút đóng hình tròn nằm trong khung trắng */
    .btn-close-circle {
        background: #f0f0f0;
        border: none;
        width: 35px;
        height: 35px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #333;
        transition: 0.2s;
        cursor: pointer;
    }

    .btn-close-circle:hover {
        background: #90ff00; /* Màu mặc định của dự án khi hover */
        transform: scale(1.1) rotate(90deg);
    }

    /* Bo tròn cho video bên trong */
    .video-inner-frame {
        border-radius: 15px;
        overflow: hidden;
        background: #000;
        border: 2px solid #f0f0f0; /* Viền mỏng phân cách video và khung trắng */
    }

    .modal.fade .modal-dialog {
        transform: scale(0.8);
        transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
    }
    .modal.show .modal-dialog {
        transform: scale(1);
    }
</style>

<div class="movie-detail-page">
    <div class="container">
        <nav class="mb-4" style="font-size: 0.85rem; color: #888;">
            Home &nbsp; > &nbsp; Now Showing &nbsp; > &nbsp; {{ $movie->title }}
        </nav>

        <div class="main-card">
            <div class="row">
                <div class="col-md-4">
                    <img src="{{ asset($movie->poster_url) }}" class="movie-poster" alt="{{ $movie->title }}">
                </div>
                <div class="col-md-8 px-md-5">
                    <div class="movie-info-header">
                        <h2>{{ $movie->title }} <span class="badge-t13">T13</span></h2>
                    </div>
                    <p class="text-muted">{{ $movie->duration }} minutes | {{ $movie->genre }}</p>
                    
                    <button class="btn-trailer mt-3" 
                            style="background: #90ff00; border:none; padding: 10px 20px; border-radius: 10px; font-weight: bold;"
                            data-bs-toggle="modal" 
                            data-bs-target="#trailerModal" 
                            data-url="{{ $movie->trailer_url }}">
                        <i class="bi bi-play-fill"></i> Watch Trailer
                    </button>

                    <div class="description-text mt-4">{{ $movie->description }}</div>
                </div>
            </div>
        </div>

        <h2 class="schedule-title">Movie Schedule</h2>
        
        <div class="date-picker">
            @php 
                $dates = [
                    ['label' => 'Today', 'day' => '06/01', 'id' => 'date-1'],
                    ['label' => 'Wednesday', 'day' => '07/01', 'id' => 'date-2'],
                    ['label' => 'Thursday', 'day' => '08/01', 'id' => 'date-3'],
                ];
            @endphp
            @foreach($dates as $index => $d)
                <div class="date-item {{ $index == 0 ? 'active' : '' }}" 
                     onclick="changeDate(this, '{{ $d['id'] }}')">
                    <span>{{ $d['label'] }}</span>
                    <strong>{{ $d['day'] }}</strong>
                </div>
            @endforeach
        </div>

        <div id="schedule-wrapper">
            <div class="cinema-accordion schedule-content" id="date-1">
                <div class="p-4">
                    <strong>BKL Cinema Ha Dong</strong>
                    <div class="mt-3">
                        @forelse($showtimes as $st)
                            <a href="{{ route('booking.create', $st->id) }}" class="time-slot">
                                {{ \Carbon\Carbon::parse($st->start_time)->format('H:i') }}
                            </a>
                        @empty
                            <p class="text-muted small">No showtimes available today.</p>
                        @endforelse
                    </div>
                </div>
            </div>
            <div class="cinema-accordion schedule-content d-none" id="date-2"></div>
            <div class="cinema-accordion schedule-content d-none" id="date-3"></div>
        </div>
    </div>
</div>

<div id="toast-container"></div>

<div class="modal fade" id="trailerModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header-custom">
                <h5>Trailer: {{ $movie->title }}</h5>
                <button type="button" class="btn-close-circle" data-bs-dismiss="modal">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>
            
            <div class="modal-body p-0">
                <div class="video-inner-frame">
                    <div class="ratio ratio-16x9">
                        <iframe id="trailerVideo" src="" title="YouTube video player" frameborder="0" 
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                            allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    /* --- GIỮ NGUYÊN HÀM TOAST CỦA CẬU --- */
    function showToast(message) {
        const container = document.getElementById('toast-container');
        if (!container) return;
        const toast = document.createElement('div');
        toast.className = 'custom-toast';
        toast.innerHTML = `
            <div class="toast-content">
                <i class="bi bi-info-circle-fill" style="color: #90ff00; font-size: 1.2rem;"></i>
                <span>${message}</span>
            </div>
            <div class="toast-close" onclick="closeToastFromElement(this)">&times;</div>
        `;
        container.appendChild(toast);
        const timeoutId = setTimeout(() => { removeToast(toast); }, 3000);
        toast.dataset.timeoutId = timeoutId;
    }

    function closeToastFromElement(el) {
        const toast = el.closest('.custom-toast');
        if (toast) {
            clearTimeout(toast.dataset.timeoutId);
            removeToast(toast);
        }
    }

    function removeToast(toast) {
        toast.classList.add('toast-fade-out');
        setTimeout(() => { if (toast && toast.parentNode) toast.remove(); }, 500);
    }

    /* --- GIỮ NGUYÊN HÀM ĐỔI NGÀY CỦA CẬU --- */
    function changeDate(element, dateId) {
        document.querySelectorAll('.date-item').forEach(item => item.classList.remove('active'));
        element.classList.add('active');
        document.querySelectorAll('.schedule-content').forEach(c => c.classList.add('d-none'));
        const target = document.getElementById(dateId);
        if (target) {
            target.classList.remove('d-none');
            const hasTimeSlots = target.querySelector('.time-slot');
            if (!hasTimeSlots) {
                showToast("There are currently no showtimes for this date.");
            }
        }
    }

    /* --- XỬ LÝ TRAILER --- */
    document.addEventListener('DOMContentLoaded', function() {
        const trailerModal = document.getElementById('trailerModal');
        const iframe = document.getElementById('trailerVideo');

        if (trailerModal && iframe) {
            trailerModal.addEventListener('show.bs.modal', function (event) {
                const button = event.relatedTarget;
                let url = button.getAttribute('data-url');
                
                if (url) {
                    if (url.includes('watch?v=')) {
                        url = url.replace('watch?v=', 'embed/');
                    } else if (url.includes('youtu.be/')) {
                        url = url.replace('youtu.be/', 'youtube.com/embed/');
                    }
                    iframe.src = url + "?autoplay=1&modestbranding=1&rel=0";
                }
            });

            trailerModal.addEventListener('hide.bs.modal', function () {
                iframe.src = "";
            });
        }
    });
</script>
@endsection