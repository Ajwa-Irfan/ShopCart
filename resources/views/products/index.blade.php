@extends('layouts.app')

@section('title', 'All Products - ShopCart')

@section('content')

    <section style="background:#0f0c29; min-height:100vh; padding: 60px 0;">
        <div class="container">

            {{-- Header --}}
            <div class="d-flex align-items-center justify-content-between mb-4">
                <div>
                    <h2 style="color:#fff; font-weight:800; margin:0;">
                        All <span style="color:#e73958;">Products</span>
                    </h2>
                    <p style="color:rgba(255,255,255,0.4); font-size:0.9rem; margin:4px 0 0;">
                        {{ $products->total() }} products found
                    </p>
                </div>
                <a href="{{ route('home') }}" style="color:rgba(255,255,255,0.5); text-decoration:none; font-size:0.9rem;">
                    <i class="fas fa-arrow-left me-1"></i> Back to Home
                </a>
            </div>

            <div class="row g-4">

                {{-- SIDEBAR FILTERS --}}
                <div class="col-lg-3">
                    <div class="filter-box">
                        <h6 class="filter-title">🔍 Search</h6>
                        <form method="GET" action="{{ route('products.index') }}">
                            <input type="text" name="search" value="{{ request('search') }}"
                                   placeholder="Search products..."
                                   class="filter-input mb-3">

                            <h6 class="filter-title">📂 Categories</h6>
                            <div class="cat-list">
                                <a href="{{ route('products.index', array_filter(['search' => request('search'), 'sort' => request('sort')])) }}"
                                   class="cat-filter-btn {{ !request('category') ? 'active' : '' }}">
                                    All Categories
                                </a>
                                @foreach($categories as $cat)
                                    <a href="{{ route('products.index', array_filter(['category' => $cat->id, 'search' => request('search'), 'sort' => request('sort')])) }}"
                                       class="cat-filter-btn {{ request('category') == $cat->id ? 'active' : '' }}">
                                        {{ $cat->name }}
                                    </a>
                                @endforeach
                            </div>

                            <h6 class="filter-title mt-3">↕️ Sort By</h6>
                            <select name="sort" class="filter-input" onchange="this.form.submit()">
                                <option value="latest"     {{ request('sort') == 'latest'     ? 'selected' : '' }}>Latest</option>
                                <option value="price_low"  {{ request('sort') == 'price_low'  ? 'selected' : '' }}>Price: Low to High</option>
                                <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Price: High to Low</option>
                            </select>

                            <button type="submit" class="search-btn mt-3">Apply Filters</button>
                            <a href="{{ route('products.index') }}" class="clear-btn mt-2">Clear All</a>
                        </form>
                    </div>
                </div>

                {{-- PRODUCTS GRID --}}
                <div class="col-lg-9">
                    <div class="row g-3">
                        @forelse($products as $product)
                            <div class="col-6 col-md-4">
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
                                <i class="fas fa-box-open fa-3x mb-3" style="color:rgba(255,255,255,0.15);"></i>
                                <p style="color:rgba(255,255,255,0.4);">No products found</p>
                                <a href="{{ route('products.index') }}" class="clear-btn mt-2">Clear Filters</a>
                            </div>
                        @endforelse
                    </div>

                    {{-- PAGINATION --}}
                    <div class="d-flex justify-content-center mt-5">
                        {{ $products->appends(request()->query())->links() }}
                    </div>
                </div>

            </div>
        </div>
    </section>

    <style>
        .filter-box {
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 16px;
            padding: 24px;
            position: sticky;
            top: 20px;
        }
        .filter-title {
            color: rgba(255,255,255,0.6);
            font-size: 0.8rem;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            margin-bottom: 12px;
        }
        .filter-input {
            width: 100%;
            background: rgba(255,255,255,0.06);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 10px;
            padding: 10px 14px;
            color: #fff;
            font-size: 0.88rem;
            outline: none;
        }
        .filter-input:focus { border-color: #e73958; }
        .filter-input option { background: #1a1a4e; }
        .cat-list { display: flex; flex-direction: column; gap: 6px; }
        .cat-filter-btn {
            padding: 8px 14px;
            border-radius: 8px;
            color: rgba(255,255,255,0.55);
            text-decoration: none;
            font-size: 0.85rem;
            transition: all 0.2s;
            border: 1px solid transparent;
        }
        .cat-filter-btn:hover, .cat-filter-btn.active {
            background: rgba(231,57,88,0.15);
            border-color: rgba(231,57,88,0.4);
            color: #e73958;
        }
        .search-btn {
            width: 100%;
            background: #e73958;
            color: #fff;
            border: none;
            padding: 10px;
            border-radius: 10px;
            font-weight: 700;
            cursor: pointer;
            font-size: 0.9rem;
        }
        .search-btn:hover { background: #c42d47; }
        .clear-btn {
            display: block;
            text-align: center;
            color: rgba(255,255,255,0.4);
            text-decoration: none;
            font-size: 0.85rem;
            padding: 8px;
        }
        .clear-btn:hover { color: #fff; }

        /* Product Cards */
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
        .product-img-wrap { position: relative; overflow: hidden; height: 180px; }
        .product-img { width:100%; height:100%; object-fit:cover; transition: transform 0.4s; }
        .product-card:hover .product-img { transform: scale(1.06); }
        .product-img-placeholder {
            width:100%; height:100%;
            background: rgba(255,255,255,0.05);
            display:flex; align-items:center; justify-content:center;
        }
        .product-img-placeholder i { font-size:2rem; color:rgba(255,255,255,0.15); }
        .product-overlay {
            position: absolute;
            bottom: -60px; left:0; right:0;
            display: flex; justify-content: center;
            padding: 12px;
            background: linear-gradient(to top, rgba(0,0,0,0.8), transparent);
            transition: bottom 0.3s;
        }
        .product-card:hover .product-overlay { bottom: 0; }
        .quick-add-btn {
            background: #e73958; color: #fff;
            border: none; padding: 7px 18px;
            border-radius: 50px; font-size: 0.8rem;
            font-weight: 600; cursor: pointer;
        }
        .quick-add-btn:hover { background: #c42d47; }
        .product-badge {
            position: absolute; top:10px; left:10px;
            background: #e73958; color: #fff;
            font-size: 11px; font-weight: 700;
            padding: 3px 10px; border-radius: 50px;
        }
        .product-info { padding: 14px; }
        .product-cat { color: #e73958; font-size: 0.72rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.8px; margin: 0 0 5px; }
        .product-name { color: #fff; font-size: 0.88rem; font-weight: 600; margin: 0 0 10px; line-height: 1.4; }
        .product-price-row { display:flex; align-items:center; justify-content:space-between; }
        .product-price { color: #e73958; font-size: 1rem; font-weight: 800; }
        .view-btn {
            width:30px; height:30px; border-radius:50%;
            background: rgba(255,255,255,0.07);
            border: 1px solid rgba(255,255,255,0.12);
            display:flex; align-items:center; justify-content:center;
            color: rgba(255,255,255,0.6); text-decoration:none;
            font-size: 0.78rem; transition: all 0.2s;
        }
        .view-btn:hover { background:#e73958; color:#fff; border-color:#e73958; }

        /* Pagination */
        .pagination .page-link {
            background: rgba(255,255,255,0.05);
            border-color: rgba(255,255,255,0.1);
            color: rgba(255,255,255,0.6);
        }
        .pagination .page-item.active .page-link {
            background: #e73958;
            border-color: #e73958;
            color: #fff;
        }
        .pagination .page-link:hover {
            background: rgba(231,57,88,0.2);
            color: #fff;
        }
    </style>

@endsection
