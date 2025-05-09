<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = Cart::with('product')
            ->where('user_id', auth()->id())
            ->get();

        return view('client.cart.index', compact('cartItems'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $cartItem = Cart::where('user_id', auth()->id())
            ->where('product_id', $request->product_id)
            ->first();

        if ($cartItem) {
            $cartItem->quantity += $request->quantity;
            $cartItem->save();
        } else {
            Cart::create([
                'user_id' => auth()->id(),
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
            ]);
        }

        return redirect()->back()->with('success', 'Sản phẩm đã được thêm vào giỏ hàng!');
    }


    public function update(Request $request)
    {
        $cartItem = Cart::where('user_id', auth()->id())
            ->where('product_id', $request->id)
            ->first();

        if ($cartItem) {
            $cartItem->quantity = $request->quantity;
            $cartItem->save();
        }

        return redirect()->back()->with('success', 'Cập nhật số lượng thành công!');
    }

    public function delete(Request $request)
    {
        Cart::where('user_id', auth()->id())
            ->where('product_id', $request->id)
            ->delete();

        return redirect()->back()->with('success', 'Đã xóa sản phẩm khỏi giỏ hàng!');
    }

    public function clear()
    {
        Cart::where('user_id', auth()->id())->delete();
        return redirect()->back()->with('success', 'Đã xóa toàn bộ giỏ hàng!');
    }
    public function checkout(Request $request)
    {
        $selected = $request->input('selected', []);
        if (empty($selected)) {
            return redirect()->route('cart.index')->with('error', 'Vui lòng chọn ít nhất một sản phẩm để thanh toán!');
        }

        // Lấy sản phẩm từ model Cart
        $selectedCart = Cart::with('product')
            ->where('user_id', Auth::id())
            ->whereIn('id', $selected)
            ->get();

        if ($selectedCart->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Không tìm thấy sản phẩm hợp lệ để thanh toán!');
        }

        $request->session()->put('checkout_items', $selectedCart);

        // Lưu vào session để chuyển qua bước thanh toán
        $request->session()->put('checkout_items', $selectedCart);

        return view('client.cart.checkout', ['cartItems' => $selectedCart]);
    }
    // Xử lý GET khi người dùng reload trang hoặc truy cập lại
    public function showCheckoutPage(Request $request)
    {
        $selectedCart = $request->session()->get('checkout_items');

        if (!$selectedCart || count($selectedCart) === 0) {
            return redirect()->route('cart.index')->with('error', 'Không có sản phẩm để thanh toán. Vui lòng chọn lại từ giỏ hàng!');
        }

        return view('client.cart.checkout', ['cartItems' => $selectedCart]);
    }

    public function order(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'payment_method' => 'required|in:cod,online',
            'selected' => 'required|array' // truyền lại danh sách sản phẩm đã chọn
        ]);

        $selected = $request->input('selected', []);

        $cartItems = Cart::with('product')
            ->where('user_id', Auth::id())
            ->whereIn('product_id', $selected)
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Không có sản phẩm để đặt hàng!');
        }

        try {
            DB::beginTransaction();

            $total = $cartItems->sum(function ($item) {
                return $item->product->price * $item->quantity;
            });

            $order = Order::create([
                'user_id' => Auth::id(),
                'name' => $request->name,
                'phone' => $request->phone,
                'address' => $request->address,
                'payment_method' => $request->payment_method,
                'status' => 'chờ xử lý',
                'total' => $total,
            ]);

            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->price,
                ]);
            }

            // Xóa khỏi bảng Cart
            Cart::where('user_id', Auth::id())
                ->whereIn('product_id', $selected)
                ->delete();

            DB::commit();
            return redirect()->route('home')->with('success', 'Đặt hàng thành công! Mã đơn hàng của bạn là #' . $order->id);

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Lỗi đặt hàng: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Có lỗi xảy ra khi đặt hàng. Vui lòng thử lại!');
        }
    }

}
