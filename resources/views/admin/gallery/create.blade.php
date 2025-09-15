@extends('layouts.admin')

@section('title', 'Upload Gallery Images')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Upload Gallery Images</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.gallery.index') }}">Gallery</a></li>
                        <li class="breadcrumb-item active">Upload</li>
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
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Upload Multiple Images</h5>
                    <p class="text-muted mb-0">Select multiple images to upload to your gallery. Maximum file size: 10MB per image.</p>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data" id="gallery-form">
                        @csrf
                        
                        <!-- File Upload Section -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <label class="form-label">Select Images <span class="text-danger">*</span></label>
                                <div class="dropzone" id="image-dropzone">
                                    <div class="dz-message" data-dz-message>
                                        <div class="mb-3">
                                            <i class="display-4 text-muted ri-upload-cloud-line"></i>
                                        </div>
                                        <h4>Drop images here or click to upload</h4>
                                        <p class="text-muted">Supports: JPG, PNG, GIF, WebP (max 10MB each)</p>
                                    </div>
                                </div>
                                
                                <!-- Traditional File Input (fallback) -->
                                <div class="mt-3">
                                    <input type="file" class="form-control" name="images[]" id="images" multiple 
                                           accept="image/jpeg,image/png,image/jpg,image/gif,image/webp" required>
                                    <small class="text-muted">Hold Ctrl/Cmd to select multiple files</small>
                                </div>
                            </div>
                        </div>

                        <!-- Preview and Details Section -->
                        <div id="image-preview-container" style="display: none;">
                            <h6 class="mb-3">Image Details</h6>
                            <div id="image-previews" class="row"></div>
                        </div>

                        <!-- Form Actions -->
                        <div class="row">
                            <div class="col-12">
                                <div class="d-flex justify-content-between">
                                    <a href="{{ route('admin.gallery.index') }}" class="btn btn-secondary">
                                        <i class="ri-arrow-left-line"></i> Back to Gallery
                                    </a>
                                    <button type="submit" class="btn btn-primary" id="submit-btn" disabled>
                                        <i class="ri-upload-line"></i> Upload Images
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
.dropzone {
    border: 2px dashed #d1d5db;
    border-radius: 8px;
    padding: 2rem;
    text-align: center;
    cursor: pointer;
    transition: all 0.3s ease;
    background: #f9fafb;
}

.dropzone:hover,
.dropzone.dragover {
    border-color: #3b82f6;
    background: #eff6ff;
}

.image-preview-card {
    border: 1px solid #e5e7eb;
    border-radius: 8px;
    padding: 1rem;
    background: white;
    margin-bottom: 1rem;
}

.preview-image {
    width: 100%;
    height: 150px;
    object-fit: cover;
    border-radius: 6px;
    border: 1px solid #e5e7eb;
}

.remove-image {
    position: absolute;
    top: 5px;
    right: 5px;
    background: rgba(220, 53, 69, 0.9);
    border: none;
    color: white;
    width: 25px;
    height: 25px;
    border-radius: 50%;
    font-size: 12px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
}

.remove-image:hover {
    background: #dc3545;
}

.image-preview-container {
    position: relative;
}

