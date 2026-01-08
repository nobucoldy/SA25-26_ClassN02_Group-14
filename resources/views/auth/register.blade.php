@extends('layouts.app')

@section('content')
<style>
    /* GIỮ NGUYÊN CSS GỐC CỦA BẠN */
    input:-webkit-autofill, input:-webkit-autofill:hover, input:-webkit-autofill:focus {
        -webkit-text-fill-color: white !important;
        -webkit-box-shadow: 0 0 0px 1000px #1e293b inset !important;
        transition: background-color 5000s ease-in-out 0s;
    }
    .register-wrapper { display: flex; align-items: center; justify-content: center; width: 100%; padding: 20px; }
    .register-card { background: rgba(30, 41, 59, 0.8); backdrop-filter: blur(15px); border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 28px; padding: 40px 30px; width: 100%; max-width: 420px; box-shadow: 0 25px 50px rgba(0,0,0,0.5); }
    .logo-circle-large { width: 90px; height: 90px; background: #000; border: 3px solid #fff; border-radius: 50%; display: flex; flex-direction: column; align-items: center; justify-content: center; font-family: 'Permanent Marker'; margin: 0 auto 25px; }
    .floating-group { position: relative; margin-bottom: 20px; }
    .floating-group input { width: 100%; height: 55px; background: #1e293b !important; border: 1px solid rgba(255, 255, 255, 0.2) !important; border-radius: 12px; padding: 15px 45px 5px 15px; color: white !important; outline: none; }
    .floating-group label { position: absolute; top: 50%; left: 15px; transform: translateY(-50%); color: #94a3b8; transition: 0.3s; pointer-events: none; }
    .floating-group input:focus ~ label, .floating-group input:not(:placeholder-shown) ~ label { top: 12px; font-size: 0.75rem; color: #39ff14; font-weight: bold; }
    .eye-toggle { position: absolute; right: 15px; top: 50%; transform: translateY(-50%); cursor: pointer; color: #94a3b8; font-size: 1.2rem; z-index: 10; }
    .btn-register { background: linear-gradient(90deg, #ff3131, #1f51ff); border: none; height: 52px; border-radius: 12px; font-weight: 600; color: white; margin-top: 10px; width: 100%; cursor: pointer; transition: 0.3s; }
    .footer-text { margin-top: 25px; text-align: center; color: #94a3b8; font-size: 0.95rem; }
    .footer-text a { color: #39ff14; text-decoration: none; font-weight: bold; }

    /* --- TOAST FIX LỖI CLICK --- */
    .toast-container { 
        position: fixed; 
        top: 20px; 
        right: 20px; 
        z-index: 999999; /* Đảm bảo nổi cao nhất */
        display: flex; 
        flex-direction: column; 
        gap: 12px; 
        pointer-events: none; /* Để có thể click xuyên qua vùng trống của container */
    }
    
    .custom-toast { 
        pointer-events: auto; /* ÉP CLICK ĐƯỢC VÀO TOAST */
        background: #1e293b; 
        color: white; 
        padding: 15px 20px; 
        border-radius: 12px; 
        min-width: 320px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.5); 
        display: flex; 
        align-items: center; 
        justify-content: space-between; 
        position: relative; 
        overflow: hidden; 
        border-left: 5px solid #ff3131; 
        animation: slideIn 0.4s ease-out forwards;
        cursor: default;
    }

    @keyframes slideIn { from { transform: translateX(120%); } to { transform: translateX(0); } }
    @keyframes slideOut { from { transform: translateX(0); opacity: 1; } to { transform: translateX(120%); opacity: 0; } }

    .close-btn { 
        background: none; border: none; color: #94a3b8; 
        font-size: 1.4rem; cursor: pointer; padding: 0 0 0 10px; line-height: 1;
        transition: 0.2s;
        z-index: 1001; /* Đảm bảo nút nằm trên cùng */
        position: relative;
    }
    .close-btn:hover { color: #ff3131; transform: scale(1.2); }

    .toast-progress {
        position: absolute; bottom: 0; left: 0; height: 3px;
        background: #ff3131; width: 100%;
        animation: toastProgress 3s linear forwards;
    }
    @keyframes toastProgress { from { width: 100%; } to { width: 0%; } }

    /* Checklist */
    .password-checklist {
        max-height: 0; overflow: hidden; background: rgba(15, 23, 42, 0.7);
        padding: 0 15px; border-radius: 12px; transition: all 0.4s ease; margin-bottom: 0;
    }
    .password-checklist.active { max-height: 250px; padding: 15px; margin-bottom: 20px; border: 1px solid rgba(57, 255, 20, 0.3); }
    .password-checklist li { font-size: 0.75rem; margin-bottom: 5px; display: flex; align-items: center; gap: 8px; }
    .invalid { color: #ff3131; } .valid { color: #39ff14; }
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
            <div class="floating-group"><input type="text" name="name" id="name" placeholder=" " value="{{ old('name') }}" required><label for="name">Họ và tên</label></div>
            <div class="floating-group"><input type="email" name="email" id="email" placeholder=" " value="{{ old('email') }}" required><label for="email">Email Address</label></div>
            <div class="floating-group"><input type="password" name="password" id="password" placeholder=" " required><label for="password">Mật khẩu</label><i class="bi bi-eye eye-toggle" onclick="togglePass('password', this)"></i></div>

            <div id="pswd_info" class="password-checklist">
                <ul>
                    <li id="length" class="invalid"><i class="bi bi-x-lg"></i> Trên 8 ký tự</li>
                    <li id="letter" class="invalid"><i class="bi bi-x-lg"></i> Có chữ cái</li>
                    <li id="number" class="invalid"><i class="bi bi-x-lg"></i> Có chữ số</li>
                    <li id="special" class="invalid"><i class="bi bi-x-lg"></i> Ký tự đặc biệt</li>
                    <li id="space" class="valid"><i class="bi bi-check-lg"></i> Không dấu cách</li>
                </ul>
            </div>

            <div class="floating-group"><input type="password" name="password_confirmation" id="password_confirmation" placeholder=" " required><label for="password_confirmation">Xác nhận mật khẩu</label><i class="bi bi-eye eye-toggle" onclick="togglePass('password_confirmation', this)"></i></div>
            <button type="submit" class="btn btn-register">ĐĂNG KÝ</button>
        </form>
    </div>
</div>

<script>
    function togglePass(id, icon) {
        const input = document.getElementById(id);
        input.type = input.type === 'password' ? 'text' : 'password';
        icon.classList.toggle('bi-eye'); icon.classList.toggle('bi-eye-slash');
    }

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

    function validateItem(id, isValid) {
        const el = document.getElementById(id); const icon = el.querySelector('i');
        if (isValid) { el.classList.replace('invalid', 'valid'); icon.classList.replace('bi-x-lg', 'bi-check-lg'); } 
        else { el.classList.replace('valid', 'invalid'); icon.classList.replace('bi-check-lg', 'bi-x-lg'); }
    }

    // FIX HÀM XÓA TOAST
    function removeToast(toastElement) {
        if (!toastElement) return;
        toastElement.style.animation = "slideOut 0.4s ease-in forwards";
        setTimeout(() => toastElement.remove(), 400);
    }

    // Tự động đóng Toast sau 3 giây
    document.querySelectorAll('.custom-toast').forEach(toast => {
        setTimeout(() => removeToast(toast), 3000);
    });
</script>
@endsection