@extends('layouts.admin')

@section('title', 'Edit Testimonial')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="h3 mb-0 text-gray-800">Edit Testimonial</h1>
                    <p class="text-muted">Update testimonial information</p>
                </div>
                <a href="{{ route('admin.testimonials.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-1"></i>
                    Back to List
                </a>
            </div>
        </div>
    </div>

    <!-- Form Card -->
    <div class="card shadow">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Testimonial Information</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.testimonials.update', $testimonial) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="row">
                    <!-- Left Column -->
                    <div class="col-md-6">
                        <!-- Name -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Client Name <span class="text-danger">*</span></label>
                            <input type="text" 
                                   class="form-control @error('name') is-invalid @enderror" 
                                   id="name" 
                                   name="name" 
                                   value="{{ old('name', $testimonial->name) }}" 
                                   required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Profession -->
                        <div class="mb-3">
                            <label for="profession" class="form-label">Profession/Title <span class="text-danger">*</span></label>
                            <input type="text" 
                                   class="form-control @error('profession') is-invalid @enderror" 
                                   id="profession" 
                                   name="profession" 
                                   value="{{ old('profession', $testimonial->profession) }}" 
                                   placeholder="e.g., CEO of Company Name"
                                   required>
                            @error('profession')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Rating -->
                        <div class="mb-3">
                            <label for="rating" class="form-label">Rating <span class="text-danger">*</span></label>
                            <select class="form-select @error('rating') is-invalid @enderror" 
                                    id="rating" 
                                    name="rating" 
                                    required>
                                <option value="">Select Rating</option>
                                @for($i = 1; $i <= 5; $i++)
                                    <option value="{{ $i }}" {{ old('rating', $testimonial->rating) == $i ? 'selected' : '' }}>
                                        {{ $i }} Star{{ $i > 1 ? 's' : '' }}
                                    </option>
                                @endfor
                            </select>
                            @error('rating')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Sort Order -->
                        <div class="mb-3">
                            <label for="sort_order" class="form-label">Sort Order</label>
                            <input type="number" 
                                   class="form-control @error('sort_order') is-invalid @enderror" 
                                   id="sort_order" 
                                   name="sort_order" 
                                   value="{{ old('sort_order', $testimonial->sort_order) }}"
                                   min="0">
                            <small class="text-muted">Lower numbers appear first</small>
                            @error('sort_order')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div class="col-md-6">
                        <!-- Current Image -->
                        @if($testimonial->img)
                            <div class="mb-3">
                                <label class="form-label">Current Image</label>
                                <div>
                                    <img src="{{ $testimonial->image_url }}" 
                                         alt="{{ $testimonial->name }}" 
                                         class="img-thumbnail" 
                                         style="max-width: 200px;">
                                </div>
                            </div>
                        @endif

                        <!-- New Image -->
                        <div class="mb-3">
                            <label for="img" class="form-label">
                                {{ $testimonial->img ? 'Change Image' : 'Profile Image' }}
                            </label>
                            <input type="file" 
                                   class="form-control @error('img') is-invalid @enderror" 
                                   id="img" 
                                   name="img"
                                   accept="image/*"
                                   onchange="previewImage(event)">
                            <small class="text-muted">Accepted formats: JPEG, PNG, JPG, GIF. Max size: 2MB</small>
                            @error('img')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            
                            <!-- Image Preview -->
                            <div class="mt-2">
                                <img id="imagePreview" src="#" alt="Preview" class="img-thumbnail" style="max-width: 200px; display: none;">
                            </div>
                        </div>

                        <!-- Status -->
                        <div class="mb-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" 
                                       type="checkbox" 
                                       id="status" 
                                       name="status" 
                                       {{ old('status', $testimonial->status) ? 'checked' : '' }}>
                                <label class="form-check-label" for="status">
                                    Active Status
                                </label>
                            </div>
                            <small class="text-muted">Inactive testimonials won't be displayed on the website</small>
                        </div>
                    </div>
                </div>

                <!-- Description -->
                <div class="mb-4">
                    <label for="desc" class="form-label">Testimonial Description <span class="text-danger">*</span></label>
                    <textarea class="form-control @error('desc') is-invalid @enderror" 
                              id="desc" 
                              name="desc" 
                              rows="5" 
                              placeholder="Enter the client's testimonial here..."
                              required>{{ old('desc', $testimonial->desc) }}</textarea>
                    @error('desc')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Submit Buttons -->
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i>
                        Update Testimonial
                    </button>
                    <a href="{{ route('admin.testimonials.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times me-1"></i>
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endpush

@push('scripts')
<script>
function previewImage(event) {
    const reader = new FileReader();
    reader.onload = function(){
        const output = document.getElementById('imagePreview');
        output.src = reader.result;
        output.style.display = 'block';
    }
    reader.readAsDataURL(event.target.files[0]);
}
</script>
@endpush
