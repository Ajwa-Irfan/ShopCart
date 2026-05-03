<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ShopCart Admin — @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { background:#0f0f1a; color:#e0e0e0; font-family:'Segoe UI',sans-serif; }

        #sidebar {
            width:250px; min-height:100vh; background:#1a1a2e;
            position:fixed; top:0; left:0; z-index:100;
            border-right:1px solid #2a2a4a;
            display:flex; flex-direction:column;
        }
        .sidebar-brand { padding:22px 20px; border-bottom:1px solid #2a2a4a; }
        .sidebar-brand .logo { font-size:1.3rem; font-weight:800; color:#fff; }
        .sidebar-brand .logo span { color:#e63946; }

        .menu-label {
            font-size:0.68rem; text-transform:uppercase;
            letter-spacing:1.5px; color:#444466;
            padding:14px 20px 5px;
        }
        .nav-item a {
            display:flex; align-items:center; gap:10px;
            padding:10px 20px; color:#8888aa; text-decoration:none;
            font-size:0.88rem; border-left:3px solid transparent;
            transition:all .2s;
        }
        .nav-item a:hover, .nav-item a.active {
            background:#12122a; color:#fff; border-left-color:#e63946;
        }
        .nav-item a i { font-size:1rem; }

        #topbar {
            margin-left:250px; background:#1a1a2e;
            padding:13px 24px; border-bottom:1px solid #2a2a4a;
            display:flex; justify-content:space-between; align-items:center;
            position:sticky; top:0; z-index:99;
        }
        #main { margin-left:250px; padding:26px; }

        .card-dark {
            background:#1a1a2e; border:1px solid #2a2a4a;
            border-radius:12px; padding:22px;
        }
        .btn-red { background:#e63946; color:#fff; border:none; }
        .btn-red:hover { background:#c1121f; color:#fff; }

        .table-dark-custom { color:#ccc; }
        .table-dark-custom thead th {
            background:#12122a; color:#888;
            font-size:0.75rem; text-transform:uppercase;
            letter-spacing:1px; border-color:#2a2a4a;
        }
        .table-dark-custom td { border-color:#1e1e3a; vertical-align:middle; }
        .table-dark-custom tbody tr:hover { background:#12122a; }

        .badge-pending    { background:#f4a261; color:#000; }
        .badge-processing { background:#457b9d; color:#fff; }
        .badge-shipped    { background:#2a9d8f; color:#fff; }
        .badge-delivered  { background:#2d6a4f; color:#fff; }
    </style>
    @stack('styles')
</head>
<body>

{{-- ═══ SIDEBAR ═══ --}}
<div id="sidebar">
    <div class="sidebar-brand">
        <div class="logo">Shop<span>Cart</span></div>
        <small style="color:#555577;">Admin Panel</small>
    </div>

    <div style="flex:1; overflow-y:auto;">
        <div class="menu-label">Main</div>
        <ul class="list-unstyled mb-0">
            <li class="nav-item">
                <a href="{{ route('admin.dashboard') }}"
                   class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2"></i> Dashboard
                </a>
            </li>
        </ul>

        <div class="menu-label">Catalog</div>
        <ul class="list-unstyled mb-0">
            <li class="nav-item">
                <a href="{{ route('admin.products.index') }}"
                   class="{{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                    <i class="bi bi-box-seam"></i> Products
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.categories.index') }}"
                   class="{{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                    <i class="bi bi-grid"></i> Categories
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.sliders.index') }}"
                   class="{{ request()->routeIs('admin.sliders.*') ? 'active' : '' }}">
                    <i class="bi bi-images"></i> Sliders
                </a>
            </li>
        </ul>

        <div class="menu-label">Sales</div>
        <ul class="list-unstyled mb-0">
            <li class="nav-item">
                <a href="{{ route('admin.orders.index') }}"
                   class="{{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
                    <i class="bi bi-bag-check"></i> Orders
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.customers.index') }}"
                   class="{{ request()->routeIs('admin.customers.*') ? 'active' : '' }}">
                    <i class="bi bi-people"></i> Customers
                </a>
            </li>
        </ul>

        <div class="menu-label">Support</div>
        <ul class="list-unstyled mb-0">
            <li class="nav-item">
                <a href="{{ route('admin.contacts.index') }}"
                   class="{{ request()->routeIs('admin.contacts.*') ? 'active' : '' }}">
                    <i class="bi bi-chat-dots"></i> Messages
                </a>
            </li>
        </ul>
    </div>

    {{-- Logout --}}
    <div style="padding:16px 20px; border-top:1px solid #2a2a4a;">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-sm w-100"
                    style="background:#2a2a4a; color:#aaa;">
                <i class="bi bi-box-arrow-left"></i> Logout
            </button>
        </form>
    </div>
</div>

{{-- ═══ TOPBAR ═══ --}}
<div id="topbar">
    <div style="font-weight:600; color:#fff;">@yield('title')</div>
    <div style="color:#888; font-size:0.85rem;">
        <i class="bi bi-person-circle"></i>
        {{ auth()->user()->name }}
    </div>
</div>

{{-- ═══ MAIN CONTENT ═══ --}}
<div id="main">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert"
             style="background:#1a3a2a; border-color:#2d6a4f; color:#90e0ae;">
            {{ session('success') }}
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>
