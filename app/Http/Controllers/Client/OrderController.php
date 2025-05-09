<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('client.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        // Eager load details và sản phẩm liên quan
    $order = $order->load('details.product'); 
        // Kiểm tra xem đơn hàng có thuộc về người dùng hiện tại không
    if ($order->user_id !== auth()->id()) {
        return redirect()->route('orders.index')->with('error', 'Không tìm thấy đơn hàng!');
    }

    return view('client.orders.show', compact('order'));
    }
}