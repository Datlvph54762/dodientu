@extends('layouts.admin')


@section('header', 'Quản lý Người dùng')


@section('content')
    <div class="container py-4">


        {{-- Tìm kiếm --}}
        <form action="{{ route('admin.users.index') }}" method="GET" class="row g-2 mb-3">
            <div class="col-md-10">
                <input type="text" name="search" class="form-control" placeholder="Tìm kiếm..."
                    value="{{ request('search') }}">
                <button class="btn btn-dark w-100">
                    <i class="bi bi-search"></i> Tìm
                </button>
            </div>

        </form>


        <div class="table-responsive rounded shadow-sm">
            <table class="table table-bordered table-hover text-center align-middle table-striped">
                <thead class="table-dark">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Họ tên
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Vai trò
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ngày tạo
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Hành động
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        <tr>
                            <td class="fw-semibold">{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <span class="badge bg-{{ $user->is_admin == 1 ? 'danger' : 'secondary' }}">
                                    {{ $user->is_admin == 1 ? 'Admin' : 'User' }}
                                </span>
                            </td>
                            <td>{{ $user->created_at->format('d/m/Y') }}</td>
                            <td>
                                <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-sm btn-outline-warning me-1">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('Bạn có chắc chắn muốn xoá?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger">
                                        <i class="bi bi-trash3-fill"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-muted">Không có người dùng nào.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>


        {{-- Phân trang --}}
        <div class="mt-3">
            {{ $users->withQueryString()->links() }}
        </div>
    </div>
@endsection