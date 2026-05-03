<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ShopCart — @yield('title', 'Premium Shopping')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Outfit', sans-serif;
            background: #f5f6fa;
            color: #1e293b;
            overflow-x: hidden;
        }

        /* NAVBAR */
        .sc-nav {
            background: #1a1a2e;
            position: sticky;
            top: 0;
            z-index: 999;
            box-shadow: 0 2px 24px rgba(0,0,0,0.25);
        }
        .sc-nav-inner {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 24px;
            height: 64px;
            display: flex;
            align-items: center;
            gap: 24px;
        }
        .sc-nav-brand {
            display: flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            flex-shrink: 0;
        }
        .sc-nav-logo {
            width: 34px; height: 34px;
            background: linear-gradient(135deg, #e94560, #ff6b8a);
            border-radius: 9px;
            display: flex; align-items: center; justify-content: center;
            font-size: 16px;
        }
        .sc-nav-name {
            font-size: 19px;
            font-weight: 800;
            color: #fff;
            letter-spacing: -0.3px;
        }
        .sc-nav-name span { color: #e94560; }

        .sc-nav-search {
            flex: 1;
            max-width: 420px;
            position: relative;
        }
        .sc-nav-search input {
            width: 100%;
            background: rgba(255,255,255,0.07);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 50px;
            padding: 8px 18px 8px 40px;
            color: #fff;
            font-size: 13.5px;
            font-family: inherit;
            outline: none;
            transition: all 0.2s;
        }
        .sc-nav-search input::placeholder { color: rgba(255,255,255,0.35); }
        .sc-nav-search input:focus {
            background: rgba(255,255,255,0.1);
            border-color: #e94560;
        }
        .sc-nav-search-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: rgba(255,255,255,0.35);
            font-size: 14px;
        }

        .sc-nav-links {
            display: flex;
            align-items: center;
            gap: 2px;
            margin-left: auto;
        }
        .sc-nav-link {
            display: flex;
            align-items: center;
            gap: 5px;
            padding: 7px 12px;
            border-radius: 8px;
            color: rgba(255,255,255,0.65);
            font-size: 13.5px;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.18s;
            white-space: nowrap;
        }
        .sc-nav-link:hover {
            background: rgba(255,255,255,0.07);
            color: #fff;
        }
        .sc-nav-link.active { color: #fff; }
        .sc-nav-link-cart {
            background: #e94560;
            color: #fff !important;
            border-radius: 50px !important;
            padding: 7px 16px !important;
            font-weight: 700 !important;
        }
        .sc-nav-link-cart:hover {
            background: #c9384f !important;
            transform: translateY(-1px);
        }
        .sc-nav-link-reg {
            background: transparent;
            border: 1.5px solid rgba(255,255,255,0.25);
            color: #fff !important;
            border-radius: 50px !important;
            padding: 6px 14px !important;
        }
        .sc-nav-link-reg:hover {
            border-color: #e94560;
            background: rgba(233,69,96,0.1) !important;
        }

        /* FOOTER */
        .sc-footer {
            background: #1a1a2e;
            color: rgba(255,255,255,0.6);
            margin-top: 0px;
            padding: 56px 0 0;
        }
        .sc-footer-inner { max-width: 1280px; margin: 0 auto; padding: 0 24px; }
        .sc-footer-brand {
            font-size: 20px;
            font-weight: 800;
            color: #fff;
            margin-bottom: 10px;
        }
        .sc-footer-brand span { color: #e94560; }
        .sc-footer-desc {
            font-size: 13.5px;
            line-height: 1.7;
            max-width: 240px;
            margin-bottom: 0;
        }
        .sc-footer-heading {
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 1.2px;
            text-transform: uppercase;
            color: #fff;
            margin-bottom: 14px;
        }
        .sc-footer-links { list-style: none; }
        .sc-footer-links li { margin-bottom: 8px; }
        .sc-footer-links a {
            color: rgba(255,255,255,0.55);
            text-decoration: none;
            font-size: 13.5px;
            transition: color 0.18s;
        }
        .sc-footer-links a:hover { color: #e94560; }
        .sc-footer-bottom {
            border-top: 1px solid rgba(255,255,255,0.07);
            margin-top: 40px;
            padding: 18px 24px;
            text-align: center;
            font-size: 12.5px;
            color: rgba(255,255,255,0.3);
            max-width: 100%;
        }

        /* ANIMATIONS */
        .sc-fade-up {
            opacity: 0;
            transform: translateY(18px);
            animation: scFadeUp 0.55s ease forwards;
        }
        @keyframes scFadeUp {
            to { opacity: 1; transform: translateY(0); }
        }
        .sc-delay-1 { animation-delay: 0.1s; }
        .sc-delay-2 { animation-delay: 0.2s; }
        .sc-delay-3 { animation-delay: 0.3s; }
        .sc-delay-4 { animation-delay: 0.4s; }
    </style>
    @stack('styles')
</head>
<body>

@if(!in_array(Route::currentRouteName(), ['login', 'register']))
    <nav class="sc-nav">
        <div class="sc-nav-inner">
            <a href="{{ url('/') }}" class="sc-nav-brand">
                <div class="sc-nav-logo">🛒</div>
                <span class="sc-nav-name">Shop<span>Cart</span></span>
            </a>

            <div class="sc-nav-search d-none d-lg-block">
                <i class="bi bi-search sc-nav-search-icon"></i>
                <input type="text" placeholder="Search products...">
            </div>

            <div class="sc-nav-links">
                <a href="{{ url('/') }}" class="sc-nav-link">
                    <i class="bi bi-house-fill"></i>
                    <span class="d-none d-md-inline">Home</span>
                </a>
                <a href="{{ url('/products') }}" class="sc-nav-link">
                    <i class="bi bi-grid-fill"></i>
                    <span class="d-none d-md-inline">Products</span>
                </a>

                @auth
                    <a href="{{ url('/contact') }}" class="sc-nav-link">
                        <i class="bi bi-chat-fill"></i>
                        <span class="d-none d-md-inline">Contact</span>
                    </a>
                    <a href="{{ url('/orders') }}" class="sc-nav-link">
                        <i class="bi bi-bag-fill"></i>
                        <span class="d-none d-md-inline">Orders</span>
                    </a>
                    <a href="{{ url('/cart') }}" class="sc-nav-link sc-nav-link-cart">
                        <i class="bi bi-cart3"></i>
                        <span class="d-none d-sm-inline">Cart</span>
                    </a>
                    <form method="POST" action="{{ route('logout') }}" class="d-flex">
                        @csrf
                        <button type="submit" class="sc-nav-link"
                                style="background:none;border:none;cursor:pointer;font-family:inherit">
                            <i class="bi bi-box-arrow-right"></i>
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="sc-nav-link">
                        <i class="bi bi-person-fill"></i>
                        <span class="d-none d-md-inline">Login</span>
                    </a>
                    <a href="{{ route('register') }}" class="sc-nav-link sc-nav-link-reg">
                        <i class="bi bi-person-plus-fill"></i>
                        <span class="d-none d-md-inline">Register</span>
                    </a>
                @endauth
            </div>
        </div>


    </nav>
@endif

@yield('content')

<footer class="sc-footer">
    <div class="sc-footer-inner">
        <div class="row g-5">
            <div class="col-lg-4">
                <div class="sc-footer-brand">Shop<span>Cart</span></div>
                <p class="sc-footer-desc">
                    Your premium destination for quality products.
                    Fast delivery, easy returns, best prices guaranteed.
                </p>
            </div>
            <div class="col-6 col-lg-2">
                <div class="sc-footer-heading">Shop</div>
                <ul class="sc-footer-links">
                    <li><a href="{{ url('/products') }}">All Products</a></li>
                    <li><a href="#">New Arrivals</a></li>
                    <li><a href="#">Best Sellers</a></li>
                </ul>
            </div>
            <div class="col-6 col-lg-2">
                <div class="sc-footer-heading">Account</div>
                <ul class="sc-footer-links">
                    <li><a href="{{ route('login') }}">Login</a></li>
                    <li><a href="{{ route('register') }}">Register</a></li>
                    <li><a href="{{ url('/orders') }}">My Orders</a></li>
                    <li><a href="{{ url('/contact') }}">Contact Us</a></li>
                </ul>
            </div>
            <div class="col-lg-4">
                <div class="sc-footer-heading">Newsletter</div>
                <p style="font-size:13.5px;margin-bottom:12px">
                    Subscribe for exclusive deals &amp; updates.
                </p>
                <div style="display:flex;gap:8px">
                    <input type="email" placeholder="Your email"
                           style="flex:1;background:rgba(255,255,255,0.07);
                                  border:1px solid rgba(255,255,255,0.1);
                                  border-radius:50px;padding:8px 14px;
                                  color:#fff;font-size:13px;
                                  font-family:inherit;outline:none">
                    <button style="background:#e94560;color:#fff;border:none;
                                   border-radius:50px;padding:8px 16px;
                                   font-size:13px;font-weight:600;
                                   cursor:pointer;font-family:inherit;
                                   white-space:nowrap">
                        Subscribe
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="sc-footer-bottom">
        &copy; {{ date('Y') }} ShopCart. All rights reserved. Made with ❤️ in Pakistan
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>
