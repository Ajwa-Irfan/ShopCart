@extends('layouts.admin')
@section('title', 'Products')

@section('content')

    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h4 style="font-weight:800;color:#fff;margin:0">All Products</h4>
            <div style="font-size:13px;color:#475569;margin-top:3px">
                {{ $products->count() }} products total
            </div>
        </div>
        <a href="{{ route('admin.products.create') }}" class="sc-btn sc-btn-primary">
            <i class="bi bi-plus-lg"></i> Add Product
        </a>
    </div>

    <div class="sc-card">
        <div class="sc-card-body">
            <table class="sc-table" id="productsTable">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @forelse($products as $product)
                    <tr>
                        <td style="color:#475569">{{ $loop->iteration }}</td>
                        <td>
                            @if($product->image)
                                <img src="{{ asset('storage/'.$product->image) }}"
                                     style="width:48px;height:48px;object-fit:cover;
                                        border-radius:8px;border:1px solid rgba(255,255,255,0.08)">
                            @else
                                <div style="width:48px;height:48px;border-radius:8px;
                                        background:rgba(255,255,255,0.05);
                                        display:flex;align-items:center;
                                        justify-content:center;font-size:20px">📦</div>
                            @endif
                        </td>
                        <td style="font-weight:600">{{ $product->name }}</td>
                        <td>
                        <span class="sc-badge sc-badge-purple">
                            {{ $product->category->name ?? '—' }}
                        </span>
                        </td>
                        <td style="font-weight:700;color:#10b981">
                            Rs. {{ number_format($product->price, 0) }}
                        </td>
                        <td>
                        <span class="sc-badge {{ $product->stock > 0 ? 'sc-badge-success' : 'sc-badge-danger' }}">
                            {{ $product->stock }}
                        </span>
                        </td>
                        <td>
                        <span class="sc-badge {{ $product->status ? 'sc-badge-success' : 'sc-badge-muted' }}">
                            {{ $product->status ? 'Active' : 'Inactive' }}
                        </span>
                        </td>
                        <td>
                            <div style="display:flex;gap:6px">
                                <a href="{{ route('admin.products.edit', $product) }}"
                                   class="sc-btn sc-btn-warning sc-btn-sm">
                                    <i class="bi bi-pencil-fill"></i>
                                </a>
                                <form action="{{ route('admin.products.destroy', $product) }}"
                                      method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="sc-btn sc-btn-danger sc-btn-sm"
                                            onclick="return confirm('Delete this product?')">
                                        <i class="bi bi-trash-fill"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" style="text-align:center;padding:40px;color:#475569">
                            <div style="font-size:32px;margin-bottom:8px">📦</div>
                            No products found
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
                $('#productsTable').DataTable({
                    responsive: true,
                    pageLength: 10,
                    language: {
                        search: "",
                        searchPlaceholder: "Search products...",
                        lengthMenu: "Show _MENU_ entries",
                        info: "Showing _START_ to _END_ of _TOTAL_ products",
                        paginate: {
                            previous: "<i class='bi bi-chevron-left'></i>",
                            next: "<i class='bi bi-chevron-right'></i>"
                        }
                    },
                    columnDefs: [
                        { orderable: false, targets: [1, 7] }
                    ]
                });
            });
        </script>
    @endpush
@endsection
