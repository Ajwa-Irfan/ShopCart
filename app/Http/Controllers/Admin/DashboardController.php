<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Models\ContactMessage;

class DashboardController extends Controller
{
    public function index()
    {
        $totalOrders    = Order::count();
        $totalProducts  = Product::count();
        $totalCustomers = User::where('role', 'customer')->count();
        $totalRevenue = Order::where('status', 'delivered')->sum('total_amount');        $recentOrders   = Order::with('user')->latest()->take(5)->get();
        $pendingContacts = ContactMessage::where('replied', false)->count();

        return view('admin.dashboard', compact(
            'totalOrders',
            'totalProducts',
            'totalCustomers',
            'totalRevenue',
            'recentOrders',
            'pendingContacts'
        ));
    }
}
