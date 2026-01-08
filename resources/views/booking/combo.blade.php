@extends('layouts.app')

@section('content')
<style>
    .booking-container { max-width: 600px; margin: 0 auto; font-family: 'Inter', sans-serif; }
    .combo-section { background: white; border-radius: 20px; overflow: hidden; margin-bottom: 30px; box-shadow: 0 5px 15px rgba(0,0,0,0.1); }
    .combo-header { background: #e2ff8d; padding: 15px; text-align: center; font-weight: bold; position: relative; }
    .back-btn { position: absolute; left: 20px; cursor: pointer; text-decoration: none; color: black; }
    .combo-item { padding: 20px; border-bottom: 1px solid #eee; display: flex; justify-content: space-between; align-items: center; }
    .combo-info h5 { margin: 0; font-weight: bold; font-size: 1.1rem; }
    .combo-info p { margin: 5px 0 0; color: #666; font-size: 0.9rem; }
    .counter { display: flex; align-items: center; gap: 15px; }
    .btn-qty { width: 30px; height: 30px; border-radius: 50%; border: 1px solid #ddd; background: white; display: flex; align-items: center; justify-content: center; cursor: pointer; font-weight: bold; }
    .btn-qty:hover { background: #f8f8f8; }
    .total-footer { padding: 20px; display: flex; justify-content: space-between; align-items: center; }
    .btn-continue { background: #e2ff8d; border: none; padding: 10px 30px; border-radius: 12px; font-weight: bold; cursor: pointer; }

    .payment-info { background: white; border-radius: 15px; display: flex; overflow: hidden; box-shadow: 0 5px 15px rgba(0,0,0,0.1); }
    .ticket-details { flex: 1; padding: 20px; border-right: 1px dashed #ccc; }
    
    /* Phần QR mặc định ẩn */
    .qr-section { 
        flex: 0 0 200px; background: #e2ff8d; display: none; /* Ẩn ở đây */
        flex-direction: column; align-items: center; justify-content: center; padding: 20px; 
    }
    .qr-section.active { display: flex; } /* Hiện khi có class active */
    
    .qr-box { background: white; padding: 10px; border-radius: 10px; }
    .qr-box img { width: 100%; }
    .detail-row { display: flex; justify-content: space-between; margin-bottom: 15px; font-size: 0.85rem; }
</style>

<div class="booking-container py-5">
    <div class="combo-section">
        <div class="combo-header">
            <a href="javascript:history.back()" class="back-btn"><i class="bi bi-chevron-left"></i> Quay lại</a>
            Combo Bắp - Nước
        </div>
        
        <div class="combo-list">
            <div class="combo-item" data-price="103000">
                <div class="combo-info"><h5>COMBO A - 103.000đ</h5><p>1 Bắp + 1 Nước lớn</p></div>
                <div class="counter">
                    <button class="btn-qty minus">-</button>
                    <span class="qty">0</span>
                    <button class="btn-qty plus">+</button>
                </div>
            </div>

            <div class="combo-item" data-price="135000">
                <div class="combo-info"><h5>COMBO B - 135.000đ</h5><p>1 Bắp + 2 Nước lớn</p></div>
                <div class="counter">
                    <button class="btn-qty minus">-</button>
                    <span class="qty">0</span>
                    <button class="btn-qty plus">+</button>
                </div>
            </div>

            <div class="combo-item" data-price="185000">
                <div class="combo-info"><h5>COMBO GIA ĐÌNH - 185.000đ</h5><p>2 Bắp + 3 Nước lớn</p></div>
                <div class="counter">
                    <button class="btn-qty minus">-</button>
                    <span class="qty">0</span>
                    <button class="btn-qty plus">+</button>
                </div>
            </div>

            <div class="combo-item" data-price="55000">
                <div class="combo-info"><h5>COMBO TIẾT KIỆM - 55.000đ</h5><p>1 Bắp ngọt nhỏ + 1 Nước</p></div>
                <div class="counter">
                    <button class="btn-qty minus">-</button>
                    <span class="qty">0</span>
                    <button class="btn-qty plus">+</button>
                </div>
            </div>
        </div>

        <div class="total-footer">
            <div>Tổng cộng: <strong id="display-total-all">0đ</strong></div>
            <button class="btn-continue" id="btn-pay">Thanh toán</button>
        </div>
    </div>

    <div class="payment-info">
        <div class="ticket-details">
            <div class="detail-row">
                <div><span class="detail-label">Ghế đã chọn</span><br><strong>{{ request('seats', 'N/A') }}</strong></div>
            </div>
            <div class="detail-row">
                <div><span class="detail-label">Tiền ghế</span><br><strong id="seat-price-val">{{ number_format(request('total', 0)) }}đ</strong></div>
                <div><span class="detail-label">Tiền Combo</span><br><strong id="combo-price-val">0đ</strong></div>
            </div>
            <div class="detail-row mt-3 pt-3" style="border-top: 1px solid #eee;">
                <strong>TỔNG THANH TOÁN</strong>
                <strong style="color: red; font-size: 1.1rem;" id="final-total-val">0đ</strong>
            </div>
        </div>
        
        <div class="qr-section" id="qr-area">
            <p style="font-size: 0.75rem; font-weight: bold; margin-bottom: 15px; text-align:center;">Quét mã để thanh toán</p>
            <div class="qr-box">
                <img id="qr-image" src="" alt="QR Payment">
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const seatPrice = parseInt("{{ request('total', 0) }}");
    let comboTotal = 0;

    function updateTotal() {
        comboTotal = 0;
        document.querySelectorAll('.combo-item').forEach(item => {
            const price = parseInt(item.getAttribute('data-price'));
            const qty = parseInt(item.querySelector('.qty').innerText);
            comboTotal += (price * qty);
        });

        const finalTotal = seatPrice + comboTotal;
        
        document.getElementById('combo-price-val').innerText = comboTotal.toLocaleString('vi-VN') + 'đ';
        document.getElementById('display-total-all').innerText = finalTotal.toLocaleString('vi-VN') + 'đ';
        document.getElementById('final-total-val').innerText = finalTotal.toLocaleString('vi-VN') + 'đ';
        
        // Cập nhật link QR động
        document.getElementById('qr-image').src = `https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=BKL-PAYMENT-${finalTotal}`;
    }

    // Xử lý nút cộng trừ
    document.querySelectorAll('.btn-qty').forEach(btn => {
        btn.addEventListener('click', function() {
            const isPlus = this.classList.contains('plus');
            const qtyElement = this.parentElement.querySelector('.qty');
            let currentQty = parseInt(qtyElement.innerText);

            if (isPlus) {
                currentQty++;
            } else if (currentQty > 0) {
                currentQty--;
            }

            qtyElement.innerText = currentQty;
            updateTotal();
        });
    });

    // Xử lý nút thanh toán hiện QR
    document.getElementById('btn-pay').addEventListener('click', function() {
        document.getElementById('qr-area').classList.add('active');
        this.innerText = "Đang chờ thanh toán...";
        this.disabled = true;
    });

    updateTotal(); // Chạy lần đầu
});
</script>
@endsection