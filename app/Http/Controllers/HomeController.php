<?php
namespace App\Http\Controllers;

use App\Models\Slider;
use App\Models\Product;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        $sliders    = Slider::where('status', 1)->get();
        $categories = Category::where('status', 1)->withCount('products')->get();
        $products   = Product::where('status', 1)->latest()->take(8)->get();

        return view('home', compact('sliders', 'categories', 'products'));
    }
}
