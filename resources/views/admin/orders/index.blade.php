@extends('layouts.admin')
@section('title', 'Orders')

@section('content')

    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h4 style="font-weight:800;color:#fff;margin:0">All Orders</h4>
            <div style="font-size:13px;color:#475569;margin-top:3px">
                {{ $orders->count() }} orders total
            </div>
        </div>
    </div>

    <div class="sc-card">
        <div class="sc-card-body">
            <table class="sc-table" id="ordersTable">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Order ID</th>
                    <th>Customer</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @forelse($orders as $order)
                    <tr>
                        <td style="color:#475569">{{ $loop->iteration }}</td>
                        <td style="font-weight:700;color:#6c63ff">#{{ $order->id }}</td>
                        <td>
                            <div style="font-weight:600">{{ $order->user->name ?? 'N/A' }}</div>
                            <div style="font-size:12px;color:#475569">{{ $order->user->email ?? '' }}</div>
                        </td>
                        <td style="font-weight:700;color:#10b981">
                            Rs. {{ number_format($order->total_amount ?? $order->total_price ?? 0, 0) }}
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
                            @endphp
                            <span class="sc-badge {{ $map[$order->status] ?? 'sc-badge-muted' }}">
                            {{ ucfirst($order->status) }}
                        </span>
                        </td>
                        <td style="color:#475569;font-size:13px">
                            {{ $order->created_at->format('d M Y') }}
                        </td>
                        <td>
                            <a href="{{ route('admin.orders.show', $order) }}"
                               class="sc-btn sc-btn-ghost sc-btn-sm">
                                <i class="bi bi-eye-fill"></i> View
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" style="text-align:center;padding:40px;color:#475569">
                            <div style="font-size:32px;margin-bottom:8px">🛒</div>
                            No orders found
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @push('scripts')
        <script>
            $(document).ready(function() {
                $('#ordersTable').DataTable({
                    responsive: true,
                    pageLength: 10,
                    order: [[5, 'desc']],
                    language: {
                        search: "",
                        searchPlaceholder: "Search orders...",
                        paginate: {
                            previous: "<i class='bi bi-chevron-left'></i>",
                            next: "<i class='bi bi-chevron-right'></i>"
                        }
                    },
                    columnDefs: [
                        { orderable: false, targets: [6] }
                    ]
                });
            });
        </script>
    @endpush
@endsection
