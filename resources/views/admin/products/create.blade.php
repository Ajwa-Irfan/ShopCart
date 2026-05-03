@extends('layouts.admin')
@section('title', 'Add Product')

@section('content')
    <div style="max-width:720px">

        <div class="sc-card">
            <div class="sc-card-header">
                <div class="sc-card-title">
                    <i class="bi bi-plus-circle-fill" style="color:#6c63ff"></i>
                    Add New Product
                </div>
                <a href="{{ route('admin.products.index') }}" class="sc-btn sc-btn-ghost sc-btn-sm">
                    <i class="bi bi-arrow-left"></i> Back
                </a>
            </div>
            <div class="sc-card-body">
                <form action="{{ route('admin.products.store') }}"
                      method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="sc-form-group">
                        <label class="sc-form-label">Product Name</label>
                        <input type="text" name="name"
                               class="sc-form-control"
                               value="{{ old('name') }}"
                               placeholder="e.g. iPhone 15 Pro" required>
                        @error('name')
                        <div class="sc-form-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="sc-form-label">Price (Rs.)</label>
                            <input type="number" name="price"
                                   class="sc-form-control"
                                   value="{{ old('price') }}"
                                   placeholder="0.00" step="0.01" min="0" required>
                            @error('price')
                            <div class="sc-form-error">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="sc-form-label">Stock</label>
                            <input type="number" name="stock"
                                   class="sc-form-control"
                                   value="{{ old('stock', 0) }}"
                                   placeholder="0" min="0" required>
                            @error('stock')
                            <div class="sc-form-error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="sc-form-group">
                        <label class="sc-form-label">Category</label>
                        <select name="category_id" class="sc-form-control" required>
                            <option value="">-- Select Category --</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}"
                                    {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                        <div class="sc-form-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="sc-form-group">
                        <label class="sc-form-label">Description</label>
                        <textarea name="description" class="sc-form-control"
                                  rows="4"
                                  placeholder="Product description...">{{ old('description') }}</textarea>
                    </div>

                    <div class="sc-form-group">
                        <label class="sc-form-label">Product Image</label>
                        <div style="border:2px dashed rgba(255,255,255,0.1);
                                border-radius:10px;padding:20px;text-align:center;
                                cursor:pointer;transition:all 0.2s"
                             onclick="document.getElementById('imgInput').click()"
                             id="dropZone">
                            <img id="imgPreview" src=""
                                 style="max-height:140px;border-radius:8px;
                                    display:none;margin-bottom:10px">
                            <div id="dropText">
                                <i class="bi bi-cloud-upload"
                                   style="font-size:28px;color:#475569"></i>
                                <div style="font-size:13px;color:#475569;margin-top:6px">
                                    Click to upload image
                                </div>
                                <div style="font-size:11px;color:#334155;margin-top:3px">
                                    JPG, PNG, WEBP — Max 2MB
                                </div>
                            </div>
                            <input type="file" name="image" id="imgInput"
                                   accept="image/*" style="display:none"
                                   onchange="previewImg(this)">
                        </div>
                        @error('image')
                        <div class="sc-form-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="sc-form-group">
                        <label class="sc-form-label">Status</label>
                        <select name="status" class="sc-form-control">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>

                    <div style="display:flex;gap:10px;padding-top:8px">
                        <button type="submit" class="sc-btn sc-btn-primary">
                            <i class="bi bi-check-lg"></i> Save Product
                        </button>
                        <a href="{{ route('admin.products.index') }}"
                           class="sc-btn sc-btn-ghost">
                            Cancel
                        </a>
                    </div>

                </form>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            function previewImg(input) {
                if (input.files && input.files[0]) {
                    const reader = new FileReader();
                    reader.onload = e => {
                        const preview = document.getElementById('imgPreview');
                        const text    = document.getElementById('dropText');
                        preview.src = e.target.result;
                        preview.style.display = 'block';
                        text.style.display    = 'none';
                    };
                    reader.readAsDataURL(input.files[0]);
                }
            }
        </script>
    @endpush
@endsection
