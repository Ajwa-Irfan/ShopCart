<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::where('status', 1)->get();

        $query = Product::where('status', 1)->with('category');

        // Category filter
        if ($request->category) {
            $query->where('category_id', $request->category);
        }

        // Search filter
        if ($request->search) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Sort filter
        if ($request->sort == 'price_low') {
            $query->orderBy('price', 'asc');
        } elseif ($request->sort == 'price_high') {
            $query->orderBy('price', 'desc');
        } elseif ($request->sort == 'latest') {
            $query->latest();
        } else {
            $query->latest();
        }

        $products = $query->paginate(12);

        return view('products.index', compact('products', 'categories'));
    }

    public function show($id)
    {
        $product  = Product::with('category')->findOrFail($id);
        $related  = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $id)
            ->where('status', 1)
            ->take(4)
            ->get();

        return view('products.show', compact('product', 'related'));
    }
}
