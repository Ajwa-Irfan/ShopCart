@extends('layouts.app')

@section('title', 'ShopCart - Shop the Latest Trends')

@section('content')

    {{-- ===== HERO SECTION ===== --}}
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center" style="min-height: 100vh;">

                {{-- LEFT SIDE --}}
                <div class="col-lg-6 py-5">
                    <div class="hero-badge">
                        <span class="badge-dot"></span>
                        NEW SEASON — UP TO 50% OFF
                    </div>
                    <h1 class="hero-title">
                        Shop the Latest<br>
                        <span class="text-red">Trends</span> Online
                    </h1>
                    <p class="hero-sub">
                        Discover thousands of premium products at unbeatable prices.
                        Quality you can trust, delivery you can count on.
                    </p>
                    <div class="hero-btns">
                        <a href="{{ route('products.index') }}" class="btn-red-solid">
                            <i class="fas fa-shopping-bag me-2"></i>Shop Now
                        </a>
                        <a href="#" class="btn-ghost-white">
                            <i class="fas fa-headset me-2"></i>Get Help
                        </a>
                    </div>
                    <div class="hero-stats">
                        <div class="hstat"><h3>10K+</h3><p>Products</p></div>
                        <div class="hstat-div"></div>
                        <div class="hstat"><h3>50K+</h3><p>Customers</p></div>
                        <div class="hstat-div"></div>
                        <div class="hstat"><h3>4.9★</h3><p>Rating</p></div>
                    </div>
                </div>

                {{-- RIGHT SIDE - Animated Shopping Flow --}}
                <div class="col-lg-6 d-none d-lg-flex justify-content-center align-items-center">
                    <div class="flow-wrapper">

                        <p class="flow-heading">How It Works</p>

                        <div class="flow-step" id="s1">
                            <div class="step-icon"><span>🛍️</span></div>
                            <div class="step-body">
                                <p class="step-label">Step 01</p>
                                <p class="step-title">Browse Products</p>
                                <p class="step-desc">Explore 10K+ items</p>
                            </div>
                            <div class="step-num" id="n1">1</div>
                        </div>
                        <div class="flow-connector" id="c1"></div>

                        <div class="flow-step" id="s2">
                            <div class="step-icon"><span>🛒</span></div>
                            <div class="step-body">
                                <p class="step-label">Step 02</p>
                                <p class="step-title">Add to Cart</p>
                                <p class="step-desc">Pick your favourites</p>
                            </div>
                            <div class="step-num" id="n2">2</div>
                        </div>
                        <div class="flow-connector" id="c2"></div>

                        <div class="flow-step" id="s3">
                            <div class="step-icon"><span>💳</span></div>
                            <div class="step-body">
                                <p class="step-label">Step 03</p>
                                <p class="step-title">Secure Checkout</p>
                                <p class="step-desc">100% safe payment</p>
                            </div>
                            <div class="step-num" id="n3">3</div>
                        </div>
                        <div class="flow-connector" id="c3"></div>

                        <div class="flow-step" id="s4">
                            <div class="step-icon"><span>📦</span></div>
                            <div class="step-body">
                                <p class="step-label">Step 04</p>
                                <p class="step-title">Order Packed</p>
                                <p class="step-desc">Ready to ship</p>
                            </div>
                            <div class="step-num" id="n4">4</div>
                        </div>
                        <div class="flow-connector" id="c4"></div>

                        <div class="flow-step" id="s5">
                            <div class="step-icon"><span>🚚</span></div>
                            <div class="step-body">
                                <p class="step-label">Step 05</p>
                                <p class="step-title">Fast Delivery</p>
                                <p class="step-desc">At your doorstep</p>
                            </div>
                            <div class="step-num" id="n5">5</div>
                        </div>

                        <div class="flow-progress">
                            <div class="flow-bar">
                                <div class="flow-fill" id="pbar"></div>
                            </div>
                            <div class="flow-prog-text">
                                <span id="plabel">Starting order...</span>
                                <strong id="ppct">0%</strong>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- ===== CATEGORIES SECTION ===== --}}
    <section class="categories-section">
        <div class="container">
            <div class="section-header">
                <h2>Shop by <span class="text-red">Category</span></h2>
                <p>Find exactly what you're looking for</p>
            </div>
            <div class="row g-3">
                @forelse($categories ?? [] as $category)
                    <div class="col-6 col-md-4 col-lg-2">
                        <a href="{{ route('products.index', ['category' => $category->id]) }}" class="cat-card">
                            <div class="cat-icon">
                                @if($category->image)
                                    <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}">
                                @else
                                    <i class="fas fa-tag"></i>
                                @endif
                            </div>
                            <p class="cat-name">{{ $category->name }}</p>
                            <p class="cat-count">{{ $category->products_count ?? 0 }} items</p>
                        </a>
                    </div>
                @empty
                    <div class="col-12 text-center py-4">
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    {{-- ===== FEATURED PRODUCTS SECTION ===== --}}
    <section class="products-section">
        <div class="container">
            <div class="section-header">
                <h2>Featured <span class="text-red">Products</span></h2>
                <p>Handpicked just for you</p>
            </div>
            <div class="row g-4">
                @forelse($products ?? [] as $product)
                    <div class="col-6 col-md-4 col-lg-3">
                        <div class="product-card">
                            <div class="product-img-wrap">
                                @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}"
                                         alt="{{ $product->name }}" class="product-img">
                                @else
                                    <div class="product-img-placeholder">
                                        <i class="fas fa-image"></i>
                                    </div>
                                @endif
                                <div class="product-overlay">
                                    <form action="{{ route('cart.add') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <input type="hidden" name="quantity" value="1">
                                        <button type="submit" class="quick-add-btn">
                                            <i class="fas fa-cart-plus me-1"></i> Add to Cart
                                        </button>
                                    </form>
                                </div>
                                @if($product->discount ?? false)
                                    <span class="product-badge">{{ $product->discount }}% OFF</span>
                                @endif
                            </div>
                            <div class="product-info">
                                <p class="product-cat">{{ $product->category->name ?? 'Uncategorized' }}</p>
                                <h6 class="product-name">{{ $product->name }}</h6>
                                <div class="product-price-row">
                                    <span class="product-price">Rs. {{ number_format($product->price, 0) }}</span>
                                    <a href="{{ route('products.show', $product->id) }}" class="view-btn">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <i class="fas fa-box-open fa-3x mb-3" style="color: rgba(255,255,255,0.2);"></i>
                    </div>
                @endforelse
            </div>
            @if(isset($products) && $products->count() > 0)
                <div class="text-center mt-5">
                    <a href="{{ route('products.index') }}" class="btn-red-solid">
                        <i class="fas fa-th me-2"></i>See all products
                    </a>
                </div>
            @endif
        </div>
    </section>

    {{-- ===== PROMO BANNER ===== --}}
    <section class="promo-section">
        <div class="container">
            <div class="promo-card">
                <div class="promo-left">
                    <span class="promo-tag">Limited Time Offer</span>
                    <h2>Get <span class="text-red">30% OFF</span> on First Order!</h2>
                    <p>Use code <strong class="promo-code">WELCOME30</strong> at checkout</p>
                    <a href="{{ route('products.index') }}" class="btn-red-solid mt-3 d-inline-block">
                        <i class="fas fa-bolt me-2"></i>Shop Now
                    </a>
                </div>
                <div class="promo-right d-none d-md-flex">
                    <div class="promo-circle c1"></div>
                    <div class="promo-circle c2"></div>
                    <div class="promo-emoji">🎁</div>
                </div>
            </div>
        </div>
    </section>

    {{-- ===== WHY CHOOSE US ===== --}}
    <section class="why-section">
        <div class="container">
            <div class="section-header">
                <h2>Why Choose <span class="text-red">ShopCart</span>?</h2>
                <p>We make shopping simple and enjoyable</p>
            </div>
            <div class="row g-4">
                <div class="col-6 col-md-3">
                    <div class="why-card">
                        <div class="why-icon">🚚</div>
                        <h6>Free Delivery</h6>
                        <p>On orders above Rs. 2000</p>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="why-card">
                        <div class="why-icon">🔒</div>
                        <h6>Secure Payment</h6>
                        <p>100% safe transactions</p>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="why-card">
                        <div class="why-icon">↩️</div>
                        <h6>Easy Returns</h6>
                        <p>7-day return policy</p>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="why-card">
                        <div class="why-icon">🎧</div>
                        <h6>24/7 Support</h6>
                        <p>Always here to help</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ===== ALL CSS ===== --}}
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { background: #0f0c29 !important; }

        /* ======= HERO ======= */
        .hero-section {
            background: linear-gradient(135deg, #0f0c29 0%, #1a1a4e 55%, #24243e 100%);
            position: relative;
            overflow: hidden;
            min-height: 100vh;
            display: flex;
            align-items: center;
        }
        .hero-section::before {
            content: '';
            position: absolute;
            width: 500px; height: 500px;
            border-radius: 50%;
            background: rgba(231,57,88,0.07);
            top: -150px; right: -100px;
            pointer-events: none;
        }
        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(231,57,88,0.15);
            border: 1px solid rgba(231,57,88,0.5);
            color: #e73958;
            padding: 7px 18px;
            border-radius: 50px;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 1.2px;
            margin-bottom: 22px;
        }
        .badge-dot {
            width: 7px; height: 7px;
            border-radius: 50%;
            background: #e73958;
            animation: blink 1.5s infinite;
        }
        .hero-title {
            font-size: 3.2rem;
            font-weight: 900;
            color: #fff;
            line-height: 1.15;
            margin-bottom: 18px;
        }
        .text-red { color: #e73958; }
        .hero-sub {
            color: rgba(255,255,255,0.6);
            font-size: 1rem;
            line-height: 1.75;
            margin-bottom: 30px;
            max-width: 420px;
        }
        .hero-btns { display: flex; gap: 14px; flex-wrap: wrap; margin-bottom: 36px; }
        .btn-red-solid {
            background: #e73958;
            color: #fff !important;
            padding: 13px 30px;
            border-radius: 50px;
            font-weight: 700;
            font-size: 0.95rem;
            text-decoration: none;
            transition: all 0.3s;
            display: inline-block;
            border: none;
            cursor: pointer;
        }
        .btn-red-solid:hover {
            background: #c42d47;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(231,57,88,0.35);
        }
        .btn-ghost-white {
            background: transparent;
            color: #fff !important;
            border: 1.5px solid rgba(255,255,255,0.3);
            padding: 12px 26px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.95rem;
            text-decoration: none;
            transition: all 0.3s;
            display: inline-block;
        }
        .btn-ghost-white:hover {
            border-color: #fff;
            background: rgba(255,255,255,0.08);
        }
        .hero-stats {
            display: flex;
            align-items: center;
            gap: 24px;
            border-top: 1px solid rgba(255,255,255,0.1);
            padding-top: 24px;
        }
        .hstat h3 { color: #fff; font-size: 1.6rem; font-weight: 900; margin: 0; }
        .hstat p  { color: rgba(255,255,255,0.45); font-size: 0.8rem; margin: 0; }
        .hstat-div { width: 1px; height: 38px; background: rgba(255,255,255,0.15); }

        /* ======= FLOW ======= */
        .flow-wrapper {
            display: flex;
            flex-direction: column;
            width: 310px;
        }
        .flow-heading {
            color: rgba(255,255,255,0.35);
            font-size: 11px;
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-bottom: 20px;
        }
        .flow-step {
            display: flex;
            align-items: center;
            gap: 14px;
            opacity: 0;
            transform: translateX(30px);
            transition: opacity 0.5s ease, transform 0.5s ease;
        }
        .flow-step.visible  { opacity: 1; transform: translateX(0); }
        .flow-step.done .step-icon { background: rgba(39,174,96,0.15); border-color: rgba(39,174,96,0.5); }
        .flow-step.done .step-num  { background: #27ae60; }
        .flow-step.running .step-icon { background: rgba(231,57,88,0.15); border-color: rgba(231,57,88,0.5); }
        .flow-step.running .step-num  { background: #e73958; animation: pulse 1s infinite; }
        .step-icon {
            width: 52px; height: 52px;
            border-radius: 14px;
            border: 1.5px solid rgba(255,255,255,0.1);
            background: rgba(255,255,255,0.05);
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
            transition: all 0.4s;
            font-size: 22px;
        }
        .step-body { flex: 1; }
        .step-label { color: rgba(255,255,255,0.35); font-size: 10px; letter-spacing: 1px; text-transform: uppercase; margin: 0; }
        .step-title { color: #fff; font-size: 0.93rem; font-weight: 700; margin: 2px 0; }
        .step-desc  { color: rgba(255,255,255,0.4); font-size: 0.78rem; margin: 0; }
        .step-num {
            width: 24px; height: 24px;
            border-radius: 50%;
            background: rgba(255,255,255,0.1);
            display: flex; align-items: center; justify-content: center;
            font-size: 11px; font-weight: 700; color: #fff;
            flex-shrink: 0;
            transition: all 0.4s;
        }
        .flow-connector {
            width: 2px; height: 20px;
            background: rgba(255,255,255,0.07);
            margin-left: 25px;
            transition: background 0.4s;
        }
        .flow-connector.lit { background: linear-gradient(to bottom, #27ae60, #e73958); }
        .flow-progress { margin-top: 20px; }
        .flow-bar { background: rgba(255,255,255,0.08); border-radius: 50px; height: 4px; overflow: hidden; }
        .flow-fill { height: 100%; border-radius: 50px; background: linear-gradient(to right, #27ae60, #e73958); width: 0%; transition: width 0.6s ease; }
        .flow-prog-text { display: flex; justify-content: space-between; margin-top: 8px; }
        .flow-prog-text span   { color: rgba(255,255,255,0.4); font-size: 11px; }
        .flow-prog-text strong { color: #fff; font-size: 11px; }

        /* ======= COMMON SECTIONS ======= */
        .categories-section { background: #111132; padding: 80px 0; }
        .products-section   { background: #0f0c29; padding: 80px 0; }
        .promo-section      { background: #111132; padding: 60px 0; }
        .why-section        { background: #0a0920; padding: 80px 0; }

        .section-header { text-align: center; margin-bottom: 48px; }
        .section-header h2 { color: #fff; font-size: 2rem; font-weight: 800; margin-bottom: 10px; }
        .section-header p  { color: rgba(255,255,255,0.45); font-size: 0.95rem; }

        /* ======= CATEGORIES ======= */
        .cat-card {
            display: flex;
            flex-direction: column;
            align-items: center;
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 16px;
            padding: 24px 16px;
            text-decoration: none;
            transition: all 0.3s;
            text-align: center;
        }
        .cat-card:hover {
            background: rgba(231,57,88,0.1);
            border-color: rgba(231,57,88,0.4);
            transform: translateY(-4px);
        }
        .cat-icon {
            width: 56px; height: 56px;
            border-radius: 50%;
            background: rgba(255,255,255,0.07);
            display: flex; align-items: center; justify-content: center;
            margin-bottom: 12px;
            overflow: hidden;
        }
        .cat-icon img { width: 100%; height: 100%; object-fit: cover; }
        .cat-icon i { color: #e73958; font-size: 1.3rem; }
        .cat-name  { color: #fff; font-size: 0.88rem; font-weight: 600; margin: 0 0 4px; }
        .cat-count { color: rgba(255,255,255,0.35); font-size: 0.75rem; margin: 0; }

        /* ======= PRODUCTS ======= */
        .product-card {
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 16px;
            overflow: hidden;
            transition: all 0.3s;
        }
        .product-card:hover {
            transform: translateY(-5px);
            border-color: rgba(231,57,88,0.35);
            box-shadow: 0 12px 40px rgba(0,0,0,0.4);
        }
        .product-img-wrap { position: relative; overflow: hidden; height: 200px; }
        .product-img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.4s; }
        .product-card:hover .product-img { transform: scale(1.06); }
        .product-img-placeholder {
            width: 100%; height: 100%;
            background: rgba(255,255,255,0.05);
            display: flex; align-items: center; justify-content: center;
        }
        .product-img-placeholder i { font-size: 2.5rem; color: rgba(255,255,255,0.15); }
        .product-overlay {
            position: absolute;
            bottom: -60px;
            left: 0; right: 0;
            display: flex;
            justify-content: center;
            padding: 12px;
            background: linear-gradient(to top, rgba(0,0,0,0.8), transparent);
            transition: bottom 0.3s;
        }
        .product-card:hover .product-overlay { bottom: 0; }
        .quick-add-btn {
            background: #e73958;
            color: #fff;
            border: none;
            padding: 8px 20px;
            border-radius: 50px;
            font-size: 0.82rem;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s;
            white-space: nowrap;
        }
        .quick-add-btn:hover { background: #c42d47; }
        .product-badge {
            position: absolute;
            top: 10px; left: 10px;
            background: #e73958;
            color: #fff;
            font-size: 11px;
            font-weight: 700;
            padding: 4px 10px;
            border-radius: 50px;
        }
        .product-info { padding: 16px; }
        .product-cat  { color: #e73958; font-size: 0.75rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.8px; margin: 0 0 6px; }
        .product-name { color: #fff; font-size: 0.92rem; font-weight: 600; margin: 0 0 12px; line-height: 1.4; }
        .product-price-row { display: flex; align-items: center; justify-content: space-between; }
        .product-price { color: #e73958; font-size: 1.05rem; font-weight: 800; }
        .view-btn {
            width: 32px; height: 32px;
            border-radius: 50%;
            background: rgba(255,255,255,0.07);
            border: 1px solid rgba(255,255,255,0.12);
            display: flex; align-items: center; justify-content: center;
            color: rgba(255,255,255,0.6);
            text-decoration: none;
            font-size: 0.8rem;
            transition: all 0.2s;
        }
        .view-btn:hover { background: #e73958; color: #fff; border-color: #e73958; }

        /* ======= PROMO BANNER ======= */
        .promo-card {
            background: linear-gradient(135deg, #1a0e2e, #2d1b4e);
            border: 1px solid rgba(231,57,88,0.25);
            border-radius: 20px;
            padding: 50px 48px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: relative;
            overflow: hidden;
        }
        .promo-tag {
            display: inline-block;
            background: rgba(231,57,88,0.15);
            color: #e73958;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 1px;
            padding: 5px 14px;
            border-radius: 50px;
            margin-bottom: 14px;
        }
        .promo-left h2 { color: #fff; font-size: 2rem; font-weight: 900; margin-bottom: 12px; }
        .promo-left p  { color: rgba(255,255,255,0.55); font-size: 0.95rem; margin: 0; }
        .promo-code {
            background: rgba(231,57,88,0.2);
            color: #e73958;
            padding: 3px 12px;
            border-radius: 6px;
            font-family: monospace;
            font-size: 1rem;
            letter-spacing: 1px;
        }
        .promo-right {
            position: relative;
            width: 160px; height: 160px;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }
        .promo-circle {
            position: absolute;
            border-radius: 50%;
            border: 1.5px solid rgba(231,57,88,0.2);
        }
        .promo-circle.c1 { width: 120px; height: 120px; }
        .promo-circle.c2 { width: 160px; height: 160px; border-style: dashed; }
        .promo-emoji { font-size: 4rem; animation: float 3s ease-in-out infinite; }

        /* ======= WHY US ======= */
        .why-card {
            background: rgba(255,255,255,0.03);
            border: 1px solid rgba(255,255,255,0.07);
            border-radius: 16px;
            padding: 30px 20px;
            text-align: center;
            transition: all 0.3s;
        }
        .why-card:hover {
            background: rgba(231,57,88,0.08);
            border-color: rgba(231,57,88,0.3);
            transform: translateY(-4px);
        }
        .why-icon { font-size: 2.2rem; margin-bottom: 14px; }
        .why-card h6 { color: #fff; font-size: 0.95rem; font-weight: 700; margin-bottom: 8px; }
        .why-card p  { color: rgba(255,255,255,0.4); font-size: 0.82rem; margin: 0; }

        /* ======= ANIMATIONS ======= */
        @keyframes blink { 0%,100%{opacity:1;} 50%{opacity:0.3;} }
        @keyframes pulse { 0%,100%{transform:scale(1);} 50%{transform:scale(1.2);} }
        @keyframes float { 0%,100%{transform:translateY(0);} 50%{transform:translateY(-10px);} }
    </style>

    {{-- ===== FLOW ANIMATION JS ===== --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const steps  = ['s1','s2','s3','s4','s5'];
            const nums   = ['n1','n2','n3','n4','n5'];
            const cons   = ['c1','c2','c3','c4'];
            const labels = ['Browsing products...','Adding to cart...','Processing payment...','Packing your order...','Out for delivery!'];
            const pcts   = [20, 40, 60, 80, 100];
            let cur = 0;

            function runStep(i) {
                const el = document.getElementById(steps[i]);
                el.classList.add('visible','running');
                document.getElementById('plabel').textContent = labels[i];
                document.getElementById('ppct').textContent   = pcts[i] + '%';
                document.getElementById('pbar').style.width   = pcts[i] + '%';
                if (i > 0) {
                    document.getElementById(steps[i-1]).classList.remove('running');
                    document.getElementById(steps[i-1]).classList.add('done');
                    document.getElementById(nums[i-1]).textContent = '✓';
                    if (cons[i-1]) document.getElementById(cons[i-1]).classList.add('lit');
                }
            }

            function animate() {
                if (cur < steps.length) {
                    runStep(cur); cur++;
                    setTimeout(animate, 1100);
                } else {
                    const last = steps.length - 1;
                    document.getElementById(steps[last]).classList.remove('running');
                    document.getElementById(steps[last]).classList.add('done');
                    document.getElementById(nums[last]).textContent = '✓';
                    setTimeout(reset, 2200);
                }
            }

            function reset() {
                cur = 0;
                steps.forEach((id, i) => {
                    const el = document.getElementById(id);
                    el.classList.remove('visible','done','running');
                    document.getElementById(nums[i]).textContent = i + 1;
                });
                cons.forEach(id => document.getElementById(id).classList.remove('lit'));
                document.getElementById('pbar').style.width    = '0%';
                document.getElementById('plabel').textContent  = 'Starting order...';
                document.getElementById('ppct').textContent    = '0%';
                setTimeout(animate, 600);
            }

            setTimeout(animate, 700);
        });
    </script>

@endsection
