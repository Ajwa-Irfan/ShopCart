@extends('layouts.admin')
@section('title', 'New Category')

@section('content')
    <div style="max-width:520px">
        <div class="sc-card">
            <div class="sc-card-header">
                <div class="sc-card-title">
                    <i class="bi bi-tag-fill" style="color:#6c63ff"></i>
                    New Category
                </div>
                <a href="{{ route('admin.categories.index') }}"
                   class="sc-btn sc-btn-ghost sc-btn-sm">
                    <i class="bi bi-arrow-left"></i> Back
                </a>
            </div>
            <div class="sc-card-body">
                <form action="{{ route('admin.categories.store') }}"
                      method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="sc-form-group">
                        <label class="sc-form-label">Category Name</label>
                        <input type="text" name="name"
                               class="sc-form-control"
                               value="{{ old('name') }}"
                               placeholder="e.g. Electronics" required>
                        @error('name')
                        <div class="sc-form-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="sc-form-group">
                        <label class="sc-form-label">Category Image</label>
                        <div style="border:2px dashed rgba(255,255,255,0.1);
                                border-radius:10px;padding:20px;
                                text-align:center;cursor:pointer"
                             onclick="document.getElementById('catImg').click()">
                            <img id="catPreview" src=""
                                 style="max-height:130px;width:100%;
                                    object-fit:cover;border-radius:8px;
                                    display:none;margin-bottom:10px">
                            <div id="catDropText">
                                <i class="bi bi-image"
                                   style="font-size:26px;color:#475569"></i>
                                <div style="font-size:13px;color:#475569;margin-top:6px">
                                    Click to upload category image
                                </div>
                                <div style="font-size:11px;color:#334155;margin-top:3px">
                                    JPG, PNG, WEBP — Max 2MB
                                </div>
                            </div>
                            <input type="file" name="image" id="catImg"
                                   accept="image/*" style="display:none"
                                   onchange="previewCat(this)">
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
                            <i class="bi bi-check-lg"></i> Save Category
                        </button>
                        <a href="{{ route('admin.categories.index') }}"
                           class="sc-btn sc-btn-ghost">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            function previewCat(input) {
                if (input.files && input.files[0]) {
                    const reader = new FileReader();
                    reader.onload = e => {
                        const preview  = document.getElementById('catPreview');
                        const dropText = document.getElementById('catDropText');
                        preview.src            = e.target.result;
                        preview.style.display  = 'block';
                        dropText.style.display = 'none';
                    };
                    reader.readAsDataURL(input.files[0]);
                }
            }
        </script>
    @endpush
@endsection
