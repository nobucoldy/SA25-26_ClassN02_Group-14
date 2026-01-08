@extends('layouts.app')

@section('content')
<style>
    /* --- TOAST NOTIFICATION (GÓC PHẢI) --- */
    .toast-container {
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 10000;
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .custom-toast {
        background: #1e293b;
        color: white;
        padding: 16px 20px;
        border-radius: 12px;
        min-width: 300px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.5);
        display: flex;
        align-items: center;
        justify-content: space-between;
        position: relative;
        overflow: hidden;
        border: 1px solid rgba(255, 49, 49, 0.3);
        animation: slideInRight 0.4s ease forwards;
    }

    .toast-content { display: flex; align-items: center; gap: 12px; }
    .toast-content i { color: #ff3131; font-size: 1.3rem; }

    /* Nút X thoát */
    .close-toast {
        background: none; border: none; color: #94a3b8;
        font-size: 1.2rem; cursor: pointer; transition: 0.3s;
    }
    .close-toast:hover { color: white; }

    /* Thanh thời gian chạy (Progress Bar) */
    .progress-bar {
        position: absolute;
        bottom: 0;
        left: 0;
        height: 3px;
        background: #ff3131;
        width: 100%;
        animation: progress 3s linear forwards;
    }

    @keyframes slideInRight {
        from { opacity: 0; transform: translateX(100%); }
        to { opacity: 1; transform: translateX(0); }
    }

    @keyframes progress {
        from { width: 100%; }
        to { width: 0%; }
    }

    /* --- GIAO DIỆN CHÍNH (GIỮ NGUYÊN PHONG CÁCH CŨ) --- */
    .login-wrapper {
        height: calc(100vh - 80px); 
        display: flex; align-items: center; justify-content: center; padding: 20px;
    }
    .login-card {
        background: rgba(30, 41, 59, 0.7); backdrop-filter: blur(15px);
        border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 28px;
        padding: 40px 30px; width: 100%; max-width: 400px;
        box-shadow: 0 25px 50px rgba(0,0,0,0.5);
    }
    .logo-container { display: flex; justify-content: center; margin-bottom: 25px; }
    .logo-circle-large {
        width: 90px; height: 90px; background: #000; border: 3px solid #fff; outline: 2px solid #000;
        border-radius: 50%; display: flex; flex-direction: column; align-items: center; justify-content: center;
        font-family: 'Permanent Marker', cursive;
    }
    .bkl-large { font-size: 2.4rem; line-height: 1; display: flex; }
    .cinema-large { font-size: 0.85rem; color: #fff; text-transform: uppercase; border-top: 2px solid #fff; width: 75%; text-align: center; margin-top: 2px; }

    .floating-group { position: relative; margin-bottom: 20px; }
    .floating-group input {
        width: 100%; height: 55px; background: rgba(255, 255, 255, 0.05) !important;
        border: 1px solid rgba(255, 255, 255, 0.2) !important; border-radius: 12px;
        padding: 15px 45px 5px 15px; color: white !important; outline: none;
    }
    .floating-group label {
        position: absolute; top: 50%; left: 15px; transform: translateY(-50%);
        color: #94a3b8; transition: all 0.3s ease; pointer-events: none;
    }
    .floating-group input:focus ~ label, .floating-group input:not(:placeholder-shown) ~ label {
        top: 12px; font-size: 0.75rem; color: #39ff14; font-weight: bold;
    }
    .form-check-input:checked { background-color: #39ff14; border-color: #39ff14; }
    .btn-login {
        background: linear-gradient(90deg, #ff3131, #1f51ff);
        border: none; height: 52px; border-radius: 12px;
        font-weight: bold; transition: 0.3s; color: white; margin-top: 10px;
    }
    .signup-text { margin-top: 25px; text-align: center; color: #94a3b8; font-size: 0.9rem; }
    .signup-text a { color: #39ff14; text-decoration: none; font-weight: bold; }
</style>

<div class="toast-container">
    {{-- HIỂN THỊ LỖI ĐĂNG NHẬP --}}
    @if ($errors->any())
    <div class="custom-toast common-toast" id="loginAlert">
        <div class="toast-content">
            <i class="bi bi-exclamation-circle-fill"></i>
            <span>{{ $errors->first() }}</span>
        </div>
        <button class="close-toast" onclick="closeToast('loginAlert')">✕</button>
        <div class="progress-bar"></div>
    </div>
    @endif

    {{-- HIỂN THỊ THÀNH CÔNG (KHI ĐĂNG KÝ XONG NHẢY QUA) --}}
    @if (session('success'))
    <div class="custom-toast common-toast" id="successAlert" style="border-color: rgba(57, 255, 20, 0.5);">
        <div class="toast-content">
            <i class="bi bi-check-circle-fill" style="color: #39ff14;"></i>
            <span>{{ session('success') }}</span>
        </div>
        <button class="close-toast" onclick="closeToast('successAlert')">✕</button>
        <div class="progress-bar" style="background: #39ff14;"></div>
    </div>
    @endif
</div>

<div class="login-wrapper">
    <div class="login-card">
        <div class="logo-container">
            <div class="logo-circle-large">
                <div class="bkl-large">
                    <span style="color:#ff3131; transform: rotate(-8deg);">B</span>
                    <span style="color:#39ff14; transform: translateY(-4px);">K</span>
                    <span style="color:#1f51ff; transform: rotate(4deg);">L</span>
                </div>
                <div class="cinema-large">Cinema</div>
            </div>
        </div>

        <form method="POST" action="/login">
            @csrf
            <div class="floating-group">
                <input type="email" name="email" id="email" placeholder=" " value="{{ old('email') }}" required autocomplete="off">
                <label for="email">Email Address</label>
            </div>

            <div class="floating-group">
                <input type="password" name="password" id="password" placeholder=" " required>
                <label for="password">Mật khẩu</label>
                <i class="bi bi-eye position-absolute" id="togglePassword" style="right: 15px; top: 50%; transform: translateY(-50%); cursor: pointer; color: #94a3b8;"></i>
            </div>

            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="form-check d-flex align-items-center gap-2">
                    <input type="checkbox" name="remember" class="form-check-input" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label style="color: #cbd5e1;" for="remember">Ghi nhớ tôi</label>
                </div>
                <a href="#" class="small text-info text-decoration-none">Quên mật khẩu?</a>
            </div>

            <button type="submit" class="btn btn-primary btn-login w-100 shadow">ĐĂNG NHẬP</button>
        </form>

        <div class="signup-text">
            Chưa có tài khoản? <a href="/register">Đăng ký ngay</a>
        </div>
    </div>
</div>

<script>
    // Logic ẩn hiện mật khẩu
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#password');
    togglePassword.addEventListener('click', function () {
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        this.classList.toggle('bi-eye');
        this.classList.toggle('bi-eye-slash');
    });

    // Hàm đóng thông báo
    function closeToast(id) {
        const alert = document.getElementById(id);
        if (alert) {
            alert.style.transform = "translateX(120%)";
            alert.style.transition = "0.4s ease";
            setTimeout(() => alert.remove(), 400);
        }
    }

    // Tự động đóng sau 3 giây (3000ms)
    document.querySelectorAll('.common-toast').forEach(toast => {
        setTimeout(() => {
            closeToast(toast.id);
        }, 3000);
    });
</script>
@endsection