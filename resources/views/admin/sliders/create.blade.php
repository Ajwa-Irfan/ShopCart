@extends('layouts.admin')
@section('title', 'New Slider')

@section('content')
    <div style="max-width:580px">
        <div class="sc-card">
            <div class="sc-card-header">
                <div class="sc-card-title">
                    <i class="bi bi-images" style="color:#6c63ff"></i>
                    New Slider
                </div>
                <a href="{{ route('admin.sliders.index') }}"
                   class="sc-btn sc-btn-ghost sc-btn-sm">
                    <i class="bi bi-arrow-left"></i> Back
                </a>
            </div>
            <div class="sc-card-body">
                <form action="{{ route('admin.sliders.store') }}"
                      method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="sc-form-group">
                        <label class="sc-form-label">Title</label>
                        <input type="text" name="title"
                               class="sc-form-control"
                               value="{{ old('title') }}"
                               placeholder="Slider title" required>
                        @error('title')
                        <div class="sc-form-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="sc-form-group">
                        <label class="sc-form-label">
                            Subtitle
                            <span style="color:#334155;font-weight:400;
                                     text-transform:none;letter-spacing:0">
                            (optional)
                        </span>
                        </label>
                        <input type="text" name="subtitle"
                               class="sc-form-control"
                               value="{{ old('subtitle') }}"
                               placeholder="Short description">
                    </div>

                    <div class="sc-form-group">
                        <label class="sc-form-label">Slider Image</label>
                        <div style="border:2px dashed rgba(255,255,255,0.1);
                                border-radius:10px;padding:20px;text-align:center;
                                cursor:pointer;transition:all 0.2s"
                             onclick="document.getElementById('sliderImg').click()">
                            <img id="sliderPreview" src=""
                                 style="max-height:160px;width:100%;object-fit:cover;
                                    border-radius:8px;display:none;margin-bottom:10px">
                            <div id="sliderDropText">
                                <i class="bi bi-image"
                                   style="font-size:28px;color:#475569"></i>
                                <div style="font-size:13px;color:#475569;margin-top:6px">
                                    Click to upload slider image
                                </div>
                                <div style="font-size:11px;color:#334155;margin-top:3px">
                                    Recommended: 1200×450px
                                </div>
                            </div>
                            <input type="file" name="image" id="sliderImg"
                                   accept="image/*" style="display:none" required
                                   onchange="previewSlider(this)">
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
                            <i class="bi bi-check-lg"></i> Save Slider
                        </button>
                        <a href="{{ route('admin.sliders.index') }}"
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
            function previewSlider(input) {
                if (input.files && input.files[0]) {
                    const reader = new FileReader();
                    reader.onload = e => {
                        const preview  = document.getElementById('sliderPreview');
                        const dropText = document.getElementById('sliderDropText');
                        preview.src           = e.target.result;
                        preview.style.display = 'block';
                        dropText.style.display = 'none';
                    };
                    reader.readAsDataURL(input.files[0]);
                }
            }
        </script>
    @endpush
@endsection
