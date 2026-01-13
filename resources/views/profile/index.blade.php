@extends('layouts.app')

@section('content')
{{-- Thư viện icon --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<style>
    /* 1. TOAST NOTIFICATION ĐỒNG BỘ 100% */
    .toast-container-profile {
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 10000;
        display: flex;
        flex-direction: column;
        gap: 12px;
        pointer-events: none;
    }

    .custom-toast-profile {
        pointer-events: auto;
        background: #1e293b;
        color: white;
        padding: 16px 20px;
        border-radius: 12px;
        min-width: 320px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.5);
        display: flex;
        align-items: center;
        justify-content: space-between;
        border-left: 5px solid #DEFE98;
        position: relative;
        overflow: hidden;
        animation: slideInProfile 0.4s ease forwards;
    }

    .progress-bar-profile {
        position: absolute;
        bottom: 0;
        left: 0;
        height: 4px;
        background: #DEFE98;
        width: 100%;
        animation: progressProfile 3s linear forwards;
    }

    @keyframes slideInProfile {
        from { opacity: 0; transform: translateX(100%); }
        to { opacity: 1; transform: translateX(0); }
    }

    @keyframes progressProfile {
        from { width: 100%; }
        to { width: 0%; }
    }

    .close-toast-profile {
        background: none; border: none; color: #94a3b8;
        font-size: 1.2rem; cursor: pointer; transition: 0.3s;
        outline: none !important;
    }
    .close-toast-profile:hover { color: #ff69b4; transform: scale(1.2); }

    /* 2. STYLE GIAO DIỆN PROFILE */
    .card-header-custom {
        background-color: #DEFE98 !important;
        color: #000 !important;
        font-weight: bold;
    }

    .btn-save-custom {
        background-color: #DEFE98 !important;
        border-color: #DEFE98 !important;
        color: #000 !important;
        font-weight: bold;
        transition: 0.3s;
    }
    .btn-save-custom:hover {
        background-color: #c9e68a !important;
        transform: translateY(-2px);
    }

    .form-control:focus {
        border-color: #ff69b4 !important;
        box-shadow: 0 0 0 0.25rem rgba(255, 105, 180, 0.2) !important;
    }

    .btn-outline-pink {
        color: #333; border: 1px solid #333; transition: 0.3s;
    }
    .btn-outline-pink:hover {
        background-color: #ff69b4 !important;
        border-color: #ff69b4 !important;
        color: white !important;
    }

    .bg-custom-theme { background-color: #DEFE98 !important; color: #000 !important; }
    .password-toggle { cursor: pointer; border-left: none !important; }
</style>

{{-- TOAST THÔNG BÁO --}}
<div class="toast-container-profile">
    @if(session('success'))
    <div class="custom-toast-profile" id="profileAlert">
        <div style="display: flex; align-items: center; gap: 10px;">
            <i class="bi bi-check-circle-fill" style="color: #DEFE98; font-size: 1.2rem;"></i>
            <span>{{ session('success') }}</span>
        </div>
        <button class="close-toast-profile" onclick="closeProfileToast()">✕</button>
        <div class="progress-bar-profile"></div>
    </div>
    @endif
</div>

<div class="container py-5">
    <h2 class="mb-4">👤 Quản lý tài khoản</h2>

    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4 shadow-sm border-0">
                <div class="card-header card-header-custom">Chỉnh sửa hồ sơ</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            {{-- CỘT AVATAR --}}
                            <div class="col-md-4 text-center border-end mb-4">
                                <div class="avatar-wrapper mb-3">
                                    <img src="{{ $user->avatar ? asset('storage/' . $user->avatar) : 'https://cdn-icons-png.flaticon.com/512/149/149071.png' }}" 
                                         class="rounded-circle img-thumbnail shadow-sm" 
                                         style="width: 180px; height: 180px; object-fit: cover;" 
                                         id="avatar-preview">
                                </div>
                                <div class="px-4 text-start">
                                    <label class="form-label fw-bold small">Chọn ảnh đại diện mới</label>
                                    <input type="file" name="avatar" class="form-control form-control-sm shadow-none" id="avatar-input" accept="image/*">
                                </div>
                            </div>

                            {{-- CỘT THÔNG TIN --}}
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold small">Họ tên</label>
                                        <input type="text" name="name" class="form-control shadow-none" value="{{ $user->name }}" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold small">Email</label>
                                        <input type="email" name="email" class="form-control shadow-none" value="{{ $user->email }}" required>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label fw-bold small">Số điện thoại</label>
                                        <input type="text" name="phone" class="form-control shadow-none" value="{{ $user->phone }}" placeholder="0123456789">
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label fw-bold small">Sở thích</label>
                                        <textarea name="hobbies" class="form-control shadow-none" rows="3">{{ $user->hobbies }}</textarea>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mt-4 border-top pt-3">
                                    <button type="button" class="btn btn-outline-pink fw-bold shadow-none" data-bs-toggle="modal" data-bs-target="#changePasswordModal">
                                        🔑 Đổi mật khẩu
                                    </button>
                                    <button type="submit" class="btn btn-save-custom px-5 shadow-none">Lưu tất cả thay đổi</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- MODAL ĐỔI MẬT KHẨU --}}
<div class="modal fade" id="changePasswordModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-custom-theme">
                <h5 class="modal-title">Thay đổi mật khẩu tài khoản</h5>
                <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" action="{{ route('profile.password') }}">
                @csrf
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Mật khẩu hiện tại</label>
                        <div class="input-group">
                            <input type="password" name="current_password" class="form-control shadow-none border-end-0" required>
                            <span class="input-group-text bg-white password-toggle border-start-0 shadow-none"><i class="fa fa-eye"></i></span>
                        </div>
                    </div>
                    <hr>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Mật khẩu mới</label>
                        <div class="input-group">
                            <input type="password" name="password" class="form-control shadow-none border-end-0" required>
                            <span class="input-group-text bg-white password-toggle border-start-0 shadow-none"><i class="fa fa-eye"></i></span>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Xác nhận mật khẩu mới</label>
                        <div class="input-group">
                            <input type="password" name="password_confirmation" class="form-control shadow-none border-end-0" required>
                            <span class="input-group-text bg-white password-toggle border-start-0 shadow-none"><i class="fa fa-eye"></i></span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light border-0">
                    <button type="button" class="btn btn-secondary shadow-none" data-bs-dismiss="modal">Hủy bỏ</button>
                    <button type="submit" class="btn btn-save-custom px-4 shadow-none">Xác nhận</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Preview ảnh
    document.getElementById('avatar-input').onchange = evt => {
        const [file] = document.getElementById('avatar-input').files
        if (file) { document.getElementById('avatar-preview').src = URL.createObjectURL(file) }
    }

    // Hàm đóng Toast
    function closeProfileToast() {
        const alert = document.getElementById('profileAlert');
        if (alert) {
            alert.style.transform = "translateX(120%)";
            alert.style.opacity = "0";
            alert.style.transition = "0.4s ease";
            setTimeout(() => alert.remove(), 400);
        }
    }

    // Tự động ẩn sau 3s
    document.addEventListener('DOMContentLoaded', function () {
        if (document.getElementById('profileAlert')) {
            setTimeout(closeProfileToast, 3000);
        }
    });

    // Toggle Password
    document.querySelectorAll('.password-toggle').forEach(toggle => {
        toggle.addEventListener('click', function() {
            const input = this.parentElement.querySelector('input');
            const icon = this.querySelector('i');
            if (input.type === "password") {
                input.type = "text";
                icon.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                input.type = "password";
                icon.classList.replace('fa-eye-slash', 'fa-eye');
            }
        });
    });
</script>
@endsection