@extends('client.layouts.app')

@section('title', 'Trang chủ - Đồ Điện Tử')

@section('content')
<div class="row mb-4">
    <div class="col-md-3">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Danh mục</h5>
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    @foreach($categories as $category)
                    <li class="list-group-item">
                        <a href="?category={{ $category->id }}" class="text-decoration-none">
                            {{ $category->name }}
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <div class="row">
            @foreach($products as $product)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text text-danger fw-bold">{{ number_format($product->price) }} đ</p>
                        <p class="card-text">{{ Str::limit($product->description, 100) }}</p>
                    </div>
                    <div class="card-footer bg-white">
                        <a href="{{ route('products.show', $product->id) }}" class="btn btn-primary w-100">
                            Xem chi tiết
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="d-flex justify-content-center mt-4">
            {{ $products->links() }}
        </div>
    </div>
</div>
@endsection 