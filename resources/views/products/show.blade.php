@extends('layouts.app')

@section('title', $product->name . ' - ShopCart')

@section('content')

    <section style="background:#0f0c29; min-height:100vh; padding: 60px 0;">
        <div class="container">

            {{-- Breadcrumb --}}
            <nav style="margin-bottom:30px;">
                <a href="{{ route('home') }}" style="color:rgba(255,255,255,0.4); text-decoration:none;">Home</a>
                <span style="color:rgba(255,255,255,0.2); margin: 0 8px;">/</span>
                <a href="{{ route('products.index') }}" style="color:rgba(255,255,255,0.4); text-decoration:none;">Products</a>
                <span style="color:rgba(255,255,255,0.2); margin: 0 8px;">/</span>
                <span style="color:#fff;">{{ $product->name }}</span>
            </nav>

            {{-- Product Detail --}}
            <div class="detail-card">
                <div class="row g-0">

                    {{-- LEFT - Image --}}
                    <div class="col-md-5">
                        <div class="detail-img-wrap">
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}"
                                     alt="{{ $product->name }}" class="detail-img">
                            @else
                                <div class="detail-img-placeholder">
                                    <i class="fas fa-image"></i>
                                </div>
                            @endif
                            @if($product->discount ?? false)
                                <span class="detail-badge">{{ $product->discount }}% OFF</span>
                            @endif
                        </div>
                    </div>

                    {{-- RIGHT - Info --}}
                    <div class="col-md-7">
                        <div class="detail-info">
                            <span class="detail-cat">{{ $product->category->name ?? 'Uncategorized' }}</span>
                            <h1 class="detail-name">{{ $product->name }}</h1>

                            <div class="detail-price-row">
                                <span class="detail-price">Rs. {{ number_format($product->price, 0) }}</span>
                                @if($product->discount ?? false)
                                    <span class="detail-old-price">
                                    Rs. {{ number_format($product->price / (1 - $product->discount/100), 0) }}
                                </span>
                                @endif
                            </div>

                            @if($product->description)
                                <p class="detail-desc">{{ $product->description }}</p>
                            @endif

                            <div class="detail-meta">
                                <div class="meta-item">
                                    <span class="meta-label">Category</span>
                                    <span class="meta-val">{{ $product->category->name ?? '-' }}</span>
                                </div>
                                <div class="meta-item">
                                    <span class="meta-label">Stock</span>
                                    <span class="meta-val {{ ($product->stock ?? 0) > 0 ? 'in-stock' : 'out-stock' }}">
                                    {{ ($product->stock ?? 0) > 0 ? 'In Stock' : 'Out of Stock' }}
                                </span>
                                </div>
                            </div>

                            {{-- Add to Cart Form --}}
                            <form action="{{ route('cart.add') }}" method="POST" class="cart-form">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <div class="qty-row">
                                    <div class="qty-box">
                                        <button type="button" onclick="changeQty(-1)">−</button>
                                        <input type="number" name="quantity" id="qty" value="1" min="1" max="{{ $product->stock ?? 99 }}">
                                        <button type="button" onclick="changeQty(1)">+</button>
                                    </div>
                                    <button type="submit" class="add-cart-btn">
                                        <i class="fas fa-cart-plus me-2"></i>Add to Cart
                                    </button>
                                </div>
                            </form>

                            {{-- Features --}}
                            <div class="detail-features">
                                <div class="feat-item"><span>🚚</span> Free delivery above Rs. 2000</div>
                                <div class="feat-item"><span>↩️</span> 7-day easy return</div>
                                <div class="feat-item"><span>🔒</span> Secure payment</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Related Products --}}
            @if($related->count() > 0)
                <div class="mt-5">
                    <h4 style="color:#fff; font-weight:800; margin-bottom:24px;">
                        Related <span style="color:#e73958;">Products</span>
                    </h4>
                    <div class="row g-3">
                        @foreach($related as $item)
                            <div class="col-6 col-md-3">
                                <div class="product-card">
                                    <div class="rel-img-wrap">
                                        @if($item->image)
                                            <img src="{{ asset('storage/' . $item->image) }}"
                                                 alt="{{ $item->name }}" class="product-img">
                                        @else
                                            <div class="product-img-placeholder">
                                                <i class="fas fa-image"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="product-info">
                                        <h6 class="product-name">{{ $item->name }}</h6>
                                        <div class="product-price-row">
                                            <span class="product-price">Rs. {{ number_format($item->price, 0) }}</span>
                                            <a href="{{ route('products.show', $item->id) }}" class="view-btn">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

        </div>
    </section>

    <style>
        .detail-card {
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 20px;
            overflow: hidden;
        }
        .detail-img-wrap {
            position: relative;
            height: 100%;
            min-height: 400px;
            background: rgba(255,255,255,0.03);
        }
        .detail-img {
            width: 100%; height: 100%;
            object-fit: cover;
            min-height: 400px;
        }
        .detail-img-placeholder {
            width:100%; height:100%; min-height:400px;
            display:flex; align-items:center; justify-content:center;
        }
        .detail-img-placeholder i { font-size:4rem; color:rgba(255,255,255,0.1); }
        .detail-badge {
            position:absolute; top:16px; left:16px;
            background:#e73958; color:#fff;
            font-size:12px; font-weight:700;
            padding:5px 14px; border-radius:50px;
        }
        .detail-info { padding: 40px; }
        .detail-cat {
            color: #e73958; font-size: 0.78rem;
            font-weight: 700; text-transform: uppercase;
            letter-spacing: 1.5px;
        }
        .detail-name {
            color: #fff; font-size: 1.8rem;
            font-weight: 800; margin: 10px 0 16px;
            line-height: 1.3;
        }
        .detail-price-row { display:flex; align-items:center; gap:14px; margin-bottom:20px; }
        .detail-price { color: #e73958; font-size: 1.8rem; font-weight: 900; }
        .detail-old-price { color: rgba(255,255,255,0.3); font-size: 1.1rem; text-decoration: line-through; }
        .detail-desc { color: rgba(255,255,255,0.5); font-size: 0.93rem; line-height: 1.75; margin-bottom: 24px; }
        .detail-meta { display:flex; gap:24px; margin-bottom:28px; }
        .meta-item { display:flex; flex-direction:column; gap:4px; }
        .meta-label { color:rgba(255,255,255,0.35); font-size:0.75rem; text-transform:uppercase; letter-spacing:1px; }
        .meta-val { color:#fff; font-size:0.9rem; font-weight:600; }
        .in-stock  { color: #27ae60 !important; }
        .out-stock { color: #e73958 !important; }
        .qty-row { display:flex; gap:14px; align-items:center; margin-bottom:24px; flex-wrap:wrap; }
        .qty-box {
            display:flex; align-items:center;
            background: rgba(255,255,255,0.06);
            border: 1px solid rgba(255,255,255,0.12);
            border-radius: 12px; overflow:hidden;
        }
        .qty-box button {
            background:transparent; border:none;
            color:#fff; width:40px; height:44px;
            font-size:1.2rem; cursor:pointer;
            transition: background 0.2s;
        }
        .qty-box button:hover { background: rgba(231,57,88,0.2); }
        .qty-box input {
            width:50px; background:transparent;
            border:none; color:#fff;
            text-align:center; font-size:1rem;
            font-weight:700; outline:none;
        }
        .add-cart-btn {
            background:#e73958; color:#fff;
            border:none; padding:12px 28px;
            border-radius:12px; font-weight:700;
            font-size:0.95rem; cursor:pointer;
            transition: all 0.3s; flex:1;
        }
        .add-cart-btn:hover {
            background:#c42d47;
            transform:translateY(-2px);
            box-shadow: 0 8px 25px rgba(231,57,88,0.35);
        }
        .detail-features {
            display:flex; flex-direction:column; gap:10px;
            border-top: 1px solid rgba(255,255,255,0.07);
            padding-top: 20px;
        }
        .feat-item { color:rgba(255,255,255,0.45); font-size:0.88rem; display:flex; gap:10px; align-items:center; }

        /* Related products */
        .product-card {
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 16px; overflow:hidden;
            transition: all 0.3s;
        }
        .product-card:hover {
            transform:translateY(-4px);
            border-color:rgba(231,57,88,0.3);
        }
        .rel-img-wrap { height:150px; overflow:hidden; }
        .product-img { width:100%; height:100%; object-fit:cover; }
        .product-img-placeholder {
            width:100%; height:100%;
            background:rgba(255,255,255,0.03);
            display:flex; align-items:center; justify-content:center;
        }
        .product-img-placeholder i { color:rgba(255,255,255,0.1); font-size:1.8rem; }
        .product-info { padding:12px; }
        .product-name { color:#fff; font-size:0.85rem; font-weight:600; margin:0 0 10px; line-height:1.4; }
        .product-price-row { display:flex; align-items:center; justify-content:space-between; }
        .product-price { color:#e73958; font-size:0.95rem; font-weight:800; }
        .view-btn {
            width:28px; height:28px; border-radius:50%;
            background:rgba(255,255,255,0.07);
            border:1px solid rgba(255,255,255,0.12);
            display:flex; align-items:center; justify-content:center;
            color:rgba(255,255,255,0.6); text-decoration:none;
            font-size:0.75rem; transition:all 0.2s;
        }
        .view-btn:hover { background:#e73958; color:#fff; border-color:#e73958; }
    </style>

    <script>
        function changeQty(val) {
            const input = document.getElementById('qty');
            const newVal = parseInt(input.value) + val;
            if (newVal >= 1) input.value = newVal;
        }
    </script>

@endsection
