@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-5">
        <h3 class="text-center mb-3">Đăng ký tài khoản</h3>

        <form method="POST" action="/register">
            @csrf

            <div class="mb-3">
                <label>Họ tên</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Mật khẩu</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Nhập lại mật khẩu</label>
                <input type="password" name="password_confirmation" class="form-control" required>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    {{ $errors->first() }}
                </div>
            @endif

            <button class="btn btn-success w-100">
                Đăng ký
            </button>

            <p class="text-center mt-3">
                Đã có tài khoản?
                <a href="/login">Đăng nhập</a>
            </p>
        </form>
    </div>
</div>
@endsection
