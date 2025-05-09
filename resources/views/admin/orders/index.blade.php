@extends('layouts.admin')

@section('title', 'Quản lý danh mục')
@section('header', 'Quản lý đơn hàng')

@section('content')
    <h1>Danh sách đơn hàng</h1>

    

    <!--  -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mã Đơn Hàng
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Khách Hàng
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Số điện thoại
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ngày Đặt</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Trạng Thái
                    </th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Thao tác
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($orders as $order)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">{{ $order->id }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $order->name }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $order->phone }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $order->created_at->format('d/m/Y')  }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST"
                                onsubmit="return confirm('Bạn có chắc muốn đổi trạng thái đơn hàng này?')">
                                @csrf
                                @method('PUT')
                                <select name="status" onchange="this.form.submit()"
                                    class="form-select text-sm text-gray-900 rounded border-gray-300 shadow-sm">
                                    <option value="chờ xử lý" {{ $order->status == 'chờ xử lý' ? 'selected' : '' }}>Chờ xử lý
                                    </option>
                                    <option value="đang giao" {{ $order->status == 'đang giao' ? 'selected' : '' }}>Đang giao
                                    </option>
                                    <option value="đã giao" {{ $order->status == 'đã giao' ? 'selected' : '' }}>Đã giao</option>
                                </select>
                            </form>
                        </td>
                        <td style="text-align: center;">
                            <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-primary">Xem</a>
                            <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    
@endsection