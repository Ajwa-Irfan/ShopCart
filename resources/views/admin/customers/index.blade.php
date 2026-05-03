@extends('layouts.admin')
@section('title', 'Customers')

@section('content')

    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h4 style="font-weight:800;color:#fff;margin:0">All Customers</h4>
            <div style="font-size:13px;color:#475569;margin-top:3px">
                {{ $customers->count() }} customers total
            </div>
        </div>
    </div>

    <div class="sc-card">
        <div class="sc-card-body">
            <table class="sc-table" id="customersTable">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Joined</th>
                    <th>Total Orders</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @forelse($customers as $customer)
                    <tr>
                        <td style="color:#475569">{{ $loop->iteration }}</td>
                        <td>
                            <div style="display:flex;align-items:center;gap:10px">
                                <div style="width:36px;height:36px;
                                        background:linear-gradient(135deg,#6c63ff,#e94560);
                                        border-radius:50%;display:flex;align-items:center;
                                        justify-content:center;font-size:13px;
                                        font-weight:700;color:#fff;flex-shrink:0">
                                    {{ strtoupper(substr($customer->name, 0, 1)) }}
                                </div>
                                <span style="font-weight:600">{{ $customer->name }}</span>
                            </div>
                        </td>
                        <td style="color:#94a3b8">{{ $customer->email }}</td>
                        <td style="color:#475569;font-size:13px">
                            {{ $customer->created_at->format('d M Y') }}
                        </td>
                        <td>
                        <span class="sc-badge sc-badge-info">
                            {{ $customer->orders_count }}
                        </span>
                        </td>
                        <td>
                            <a href="mailto:{{ $customer->email }}"
                               class="sc-btn sc-btn-ghost sc-btn-sm">
                                <i class="bi bi-envelope-fill"></i> Email
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="text-align:center;padding:40px;color:#475569">
                            <div style="font-size:32px;margin-bottom:8px">👥</div>
                            No customers found
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
                $('#customersTable').DataTable({
                    responsive: true,
                    pageLength: 10,
                    language: {
                        search: "",
                        searchPlaceholder: "Search customers...",
                        paginate: {
                            previous: "<i class='bi bi-chevron-left'></i>",
                            next: "<i class='bi bi-chevron-right'></i>"
                        }
                    },
                    columnDefs: [
                        { orderable: false, targets: [5] }
                    ]
                });
            });
        </script>
    @endpush
@endsection
