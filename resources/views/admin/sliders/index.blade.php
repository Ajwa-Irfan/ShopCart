@extends('layouts.admin')

@section('content')
    <div class="container-fluid py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold">Sliders</h2>
            <a href="{{ route('admin.sliders.create') }}" class="btn btn-primary">
                + New Slider
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="row g-4">
            @forelse($sliders as $slider)
                <div class="col-md-4">
                    <div class="card shadow-sm h-100">
                        <img src="{{ Storage::url($slider->image) }}"
                             class="card-img-top"
                             style="height:190px;object-fit:cover">
                        <div class="card-body">
                            <h5 class="card-title mb-1">{{ $slider->title }}</h5>
                            @if($slider->subtitle)
                                <p class="card-text text-muted small mb-2">
                                    {{ $slider->subtitle }}
                                </p>
                            @endif
                            <span class="badge {{ $slider->status ? 'bg-success' : 'bg-secondary' }}">
                        {{ $slider->status ? 'Active' : 'Inactive' }}
                    </span>
                        </div>
                        <div class="card-footer bg-transparent d-flex gap-2">
                            <a href="{{ route('admin.sliders.edit', $slider) }}"
                               class="btn btn-sm btn-warning flex-grow-1">Edit</a>
                            <form action="{{ route('admin.sliders.destroy', $slider) }}"
                                  method="POST" class="flex-grow-1">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-danger w-100"
                                        onclick="return confirm('Delete karna chahte ho?')">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info text-center">
No slider                    </div>
                </div>
            @endforelse
        </div>
    </div>
@endsection
