@extends('layouts.admin')

@section('title', 'Quản lý danh mục')
@section('header', 'Quản lý đơn hàng')

@section('content')
    <div class="container mt-5">
        <h2 class="mb-4 text-primary">Chi tiết đơn hàng #{{ $order->id }}</h2>

        <div class="card shadow-sm mb-5">
            <div class="card-body">
                <div class="row mb-2">
                    <div class="col-md-6">
                        <p><strong>👤 Khách hàng:</strong> {{ $order->user->name }} ({{ $order->user->email }})</p>
                        <p><strong>👤 Số điện thoại:</strong> {{ $order->phone }}</p>
                        <p><strong>📅 Ngày đặt:</strong> {{ $order->created_at->format('d/m/Y H:i') }}</p>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <p><strong>💰 Tổng tiền:</strong> <span
                                class="text-danger fs-5">{{ number_format($order->total, 0, ',', '.') }}đ</span></p>
                    </div>
                </div>
            </div>
        </div>

        <h4 class="mb-4 text-secondary">🛒 Sản phẩm</h4>
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle text-center shadow-sm" style="font-size: 1.05rem">
                <thead class="table-dark">
                    <tr>
                        <th style="width: 120px">Hình ảnh</th>
                        <th style="width: 200px">Tên sản phẩm</th>
                        <th style="width: 120px">Số lượng</th>
                        <th style="width: 150px">Giá</th>
                        <th style="width: 160px">Thành tiền</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->details as $detail)
                        <tr>
                            <td>
                                <img src="{{ asset('storage/' . $detail->product->image) }}" alt="{{ $detail->product->name }}"
                                    class="img-thumbnail" style="max-width: 100px; height: auto;">
                            </td>
                            <td class="text-start">{{ $detail->product->name }}</td>
                            <td style="text-align: center;">{{ $detail->quantity }}</td>
                            <td style="text-align: center;" class="text-danger">
                                {{ number_format($detail->price, 0, ',', '.') }}đ
                            </td>
                            <td style="text-align: center;" class="text-success fw-bold">
                                {{ number_format($detail->quantity * $detail->price, 0, ',', '.') }}đ
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-4    text-center">
                <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-primary ">
                    ⬅ Quay lại 
                </a>
            </div>
        </div>
    </div>
@endsection