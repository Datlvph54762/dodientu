@extends('layouts.admin')

@section('title', 'Dashboard')
@section('header', 'Dashboard')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-blue-500 bg-opacity-75">
                <i class="fas fa-box text-2xl text-white"></i>
            </div>
            <div class="ml-4">
                <h3 class="text-gray-500 text-sm">Tổng số sản phẩm</h3>
                <p class="text-2xl font-semibold">{{ $totalProducts }}</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-green-500 bg-opacity-75">
                <i class="fas fa-tags text-2xl text-white"></i>
            </div>
            <div class="ml-4">
                <h3 class="text-gray-500 text-sm">Tổng số danh mục</h3>
                <p class="text-2xl font-semibold">{{ $totalCategories }}</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-purple-500 bg-opacity-75">
                <i class="fas fa-shopping-cart text-2xl text-white"></i>
            </div>
            <div class="ml-4">
                <h3 class="text-gray-500 text-sm">Tổng số đơn hàng</h3>
                <p class="text-2xl font-semibold">{{ $totalOrders }}</p>
            </div>
        </div>
    </div>
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-purple-500 bg-opacity-75">
                <i class="fas fa-shopping-cart text-2xl text-white"></i>
            </div>
            <div class="ml-4">
                <h3 class="text-gray-500 text-sm">Tổng số Tài khoản</h3>
                <p class="text-2xl font-semibold">{{ $totalUsers }}</p>
            </div>
        </div>
    </div>
</div>

<!-- Sản phẩm mới nhất -->
<div class="bg-white rounded-lg shadow">
    <div class="p-6 border-b border-gray-100">
        <h2 class="text-xl font-semibold">Sản phẩm mới nhất</h2>
    </div>
    <div class="p-6">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="text-left bg-gray-50">
                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Sản phẩm</th>
                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Hình ảnh</th>
                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Danh mục</th>
                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Giá</th>
                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Ngày tạo</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($latestProducts as $product)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">{{ $product->name }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <img class="h-16 w-16 object-cover rounded" src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $product->category->name }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ number_format($product->price) }}đ</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $product->created_at ? $product->created_at->format('d/m/Y') : '' }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
    Tạo sản phẩm
</button>
@endsection 