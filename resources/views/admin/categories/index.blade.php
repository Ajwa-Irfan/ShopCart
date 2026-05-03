@extends('layouts.admin')
@section('title', 'Categories')

@section('content')

    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h4 style="font-weight:800;color:#fff;margin:0">All Categories</h4>
            <div style="font-size:13px;color:#475569;margin-top:3px">
                {{ $categories->count() }} categories total
            </div>
        </div>
        <a href="{{ route('admin.categories.create') }}" class="sc-btn sc-btn-primary">
            <i class="bi bi-plus-lg"></i> Add Category
        </a>
    </div>

    <div class="sc-card">
        <div class="sc-card-body">
            <table class="sc-table" id="categoriesTable">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Products</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @forelse($categories as $category)
                    <tr>
                        <td style="color:#475569">{{ $loop->iteration }}</td>
                        <td>
                            @if($category->image)
                                <img src="{{ asset('storage/'.$category->image) }}"
                                     style="width:48px;height:48px;object-fit:cover;border-radius:8px;border:1px solid rgba(255,255,255,0.08)">
                            @else
                                <div style="width:48px;height:48px;border-radius:8px;background:rgba(255,255,255,0.05);display:flex;align-items:center;justify-content:center;font-size:20px">🏷️</div>
                            @endif
                        </td>
                        <td style="font-weight:600">{{ $category->name }}</td>
                        <td><code style="color:#6c63ff;background:rgba(108,99,255,0.1);padding:2px 7px;border-radius:5px">{{ $category->slug }}</code></td>
                        <td>
                        <span class="sc-badge sc-badge-info">
                            {{ $category->products_count }}
                        </span>
                        </td>
                        <td>
                        <span class="sc-badge {{ $category->status ? 'sc-badge-success' : 'sc-badge-muted' }}">
                            {{ $category->status ? 'Active' : 'Inactive' }}
                        </span>
                        </td>
                        <td>
                            <div style="display:flex;gap:6px">
                                <a href="{{ route('admin.categories.edit', $category) }}"
                                   class="sc-btn sc-btn-warning sc-btn-sm">
                                    <i class="bi bi-pencil-fill"></i>
                                </a>
                                <form action="{{ route('admin.categories.destroy', $category) }}"
                                      method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="sc-btn sc-btn-danger sc-btn-sm"
                                            onclick="return confirm('Delete this category?')">
                                        <i class="bi bi-trash-fill"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" style="text-align:center;padding:40px;color:#475569">
                            <div style="font-size:32px;margin-bottom:8px">🏷️</div>
                            No categories found
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
                $('#categoriesTable').DataTable({
                    responsive: true,
                    pageLength: 10,
                    language: {
                        search: "",
                        searchPlaceholder: "Search categories...",
                        paginate: {
                            previous: "<i class='bi bi-chevron-left'></i>",
                            next: "<i class='bi bi-chevron-right'></i>"
                        }
                    },
                    columnDefs: [
                        { orderable: false, targets: [1, 6] }
                    ]
                });
            });
        </script>
    @endpush
@endsection
