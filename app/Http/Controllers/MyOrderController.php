<?php
namespace App\Http\Controllers;

use App\Models\Order;

class MyOrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', auth()->id())
            ->latest()
            ->get();
        return view('orders.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::where('user_id', auth()->id())
            ->with('orderItems.product')
            ->findOrFail($id);
        return view('orders.show', compact('order'));
    }

    public function success($id)
    {
        $order = Order::where('user_id', auth()->id())
            ->with('items.product.category')
            ->findOrFail($id);
    }
}
