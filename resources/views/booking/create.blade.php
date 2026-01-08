@extends('layouts.app')

@section('content')
<style>
    .booking-page { background-color: #efe6f5; padding: 30px 0; min-height: 100vh; padding-bottom: 100px; }
    
    /* Header thông tin vé */
    .ticket-summary {
        background: white; border-radius: 25px; padding: 20px;
        display: flex; gap: 20px; box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        margin-bottom: 30px;
    }
    .summary-poster { width: 100px; height: 150px; border-radius: 10px; object-fit: cover; }
    .info-grid { display: grid; grid-template-columns: 80px 1fr; gap: 5px; font-size: 0.85rem; }
    .info-label { color: #888; }

    /* Chú thích ghế */
    .seat-legend { display: flex; justify-content: center; gap: 20px; margin-bottom: 40px; font-size: 0.8rem; }
    .legend-item { display: flex; align-items: center; gap: 8px; }
    .seat-demo { width: 30px; height: 30px; border-radius: 5px; }

    /* Sơ đồ ghế */
    .screen { 
        width: 60%; height: 8px; background: #fff; margin: 0 auto 50px; 
        box-shadow: 0 10px 20px rgba(255,255,255,0.8); text-align: center;
        border-radius: 10px; line-height: 8px; font-size: 0.6rem; color: #aaa;
    }
    .seat-grid { display: flex; flex-direction: column; align-items: center; gap: 10px; }
    .seat-row { display: flex; gap: 8px; }
    .seat { 
        width: 35px; height: 35px; border-radius: 6px; 
        display: flex; align-items: center; justify-content: center;
        font-size: 0.7rem; font-weight: bold; cursor: pointer; transition: 0.2s;
        user-select: none;
    }
    
    /* Màu sắc ghế theo ảnh cậu gửi */
    .seat-normal { background: #90ff00; color: #444; } 
    .seat-vip { background: #ff0000; color: white; }    
    .seat-double { background: #ff9999; color: white; width: 80px; } 
    .seat-selected { background: #333 !important; color: #fff !important; }
    .seat-sold { background: #bbb; color: #fff; cursor: not-allowed; opacity: 0.5; } 

    .seat:hover:not(.seat-sold) { transform: scale(1.1); }

    /* Footer thanh toán */
    .booking-footer {
        position: fixed; bottom: 0; left: 0; width: 100%;
        background: white; padding: 15px 0; border-top: 1px solid #eee; z-index: 1000;
    }
    .btn-next { 
        background: #d4ff7a; color: #000; text-decoration: none;
        padding: 10px 40px; border-radius: 10px; font-weight: bold; 
        display: inline-block; transition: 0.3s;
    }
    .btn-next:hover { background: #90ff00; }
</style>

<div class="booking-page">
    <div class="container">
        <div class="ticket-summary">
            <img src="{{ asset($showtime->movie->poster_url) }}" class="summary-poster">
            <div>
                <h5 class="fw-bold mb-3">{{ $showtime->movie->title }} <span class="badge bg-primary" style="font-size: 0.6rem;">T13</span></h5>
                <div class="info-grid">
                    <span class="info-label">Suất chiếu:</span> <strong>{{ \Carbon\Carbon::parse($showtime->start_time)->format('H:i') }}</strong>
                    <span class="info-label">Rạp chiếu:</span> <strong>BKL Hà Đông</strong>
                    <span class="info-label">Ngày:</span> <strong>{{ \Carbon\Carbon::parse($showtime->date)->format('d/m/Y') }}</strong>
                    <span class="info-label">Phòng:</span> <strong>{{ $showtime->room->name }}</strong>
                </div>
            </div>
        </div>

        <div class="seat-legend">
            <div class="legend-item"><div class="seat-demo" style="background:#333"></div> Ghế đã chọn</div>
            <div class="legend-item"><div class="seat-demo seat-normal"></div> Ghế thường<br>36.000đ</div>
            <div class="legend-item"><div class="seat-demo seat-vip"></div> Ghế VIP<br>49.000đ</div>
            <div class="legend-item"><div class="seat-demo seat-double"></div> Ghế đôi<br>95.000đ</div>
        </div>

        <div class="screen">Màn hình</div>

        <div class="seat-grid">
            @php
                $rows = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H'];
                $vipRows = ['D', 'E', 'F'];
            @endphp

            @foreach($rows as $row)
                <div class="seat-row">
                    @for($i=1; $i<=12; $i++)
                        @php 
                            $seatCode = $row . sprintf("%02d", $i);
                            $typeClass = in_array($row, $vipRows) ? 'seat-vip' : 'seat-normal';
                            $price = in_array($row, $vipRows) ? 49000 : 36000;
                        @endphp
                        <div class="seat {{ $typeClass }}" data-name="{{ $seatCode }}" data-price="{{ $price }}">
                            {{ $seatCode }}
                        </div>
                    @endfor
                </div>
            @endforeach

            <div class="seat-row mt-4">
                @for($i=1; $i<=6; $i++)
                    <div class="seat seat-double" data-name="SW0{{$i}}" data-price="95000">
                        SW0{{$i}}
                    </div>
                @endfor
            </div>
        </div>
    </div>
</div>

<div class="booking-footer">
    <div class="container d-flex justify-content-between align-items-center">
        <div>Ghế: <span id="selected-seats-list" class="fw-bold">Chưa chọn</span></div>
        <div class="d-flex align-items-center gap-4">
            <div>Tổng tiền: <strong id="total-amount" style="color: red; font-size: 1.2rem;">0đ</strong></div>
            <a href="{{ route('booking.combo') }}" id="btn-next-step" class="btn-next">Tiếp tục</a>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const seats = document.querySelectorAll('.seat:not(.seat-sold)');
        const countSpan = document.getElementById('selected-seats-list');
        const totalSpan = document.getElementById('total-amount');
        const btnNext = document.getElementById('btn-next-step');
        const baseRoute = "{{ route('booking.combo') }}";
        
        let selectedSeats = [];
        let totalPrice = 0;

        seats.forEach(seat => {
            seat.addEventListener('click', function() {
                const name = this.getAttribute('data-name');
                const price = parseInt(this.getAttribute('data-price'));

                if (this.classList.contains('seat-selected')) {
                    this.classList.remove('seat-selected');
                    selectedSeats = selectedSeats.filter(s => s !== name);
                    totalPrice -= price;
                } else {
                    this.classList.add('seat-selected');
                    selectedSeats.push(name);
                    totalPrice += price;
                }

                // Cập nhật giao diện footer
                countSpan.innerText = selectedSeats.length > 0 ? selectedSeats.join(', ') : 'Chưa chọn';
                totalSpan.innerText = totalPrice.toLocaleString('vi-VN') + 'đ';

                // CẬP NHẬT ĐƯỜNG DẪN NÚT TIẾP TỤC
                // Gắn thêm danh sách ghế và tổng tiền vào URL để trang Combo có thể nhận
                if (selectedSeats.length > 0) {
                    btnNext.href = `${baseRoute}?seats=${selectedSeats.join(',')}&total=${totalPrice}`;
                } else {
                    btnNext.href = baseRoute;
                }
            });
        });

        // Ngăn không cho đi tiếp nếu chưa chọn ghế
        btnNext.addEventListener('click', function(e) {
            if (selectedSeats.length === 0) {
                e.preventDefault();
                alert('Vui lòng chọn ít nhất một ghế để tiếp tục!');
            }
        });
    });
</script>
@endsection