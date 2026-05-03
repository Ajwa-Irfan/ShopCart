@extends('layouts.admin')

@section('content')
    <div class="container py-4" style="max-width:580px">
        <div class="card shadow-sm">
            <div class="card-header bg-warning">
                <h5 class="mb-0">Edit Slider</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.sliders.update', $slider) }}"
                      method="POST" enctype="multipart/form-data">
                    @csrf @method('PUT')

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Title</label>
                        <input type="text" name="title" class="form-control"
                               value="{{ old('title', $slider->title) }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Subtitle</label>
                        <input type="text" name="subtitle" class="form-control"
                               value="{{ old('subtitle', $slider->subtitle) }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Image</label>
                        <img id="imgPreview"
                             src="{{ Storage::url($slider->image) }}"
                             class="d-block rounded mb-2 w-100"
                             style="max-height:200px;object-fit:cover">
                        <input type="file" name="image" class="form-control"
                               accept="image/*" onchange="previewImg(this)">
                        <small class="text-muted">Khaali chhodo agar same rakhni ho</small>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold">Status</label>
                        <select name="status" class="form-select">
                            <option value="1" {{ $slider->status ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ !$slider->status ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-warning">Update</button>
                        <a href="{{ route('admin.sliders.index') }}"
                           class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        function previewImg(input) {
            const img = document.getElementById('imgPreview');
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = e => { img.src = e.target.result; };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