.form-control:focus {
    border-color: #3b82f6;
    box-shadow: 0 0 0 0.2rem rgba(59, 130, 246, 0.25);
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
document.addEventListener('DOMContentLoaded', function() {
    const imageInput = document.getElementById('images');
    const previewContainer = document.getElementById('image-preview-container');
    const previewsContainer = document.getElementById('image-previews');
    const submitBtn = document.getElementById('submit-btn');
    const dropzone = document.getElementById('image-dropzone');
    
    let selectedFiles = [];
    let imageCounter = 0;

    // Handle file input change
    imageInput.addEventListener('change', function(e) {
        handleFiles(e.target.files);
    });

    // Handle drag and drop
    dropzone.addEventListener('dragover', function(e) {
        e.preventDefault();
        e.stopPropagation();
        dropzone.classList.add('dragover');
    });

    dropzone.addEventListener('dragleave', function(e) {
        e.preventDefault();
        e.stopPropagation();
        dropzone.classList.remove('dragover');
    });

    dropzone.addEventListener('drop', function(e) {
        e.preventDefault();
        e.stopPropagation();
        dropzone.classList.remove('dragover');
        
        const files = e.dataTransfer.files;
        handleFiles(files);
        
        // Update file input
        imageInput.files = files;
    });

    dropzone.addEventListener('click', function() {
        imageInput.click();
    });

    function handleFiles(files) {
        if (files.length === 0) {
            previewContainer.style.display = 'none';
            submitBtn.disabled = true;
            return;
        }

        selectedFiles = Array.from(files);
        previewContainer.style.display = 'block';
        submitBtn.disabled = false;
        
        generatePreviews();
    }

    function generatePreviews() {
        previewsContainer.innerHTML = '';
        imageCounter = 0;

        selectedFiles.forEach((file, index) => {
            if (file && file.type.startsWith('image/')) {
                createImagePreview(file, index);
            }
        });
    }

    function createImagePreview(file, index) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            const previewHtml = `
                <div class="col-md-6 col-lg-4 mb-3" data-index="${index}">
                    <div class="image-preview-card">
                        <div class="image-preview-container">
                            <img src="${e.target.result}" alt="Preview" class="preview-image">
                            <button type="button" class="remove-image" onclick="removeImage(${index})">
                                <i class="ri-close-line"></i>
                            </button>
                        </div>
                        
                        <div class="mt-3">
                            <div class="mb-2">
                                <label class="form-label">Title <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="titles[]" 
                                       value="${getFileNameWithoutExtension(file.name)}" required>
                            </div>
                            
                            <div class="mb-2">
                                <label class="form-label">Description</label>
                                <textarea class="form-control" name="descriptions[]" rows="2" 
                                          placeholder="Optional description"></textarea>
                            </div>
                            
                            <div class="mb-0">
                                <label class="form-label">Alt Text</label>
                                <input type="text" class="form-control" name="alt_texts[]" 
                                       value="${getFileNameWithoutExtension(file.name)}"
                                       placeholder="Alternative text for accessibility">
                            </div>
                        </div>
                        
                        <div class="mt-2">
                            <small class="text-muted">
                                Size: ${(file.size / 1024 / 1024).toFixed(2)} MB | 
                                Type: ${file.type}
                            </small>
                        </div>
                    </div>
                </div>
            `;
            
            previewsContainer.insertAdjacentHTML('beforeend', previewHtml);
        };
        
        reader.readAsDataURL(file);
    }

    // Make removeImage function global
    window.removeImage = function(index) {
        // Remove from selectedFiles array
        selectedFiles.splice(index, 1);
        
        // Remove from DOM
        const previewElement = document.querySelector(`[data-index="${index}"]`);
        if (previewElement) {
            previewElement.remove();
        }

        // Update file input
        const dt = new DataTransfer();
        selectedFiles.forEach(file => dt.items.add(file));
        imageInput.files = dt.files;

        // Hide preview container if no files
        if (selectedFiles.length === 0) {
            previewContainer.style.display = 'none';
            submitBtn.disabled = true;
        } else {
            // Regenerate previews to fix indices
            generatePreviews();
        }
    };

    function getFileNameWithoutExtension(filename) {
        return filename.substring(0, filename.lastIndexOf('.')) || filename;
    }

    // Form validation before submit
    document.getElementById('gallery-form').addEventListener('submit', function(e) {
        const titles = document.querySelectorAll('input[name="titles[]"]');
        let hasEmptyTitle = false;
        
        titles.forEach(input => {
            if (input.value.trim() === '') {
                hasEmptyTitle = true;
                input.classList.add('is-invalid');
            } else {
                input.classList.remove('is-invalid');
            }
        });
        
        if (hasEmptyTitle) {
            e.preventDefault();
            alert('Please fill in all required title fields.');
            return false;
        }
        
        if (selectedFiles.length === 0) {
            e.preventDefault();
            alert('Please select at least one image to upload.');
            return false;
        }

        // Disable submit button to prevent double submission
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="ri-loader-line spinner-border spinner-border-sm"></i> Uploading...';
    });
});
</script>
@endsection
