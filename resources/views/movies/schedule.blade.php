@extends('layouts.app')

@section('content')
{{-- Icon library and fonts --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<style>
    /* 1. Overall interface */
    .schedule-wrapper {
        background-color: #f4f4f4;
        min-height: 100vh;
        padding-top: 30px;
    }
    
    .schedule-card {
        background: #fff;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        border: 1px solid #e0e0e0;
    }

    .schedule-header {
        padding: 20px;
        border-bottom: 1px solid #eee;
    }

    /* 2. Left column: Theater list */
    .theater-sidebar {
        background: #fff;
        max-height: 700px;
        overflow-y: auto;
    }

    .search-container {
        padding: 15px;
        background: #fff;
        position: sticky;
        top: 0;
        z-index: 10;
    }

    .theater-item {
        padding: 15px;
        display: flex;
        align-items: center;
        gap: 12px;
        cursor: pointer;
        border-bottom: 1px solid #f1f1f1;
        transition: 0.2s;
    }

    .theater-item:hover {
        background: #f9f9f9;
    }

    .theater-item.active {
        background: #DEFE98; /* Màu xanh neon của cậu */
    }

    .theater-logo {
        width: 40px;
        height: 40px;
        background: #ff3131;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: bold;
        font-size: 10px;
        flex-shrink: 0;
    }

    /* 3. Right column: Showtimes */
    .showtime-main {
        padding: 25px;
        background: #fff;
    }

    .date-scroller {
        display: flex;
        gap: 10px;
        overflow-x: auto;
        padding-bottom: 15px;
        margin-bottom: 25px;
    }

    .date-btn {
        min-width: 80px;
        padding: 10px;
        text-align: center;
        background: #f8f9fa;
        border: 1px solid #ddd;
        border-radius: 8px;
        cursor: pointer;
        transition: 0.3s;
    }

    .date-btn.active {
        background: #DEFE98;
        border-color: #DEFE98;
        font-weight: bold;
    }

    .date-btn span {
        display: block;
        font-size: 12px;
        color: #666;
    }

    .date-btn strong {
        font-size: 18px;
    }

    /* 4. Movie frame */
    .movie-item {
        display: flex;
        gap: 20px;
        padding: 20px;
        border: 1px solid #eee;
        border-radius: 12px;
        margin-bottom: 20px;
    }

    .movie-poster {
        width: 150px;
        height: 220px;
        object-fit: cover;
        border-radius: 8px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }

    .time-slot-container {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 15px;
    }

    .time-slot {
        padding: 8px 16px;
        background: #f1f5f9;
        border: 1px solid #cbd5e1;
        border-radius: 6px;
        color: #334155;
        text-decoration: none;
        font-weight: 500;
        font-size: 14px;
        transition: 0.2s;
    }

    .time-slot:hover {
        background: #ff69b4; /* Màu hồng khi hover */
        color: white;
        border-color: #ff69b4;
    }

    /* Beautiful scrollbar for Sidebar */
    .theater-sidebar::-webkit-scrollbar { width: 5px; }
    .theater-sidebar::-webkit-scrollbar-thumb { background: #ccc; border-radius: 10px; }
</style>

<div class="schedule-wrapper">
    <div class="container">
        <div class="schedule-card">
            <div class="schedule-header d-flex justify-content-between align-items-center">
                <h3 class="mb-0 fw-bold">MOVIE SCHEDULE</h3>
                <div class="d-flex align-items-center gap-2">
                    <span class="text-muted small">Location:</span>
                    <select class="form-select form-select-sm shadow-none" style="width: 150px;">
                        <option>Hanoi</option>
                        <option>Ho Chi Minh</option>
                    </select>
                </div>
            </div>

            <div class="row g-0">
                <div class="col-md-4 theater-sidebar border-end">
                    <div class="search-container border-bottom">
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0"><i class="bi bi-search"></i></span>
                            <input type="text" class="form-control bg-light border-start-0 shadow-none" placeholder="Search by theater name...">
                        </div>
                    </div>
                    
                    <div class="theater-list">
                        {{-- Sample theaters --}}
                        @php
                            $theaters = [
                                ['name' => 'BKL Ha Dong', 'addr' => 'Floor 25, Phenikaa Urban, Ha Dong'],
                                ['name' => 'BKL My Dinh', 'addr' => 'Ham Nghi Building, Nam Tu Liem'],
                                ['name' => 'BKL Cau Giay', 'addr' => '1 Xuan Thuy, Cau Giay'],
                                ['name' => 'BKL Hoan Kiem', 'addr' => '24 Trang Tien, Hoan Kiem'],
                            ];
                        @endphp

                        @foreach($theaters as $index => $t)
                        <div class="theater-item {{ $index == 0 ? 'active' : '' }}">
                            <div class="theater-logo">BKL<br>CINEMA</div>
                            <div class="theater-info overflow-hidden">
                                <h6 class="mb-0 fw-bold text-truncate">{{ $t['name'] }}</h6>
                                <p class="mb-0 text-muted small text-truncate">{{ $t['addr'] }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="col-md-8 showtime-main">
                    <div class="selected-theater-info mb-4">
                        <h4 class="fw-bold mb-1 text-danger"><i class="bi bi-geo-alt-fill"></i> BKL Ha Dong</h4>
                        <p class="text-muted small">Floor 25, Phenikaa University, Nguyen Trac, Yen Nghia, Ha Dong, Hanoi</p>
                    </div>

                    <div class="date-scroller">
                        <div class="date-btn active"><span>Today</span><strong>28</strong></div>
                        <div class="date-btn"><span>Monday</span><strong>29</strong></div>
                        <div class="date-btn"><span>Tuesday</span><strong>30</strong></div>
                        <div class="date-btn"><span>Wednesday</span><strong>31</strong></div>
                        <div class="date-btn"><span>Thursday</span><strong>01</strong></div>
                        <div class="date-btn"><span>Friday</span><strong>02</strong></div>
                    </div>

                    <div class="movie-list">
                        {{-- Movie 1 --}}
                        <div class="movie-item shadow-sm">
                            <img src="https://i.ebayimg.com/images/g/H0YAAOSw30JmG9xN/s-l1200.jpg" class="movie-poster">
                            <div class="movie-info w-100">
                                <h4 class="fw-bold mb-1">ZOOTOPIA 2: MISSION IMPOSSIBLE</h4>
                                <p class="text-muted small mb-3">Action, Animation, Family | 107 minutes</p>
                                <div class="type-badge mb-2"><span class="badge bg-dark">2D - Dubbed</span></div>
                                <div class="time-slot-container">
                                    <a href="#" class="time-slot">09:30 - 11:17</a>
                                    <a href="#" class="time-slot">12:00 - 13:47</a>
                                    <a href="#" class="time-slot">15:30 - 17:17</a>
                                    <a href="#" class="time-slot">18:00 - 19:47</a>
                                </div>
                            </div>
                        </div>

                        {{-- Movie 2 --}}
                        <div class="movie-item shadow-sm">
                            <img src="https://m.media-amazon.com/images/M/MV5BMjMwMDU5MTQxN15BMl5BanBnXkFtZTgwNjM5NDM1MDE@._V1_.jpg" class="movie-poster">
                            <div class="movie-info w-100">
                                <h4 class="fw-bold mb-1">DEADPOOL & WOLVERINE</h4>
                                <p class="text-muted small mb-3">Action, Comedy | 128 minutes</p>
                                <div class="type-badge mb-2"><span class="badge bg-dark">2D - Subtitled</span></div>
                                <div class="time-slot-container">
                                    <a href="#" class="time-slot">10:00 - 12:08</a>
                                    <a href="#" class="time-slot">14:20 - 16:28</a>
                                    <a href="#" class="time-slot">20:30 - 22:38</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Simple JS to toggle Active for theater and date
    document.querySelectorAll('.theater-item').forEach(item => {
        item.addEventListener('click', function() {
            document.querySelector('.theater-item.active').classList.remove('active');
            this.classList.add('active');
        });
    });

    document.querySelectorAll('.date-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            document.querySelector('.date-btn.active').classList.remove('active');
            this.classList.add('active');
        });
    });
</script>
@endsection