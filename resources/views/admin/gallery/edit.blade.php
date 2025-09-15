@extends('admin.layouts.app')

@section('title', 'Edit Gallery Image')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Edit Gallery Image</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.gallery.index') }}">Gallery</a></li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Alert Messages -->
    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Main Content -->
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Image Details</h5>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.gallery.update', $gallery) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Title -->
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Title <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                       name="title" value="{{ old('title', $gallery->title) }}" required>
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Description</label>
                            <div class="col-sm-9">
                                <textarea class="form-control @error('description') is-invalid @enderror" 
                                          name="description" rows="4" 
                                          placeholder="Optional description">{{ old('description', $gallery->description) }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Alt Text -->
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Alt Text</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control @error('alt_text') is-invalid @enderror" 
                                       name="alt_text" value="{{ old('alt_text', $gallery->alt_text) }}"
                                       placeholder="Alternative text for accessibility">
                                @error('alt_text')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Sort Order -->
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Sort Order</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control @error('sort_order') is-invalid @enderror" 
                                       name="sort_order" value="{{ old('sort_order', $gallery->sort_order) }}" min="0">
                                <small class="text-muted">Lower numbers appear first</small>
                                @error('sort_order')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Status -->
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Status</label>
                            <div class="col-sm-9">
                                <div class="form-check form-switch">
                                    <input type="checkbox" class="form-check-input" name="is_active" 
                                           id="is_active" value="1" 
                                           {{ old('is_active', $gallery->is_active) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_active">Active</label>
                                </div>
                                <small class="text-muted">Inactive images won't be shown in the frontend gallery</small>
                            </div>
                        </div>

                        <!-- Replace Image -->
                        <div class="row mb-4">
                            <label class="col-sm-3 col-form-label">Replace Image</label>
                            <div class="col-sm-9">
                                <input type="file" class="form-control @error('image') is-invalid @enderror" 
                                       name="image" accept="image/jpeg,image/png,image/jpg,image/gif,image/webp">
                                <small class="text-muted">Leave empty to keep current image. Max size: 10MB</small>
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="row">
                            <div class="col-sm-9 offset-sm-3">
                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="ri-save-line"></i> Update Image
                                    </button>
                                    <a href="{{ route('admin.gallery.index') }}" class="btn btn-secondary">
                                        <i class="ri-arrow-left-line"></i> Back to Gallery
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Current Image</h5>
                </div>
                <div class="card-body">
                    <div class="text-center">
                        <img src="{{ $gallery->image_url }}" alt="{{ $gallery->alt_text }}" 
                             class="img-fluid rounded shadow-sm current-image" 
                             id="currentImage" style="cursor: pointer;">
                        
                        <div class="mt-3">
                            <button type="button" class="btn btn-outline-primary btn-sm" 
                                    onclick="viewFullImage()">
                                <i class="ri-eye-line"></i> View Full Size
                            </button>
                        </div>
                        
                        <div class="mt-3">
                            <div class="row g-2 text-start">
                                <div class="col-12">
                                    <small class="text-muted">
                                        <strong>File:</strong> {{ $gallery->image_name }}
                                    </small>
                                </div>
                                <div class="col-12">
                                    <small class="text-muted">
                                        <strong>Uploaded:</strong> {{ $gallery->created_at->format('M j, Y g:i A') }}
                                    </small>
                                </div>
                                <div class="col-12">
                                    <small class="text-muted">
                                        <strong>Last Updated:</strong> {{ $gallery->updated_at->format('M j, Y g:i A') }}
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions Card -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Quick Actions</h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <form action="{{ route('admin.gallery.toggle-status', $gallery) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn {{ $gallery->is_active ? 'btn-warning' : 'btn-success' }} w-100">
                                <i class="ri-toggle-line"></i> 
                                {{ $gallery->is_active ? 'Deactivate' : 'Activate' }}
                            </button>
                        </form>
                        
                        <form action="{{ route('admin.gallery.destroy', $gallery) }}" method="POST" 
                              onsubmit="return confirm('Are you sure you want to delete this image? This action cannot be undone.')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger w-100">
                                <i class="ri-delete-bin-line"></i> Delete Image
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Full Image Modal -->
<div class="modal fade" id="imageModal" tabindex="-1">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ $gallery->title }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center p-0">
                <img src="{{ $gallery->image_url }}" alt="{{ $gallery->alt_text }}" class="img-fluid">
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
.current-image {
    max-height: 300px;
    width: auto;
    transition: transform 0.2s ease;
}

.current-image:hover {
    transform: scale(1.02);
}

.form-control:focus {
    border-color: #3b82f6;
    box-shadow: 0 0 0 0.2rem rgba(59, 130, 246, 0.25);
}

.card {
    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    border: 1px solid rgba(0, 0, 0, 0.125);
}

.card-header {
    background-color: #f8f9fa;
    border-bottom: 1px solid rgba(0, 0, 0, 0.125);
}

.btn-primary {
    background-color: #3b82f6;
    border-color: #3b82f6;
}

.btn-primary:hover {
    background-color: #2563eb;
    border-color: #2563eb;
}
</style>
@endsection

@section('scripts')
<script>
function viewFullImage() {
    const modal = new bootstrap.Modal(document.getElementById('imageModal'));
    modal.show();
}

// Handle image replacement preview
document.querySelector('input[name="image"]').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(event) {
            const currentImage = document.getElementById('currentImage');
            currentImage.src = event.target.result;
        };
        reader.readAsDataURL(file);
    }
});
</script>
@endsection
