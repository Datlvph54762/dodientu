@extends('client.layouts.app')

@section('title', 'Đăng ký')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-5">
        <div class="card mt-5">
            <div class="card-header text-center"><h4>Đăng ký</h4></div>
            <div class="card-body">
                <form action="{{ route('register') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Họ tên</label>
                        <input type="text" name="name" id="name" class="form-control" required autofocus>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" id="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Mật khẩu</label>
                        <input type="password" name="password" id="password" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Xác nhận mật khẩu</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-success w-100">Đăng ký</button>
                </form>
                <div class="mt-3 text-center">
                    <a href="{{ route('login') }}">Đã có tài khoản? Đăng nhập</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 