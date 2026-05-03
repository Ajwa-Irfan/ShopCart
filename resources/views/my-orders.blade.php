@extends('layouts.app')
@section('title', 'My Orders')
@section('content')

    <div class="container py-5" style="max-width:900px;">
        <h3 class="fw-bold mb-4"><i class="bi bi-bag-check me-2 text-primary"></i>My Orders</h3>

        @forelse($orders as $order)
            <div class="card border-0 shadow-sm mb-4" style="border-radius:14px; overflow:hidden;">
                <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
                    <div>
                        <span class="fw-bold fs-6">#{{ $order->id }}</span>
                        <span class="text-muted small ms-3">
                    <i class="bi bi-calendar me-1"></i>{{ $order->created_at->format('d M Y, h:i A') }}
                </span>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        @php
                            $badge = match($order->status) {
                                'pending'    => 'warning',
                                'processing' => 'info',
                                'shipped'    => 'primary',
                                'delivered'  => 'success',
                                'cancelled'  => 'danger',
                                default      => 'secondary'
                            };
                            $icon = match($order->status) {
                                'pending'    => 'bi-hourglass',
                                'processing' => 'bi-gear',
                                'shipped'    => 'bi-truck',
                                'delivered'  => 'bi-check-circle',
                                'cancelled'  => 'bi-x-circle',
                                default      => 'bi-circle'
                            };
                        @endphp
                        <span class="badge bg-{{ $badge }} px-3 py-2">
                    <i class="bi {{ $icon }} me-1"></i>{{ ucfirst($order->status) }}
                </span>
                        <span class="fw-bold text-primary fs-6">Rs. {{ number_format($order->total_price) }}</span>
                    </div>
                </div>

                <div class="card-body">
                    @foreach($order->items as $item)
                        <div class="d-flex align-items-center gap-3 py-2 {{ !$loop->last ? 'border-bottom' : '' }}">
                            @if($item->product && $item->product->image)
                                <img src="{{ Storage::url($item->product->image) }}"
                                     width="60" height="50"
                                     style="object-fit:cover; border-radius:8px; flex-shrink:0;">
                            @else
                                <div class="bg-light d-flex align-items-center justify-content-center"
                                     style="width:60px; height:50px; border-radius:8px; flex-shrink:0;">
                                    <i class="bi bi-box text-muted"></i>
                                </div>
                            @endif
                            <div class="flex-grow-1">
                                <p class="mb-0 fw-semibold">{{ $item->product->name ?? 'Product Deleted' }}</p>
                                <p class="mb-0 text-muted small">
                                    Qty: {{ $item->quantity }} &times; Rs. {{ number_format($item->price) }}
                                </p>
                            </div>
                            <span class="fw-semibold">Rs. {{ number_format($item->quantity * $item->price) }}</span>
                        </div>
                    @endforeach
                </div>

                <div class="card-footer bg-white d-flex justify-content-between align-items-center py-3">
                    <div class="text-muted small">
                        <i class="bi bi-geo-alt me-1"></i>{{ Str::limit($order->address, 50) }}
                    </div>
                    <div class="fw-bold">
                        Total: <span class="text-primary">Rs. {{ number_format($order->total_price) }}</span>
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center py-5">
                <i class="bi bi-bag-x display-2 text-primary opacity-50 d-block mb-3"></i>
                <h4 class="fw-semibold mb-2">No Orders Yet</h4>
                <p class="text-muted mb-4">You haven't placed any orders yet.</p>
                <a href="{{ url('/products') }}" class="btn btn-primary btn-lg px-5">
                    <i class="bi bi-bag me-2"></i>Start Shopping
                </a>
            </div>
        @endforelse

        <div class="mt-3">{{ $orders->links() }}</div>
    </div>

@endsection
