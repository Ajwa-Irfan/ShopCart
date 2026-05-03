@extends('layouts.admin')
@section('title', 'Edit Product')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card-dark">
                <h6 style="color:#fff;" class="mb-4">Edit Product</h6>

                <form method="POST" action="{{ route('admin.products.update', $product) }}"
                      enctype="multipart/form-data">
                    @csrf @method('PUT')

                    <div class="mb-3">
                        <label style="color:#888; font-size:.85rem;">Product Name</label>
                        <input type="text" name="name" class="form-control"
                               style="background:#12122a; border-color:#2a2a4a; color:#fff;"
                               value="{{ old('name', $product->name) }}" required>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label style="color:#888; font-size:.85rem;">Price (Rs.)</label>
                            <input type="number" name="price" class="form-control"
                                   style="background:#12122a; border-color:#2a2a4a; color:#fff;"
                                   value="{{ old('price', $product->price) }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label style="color:#888; font-size:.85rem;">Stock</label>
                            <input type="number" name="stock" class="form-control"
                                   style="background:#12122a; border-color:#2a2a4a; color:#fff;"
                                   value="{{ old('stock', $product->stock) }}" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label style="color:#888; font-size:.85rem;">Category</label>
                        <select name="category_id" class="form-select"
                                style="background:#12122a; border-color:#2a2a4a; color:#fff;">
                            <option value="">-- Select Category --</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}"
                                    {{ $product->category_id == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label style="color:#888; font-size:.85rem;">Description</label>
                        <textarea name="description" rows="4" class="form-control"
                                  style="background:#12122a; border-color:#2a2a4a; color:#fff;">{{ old('description', $product->description) }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label style="color:#888; font-size:.85rem;">Current Image</label><br>
                        @if($product->image)
                            <img src="{{ asset('storage/'.$product->image) }}"
                                 style="height:80px; border-radius:8px;" class="mb-2">
                        @endif
                        <input type="file" name="image" class="form-control"
                               style="background:#12122a; border-color:#2a2a4a; color:#fff;"
                               accept="image/*">
                        <small style="color:#555;">Leave empty to keep current image</small>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-red px-4">Update Product</button>
                        <a href="{{ route('admin.products.index') }}"
                           class="btn" style="background:#2a2a4a; color:#aaa;">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
