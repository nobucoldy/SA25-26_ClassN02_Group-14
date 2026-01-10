@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">👤 Quản lý tài khoản</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="row">
        {{-- THÔNG TIN --}}
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header fw-bold">Thông tin cá nhân</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('profile.update') }}">
                        @csrf

                        <div class="mb-3">
                            <label>Họ tên</label>
                            <input type="text" name="name"
                                   class="form-control"
                                   value="{{ $user->name }}">
                        </div>

                        <div class="mb-3">
                            <label>Email</label>
                            <input type="email" name="email"
                                   class="form-control"
                                   value="{{ $user->email }}">
                        </div>

                        <button class="btn btn-primary">Lưu thay đổi</button>
                    </form>
                </div>
            </div>
        </div>

        {{-- ĐỔI MẬT KHẨU --}}
        <div class="col-md-6">
            <div class="card">
                <div class="card-header fw-bold">Đổi mật khẩu</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('profile.password') }}">
                        @csrf

                        <div class="mb-3">
                            <label>Mật khẩu hiện tại</label>
                            <input type="password" name="current_password"
                                   class="form-control">
                        </div>

                        <div class="mb-3">
                            <label>Mật khẩu mới</label>
                            <input type="password" name="password"
                                   class="form-control">
                        </div>

                        <div class="mb-3">
                            <label>Xác nhận mật khẩu</label>
                            <input type="password" name="password_confirmation"
                                   class="form-control">
                        </div>

                        <button class="btn btn-danger">Đổi mật khẩu</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
