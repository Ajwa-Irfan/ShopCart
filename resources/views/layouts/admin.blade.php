<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ShopCart Admin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; background: #0f1117; color: #e2e8f0; min-height: 100vh; }
        .sc-sidebar { position: fixed; top: 0; left: 0; width: 250px; height: 100vh; background: #13151e; border-right: 1px solid rgba(255,255,255,0.06); display: flex; flex-direction: column; overflow-y: auto; z-index: 200; }
        .sc-brand { padding: 22px 20px; border-bottom: 1px solid rgba(255,255,255,0.06); display: flex; align-items: center; gap: 10px; text-decoration: none; }
        .sc-brand-icon { width: 36px; height: 36px; background: linear-gradient(135deg, #6c63ff, #ff6584); border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 16px; }
        .sc-brand-name { font-size: 17px; font-weight: 800; color: #fff; }
        .sc-brand-name span { color: #6c63ff; }
        .sc-nav-section { padding: 16px 12px 4px; }
        .sc-nav-label { font-size: 10px; font-weight: 700; letter-spacing: 1.5px; text-transform: uppercase; color: #475569; padding: 0 8px; margin-bottom: 4px; }
        .sc-nav-link { display: flex; align-items: center; gap: 9px; padding: 9px 12px; border-radius: 9px; color: #64748b; font-size: 13.5px; font-weight: 500; text-decoration: none; margin-bottom: 1px; transition: all 0.18s; }
        .sc-nav-link i { font-size: 15px; width: 18px; text-align: center; }
        .sc-nav-link:hover { background: rgba(108,99,255,0.1); color: #c4c9d4; }
        .sc-nav-link.active { background: rgba(108,99,255,0.18); color: #fff; border: 1px solid rgba(108,99,255,0.25); }
        .sc-nav-link.active i { color: #6c63ff; }
        .sc-sidebar-footer { margin-top: auto; padding: 14px 12px; border-top: 1px solid rgba(255,255,255,0.06); }
        .sc-user-box { display: flex; align-items: center; gap: 9px; padding: 10px 11px; border-radius: 10px; background: rgba(255,255,255,0.04); margin-bottom: 8px; }
        .sc-avatar { width: 33px; height: 33px; background: linear-gradient(135deg, #6c63ff, #ff6584); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 13px; font-weight: 700; color: #fff; flex-shrink: 0; }
        .sc-user-name { font-size: 13px; font-weight: 600; color: #e2e8f0; }
        .sc-user-role { font-size: 11px; color: #475569; }
        .sc-logout-btn { display: flex; align-items: center; justify-content: center; gap: 7px; width: 100%; background: rgba(239,68,68,0.08); border: 1px solid rgba(239,68,68,0.15); color: #ef4444; padding: 8px; border-radius: 9px; font-size: 13px; font-weight: 600; font-family: inherit; cursor: pointer; transition: all 0.18s; }
        .sc-logout-btn:hover { background: rgba(239,68,68,0.15); }
        .sc-main { margin-left: 250px; min-height: 100vh; display: flex; flex-direction: column; }
        .sc-topbar { position: sticky; top: 0; z-index: 100; background: #13151e; border-bottom: 1px solid rgba(255,255,255,0.06); padding: 14px 24px; display: flex; align-items: center; gap: 12px; }
        .sc-topbar-title { font-size: 15px; font-weight: 700; flex: 1; }
        .sc-view-site { display: flex; align-items: center; gap: 6px; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.08); color: #94a3b8; padding: 7px 14px; border-radius: 8px; font-size: 12.5px; font-weight: 500; text-decoration: none; transition: all 0.18s; }
        .sc-view-site:hover { color: #fff; background: rgba(255,255,255,0.08); }
        .sc-page { padding: 24px; flex: 1; animation: scFadeUp 0.25s ease; }
        @keyframes scFadeUp { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
        .sc-alert-success { display: flex; align-items: center; gap: 9px; background: rgba(16,185,129,0.1); border: 1px solid rgba(16,185,129,0.2); color: #10b981; padding: 11px 16px; border-radius: 10px; font-size: 13.5px; margin-bottom: 20px; }
        .sc-card { background: #1a1d27; border: 1px solid rgba(255,255,255,0.06); border-radius: 14px; overflow: hidden; }
        .sc-card-header { padding: 14px 20px; border-bottom: 1px solid rgba(255,255,255,0.06); display: flex; align-items: center; justify-content: space-between; }
        .sc-card-title { font-size: 14px; font-weight: 700; }
        .sc-card-body { padding: 20px; }
        .sc-table { width: 100%; border-collapse: collapse; }
        .sc-table th { padding: 11px 16px; font-size: 10.5px; font-weight: 700; letter-spacing: 0.8px; text-transform: uppercase; color: #475569; border-bottom: 1px solid rgba(255,255,255,0.06); text-align: left; white-space: nowrap; }
        .sc-table td { padding: 13px 16px; font-size: 13.5px; border-bottom: 1px solid rgba(255,255,255,0.03); vertical-align: middle; }
        .sc-table tr:last-child td { border-bottom: none; }
        .sc-table tbody tr:hover td { background: rgba(255,255,255,0.015); }
        .sc-badge { display: inline-flex; align-items: center; gap: 4px; padding: 3px 9px; border-radius: 20px; font-size: 11.5px; font-weight: 600; }
        .sc-badge-success { background: rgba(16,185,129,0.12); color: #10b981; }
        .sc-badge-warning { background: rgba(245,158,11,0.12); color: #f59e0b; }
        .sc-badge-danger  { background: rgba(239,68,68,0.12); color: #ef4444; }
        .sc-badge-info    { background: rgba(59,130,246,0.12); color: #3b82f6; }
        .sc-badge-muted   { background: rgba(100,116,139,0.12); color: #64748b; }
        .sc-badge-purple  { background: rgba(108,99,255,0.12); color: #6c63ff; }
        .sc-btn { display: inline-flex; align-items: center; gap: 6px; padding: 8px 16px; border-radius: 9px; font-size: 13px; font-weight: 600; font-family: inherit; cursor: pointer; transition: all 0.18s; text-decoration: none; border: none; white-space: nowrap; }
        .sc-btn-primary { background: #6c63ff; color: #fff; }
        .sc-btn-primary:hover { background: #5a52d5; color: #fff; transform: translateY(-1px); box-shadow: 0 4px 16px rgba(108,99,255,0.35); }
        .sc-btn-ghost { background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.08); color: #94a3b8; }
        .sc-btn-ghost:hover { background: rgba(255,255,255,0.08); color: #e2e8f0; }
        .sc-btn-warning { background: rgba(245,158,11,0.12); border: 1px solid rgba(245,158,11,0.2); color: #f59e0b; }
        .sc-btn-warning:hover { background: rgba(245,158,11,0.2); color: #f59e0b; }
        .sc-btn-danger { background: rgba(239,68,68,0.1); border: 1px solid rgba(239,68,68,0.18); color: #ef4444; }
        .sc-btn-danger:hover { background: rgba(239,68,68,0.18); color: #ef4444; }
        .sc-btn-sm { padding: 5px 11px; font-size: 12px; border-radius: 7px; }
        .sc-form-label { display: block; font-size: 11.5px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; color: #64748b; margin-bottom: 6px; }
        .sc-form-control { width: 100%; background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.08); border-radius: 9px; padding: 9px 13px; color: #e2e8f0; font-size: 13.5px; font-family: inherit; outline: none; transition: all 0.18s; }
        .sc-form-control:focus { border-color: #6c63ff; background: rgba(108,99,255,0.06); box-shadow: 0 0 0 3px rgba(108,99,255,0.12); }
        .sc-form-control::placeholder { color: #334155; }
        select.sc-form-control option { background: #1a1d27; color: #e2e8f0; }
        textarea.sc-form-control { resize: vertical; min-height: 90px; }
        .sc-form-group { margin-bottom: 18px; }
        .sc-form-error { font-size: 12px; color: #ef4444; margin-top: 4px; }
        /* DATATABLES DARK */
        .dataTables_wrapper { color: #e2e8f0; font-family: 'Plus Jakarta Sans', sans-serif; font-size: 13px; }
        .dataTables_wrapper .dataTables_length select,
        .dataTables_wrapper .dataTables_filter input { background: rgba(255,255,255,0.05) !important; border: 1px solid rgba(255,255,255,0.08) !important; border-radius: 8px !important; color: #e2e8f0 !important; padding: 5px 10px !important; outline: none !important; font-family: inherit !important; }
        .dataTables_wrapper .dataTables_filter input:focus { border-color: #6c63ff !important; box-shadow: 0 0 0 3px rgba(108,99,255,0.12) !important; }
        .dataTables_wrapper .dataTables_length label,
        .dataTables_wrapper .dataTables_filter label,
        .dataTables_wrapper .dataTables_info { color: #64748b !important; font-size: 13px !important; }
        .dataTables_wrapper .dataTables_paginate { margin-top: 16px; }
        .dataTables_wrapper .dataTables_paginate .paginate_button { background: rgba(255,255,255,0.04) !important; border: 1px solid rgba(255,255,255,0.06) !important; border-radius: 7px !important; color: #94a3b8 !important; padding: 4px 10px !important; margin: 0 2px !important; font-size: 12.5px !important; cursor: pointer !important; }
        .dataTables_wrapper .dataTables_paginate .paginate_button:hover { background: rgba(108,99,255,0.15) !important; border-color: rgba(108,99,255,0.3) !important; color: #fff !important; }
        .dataTables_wrapper .dataTables_paginate .paginate_button.current { background: #6c63ff !important; border-color: #6c63ff !important; color: #fff !important; }
        .dataTables_wrapper .dataTables_paginate .paginate_button.disabled { opacity: 0.3 !important; }
        .dataTables_wrapper .dataTables_length,
        .dataTables_wrapper .dataTables_filter { margin-bottom: 16px; }
        table.dataTable thead th { border-bottom: 1px solid rgba(255,255,255,0.06) !important; }
        table.dataTable.no-footer { border-bottom: none !important; }
        ::-webkit-scrollbar { width: 4px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.08); border-radius: 4px; }
    </style>
    @stack('styles')
</head>
<body>

<aside class="sc-sidebar">
    <a href="{{ route('admin.dashboard') }}" class="sc-brand">
        <div class="sc-brand-icon">🛒</div>
        <div class="sc-brand-name">Shop<span>Cart</span></div>
    </a>
    <div class="sc-nav-section">
        <div class="sc-nav-label">Main</div>
        <a href="{{ route('admin.dashboard') }}" class="sc-nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="bi bi-grid-fill"></i> Dashboard
        </a>
    </div>
    <div class="sc-nav-section">
        <div class="sc-nav-label">Catalog</div>
        <a href="{{ route('admin.categories.index') }}" class="sc-nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
            <i class="bi bi-tag-fill"></i> Categories
        </a>
        <a href="{{ route('admin.products.index') }}" class="sc-nav-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
            <i class="bi bi-box-seam-fill"></i> Products
        </a>
        <a href="{{ route('admin.sliders.index') }}" class="sc-nav-link {{ request()->routeIs('admin.sliders.*') ? 'active' : '' }}">
            <i class="bi bi-images"></i> Sliders
        </a>
    </div>
    <div class="sc-nav-section">
        <div class="sc-nav-label">Sales</div>
        <a href="{{ route('admin.orders.index') }}" class="sc-nav-link {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
            <i class="bi bi-bag-check-fill"></i> Orders
        </a>
        <a href="{{ route('admin.customers.index') }}" class="sc-nav-link {{ request()->routeIs('admin.customers.*') ? 'active' : '' }}">
            <i class="bi bi-people-fill"></i> Customers
        </a>
    </div>
    <div class="sc-nav-section">
        <div class="sc-nav-label">Support</div>
        <a href="{{ route('admin.contacts.index') }}" class="sc-nav-link {{ request()->routeIs('admin.contacts.*') ? 'active' : '' }}">
            <i class="bi bi-chat-left-text-fill"></i> Messages
        </a>
    </div>
    <div class="sc-sidebar-footer">
        <div class="sc-user-box">
            <div class="sc-avatar">{{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}</div>
            <div>
                <div class="sc-user-name">{{ auth()->user()->name ?? 'Admin' }}</div>
                <div class="sc-user-role">Administrator</div>
            </div>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="sc-logout-btn">
                <i class="bi bi-box-arrow-left"></i> Logout
            </button>
        </form>
    </div>
</aside>

<div class="sc-main">
    <div class="sc-topbar">
        <div class="sc-topbar-title">@yield('title', 'Dashboard')</div>
        <a href="{{ url('/') }}" class="sc-view-site" target="_blank">
            <i class="bi bi-globe2"></i> View Site
        </a>
    </div>
    <div class="sc-page">
        @if(session('success'))
            <div class="sc-alert-success">
                <i class="bi bi-check-circle-fill"></i>
                {{ session('success') }}
            </div>
        @endif
        @yield('content')
    </div>
</div>

{{-- ORDER MATTERS: jQuery first --}}
<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
@stack('scripts')
</body>
</html>
