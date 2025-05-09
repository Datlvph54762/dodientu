@extends('client.layouts.app')

@section('title', 'Trang chủ - Đồ Điện Tử')

@section('content')
<div class="container">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div id="homeCarousel" class="carousel slide mb-5" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="/storage/slides/slide1.jpg" class="d-block w-100" style="height:350px;object-fit:cover;" alt="Slide 1">
            </div>
            <div class="carousel-item">
                <img src="/storage/slides/slide2.jpg" class="d-block w-100" style="height:350px;object-fit:cover;" alt="Slide 2">
            </div>
            <div class="carousel-item">
                <img src="/storage/slides/slide3.jpg" class="d-block w-100" style="height:350px;object-fit:cover;" alt="Slide 3">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#homeCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#homeCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </div>

    {{-- Hiển thị sản phẩm nổi bật --}}
    <div class="row">
        <h2 class="mb-4">Sản phẩm mới nhất</h2>
        @foreach($products as $product)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <a href="{{ route('products.show', $product->id) }}">
                    <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                    </a>
                    
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text text-danger fw-bold">{{ number_format($product->price) }} đ</p>
                    </div>
                    <div class="card-footer bg-white">
                        @auth
                            <form action="{{ route('cart.add') }}" method="POST" class="d-inline">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <input type="hidden" name="quantity" value="1">
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
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection 