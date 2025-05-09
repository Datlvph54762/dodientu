@extends('layouts.admin')

@section('header', 'Sửa Thông Tin Người Dùng')

@section('content')
    <div class="container py-4">
        <h4>Sửa Thông Tin Người Dùng</h4>

        <!-- Form sửa -->
        <form action="{{ route('admin.users.update', $user) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Họ tên</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name) }}"
                    required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $user->email) }}"
                    required>
            </div>

            <div class="form-group">
                <label for="is_admin">Vai trò</label>
                <select name="is_admin" class="form-control" required>
                    <option value="0" {{ $user->is_admin == 0 ? 'selected' : '' }}>User</option>
                    <option value="1" {{ $user->is_admin == 1 ? 'selected' : '' }}>Admin</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Cập nhật</button>
            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Quay lại</a>
        </form>
    </div>
@endsection