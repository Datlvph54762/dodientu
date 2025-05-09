<?php
namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    

public function index(Request $request)
{
    $query = Product::query();

    // Lọc theo danh mục nếu có
    if ($request->has('category')) {
        $query->where('category_id', $request->category);
    }

    // Tìm kiếm theo từ khóa
    if ($request->filled('keyword')) {
        $keyword = $request->keyword;
        $query->where('name', 'like', '%' . $keyword . '%');
    }

    $products = $query->paginate(12);
    $categories = Category::all();

    return view('client.products.index', compact('products', 'categories'));
}


    public function show(Product $product)
    {
        return view('client.products.show', compact('product'));
    }

}
