@extends('client.layouts.app')

@section('title', $product->name . ' - Đồ Điện Tử')

@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid" alt="{{ $product->name }}">
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h1 class="card-title">{{ $product->name }}</h1>
                <p class="text-danger fw-bold fs-4">{{ number_format($product->price) }} đ</p>
                <p class="card-text">{{ $product->description }}</p>
                
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <div class="card-footer bg-white">
                    @auth
                        <form action="{{ route('cart.add') }}" method="POST" class="d-inline">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label class="form-label">Số lượng:</label>
                                    <div class="input-group">
                                        <button type="button" class="btn btn-outline-secondary" onclick="decreaseQuantity()">-</button>
                                        <input type="number" id="quantity" name="quantity" value="1" min="1" class="form-control text-center" style="width: 60px;">
                                        <button type="button" class="btn btn-outline-secondary" onclick="increaseQuantity()">+</button>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="fas fa-cart-plus"></i> Thêm vào giỏ
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-primary w-100">
                            <i class="fas fa-sign-in-alt"></i> Đăng nhập để mua hàng
                        </a>
                    @endauth
                </div>

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Thông tin sản phẩm</h5>
                        <ul class="list-unstyled">
                            <li><strong>Danh mục:</strong> {{ $product->category->name }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Mô tả chi tiết</h5>
            </div>
            <div class="card-body">
                {!! $product->details !!}
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function decreaseQuantity() {
    const input = document.getElementById('quantity');
    const value = parseInt(input.value);
    if (value > 1) {
        input.value = value - 1;
    }
}

function increaseQuantity() {
    const input = document.getElementById('quantity');
    const value = parseInt(input.value);
    input.value = value + 1;
}
</script>
@endpush
@endsection 