@extends('layouts.admin')
@section('title', 'Dashboard')

@section('content')

    <div class="row g-4 mb-4">

        {{-- Total Orders --}}
        <div class="col-md-3 col-sm-6">
            <div class="sc-card p-4">
                <div class="d-flex align-items-center justify-content-between mb-3">
                <span style="font-size:11px;font-weight:700;text-transform:uppercase;
                             letter-spacing:1px;color:#475569">Total Orders</span>
                    <div style="width:38px;height:38px;background:rgba(108,99,255,0.15);
                            border-radius:10px;display:flex;align-items:center;
                            justify-content:center;font-size:17px">🛒</div>
                </div>
                <div style="font-size:30px;font-weight:800;color:#fff;margin-bottom:4px">
                    {{ $totalOrders }}
                </div>
                <div style="font-size:12px;color:#475569">All time orders</div>
            </div>
        </div>

        {{-- Customers --}}
        <div class="col-md-3 col-sm-6">
            <div class="sc-card p-4">
                <div class="d-flex align-items-center justify-content-between mb-3">
                <span style="font-size:11px;font-weight:700;text-transform:uppercase;
                             letter-spacing:1px;color:#475569">Customers</span>
                    <div style="width:38px;height:38px;background:rgba(59,130,246,0.15);
                            border-radius:10px;display:flex;align-items:center;
                            justify-content:center;font-size:17px">👥</div>
                </div>
                <div style="font-size:30px;font-weight:800;color:#fff;margin-bottom:4px">
                    {{ $totalCustomers }}
                </div>
                <div style="font-size:12px;color:#475569">Registered users</div>
            </div>
        </div>

        {{-- Products --}}
        <div class="col-md-3 col-sm-6">
            <div class="sc-card p-4">
                <div class="d-flex align-items-center justify-content-between mb-3">
                <span style="font-size:11px;font-weight:700;text-transform:uppercase;
                             letter-spacing:1px;color:#475569">Products</span>
                    <div style="width:38px;height:38px;background:rgba(245,158,11,0.15);
                            border-radius:10px;display:flex;align-items:center;
                            justify-content:center;font-size:17px">📦</div>
                </div>
                <div style="font-size:30px;font-weight:800;color:#fff;margin-bottom:4px">
                    {{ $totalProducts }}
                </div>
                <div style="font-size:12px;color:#475569">Active products</div>
            </div>
        </div>

    </div>

    {{-- Recent Orders + Quick Links --}}
    <div class="row g-4">

        {{-- Recent Orders --}}
        <div class="col-lg-8">
            <div class="sc-card">
                <div class="sc-card-header">
                    <div class="sc-card-title">
                        <i class="bi bi-bag-check-fill" style="color:#6c63ff"></i>
                        Recent Orders
                    </div>
                    <a href="{{ route('admin.orders.index') }}"
                       class="sc-btn sc-btn-ghost sc-btn-sm">
                        View All <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
                <div style="overflow-x:auto">
                    <table class="sc-table">
                        <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Customer</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($recentOrders as $order)
                            <tr>
                                <td>
                                <span style="font-weight:700;color:#6c63ff">
                                    #{{ $order->id }}
                                </span>
                                </td>
                                <td>{{ $order->user->name ?? 'N/A' }}</td>
                                <td style="font-weight:600">
                                    Rs. {{ number_format($order->total_amount, 0) }}
                                </td>
                                <td>
                                    @php
                                        $map = [
                                            'pending'    => 'sc-badge-warning',
                                            'processing' => 'sc-badge-info',
                                            'shipped'    => 'sc-badge-purple',
                                            'delivered'  => 'sc-badge-success',
                                            'cancelled'  => 'sc-badge-danger',
                                        ];
                                        $cls = $map[$order->status] ?? 'sc-badge-muted';
                                    @endphp
                                    <span class="sc-badge {{ $cls }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                                </td>
                                <td style="color:#64748b;font-size:13px">
                                    {{ $order->created_at->format('d M Y') }}
                                </td>
                                <td>
                                    <a href="{{ route('admin.orders.show', $order) }}"
                                       class="sc-btn sc-btn-ghost sc-btn-sm">
                                        View
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" style="text-align:center;
                                color:#475569;padding:32px">
No order                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- Quick Links --}}
        <div class="col-lg-4">
            <div class="sc-card sc-card-body">
                <div class="sc-card-title mb-4">
                    <i class="bi bi-lightning-fill" style="color:#f59e0b"></i>
                    Quick Actions
                </div>

                <div style="display:flex;flex-direction:column;gap:10px">
                    <a href="{{ route('admin.products.create') }}"
                       class="sc-btn sc-btn-primary w-100 justify-content-center">
                        <i class="bi bi-plus-circle-fill"></i> Add New Product
                    </a>
                    <a href="{{ route('admin.categories.create') }}"
                       class="sc-btn sc-btn-ghost w-100 justify-content-center">
                        <i class="bi bi-tag-fill"></i> Add Category
                    </a>
                    <a href="{{ route('admin.sliders.create') }}"
                       class="sc-btn sc-btn-ghost w-100 justify-content-center">
                        <i class="bi bi-images"></i> Add Slider
                    </a>
                    <a href="{{ route('admin.orders.index') }}"
                       class="sc-btn sc-btn-ghost w-100 justify-content-center">
                        <i class="bi bi-bag-check-fill"></i> View All Orders
                    </a>
                    <a href="{{ route('admin.contacts.index') }}"
                       class="sc-btn sc-btn-ghost w-100 justify-content-center">
                        <i class="bi bi-chat-left-text-fill"></i> View Messages
                        @if($pendingContacts > 0)
                            <span class="sc-badge sc-badge-danger ms-auto">
                            {{ $pendingContacts }}
                        </span>
                        @endif
                    </a>
                </div>
            </div>

            {{-- Pending Contacts Alert --}}
            @if($pendingContacts > 0)
                <div style="margin-top:16px;background:rgba(239,68,68,0.08);
                    border:1px solid rgba(239,68,68,0.18);
                    border-radius:12px;padding:14px 16px;
                    display:flex;align-items:center;gap:10px">
                    <i class="bi bi-exclamation-circle-fill" style="color:#ef4444;font-size:18px"></i>
                    <div>
                        <div style="font-size:13px;font-weight:700;color:#ef4444">
                            {{ $pendingContacts }} Pending
                            {{ Str::plural('Message', $pendingContacts) }}
                        </div>
                        <div style="font-size:12px;color:#64748b">Reply fast!</div>
                    </div>
                </div>
            @endif
        </div>

    </div>

@endsection
