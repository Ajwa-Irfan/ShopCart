@extends('layouts.app')

@section('title', 'My Cart - ShopCart')

@section('content')

    <section style="background:#0f0c29; min-height:100vh; padding:60px 0;">
        <div class="container">

            {{-- Header --}}
            <div class="d-flex align-items-center justify-content-between mb-4">
                <div>
                    <h2 style="color:#fff; font-weight:800; margin:0;">
                        My <span style="color:#e73958;">Cart</span>
                    </h2>
                    <p style="color:rgba(255,255,255,0.4); font-size:0.9rem; margin:4px 0 0;">
                        {{ $cartItems->count() }} items in your cart
                    </p>
                </div>
                <a href="{{ route('products.index') }}" style="color:rgba(255,255,255,0.5); text-decoration:none; font-size:0.9rem;">
                    <i class="fas fa-arrow-left me-1"></i> Continue Shopping
                </a>
            </div>

            {{-- Success Message --}}
            @if(session('success'))
                <div class="alert-success-custom mb-4">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                </div>
            @endif

            @if($cartItems->count() > 0)
                <div class="row g-4">

                    {{-- CART ITEMS --}}
                    <div class="col-lg-8">
                        @foreach($cartItems as $item)
                            <div class="cart-item">
                                {{-- Product Image --}}
                                <div class="cart-img-wrap">
                                    @if($item->product->image)
                                        <img src="{{ asset('storage/' . $item->product->image) }}"
                                             alt="{{ $item->product->name }}">
                                    @else
                                        <div class="cart-img-placeholder">
                                            <i class="fas fa-image"></i>
                                        </div>
                                    @endif
                                </div>

                                {{-- Product Info --}}
                                <div class="cart-item-info">
                                    <p class="cart-cat">{{ $item->product->category->name ?? 'Uncategorized' }}</p>
                                    <h6 class="cart-name">{{ $item->product->name }}</h6>
                                    <p class="cart-price">Rs. {{ number_format($item->product->price, 0) }}</p>
                                </div>

                                {{-- Quantity --}}
                                <form action="{{ route('cart.update', $item->id) }}" method="POST" class="qty-form">
                                    @csrf
                                    <div class="qty-box">
                                        <button type="button" onclick="changeQty(this, -1)">−</button>
                                        <input type="number" name="quantity" value="{{ $item->quantity }}"
                                               min="1" onchange="this.form.submit()">
                                        <button type="button" onclick="changeQty(this, 1)">+</button>
                                    </div>
                                </form>

                                {{-- Subtotal --}}
                                <div class="cart-subtotal">
                                    Rs. {{ number_format($item->product->price * $item->quantity, 0) }}
                                </div>

                                {{-- Remove --}}
                                <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="remove-btn" onclick="return confirm('Remove this item?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        @endforeach

                        {{-- Clear Cart --}}
                        <form action="{{ route('cart.clear') }}" method="POST" class="mt-3">
                            @csrf
                            <button type="submit" class="clear-cart-btn"
                                    onclick="return confirm('Clear entire cart?')">
                                <i class="fas fa-trash me-2"></i>Clear Cart
                            </button>
                        </form>
                    </div>

                    {{-- ORDER SUMMARY --}}
                    <div class="col-lg-4">
                        <div class="summary-box">
                            <h5 class="summary-title">Order Summary</h5>

                            <div class="summary-row">
                                <span>Subtotal ({{ $cartItems->count() }} items)</span>
                                <span>Rs. {{ number_format($total, 0) }}</span>
                            </div>
                            <div class="summary-row">
                                <span>Delivery</span>
                                <span class="{{ $total >= 2000 ? 'text-green' : '' }}">
                            {{ $total >= 2000 ? 'FREE' : 'Rs. 200' }}
                        </span>
                            </div>
                            @if($total < 2000)
                                <div class="free-delivery-note">
                                    <i class="fas fa-truck me-1"></i>
                                    Rs. {{ number_format(2000 - $total, 0) }} more for FREE delivery!
                                </div>
                            @endif

                            <div class="summary-divider"></div>

                            <div class="summary-total">
                                <span>Total</span>
                                <span>Rs. {{ number_format($total + ($total >= 2000 ? 0 : 200), 0) }}</span>
                            </div>

                            <a href="{{ route('checkout.index') }}" class="checkout-btn">
                                <i class="fas fa-lock me-2"></i>Proceed to Checkout
                            </a>

                            <div class="secure-note">
                                <i class="fas fa-shield-alt me-1"></i> 100% Secure Checkout
                            </div>
                        </div>
                    </div>

                </div>

            @else
                {{-- Empty Cart --}}
                <div class="empty-cart">
                    <div class="empty-icon">🛒</div>
                    <h4>Your cart is empty!</h4>
                    <p>Add some products to get started</p>
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
            color: #27ae60;
            padding: 12px 20px;
            border-radius: 12px;
            font-size: 0.9rem;
        }
        .cart-item {
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 16px;
            padding: 20px;
            display: flex;
            align-items: center;
            gap: 16px;
            margin-bottom: 14px;
            flex-wrap: wrap;
        }
        .cart-img-wrap {
            width: 80px; height: 80px;
            border-radius: 12px;
            overflow: hidden;
            flex-shrink: 0;
        }
        .cart-img-wrap img { width:100%; height:100%; object-fit:cover; }
        .cart-img-placeholder {
            width:100%; height:100%;
            background:rgba(255,255,255,0.05);
            display:flex; align-items:center; justify-content:center;
        }
        .cart-img-placeholder i { color:rgba(255,255,255,0.2); }
        .cart-item-info { flex: 1; min-width: 150px; }
        .cart-cat  { color:#e73958; font-size:0.72rem; font-weight:700; text-transform:uppercase; margin:0 0 4px; }
        .cart-name { color:#fff; font-size:0.92rem; font-weight:600; margin:0 0 6px; }
        .cart-price { color:rgba(255,255,255,0.5); font-size:0.85rem; margin:0; }
        .qty-box {
            display:flex; align-items:center;
            background:rgba(255,255,255,0.06);
            border:1px solid rgba(255,255,255,0.12);
            border-radius:10px; overflow:hidden;
        }
        .qty-box button {
            background:transparent; border:none;
            color:#fff; width:36px; height:38px;
            font-size:1.1rem; cursor:pointer;
        }
        .qty-box button:hover { background:rgba(231,57,88,0.2); }
        .qty-box input {
            width:44px; background:transparent;
            border:none; color:#fff;
            text-align:center; font-size:0.95rem;
            font-weight:700; outline:none;
        }
        .cart-subtotal {
            color:#fff; font-size:1rem;
            font-weight:800; min-width:100px;
            text-align:right;
        }
        .remove-btn {
            background:rgba(231,57,88,0.1);
            border:1px solid rgba(231,57,88,0.3);
            color:#e73958; width:36px; height:36px;
            border-radius:8px; cursor:pointer;
            transition:all 0.2s;
            display:flex; align-items:center; justify-content:center;
        }
        .remove-btn:hover { background:#e73958; color:#fff; }
        .clear-cart-btn {
            background:transparent;
            border:1px solid rgba(255,255,255,0.15);
            color:rgba(255,255,255,0.4);
            padding:8px 20px; border-radius:10px;
            font-size:0.85rem; cursor:pointer;
            transition:all 0.2s;
        }
        .clear-cart-btn:hover { border-color:#e73958; color:#e73958; }

        /* Summary */
        .summary-box {
            background:rgba(255,255,255,0.04);
            border:1px solid rgba(255,255,255,0.08);
            border-radius:16px; padding:24px;
            position:sticky; top:20px;
        }
        .summary-title { color:#fff; font-size:1.1rem; font-weight:800; margin-bottom:20px; }
        .summary-row {
            display:flex; justify-content:space-between;
            color:rgba(255,255,255,0.5); font-size:0.9rem;
            margin-bottom:12px;
        }
        .text-green { color:#27ae60 !important; font-weight:700; }
        .free-delivery-note {
            background:rgba(39,174,96,0.1);
            border:1px solid rgba(39,174,96,0.2);
            color:#27ae60; font-size:0.8rem;
            padding:8px 12px; border-radius:8px;
            margin-bottom:12px;
        }
        .summary-divider { height:1px; background:rgba(255,255,255,0.07); margin:16px 0; }
        .summary-total {
            display:flex; justify-content:space-between;
            color:#fff; font-size:1.1rem;
            font-weight:800; margin-bottom:20px;
        }
        .checkout-btn {
            display:block; text-align:center;
            background:#e73958; color:#fff !important;
            padding:14px; border-radius:12px;
            font-weight:700; text-decoration:none;
            font-size:0.95rem; transition:all 0.3s;
            margin-bottom:12px;
        }
        .checkout-btn:hover {
            background:#c42d47;
            transform:translateY(-2px);
            box-shadow:0 8px 25px rgba(231,57,88,0.35);
        }
        .secure-note {
            text-align:center;
            color:rgba(255,255,255,0.3);
            font-size:0.8rem;
        }

        /* Empty Cart */
        .empty-cart {
            text-align:center; padding:80px 20px;
        }
        .empty-icon { font-size:5rem; margin-bottom:20px; }
        .empty-cart h4 { color:#fff; font-weight:800; margin-bottom:10px; }
        .empty-cart p  { color:rgba(255,255,255,0.4); margin-bottom:24px; }
        .btn-red-solid {
            background:#e73958; color:#fff !important;
            padding:13px 30px; border-radius:50px;
            font-weight:700; text-decoration:none;
            display:inline-block; transition:all 0.3s;
        }
        .btn-red-solid:hover { background:#c42d47; transform:translateY(-2px); }
    </style>

    <script>
        function changeQty(btn, val) {
            const form  = btn.closest('form');
            const input = form.querySelector('input[name="quantity"]');
            const newVal = parseInt(input.value) + val;
            if (newVal >= 1) {
                input.value = newVal;
                form.submit();
            }
        }
    </script>

@endsection
