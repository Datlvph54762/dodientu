@extends('client.layouts.app')

@section('title', 'Chi tiết đơn hàng #' . $order->id . ' - Đồ Điện Tử')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Chi tiết đơn hàng #{{ $order->id }}</h2>
        <a href="{{ route('orders.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Quay lại
        </a>
    </div>

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">Sản phẩm đã đặt</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Hình ảnh</th>
                                    <th>Sản phẩm</th>
                                    <th>Giá</th>
                                    <th>Số lượng</th>
                                    <th>Thành tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->details as $detail)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="{{ asset('storage/' . $detail->product->image) }}" 
                                                     alt="{{ $detail->product->name }}" 
                                                     style="width: 50px; height: 50px; object-fit: cover;" 
                                                     class="me-3">
                                                <!-- <span>{{ $detail->product->name }}</span> -->
                                            </div>
                                        </td>
                                        <td>{{ $detail->product->name }}</td>
                                        <td>{{ number_format($detail->price) }} đ</td>
                                        <td>{{ $detail->quantity }}</td>
                                        <td>{{ number_format($detail->price * $detail->quantity) }} đ</td>
                                    </tr>
                    
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="3" class="text-end"><strong>Tổng cộng:</strong></td>
                                    <td><strong class="text-danger">{{ number_format($order->total) }} đ</strong></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">Thông tin đơn hàng</h5>
                </div>
                <div class="card-body">
                    <p><strong>Mã đơn hàng:</strong> #{{ $order->id }}</p>
                    <p><strong>Ngày đặt:</strong> {{ $order->created_at->format('d/m/Y H:i') }}</p>
                    <p><strong>Trạng thái:</strong> 
                        @switch($order->status)
                            @case('pending')
                                <span class="badge bg-warning">Chờ xử lý</span>
                                @break
                            @case('processing')
                                <span class="badge bg-info">Đang xử lý</span>
                                @break
                            @case('completed')
                                <span class="badge bg-success">Hoàn thành</span>
                                @break
                            @case('cancelled')
                                <span class="badge bg-danger">Đã hủy</span>
                                @break
                            @default
                                <span class="badge bg-secondary">{{ $order->status }}</span>
                        @endswitch
                    </p>
                    <p><strong>Phương thức thanh toán:</strong> 
                        @if($order->payment_method == 'cod')
                            <span class="badge bg-primary">Thanh toán khi nhận hàng</span>
                        @else
                            <span class="badge bg-success">Đã thanh toán online</span>
                        @endif
                    </p>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Thông tin giao hàng</h5>
                </div>
                <div class="card-body">
                    <p><strong>Người nhận:</strong> {{ $order->name }}</p>
                    <p><strong>Số điện thoại:</strong> {{ $order->phone }}</p>
                    <p><strong>Địa chỉ:</strong> {{ $order->address }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 