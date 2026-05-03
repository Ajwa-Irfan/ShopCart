@extends('layouts.admin')

@section('content')
    <div class="container py-4" style="max-width:820px">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold">Order #{{ $order->id }}</h2>
            <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">← Back</a>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="row g-4">
            <div class="col-md-6">
                <div class="card shadow-sm h-100">
                    <div class="card-header bg-dark text-white fw-semibold">Customer Info</div>
                    <div class="card-body">
                        <p class="mb-2"><strong>Name:</strong> {{ $order->user->name ?? 'N/A' }}</p>
                        <p class="mb-2"><strong>Email:</strong> {{ $order->user->email ?? 'N/A' }}</p>
                        <p class="mb-0"><strong>Address:</strong> {{ $order->address }}</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card shadow-sm h-100">
                    <div class="card-header bg-dark text-white fw-semibold">Update Status</div>
                    <div class="card-body d-flex align-items-center">
                        <form action="{{ route('admin.orders.update', $order) }}" method="POST" class="w-100">
                            @csrf @method('PUT')
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Current Status</label>
                                <select name="status" class="form-select form-select-lg">
                                    @foreach(['pending','processing','shipped','delivered','cancelled'] as $s)
                                        <option value="{{ $s }}" {{ $order->status === $s ? 'selected' : '' }}>
                                            {{ ucfirst($s) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-success w-100">Update Status</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow-sm mt-4">
            <div class="card-header bg-dark text-white fw-semibold">Order Items</div>
            <div class="card-body p-0">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                    <tr>
                        <th>Product</th>
                        <th>Unit Price</th>
                        <th>Qty</th>
                        <th>Subtotal</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($order->items as $item)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    @if($item->product && $item->product->image)
                                        <img src="{{ asset('storage/' . $item->product->image) }}"
                                             width="50" height="50"
                                             class="rounded object-fit-cover">
                                    @endif
                                    <span class="fw-semibold">
                                        {{ $item->product->name ?? 'Product deleted' }}
                                    </span>
                                </div>
                            </td>
                            <td>Rs. {{ number_format($item->price, 2) }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td class="fw-semibold">Rs. {{ number_format($item->price * $item->quantity, 2) }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot class="table-light">
                    <tr>
                        <td colspan="3" class="text-end fw-bold fs-5">Total:</td>
                        <td class="fw-bold fs-5 text-success">
                            Rs. {{ number_format($order->total_amount, 2) }}
                        </td>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection
