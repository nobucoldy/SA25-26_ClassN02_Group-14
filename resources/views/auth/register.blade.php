@extends('layouts.app')

@section('content')
{{-- Thư viện icon Bootstrap --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<style>
    /* 1. XỬ LÝ AUTOFILL VÀ MÀU SẮC CHỦ ĐẠO */
    input:-webkit-autofill, input:-webkit-autofill:hover, input:-webkit-autofill:focus {
        -webkit-text-fill-color: #000 !important;
        -webkit-box-shadow: 0 0 0px 1000px #fff inset !important;
        transition: background-color 5000s ease-in-out 0s;
    }
    .register-wrapper { display: flex; align-items: center; justify-content: center; width: 100%; padding: 20px; min-height: 80vh; }
    
    /* KHUNG ĐĂNG KÝ MÀU DEFE98 */
    .register-card { 
        background: #DEFE98; 
        border: 1px solid rgba(0, 0, 0, 0.1); 
        border-radius: 28px; 
        padding: 40px 30px; 
        width: 100%; 
        max-width: 420px; 
        box-shadow: 0 20px 40px rgba(0,0,0,0.15); 
    }
    
    .logo-circle-large { width: 90px; height: 90px; background: #000; border: 3px solid #fff; border-radius: 50%; display: flex; flex-direction: column; align-items: center; justify-content: center; font-family: 'Permanent Marker'; margin: 0 auto 25px; }
    
    .floating-group { position: relative; margin-bottom: 20px; }
    .floating-group input { 
        width: 100%; 
        height: 55px; 
        background: rgba(255, 255, 255, 0.8) !important; 
        border: 1px solid rgba(0, 0, 0, 0.2) !important; 
        border-radius: 12px; 
        padding: 15px 45px 5px 15px; 
        color: #000 !important; 
        outline: none; 
        transition: 0.3s ease;
    }

    /* HIỆU ỨNG FOCUS Ô NHẬP LIỆU SANG HỒNG */
    .floating-group input:focus {
        border-color: #ff69b4 !important;
        box-shadow: 0 0 0 4px rgba(255, 105, 180, 0.2) !important;
    }

    .floating-group label { position: absolute; top: 50%; left: 15px; transform: translateY(-50%); color: #4b5563; transition: 0.3s; pointer-events: none; }
    
    .floating-group input:focus ~ label, .floating-group input:not(:placeholder-shown) ~ label { 
        top: 12px; 
        font-size: 0.75rem; 
        color: #ff69b4; 
        font-weight: bold; 
    }
    .eye-toggle { position: absolute; right: 15px; top: 50%; transform: translateY(-50%); cursor: pointer; color: #4b5563; font-size: 1.2rem; z-index: 10; }

    /* NÚT ĐĂNG KÝ ff69b4 */
    .btn-register { 
        background: #ff69b4; 
        border: none; 
        height: 52px; 
        border-radius: 12px; 
        font-weight: 600; 
        color: white; 
        margin-top: 10px; 
        width: 100%; 
        cursor: pointer; 
        transition: 0.3s ease; 
        box-shadow: 0 4px 15px rgba(255, 105, 180, 0.4);
    }
    .btn-register:hover, .btn-register:focus { background: #ff47a1; transform: translateY(-2px); outline: none; }

    .footer-text { margin-top: 25px; text-align: center; color: #1f2937; font-size: 0.95rem; }

    /* CHỈ ĐỔI MÀU CHỮ HỒNG CHO LINK ĐĂNG NHẬP NGAY */
    .footer-text a { 
        color: #000; 
        text-decoration: none; 
        font-weight: bold; 
        transition: all 0.3s ease;
        display: inline-block;
    }
    .footer-text a:hover, .footer-text a:focus { 
        color: #ff69b4 !important; 
        background-color: transparent !important;
        outline: none;
        transform: scale(1.1);
        text-decoration: underline;
    }

    /* 2. THÔNG BÁO TOAST */
    .toast-container { position: fixed; top: 20px; right: 20px; z-index: 999999; display: flex; flex-direction: column; gap: 12px; pointer-events: none; }
    .custom-toast { pointer-events: auto; background: #1e293b; color: white; padding: 15px 20px; border-radius: 12px; min-width: 320px; box-shadow: 0 10px 30px rgba(0,0,0,0.5); display: flex; align-items: center; justify-content: space-between; position: relative; overflow: hidden; border-left: 5px solid #ff3131; animation: slideIn 0.4s ease-out forwards; }
    
    @keyframes slideIn { from { transform: translateX(120%); } to { transform: translateX(0); } }
    @keyframes slideOut { from { transform: translateX(0); opacity: 1; } to { transform: translateX(120%); opacity: 0; } }

    .close-btn { 
        background: none; border: none; color: #94a3b8; 
        font-size: 1.4rem; cursor: pointer; padding: 0; line-height: 1;
        transition: 0.2s; outline: none !important; box-shadow: none !important;
    }
    .close-btn:hover { color: #ff3131; transform: scale(1.2); }

    .toast-progress { position: absolute; bottom: 0; left: 0; height: 3px; background: #ff3131; width: 100%; animation: toastProgress 3s linear forwards; }
    @keyframes toastProgress { from { width: 100%; } to { width: 0%; } }

    /* 3. CHECKLIST DÙNG CHUNG CHO PHONE & PASSWORD */
    .checklist-box {
        max-height: 0; overflow: hidden; background: rgba(255, 255, 255, 0.5);
        padding: 0 15px; border-radius: 12px; transition: all 0.4s ease; margin-bottom: 0;
    }
    .checklist-box.active { max-height: 250px; padding: 15px; margin-bottom: 20px; border: 1px solid rgba(255, 105, 180, 0.3); }
    .checklist-box li { font-size: 0.75rem; margin-bottom: 5px; display: flex; align-items: center; gap: 8px; list-style: none; }
    .invalid { color: #dc2626; } .valid { color: #059669; }
</style>

<div class="toast-container">
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="custom-toast">
                <div style="display: flex; align-items: center; gap: 10px;">
                    <i class="bi bi-exclamation-circle-fill" style="color: #ff3131;"></i>
                    <span style="font-size: 0.9rem;">{{ $error }}</span>
                </div>
                <button type="button" class="close-btn" onclick="removeToast(this.parentElement)">&times;</button>
                <div class="toast-progress"></div>
            </div>
        @endforeach
    @endif
</div>

<div class="register-wrapper">
    <div class="register-card">
        <div class="logo-circle-large">
            <div style="font-size: 2.4rem; line-height: 1; display: flex; font-family: 'Permanent Marker';">
                <span style="color:#ff3131;">B</span><span style="color:#39ff14;">K</span><span style="color:#1f51ff;">L</span>
            </div>
            <div style="font-size: 0.85rem; color: #fff; text-transform: uppercase; border-top: 2px solid #fff; width: 75%; text-align: center;">Cinema</div>
        </div>

        <form method="POST" action="{{ route('register') }}">
            @csrf
            {{-- HỌ TÊN --}}
            <div class="floating-group">
                <input type="text" name="name" id="name" placeholder=" " value="{{ old('name') }}" required>
                <label for="name">Họ và tên</label>
            </div>

            {{-- ĐỊA CHỈ EMAIL --}}
            <div class="floating-group">
                <input type="email" name="email" id="email" placeholder=" " value="{{ old('email') }}" required>
                <label for="email">Địa chỉ Email</label>
            </div>

            {{-- SỐ ĐIỆN THOẠI --}}
            <div class="floating-group">
                <input type="text" name="phone" id="phone" placeholder=" " value="{{ old('phone') }}" required maxlength="10">
                <label for="phone">Số điện thoại</label>
            </div>

            <div id="phone_info" class="checklist-box">
                <ul>
                    <li id="p_start" class="invalid"><i class="bi bi-x-lg"></i> Đầu số VN (03, 05, 07, 08, 09)</li>
                    <li id="p_length" class="invalid"><i class="bi bi-x-lg"></i> Đúng 10 chữ số</li>
                    <li id="p_number" class="invalid"><i class="bi bi-x-lg"></i> Chỉ chứa ký tự số</li>
                </ul>
            </div>

            {{-- MẬT KHẨU --}}
            <div class="floating-group">
                <input type="password" name="password" id="password" placeholder=" " required>
                <label for="password">Mật khẩu</label>
                <i class="bi bi-eye eye-toggle" onclick="togglePass('password', this)"></i>
            </div>

            <div id="pswd_info" class="checklist-box">
                <ul>
                    <li id="length" class="invalid"><i class="bi bi-x-lg"></i> Ít nhất 8 ký tự</li>
                    <li id="letter" class="invalid"><i class="bi bi-x-lg"></i> Chứa chữ cái</li>
                    <li id="number" class="invalid"><i class="bi bi-x-lg"></i> Chứa chữ số</li>
                    <li id="special" class="invalid"><i class="bi bi-x-lg"></i> Ký tự đặc biệt (@, $, !...)</li>
                    <li id="space" class="valid"><i class="bi bi-check-lg"></i> Không chứa dấu cách</li>
                </ul>
            </div>

            {{-- XÁC NHẬN MẬT KHẨU --}}
            <div class="floating-group">
                <input type="password" name="password_confirmation" id="password_confirmation" placeholder=" " required>
                <label for="password_confirmation">Xác nhận mật khẩu</label>
                <i class="bi bi-eye eye-toggle" onclick="togglePass('password_confirmation', this)"></i>
            </div>
            
            <button type="submit" class="btn btn-register">ĐĂNG KÝ NGAY</button>
            
            <div class="footer-text">
                Đã có tài khoản? <a href="{{ route('login') }}">Đăng nhập ngay</a>
            </div>
        </form>
    </div>
</div>

<script>
    function togglePass(id, icon) {
        const input = document.getElementById(id);
        input.type = input.type === 'password' ? 'text' : 'password';
        icon.classList.toggle('bi-eye'); icon.classList.toggle('bi-eye-slash');
    }

    // --- LOGIC CHO SỐ ĐIỆN THOẠI ---
    const phone = document.getElementById('phone');
    const phone_info = document.getElementById('phone_info');

    phone.addEventListener('focus', () => phone_info.classList.add('active'));
    phone.addEventListener('blur', () => phone_info.classList.remove('active'));

    phone.addEventListener('input', function() {
        const val = this.value;
        validateItem('p_start', /^(03|05|07|08|09)/.test(val));
        validateItem('p_length', val.length === 10);
        validateItem('p_number', /^[0-9]+$/.test(val) && val.length > 0);
    });

    // --- LOGIC CHO MẬT KHẨU ---
    const pswd = document.getElementById('password');
    const pswd_info = document.getElementById('pswd_info');

    pswd.addEventListener('focus', () => pswd_info.classList.add('active'));
    pswd.addEventListener('blur', () => pswd_info.classList.remove('active'));

    pswd.addEventListener('keyup', function() {
        const val = this.value;
        validateItem('length', val.length >= 8);
        validateItem('letter', /[a-zA-Z]/.test(val));
        validateItem('number', /[0-9]/.test(val));
        validateItem('special', /[@\-\.,$!%*?#]/.test(val));
        validateItem('space', !/\s/.test(val) && val.length > 0);
    });

    // Hàm dùng chung để đổi màu icon tích
    function validateItem(id, isValid) {
        const el = document.getElementById(id); 
        if(!el) return;
        const icon = el.querySelector('i');
        if (isValid) { 
            el.classList.replace('invalid', 'valid'); 
            icon.classList.replace('bi-x-lg', 'bi-check-lg'); 
        } else { 
            el.classList.replace('valid', 'invalid'); 
            icon.classList.replace('bi-check-lg', 'bi-x-lg'); 
        }
    }

    function removeToast(toastElement) {
        if (!toastElement) return;
        toastElement.style.animation = "slideOut 0.4s ease-in forwards";
        setTimeout(() => toastElement.remove(), 400);
    }

    document.querySelectorAll('.custom-toast').forEach(toast => {
        setTimeout(() => removeToast(toast), 3000);
    });
</script>
@endsection