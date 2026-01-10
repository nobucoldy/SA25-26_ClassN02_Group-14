<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đặt vé - BKL Cinema</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        body { margin: 0; padding: 0; font-family: 'Inter', sans-serif; background-color: #f4f4f9; overflow-x: hidden; }
        .booking-page { padding: 30px 0 140px 0; min-height: 100vh; position: relative; }

        /* SIDEBAR - GIỮ NGUYÊN */
        .side-menu { position: fixed; top: 50%; transform: translateY(-50%); display: flex; flex-direction: column; gap: 15px; z-index: 2000; }
        .side-menu.left { left: 30px; }
        .side-menu.right { right: 30px; }
        .menu-btn { 
            width: 50px; height: 50px; background: white; border: none; border-radius: 15px; 
            box-shadow: 0 4px 15px rgba(0,0,0,0.1); display: flex; align-items: center; 
            justify-content: center; font-size: 1.2rem; transition: 0.3s; cursor: pointer; 
            text-decoration: none; color: #333;
        }
        .menu-btn:hover { background: #90ff00; color: #000; transform: scale(1.1); }

        /* TOAST - GIỮ NGUYÊN */
        .toast-container { position: fixed; top: 20px; right: 20px; z-index: 999999; display: flex; flex-direction: column; gap: 12px; pointer-events: none; }
        .custom-toast { 
            pointer-events: auto; background: #1e293b; color: white; padding: 15px 20px; 
            border-radius: 12px; min-width: 320px; box-shadow: 0 10px 30px rgba(0,0,0,0.5); 
            display: flex; align-items: center; justify-content: space-between; 
            position: relative; overflow: hidden; border-left: 5px solid #ff3131; 
            animation: slideIn 0.4s ease-out forwards; 
        }
        @keyframes slideIn { from { transform: translateX(120%); } to { transform: translateX(0); } }
        @keyframes slideOut { from { transform: translateX(0); opacity: 1; } to { transform: translateX(120%); opacity: 0; } }
        
        .close-btn { 
            background: transparent !important; border: none !important; color: #94a3b8; 
            font-size: 1.4rem; cursor: pointer; padding: 0 0 0 10px; line-height: 1; 
            outline: none !important; box-shadow: none !important; appearance: none !important;
        }
        .close-btn:hover { color: #ff3131; }
        .toast-progress { position: absolute; bottom: 0; left: 0; height: 3px; background: #ff3131; width: 100%; animation: toastProgress 3s linear forwards; }
        @keyframes toastProgress { from { width: 100%; } to { width: 0%; } }

        /* HEADER - GIỮ NGUYÊN */
        .ticket-header { background: white; border-radius: 20px; padding: 25px; display: flex; gap: 30px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); margin-bottom: 30px; border-left: 8px solid #90ff00; }
        .summary-poster { width: 110px; height: 160px; border-radius: 12px; object-fit: cover; }
        .movie-title { font-size: 1.6rem; font-weight: 800; color: #1a1a1a; margin-bottom: 15px; }
        .info-details-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 15px; }
        .info-box { background: #f8f9fa; padding: 10px; border-radius: 10px; border: 1px solid #eee; }
        .info-box label { display: block; font-size: 0.65rem; color: #888; text-transform: uppercase; font-weight: 700; }
        .info-box span { display: block; font-size: 0.9rem; font-weight: 700; color: #333; }

        /* LEGEND - GIỮ NGUYÊN */
        .seat-legend { display: flex; justify-content: center; gap: 40px; margin: 0 auto 40px; padding: 15px 40px; background: #fff; border-radius: 20px; width: fit-content; box-shadow: 0 2px 10px rgba(0,0,0,0.05); }
        .legend-item { display: flex; flex-direction: column; align-items: center; gap: 2px; }
        .legend-label { display: flex; align-items: center; gap: 8px; font-size: 0.8rem; font-weight: 700; color: #444; }
        .legend-price { font-size: 0.7rem; color: #ff3131; font-weight: 600; }
        .seat-demo { width: 20px; height: 20px; border-radius: 5px; }
        .legend-item .seat-double-demo { width: 20px !important; }

        /* SCREEN & AREA - THÊM TRANSITION CHO MÀN HÌNH */
        .screen-container { width: 100%; perspective: 500px; margin-bottom: 60px; text-align: center; }
        .screen { width: 70%; height: 10px; background: #ddd; margin: 0 auto; transform: rotateX(-30deg); box-shadow: 0 15px 25px rgba(0,0,0,0.1); border-radius: 5px; }
        .screen-text { color: #bbb; font-size: 0.75rem; margin-top: 20px; letter-spacing: 10px; font-weight: 800; }

        /* SEAT GRID & AREA ZOOM - SỬA LẠI ĐỂ ZOOM ĐỒNG BỘ */
        .zoom-wrapper { width: 100%; display: flex; justify-content: center; }
        #main-booking-area { transition: transform 0.3s ease; transform-origin: top center; width: 100%; }
        .seat-grid { display: flex; flex-direction: column; align-items: center; gap: 15px; }
        .seat-row { display: flex; gap: 8px; align-items: center; }
        .seat-row .seat:nth-child(3) { margin-right: 35px; }
        .seat-row .seat:nth-child(8) { margin-right: 35px; }

        .seat { width: 40px; height: 40px; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 0.7rem; font-weight: 700; cursor: pointer; transition: 0.2s; }
        .seat-normal { background: #90ff00; color: #000; } 
        .seat-vip { background: #ff4d4d; color: white; }    
        .seat-double { background: #ff66cc; color: white; width: 88px; } 
        .seat-selected { background: #1a1a1a !important; color: #fff !important; transform: scale(1.15); box-shadow: 0 5px 12px rgba(0,0,0,0.2); }
        .seat-sold { background: #e0e0e0 !important; color: #aaa !important; cursor: not-allowed; } 

        /* CHECKOUT - GIỮ NGUYÊN */
        .checkout-card { 
            position: fixed; bottom: 0; left: 0; right: 0; background: white; 
            padding: 12px 10%; box-shadow: 0 -8px 25px rgba(0,0,0,0.08); 
            border-top: 1px solid #eee; z-index: 1000; 
        }
        .total-price { color: #ff0000; font-size: 1.5rem; font-weight: 800; }
        #display-seats { font-size: 0.95rem !important; }
        .text-uppercase-label { font-size: 0.65rem; color: #888; font-weight: 700; text-transform: uppercase; margin-bottom: 2px; }
        .btn-next-step { 
            border-radius: 10px; background: #90ff00; color: #000; border: none; 
            padding: 10px 45px; font-weight: 800; font-size: 1rem; transition: 0.2s; 
        }
        .btn-next-step:hover { background: #82e600; transform: translateY(-2px); }
    </style>
</head>
<body>

<div class="booking-page">
    <div class="toast-container" id="toast-wrapper"></div>

    <div class="side-menu left">
        <button class="menu-btn" onclick="window.history.back()" title="Quay lại"><i class="bi bi-chevron-left"></i></button>
        <button type="button" class="menu-btn" data-bs-toggle="modal" data-bs-target="#cancelModal" title="Hủy giao dịch">
            <i class="bi bi-x-lg"></i>
        </button>
    </div>

    <div class="side-menu right">
        <button class="menu-btn" onclick="zoomGrid(0.1)" title="Phóng to"><i class="bi bi-plus-lg"></i></button>
        <button class="menu-btn" onclick="zoomGrid(-0.1)" title="Thu nhỏ"><i class="bi bi-dash-lg"></i></button>
        <button class="menu-btn" onclick="window.location.reload()" title="Tải lại"><i class="bi bi-arrow-clockwise"></i></button>
    </div>

    <div class="container">
        <div class="ticket-header">
            <img src="{{ asset($showtime->movie->poster_url) }}" class="summary-poster">
            <div class="flex-grow-1">
                <div style="color: #d63384; font-weight: 600;">BKL CINEMA HÀ ĐÔNG</div>
                <h2 class="movie-title">{{ $showtime->movie->title }}</h2>
                <div class="info-details-grid">
                    <div class="info-box"><label>Suất chiếu</label><span>{{ \Carbon\Carbon::parse($showtime->start_time)->format('H:i') }}</span></div>
                    <div class="info-box"><label>Ngày</label><span>{{ \Carbon\Carbon::parse($showtime->show_date)->format('d/m/Y') }}</span></div>
                    <div class="info-box"><label>Phòng</label><span>{{ $showtime->room->name }}</span></div>
                    <div class="info-box"><label>Rạp</label><span>BKL Hà Đông</span></div>
                </div>
            </div>
        </div>

        <div class="seat-legend">
            <div class="legend-item">
                <div class="legend-label"><div class="seat-demo seat-normal"></div>Thường</div>
                <div class="legend-price">36.000đ</div>
            </div>
            <div class="legend-item">
                <div class="legend-label"><div class="seat-demo seat-vip"></div>VIP</div>
                <div class="legend-price">49.000đ</div>
            </div>
            <div class="legend-item">
                <div class="legend-label"><div class="seat-demo seat-double seat-double-demo"></div>Ghế đôi</div>
                <div class="legend-price">90.000đ</div>
            </div>
            <div class="legend-item">
                <div class="legend-label"><div class="seat-demo" style="background:#1a1a1a"></div>Đang chọn</div>
                <div class="legend-price">-</div>
            </div>
            <div class="legend-item">
                <div class="legend-label"><div class="seat-demo seat-sold"></div>Đã bán</div>
                <div class="legend-price">-</div>
            </div>
        </div>

        <div class="zoom-wrapper">
            <div id="main-booking-area">
                <div class="screen-container">
                    <div class="screen"></div>
                    <div class="screen-text">MÀN HÌNH</div>
                </div>

                <div class="seat-grid" id="seat-grid">
                    @php 
                        $rows = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H']; 
                        $normalRows = ['A', 'B', 'C'];
                        $soldSeats = $soldSeats ?? []; 
                    @endphp

                    @foreach($rows as $row)
                        <div class="seat-row">
                            @for($i=1; $i<=10; $i++)
                                @php 
                                    $code = $row . sprintf("%02d", $i);
                                    $isNormal = in_array($row, $normalRows);
                                    $type = $isNormal ? 'seat-normal' : 'seat-vip';
                                    $price = $isNormal ? 36000 : 49000;
                                    $isSold = in_array($code, $soldSeats);
                                @endphp
                                <div class="seat {{ $isSold ? 'seat-sold' : $type }}" data-name="{{ $code }}" data-price="{{ $price }}">{{ $code }}</div>
                            @endfor
                        </div>
                    @endforeach

                    <div class="seat-row mt-4">
                        @for($i=1; $i<=5; $i++)
                            @php 
                                $code = "L" . sprintf("%02d", $i);
                                $price = 90000;
                                $isSold = in_array($code, $soldSeats);
                            @endphp
                            <div class="seat {{ $isSold ? 'seat-sold' : $seat_double ?? 'seat-double' }}" data-name="{{ $code }}" data-price="{{ $price }}">{{ $code }}</div>
                        @endfor
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="checkout-card">
        <div class="d-flex justify-content-between align-items-center w-100">
            <div>
                <div class="text-uppercase-label" id="seat-counter">Đã chọn 0 ghế</div>
                <div id="display-seats" class="fw-bold text-dark">Chưa có ghế nào</div>
            </div>
            <div class="d-flex align-items-center gap-4">
                <div class="text-end">
                    <div class="text-uppercase-label">Tổng tạm tính</div>
                    <div id="display-total" class="total-price">0đ</div>
                </div>
                <button id="next-button" class="btn btn-next-step shadow-sm">TIẾP TỤC</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="cancelModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 15px;">
            <div class="modal-body p-4 text-center">
                <h5 class="fw-bold mb-3">Bạn có chắc muốn hủy giao dịch?</h5>
                <p class="text-muted small mb-4">Với việc bấm vào <strong>đồng ý</strong>, bạn sẽ hủy giao dịch mua vé xem phim này, và bạn sẽ được chuyển đến xem thông tin các phim khác</p>
                <div class="d-flex gap-3 justify-content-center">
                    <button type="button" class="btn btn-outline-secondary px-4 fw-bold" data-bs-dismiss="modal" style="border-radius: 8px;">Tiếp tục mua vé</button>
                    <a href="{{ route('movies.index') }}" class="btn btn-primary px-5 fw-bold" style="border-radius: 8px; background-color: #0056b3; border:none;">Đồng ý</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // ZOOM ĐỒNG BỘ: SỬA LẠI ĐỂ TÁC ĐỘNG VÀO AREA CHUNG
    let currentZoom = 1;
    function zoomGrid(step) {
        currentZoom += step;
        if (currentZoom < 0.6) currentZoom = 0.6;
        if (currentZoom > 1.3) currentZoom = 1.3;
        const area = document.getElementById('main-booking-area');
        if(area) area.style.transform = `scale(${currentZoom})`;
    }

    // LOGIC TOAST GIỮ NGUYÊN
    function removeToast(el) {
        if (!el) return;
        el.style.animation = "slideOut 0.4s ease-in forwards";
        setTimeout(() => el.remove(), 400);
    }
    function createToast(msg) {
        const wrapper = document.getElementById('toast-wrapper');
        const toast = document.createElement('div');
        toast.className = 'custom-toast';
        toast.innerHTML = `<div style="display: flex; align-items: center; gap: 10px;"><i class="bi bi-exclamation-circle-fill" style="color: #ff3131;"></i><span style="font-size: 0.9rem;">${msg}</span></div><button type="button" class="close-btn" onclick="removeToast(this.parentElement)">&times;</button><div class="toast-progress"></div>`;
        wrapper.appendChild(toast);
        setTimeout(() => removeToast(toast), 3000);
    }

    // LOGIC CHỌN GHẾ GIỮ NGUYÊN
    document.addEventListener('DOMContentLoaded', function() {
        const seats = document.querySelectorAll('.seat:not(.seat-sold)');
        const seatText = document.getElementById('display-seats');
        const seatCounter = document.getElementById('seat-counter'); 
        const totalText = document.getElementById('display-total');
        const nextBtn = document.getElementById('next-button');
        let selected = [];

        seats.forEach(seat => {
            seat.addEventListener('click', function() {
                const name = this.dataset.name;
                const price = parseInt(this.dataset.price);
                if (this.classList.contains('seat-selected')) {
                    this.classList.remove('seat-selected');
                    selected = selected.filter(s => s.name !== name);
                } else {
                    this.classList.add('seat-selected');
                    selected.push({ name, price });
                }
                updateCheckout();
            });
        });

        function updateCheckout() {
            if (selected.length === 0) {
                if(seatCounter) seatCounter.innerText = 'Đã chọn 0 ghế';
                seatText.innerText = 'Chưa có ghế nào';
                totalText.innerText = '0đ';
                return;
            }
            if(seatCounter) seatCounter.innerText = `Đã chọn ${selected.length} ghế`;
            seatText.innerText = selected.map(s => s.name).join(', ');
            const total = selected.reduce((sum, s) => sum + s.price, 0);
            totalText.innerText = new Intl.NumberFormat('vi-VN').format(total) + 'đ';
        }

        nextBtn.addEventListener('click', function() {
            if (selected.length === 0) {
                createToast("Vui lòng chọn ít nhất một ghế!");
            } else {
                const seatsParam = selected.map(s => s.name).join(',');
                const totalAmount = selected.reduce((sum, s) => sum + s.price, 0);
                window.location.href = `{{ route('booking.combo') }}?seats=${seatsParam}&total=${totalAmount}`;
            }
        });
    });
</script>
</body>
</html>