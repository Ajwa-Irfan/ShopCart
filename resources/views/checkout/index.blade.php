@extends('layouts.app')

@section('title', 'Checkout - ShopCart')

@section('content')

    <section style="background:#0f0c29; min-height:100vh; padding:60px 0;">
        <div class="container">

            <div class="d-flex align-items-center justify-content-between mb-4">
                <h2 style="color:#fff; font-weight:800; margin:0;">
                    <span style="color:#e73958;">Checkout</span>
                </h2>
                <a href="{{ route('cart.index') }}"
                   style="color:rgba(255,255,255,0.5); text-decoration:none; font-size:0.9rem;">
                    <i class="fas fa-arrow-left me-1"></i> Back to Cart
                </a>
            </div>

            <form action="{{ route('checkout.store') }}" method="POST">
                @csrf
                <div class="row g-4">

                    {{-- LEFT - Shipping Info --}}
                    <div class="col-lg-7">
                        <div class="checkout-box">
                            <h5 class="box-title">
                                <i class="fas fa-map-marker-alt me-2" style="color:#e73958;"></i>
                                Shipping Information
                            </h5>

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label-custom">Full Name</label>
                                    <input type="text" name="name"
                                           value="{{ Auth::user()->name }}"
                                           class="form-input-custom @error('name') is-error @enderror"
                                           placeholder="Your name">
                                    @error('name')
                                    <span class="error-msg">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label-custom">Email</label>
                                    <input type="email" name="email"
                                           value="{{ Auth::user()->email }}"
                                           class="form-input-custom @error('email') is-error @enderror"
                                           placeholder="Email address">
                                    @error('email')
                                    <span class="error-msg">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label-custom">Phone Number</label>
                                    <input type="text" name="phone"
                                           class="form-input-custom @error('phone') is-error @enderror"
                                           placeholder="03XX-XXXXXXX">
                                    @error('phone')
                                    <span class="error-msg">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label-custom">City</label>
                                    <input type="text" name="city"
                                           class="form-input-custom @error('city') is-error @enderror"
                                           placeholder="Your city">
                                    @error('city')
                                    <span class="error-msg">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <label class="form-label-custom">Full Address</label>
                                    <textarea name="address" rows="3"
                                              class="form-input-custom @error('address') is-error @enderror"
                                              placeholder="Your complete address"></textarea>
                                    @error('address')
                                    <span class="error-msg">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        {{-- Payment Method --}}
                        <div class="checkout-box mt-4">
                            <h5 class="box-title">
                                <i class="fas fa-credit-card me-2" style="color:#e73958;"></i>
                                Payment Method
                            </h5>
                            <div class="payment-options">
                                <label class="payment-option">
                                    <input type="radio" name="payment_method"
                                           value="cod" checked>
                                    <div class="payment-card">
                                        <span class="pay-icon">💵</span>
                                        <div>
                                            <p class="pay-title">Cash on Delivery</p>
                                            <p class="pay-desc">Payment on delivery</p>
                                        </div>
                                        <span class="pay-check">✓</span>
                                    </div>
                                </label>
                                <label class="payment-option">
                                    <input type="radio" name="payment_method" value="online">
                                    <div class="payment-card">
                                        <span class="pay-icon">💳</span>
                                        <div>
                                            <p class="pay-title">Online Payment</p>
                                            <p class="pay-desc">Card / Bank transfer</p>
                                        </div>
                                        <span class="pay-check">✓</span>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>

                    {{-- RIGHT - Order Summary --}}
                    <div class="col-lg-5">
                        <div class="checkout-box">
                            <h5 class="box-title">
                                <i class="fas fa-shopping-bag me-2" style="color:#e73958;"></i>
                                Order Summary
                            </h5>

                            {{-- Items --}}
                            @foreach($cartItems as $item)
                                <div class="order-item">
                                    <div class="order-item-img">
                                        @if($item->product->image)
                                            <img src="{{ asset('storage/' . $item->product->image) }}"
                                                 alt="{{ $item->product->name }}">
                                        @else
                                            <i class="fas fa-image"></i>
                                        @endif
                                    </div>
                                    <div class="order-item-info">
                                        <p class="order-item-name">{{ $item->product->name }}</p>
                                        <p class="order-item-qty">Qty: {{ $item->quantity }}</p>
                                    </div>
                                    <span class="order-item-price">
                                Rs. {{ number_format($item->product->price * $item->quantity, 0) }}
                            </span>
                                </div>
                            @endforeach

                            <div class="summary-divider"></div>

                            <div class="summary-row">
                                <span>Subtotal</span>
                                <span>Rs. {{ number_format($subtotal, 0) }}</span>
                            </div>
                            <div class="summary-row">
                                <span>Delivery</span>
                                <span class="{{ $deliveryFee == 0 ? 'text-green' : '' }}">
                                {{ $deliveryFee == 0 ? 'FREE' : 'Rs. ' . number_format($deliveryFee, 0) }}
                            </span>
                            </div>

                            <div class="summary-divider"></div>

                            <div class="summary-total">
                                <span>Total</span>
                                <span>Rs. {{ number_format($total, 0) }}</span>
                            </div>

                            <button type="submit" class="place-order-btn">
                                <i class="fas fa-check-circle me-2"></i>Place Order
                            </button>

                            <div class="secure-note mt-3">
                                <i class="fas fa-shield-alt me-1"></i> 100% Secure & Safe
                            </div>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </section>

    <style>
        .checkout-box {
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 16px;
            padding: 28px;
        }
        .box-title {
            color: #fff;
            font-size: 1rem;
            font-weight: 700;
            margin-bottom: 22px;
            padding-bottom: 14px;
            border-bottom: 1px solid rgba(255,255,255,0.07);
        }
        .form-label-custom {
            color: rgba(255,255,255,0.5);
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            display: block;
            margin-bottom: 8px;
        }
        .form-input-custom {
            width: 100%;
            background: rgba(255,255,255,0.06);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 10px;
            padding: 11px 16px;
            color: #fff;
            font-size: 0.9rem;
            outline: none;
            transition: border-color 0.2s;
            resize: none;
        }
        .form-input-custom:focus { border-color: #e73958; }
        .form-input-custom.is-error { border-color: #e73958; }
        .error-msg { color: #e73958; font-size: 0.78rem; margin-top: 4px; display: block; }

        /* Payment */
        .payment-options { display: flex; flex-direction: column; gap: 12px; }
        .payment-option input { display: none; }
        .payment-card {
            display: flex;
            align-items: center;
            gap: 14px;
            background: rgba(255,255,255,0.04);
            border: 1.5px solid rgba(255,255,255,0.08);
            border-radius: 12px;
            padding: 16px;
            cursor: pointer;
            transition: all 0.2s;
        }
        .payment-option input:checked + .payment-card {
            border-color: #e73958;
            background: rgba(231,57,88,0.08);
        }
        .pay-icon { font-size: 1.6rem; }
        .pay-title { color: #fff; font-size: 0.92rem; font-weight: 600; margin: 0; }
        .pay-desc  { color: rgba(255,255,255,0.4); font-size: 0.78rem; margin: 0; }
        .pay-check {
            margin-left: auto;
            color: #e73958;
            font-weight: 900;
            opacity: 0;
            transition: opacity 0.2s;
        }
        .payment-option input:checked + .payment-card .pay-check { opacity: 1; }

        /* Order items */
        .order-item {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 14px;
        }
        .order-item-img {
            width: 52px; height: 52px;
            border-radius: 10px;
            overflow: hidden;
            background: rgba(255,255,255,0.05);
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }
        .order-item-img img { width:100%; height:100%; object-fit:cover; }
        .order-item-img i { color:rgba(255,255,255,0.2); }
        .order-item-info { flex: 1; }
        .order-item-name { color:#fff; font-size:0.85rem; font-weight:600; margin:0 0 3px; }
        .order-item-qty  { color:rgba(255,255,255,0.4); font-size:0.78rem; margin:0; }
        .order-item-price { color:#e73958; font-size:0.9rem; font-weight:700; white-space:nowrap; }

        .summary-divider { height:1px; background:rgba(255,255,255,0.07); margin:14px 0; }
        .summary-row {
            display:flex; justify-content:space-between;
            color:rgba(255,255,255,0.5); font-size:0.9rem;
            margin-bottom:10px;
        }
        .text-green { color:#27ae60 !important; font-weight:700; }
        .summary-total {
            display:flex; justify-content:space-between;
            color:#fff; font-size:1.1rem;
            font-weight:800; margin-bottom:20px;
        }
        .place-order-btn {
            width: 100%;
            background: #e73958;
            color: #fff;
            border: none;
            padding: 15px;
            border-radius: 12px;
            font-weight: 700;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s;
        }
        .place-order-btn:hover {
            background: #c42d47;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(231,57,88,0.35);
        }
        .secure-note {
            text-align: center;
            color: rgba(255,255,255,0.3);
            font-size: 0.8rem;
        }
    </style>

@endsection
