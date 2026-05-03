<?php
namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index()
    {
        $cartItems = Cart::where('user_id', Auth::id())
            ->with('product')
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')
                ->with('error', 'Cart empty hai!');
        }

        $subtotal     = $cartItems->sum(fn($i) => $i->product->price * $i->quantity);
        $deliveryFee  = $subtotal >= 2000 ? 0 : 200;
        $total        = $subtotal + $deliveryFee;

        return view('checkout.index',
            compact('cartItems', 'subtotal', 'deliveryFee', 'total'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'           => 'required|string|max:100',
            'email'          => 'required|email',
            'phone'          => 'required|string|max:20',
            'address'        => 'required|string',
            'city'           => 'required|string',
            'payment_method' => 'required|in:cod,online',
        ]);

        $cartItems = Cart::where('user_id', Auth::id())
            ->with('product')
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')
                ->with('error', 'Cart empty hai!');
        }

        $subtotal    = $cartItems->sum(fn($i) => $i->product->price * $i->quantity);
        $deliveryFee = $subtotal >= 2000 ? 0 : 200;
        $total       = $subtotal + $deliveryFee;

        // Order create karo
        $order = Order::create([
            'user_id'        => Auth::id(),
            'order_number'   => 'ORD-' . strtoupper(uniqid()),
            'name'           => $request->name,
            'email'          => $request->email,
            'phone'          => $request->phone,
            'address'        => $request->address,
            'city'           => $request->city,
            'total_amount'   => $total,
            'payment_method' => $request->payment_method,
            'status'         => 'pending',
        ]);

        // Order items save karo
        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id'   => $order->id,
                'product_id' => $item->product_id,
                'quantity'   => $item->quantity,
                'price'      => $item->product->price,
            ]);
        }

        // Cart clear karo
        Cart::where('user_id', Auth::id())->delete();

        return redirect()->route('orders.success', $order->id);
    }
}
