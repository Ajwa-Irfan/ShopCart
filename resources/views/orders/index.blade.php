@extends('layouts.app')

@section('title', 'My Orders - ShopCart')

@section('content')

    <section style="background:#0f0c29; min-height:100vh; padding:60px 0;">
        <div class="container">

            <div class="d-flex align-items-center justify-content-between mb-4">
                <div>
                    <h2 style="color:#fff; font-weight:800; margin:0;">
                        My <span style="color:#e73958;">Orders</span>
                    </h2>
                    <p style="color:rgba(255,255,255,0.4); font-size:0.9rem; margin:4px 0 0;">
                        {{ $orders->count() }} orders total
                    </p>
                </div>
                <a href="{{ route('products.index') }}"
                   style="color:rgba(255,255,255,0.5); text-decoration:none; font-size:0.9rem;">
                    <i class="fas fa-shopping-bag me-1"></i> Continue Shopping
                </a>
            </div>

            @if(session('success'))
                <div class="alert-success-custom mb-4">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                </div>
            @endif

            @if($orders->count() > 0)
                @foreach($orders as $order)
                    <div class="order-card">
                        <div class="order-header">
                            <div>
                                <span class="order-num">{{ $order->order_number }}</span>
                                <span class="order-date">
                            {{ $order->created_at->format('d M Y, h:i A') }}
                        </span>
                            </div>
                            <span class="order-status status-{{ $order->status }}">
                        {{ ucfirst($order->status) }}
                    </span>
                        </div>

                        <div class="order-items-preview">
                            @foreach($order->items->take(3) as $item)
                                <div class="preview-item">
                                    <div class="preview-img">
                                        @if($item->product->image)
                                            <img src="{{ asset('storage/' . $item->product->image) }}"
                                                 alt="{{ $item->product->name }}">
                                        @else
                                            <i class="fas fa-image"></i>
                                        @endif
                                    </div>
                                    <div>
                                        <p class="preview-name">{{ $item->product->name }}</p>
                                        <p class="preview-qty">Qty: {{ $item->quantity }} × Rs. {{ number_format($item->price, 0) }}</p>
                                    </div>
                                </div>
                            @endforeach
                            @if($order->items->count() > 3)
                                <p style="color:rgba(255,255,255,0.3); font-size:0.8rem; margin-top:8px;">
                                    +{{ $order->items->count() - 3 }} more items
                                </p>
                            @endif
                        </div>

                        <div class="order-footer">
                            <div class="order-total">
                                Total: <strong>Rs. {{ number_format($order->total_amount, 0) }}</strong>
                                <span class="pay-method">
                            {{ $order->payment_method == 'cod' ? '💵 COD' : '💳 Online' }}
                        </span>
                            </div>
                            <a href="{{ route('orders.show', $order->id) }}" class="view-order-btn">
                                <i class="fas fa-eye me-1"></i> View Details
                            </a>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="empty-orders">
                    <div style="font-size:5rem; margin-bottom:20px;">📦</div>
                    <h4>No order found!</h4>
                    <p>Place you first order</p>
                    <a href="{{ route('products.index') }}" class="btn-red-solid">
                        <i class="fas fa-shopping-bag me-2"></i>Shop Now
                    </a>
                </div>
            @endif

        </div>
    </section>

    <style>
        .alert-success-custom {
            background: rgba(39,174,96,0.15);
            border: 1px solid rgba(39,174,96,0.3);
            color: #27ae60; padding: 12px 20px;
            border-radius: 12px; font-size: 0.9rem;
        }
        .order-card {
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 16px; padding: 22px;
            margin-bottom: 16px;
            transition: border-color 0.2s;
        }
        .order-card:hover { border-color: rgba(231,57,88,0.3); }
        .order-header {
            display: flex; justify-content: space-between;
            align-items: center; margin-bottom: 18px;
            padding-bottom: 14px;
            border-bottom: 1px solid rgba(255,255,255,0.07);
            flex-wrap: wrap; gap: 10px;
        }
        .order-num {
            color: #fff; font-weight: 700;
            font-size: 0.95rem; display: block;
        }
        .order-date {
            color: rgba(255,255,255,0.35);
            font-size: 0.8rem; display: block;
            margin-top: 3px;
        }
        .order-status {
            padding: 5px 14px; border-radius: 50px;
            font-size: 0.8rem; font-weight: 700;
        }
        .status-pending    { background:rgba(243,156,18,0.15); color:#f39c12; }
        .status-processing { background:rgba(52,152,219,0.15); color:#3498db; }
        .status-shipped    { background:rgba(155,89,182,0.15); color:#9b59b6; }
        .status-delivered  { background:rgba(39,174,96,0.15);  color:#27ae60; }
        .status-cancelled  { background:rgba(231,57,88,0.15);  color:#e73958; }
        .preview-item {
            display: flex; align-items: center;
            gap: 12px; margin-bottom: 10px;
        }
        .preview-img {
            width: 48px; height: 48px;
            border-radius: 10px; overflow: hidden;
            background: rgba(255,255,255,0.05);
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }
        .preview-img img { width:100%; height:100%; object-fit:cover; }
        .preview-img i { color:rgba(255,255,255,0.2); font-size:0.9rem; }
        .preview-name { color:#fff; font-size:0.85rem; font-weight:600; margin:0 0 3px; }
        .preview-qty  { color:rgba(255,255,255,0.4); font-size:0.78rem; margin:0; }
        .order-footer {
            display: flex; justify-content: space-between;
            align-items: center; margin-top: 16px;
            padding-top: 14px;
            border-top: 1px solid rgba(255,255,255,0.07);
            flex-wrap: wrap; gap: 10px;
        }
        .order-total { color:rgba(255,255,255,0.5); font-size:0.9rem; }
        .order-total strong { color:#fff; font-size:1rem; }
        .pay-method {
            margin-left: 10px;
            background: rgba(255,255,255,0.06);
            padding: 3px 10px; border-radius: 50px;
            font-size: 0.78rem; color: rgba(255,255,255,0.5);
        }
        .view-order-btn {
            background: rgba(231,57,88,0.1);
            border: 1px solid rgba(231,57,88,0.3);
            color: #e73958 !important; padding: 8px 18px;
            border-radius: 10px; text-decoration: none;
            font-size: 0.85rem; font-weight: 600;
            transition: all 0.2s;
        }
        .view-order-btn:hover { background:#e73958; color:#fff !important; }
        .empty-orders { text-align:center; padding:80px 20px; }
        .empty-orders h4 { color:#fff; font-weight:800; margin-bottom:10px; }
        .empty-orders p  { color:rgba(255,255,255,0.4); margin-bottom:24px; }
        .btn-red-solid {
            background:#e73958; color:#fff !important;
            padding:12px 28px; border-radius:50px;
            font-weight:700; text-decoration:none;
            display:inline-block; transition:all 0.3s;
        }
        .btn-red-solid:hover { background:#c42d47; transform:translateY(-2px); }
    </style>

@endsection
