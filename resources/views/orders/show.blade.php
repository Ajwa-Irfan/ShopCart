@extends('layouts.app')

@section('title', 'Order Details - ShopCart')

@section('content')

    <section style="background:#0f0c29; min-height:100vh; padding:60px 0;">
        <div class="container">

            <div class="d-flex align-items-center justify-content-between mb-4">
                <h2 style="color:#fff; font-weight:800; margin:0;">
                    Order <span style="color:#e73958;">Details</span>
                </h2>
                <a href="{{ route('orders.index') }}"
                   style="color:rgba(255,255,255,0.5); text-decoration:none; font-size:0.9rem;">
                    <i class="fas fa-arrow-left me-1"></i> My Orders
                </a>
            </div>

            <div class="row g-4">

                {{-- LEFT - Items --}}
                <div class="col-lg-8">
                    <div class="detail-box">
                        <h5 class="box-title">
                            <i class="fas fa-box me-2" style="color:#e73958;"></i>
                            Ordered Items
                        </h5>
                        @foreach($order->items as $item)
                            <div class="item-row">
                                <div class="item-img">
                                    @if($item->product->image)
                                        <img src="{{ asset('storage/' . $item->product->image) }}"
                                             alt="{{ $item->product->name }}">
                                    @else
                                        <i class="fas fa-image"></i>
                                    @endif
                                </div>
                                <div class="item-info">
                                    <p class="item-name">{{ $item->product->name }}</p>
                                    <p class="item-cat">{{ $item->product->category->name ?? '' }}</p>
                                </div>
                                <div class="item-qty">× {{ $item->quantity }}</div>
                                <div class="item-price">
                                    Rs. {{ number_format($item->price * $item->quantity, 0) }}
                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{-- Shipping Info --}}
                    <div class="detail-box mt-4">
                        <h5 class="box-title">
                            <i class="fas fa-map-marker-alt me-2" style="color:#e73958;"></i>
                            Shipping Details
                        </h5>
                        <div class="info-grid">
                            <div class="info-item">
                                <span class="info-label">Name</span>
                                <span class="info-val">{{ $order->name }}</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Phone</span>
                                <span class="info-val">{{ $order->phone }}</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Email</span>
                                <span class="info-val">{{ $order->email }}</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">City</span>
                                <span class="info-val">{{ $order->city }}</span>
                            </div>
                            <div class="info-item" style="grid-column: 1/-1;">
                                <span class="info-label">Address</span>
                                <span class="info-val">{{ $order->address }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- RIGHT - Summary --}}
                <div class="col-lg-4">
                    <div class="detail-box">
                        <h5 class="box-title">
                            <i class="fas fa-receipt me-2" style="color:#e73958;"></i>
                            Order Summary
                        </h5>

                        <div class="summary-row">
                            <span>Order Number</span>
                            <span style="color:#fff; font-weight:600;">{{ $order->order_number }}</span>
                        </div>
                        <div class="summary-row">
                            <span>Date</span>
                            <span>{{ $order->created_at->format('d M Y') }}</span>
                        </div>
                        <div class="summary-row">
                            <span>Payment</span>
                            <span>{{ $order->payment_method == 'cod' ? '💵 Cash on Delivery' : '💳 Online' }}</span>
                        </div>
                        <div class="summary-row">
                            <span>Status</span>
                            <span class="order-status status-{{ $order->status }}">
                            {{ ucfirst($order->status) }}
                        </span>
                        </div>

                        <div class="summary-divider"></div>
                        <div class="summary-row">
                            <span>Subtotal</span>
                            <span>Rs. {{ number_format($order->total_amount, 0) }}</span>
                        </div>
                        <div class="summary-row">
                            <span>Delivery</span>
                            <span class="text-green">FREE</span>
                        </div>

                        <div class="summary-divider"></div>

                        <div class="summary-total">
                            <span>Total</span>
                            <span>Rs. {{ number_format($order->total_amount, 0) }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        .detail-box {
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 16px; padding: 24px;
        }
        .box-title {
            color: #fff; font-size: 1rem;
            font-weight: 700; margin-bottom: 20px;
            padding-bottom: 14px;
            border-bottom: 1px solid rgba(255,255,255,0.07);
        }
        .item-row {
            display: flex; align-items: center;
            gap: 14px; padding: 12px 0;
            border-bottom: 1px solid rgba(255,255,255,0.05);
        }
        .item-row:last-child { border-bottom: none; }
        .item-img {
            width: 56px; height: 56px;
            border-radius: 10px; overflow: hidden;
            background: rgba(255,255,255,0.05);
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }
        .item-img img { width:100%; height:100%; object-fit:cover; }
        .item-img i { color:rgba(255,255,255,0.2); }
        .item-info { flex: 1; }
        .item-name { color:#fff; font-size:0.88rem; font-weight:600; margin:0 0 3px; }
        .item-cat  { color:rgba(255,255,255,0.35); font-size:0.75rem; margin:0; }
        .item-qty  { color:rgba(255,255,255,0.4); font-size:0.85rem; }
        .item-price { color:#e73958; font-size:0.95rem; font-weight:700; min-width:80px; text-align:right; }
        .info-grid { display:grid; grid-template-columns:1fr 1fr; gap:16px; }
        .info-item { display:flex; flex-direction:column; gap:4px; }
        .info-label { color:rgba(255,255,255,0.35); font-size:0.75rem; text-transform:uppercase; letter-spacing:0.8px; }
        .info-val   { color:#fff; font-size:0.9rem; font-weight:500; }
        .summary-row {
            display:flex; justify-content:space-between;
            color:rgba(255,255,255,0.5); font-size:0.9rem;
            margin-bottom:12px;
        }
        .summary-divider { height:1px; background:rgba(255,255,255,0.07); margin:14px 0; }
        .summary-total {
            display:flex; justify-content:space-between;
            color:#fff; font-size:1.1rem; font-weight:800;
        }
        .text-green { color:#27ae60 !important; font-weight:700; }
        .order-status {
            padding: 3px 12px; border-radius: 50px;
            font-size: 0.78rem; font-weight: 700;
        }
        .status-pending    { background:rgba(243,156,18,0.15); color:#f39c12; }
        .status-processing { background:rgba(52,152,219,0.15); color:#3498db; }
        .status-shipped    { background:rgba(155,89,182,0.15); color:#9b59b6; }
        .status-delivered  { background:rgba(39,174,96,0.15);  color:#27ae60; }
        .status-cancelled  { background:rgba(231,57,88,0.15);  color:#e73958; }
    </style>

@endsection
