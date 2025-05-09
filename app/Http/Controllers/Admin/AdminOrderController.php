<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    // Hiển thị danh sách đơn hàng
    public function index()
    {
        $orders = Order::paginate(10); // Lấy 10 đơn hàng mỗi trang
        return view('admin.orders.index', compact('orders'));
    }

    
    public function show($id)
    {
        $order = Order::findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }
    public function updateStatus(Request $request, $id)
{
    $request->validate([
        'status' => 'required|in:chờ xử lý,đang giao,đã giao',
    ]);

    $order = Order::findOrFail($id);
    $order->status = $request->status;
    $order->save();

    return redirect()->back()->with('success', 'Cập nhật trạng thái đơn hàng thành công.');
}
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();
        return redirect()->route('admin.orders.index')->with('success', 'Đơn hàng đã bị xóa');
    }
    
}
