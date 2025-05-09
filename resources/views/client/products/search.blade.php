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
        @if(request('keyword'))
            <h5>Kết quả tìm kiếm cho: <strong>{{ request('keyword') }}</strong></h5>
        @endif

        <div class="row">
            @forelse($products as $product)
                <div class="col-md-3 mb-4">
                    <div class="card h-100">
                        <img src="{{ asset('uploads/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">{{ number_format($product->price, 0, ',', '.') }} đ</p>
                            <a href="{{ route('products.show', $product->id) }}" class="btn btn-primary">Xem chi tiết</a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <p>Không tìm thấy sản phẩm nào phù hợp.</p>
                </div>
            @endforelse
        </div>

        <div class="mt-4">
            {{ $products->withQueryString()->links() }}
        </div>

    </div>
@endsection