@extends('layouts.app')

@section('title', 'Order Placed - ShopCart')

@section('content')

    <section style="background:#0f0c29; min-height:100vh; padding:80px 0;">
        <div class="container">
            <div class="success-card">
                <div class="success-icon">🎉</div>
                <h2>Order placed successfully!</h2>
                <p>Thanks!</p>

                <div class="order-details">
                    <div class="order-detail-row">
                        <span>Order Number</span>
                        <strong>{{ $order->order_number }}</strong>
                    </div>
                    <div class="order-detail-row">
                        <span>Total Amount</span>
                        <strong>Rs. {{ number_format($order->total_amount, 0) }}</strong>                    </div>
                    <div class="order-detail-row">
                        <span>Payment Method</span>
                        <strong>{{ $order->payment_method == 'cod' ? 'Cash on Delivery' : 'Online Payment' }}</strong>
                    </div>
                    <div class="order-detail-row">
                        <span>Status</span>
                        <strong class="status-pending">Pending</strong>
                    </div>
                </div>

                <div class="success-btns">
                    <a href="{{ route('orders.index') }}" class="btn-red-solid">
                        <i class="fas fa-list me-2"></i>My Orders
                    </a>
                    <a href="{{ route('products.index') }}" class="btn-ghost">
                        <i class="fas fa-shopping-bag me-2"></i>Continue Shopping
                    </a>
                </div>
            </div>
        </div>
    </section>

    <style>
        .success-card {
            max-width: 560px;
            margin: 0 auto;
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 24px;
            padding: 50px 40px;
            text-align: center;
        }
        .success-icon { font-size: 5rem; margin-bottom: 20px; }
        .success-card h2 { color: #fff; font-weight: 800; margin-bottom: 12px; }
        .success-card p  { color: rgba(255,255,255,0.45); margin-bottom: 30px; }
        .order-details {
            background: rgba(255,255,255,0.03);
            border: 1px solid rgba(255,255,255,0.07);
            border-radius: 14px;
            padding: 20px;
            margin-bottom: 30px;
            text-align: left;
        }
        .order-detail-row {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid rgba(255,255,255,0.05);
            font-size: 0.9rem;
        }
        .order-detail-row:last-child { border-bottom: none; }
        .order-detail-row span   { color: rgba(255,255,255,0.45); }
        .order-detail-row strong { color: #fff; }
        .status-pending { color: #f39c12 !important; }
        .success-btns { display: flex; gap: 14px; justify-content: center; flex-wrap: wrap; }
        .btn-red-solid {
            background: #e73958; color: #fff !important;
            padding: 12px 28px; border-radius: 50px;
            font-weight: 700; text-decoration: none;
            transition: all 0.3s; display: inline-block;
        }
        .btn-red-solid:hover { background: #c42d47; transform: translateY(-2px); }
        .btn-ghost {
            background: transparent;
            color: rgba(255,255,255,0.6) !important;
            border: 1.5px solid rgba(255,255,255,0.2);
            padding: 12px 28px; border-radius: 50px;
            font-weight: 600; text-decoration: none;
            transition: all 0.3s; display: inline-block;
        }
        .btn-ghost:hover { border-color: #fff; color: #fff !important; }
    </style>

@endsection
