@extends('client.layouts.app')

@section('title', 'Giỏ hàng - Đồ Điện Tử')

@section('content')
<div class="container">
    <h2 class="mb-4">Giỏ hàng của bạn</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($cartItems->isEmpty())
        <div class="alert alert-info">Giỏ hàng của bạn đang trống.</div>
        <a href="{{ route('products.index') }}" class="btn btn-primary">Tiếp tục mua sắm</a>
    @else
        <div class="card">
            <div class="card-body">
                <form action="{{ route('cart.checkout') }}" method="POST" id="checkout-form">
                    @csrf
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" id="select-all"></th>
                                    <th>Sản phẩm</th>
                                    <th>Giá</th>
                                    <th>Số lượng</th>
                                    <th>Thành tiền</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $total = 0; @endphp
                                @foreach($cartItems as $item)
                                    @php
                                        $total += $item->product->price * $item->quantity;
                                    @endphp
                                    <tr>
                                        {{-- Checkbox để chọn sản phẩm thanh toán --}}
                                        <td>
                                            <input type="checkbox" name="selected[]" value="{{ $item->id }}" class="item-checkbox">
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}" style="width: 50px; height: 50px; object-fit: cover;" class="me-3">
                                                <span>{{ $item->product->name }}</span>
                                            </div>
                                        </td>
                                        <td>{{ number_format($item->product->price) }} đ</td>

                                        {{-- Form riêng để cập nhật số lượng --}}
                                        <td>
                                            <form action="{{ route('cart.update') }}" method="POST" class="d-flex align-items-center" style="width: 120px;">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $item->product_id }}">
                                                <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" class="form-control form-control-sm me-2">
                                                <button type="submit" class="btn btn-sm btn-outline-primary">Cập nhật</button>
                                            </form>
                                        </td>

                                        <td>{{ number_format($item->product->price * $item->quantity) }} đ</td>

                                        {{-- Form riêng để xóa sản phẩm --}}
                                        <td>
                                            <form action="{{ route('cart.delete') }}" method="POST" class="d-inline">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $item->product_id }}">
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="3" class="text-end"><strong>Tổng cộng:</strong></td>
                                    <td><strong class="text-danger">{{ number_format($total) }} đ</strong></td>
                                    <td></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <div class="d-flex justify-content-between mt-3">
                        <a href="{{ route('products.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Tiếp tục mua sắm
                        </a>
                        <div>
                            
                            <button type="submit" class="btn btn-primary ms-2">
                                <i class="fas fa-shopping-cart"></i> Thanh toán
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>

@endsection

@push('scripts')
<script>
    document.getElementById('select-all').addEventListener('change', function() {
        let checkboxes = document.querySelectorAll('.item-checkbox');
        for (let cb of checkboxes) {
            cb.checked = this.checked;
        }
    });
    document.getElementById('checkout-form').addEventListener('submit', function(e) {
        let checked = document.querySelectorAll('.item-checkbox:checked');
        if (checked.length === 0) {
            e.preventDefault();
            alert('Vui lòng chọn ít nhất một sản phẩm để thanh toán!');
        }else {
            console.log('Form submitted, selected items:', checked.length); // Debug
            let formData = new FormData(this);
            for (let [key, value] of formData.entries()) {
                console.log(key, value); // Debug dữ liệu gửi đi
            }
        }
    });
</script>
@endpush
