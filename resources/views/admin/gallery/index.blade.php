@extends('layouts.admin')

@section('title', 'Gallery Management')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Gallery Management</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Gallery</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Alert Messages -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

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
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Gallery Images</h5>
                    <div class="d-flex gap-2">
                        <button type="button" class="btn btn-danger btn-sm" id="bulkDeleteBtn" style="display: none;">
                            <i class="ri-delete-bin-line"></i> Delete Selected
                        </button>
                        <a href="{{ route('admin.gallery.create') }}" class="btn btn-primary btn-sm">
                            <i class="ri-add-line"></i> Upload Images
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    @if($galleries->count() > 0)
                        <!-- Bulk Actions Form -->
                        <form id="bulkDeleteForm" action="{{ route('admin.gallery.bulk-delete') }}" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                            <div id="selectedImagesContainer"></div>
                        </form>

                        <!-- Gallery Grid -->
                        <div class="row gallery-grid" id="gallery-grid">
                            @foreach($galleries as $gallery)
                                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 mb-4">
                                    <div class="gallery-item card h-100">
                                        <div class="position-relative">
                                            <div class="form-check position-absolute top-0 start-0 m-2" style="z-index: 10;">
                                                <input class="form-check-input gallery-checkbox" type="checkbox" 
                                                       value="{{ $gallery->id }}" id="gallery{{ $gallery->id }}">
                                            </div>
                                            
                                            <div class="gallery-image-container">
                                                <img src="{{ $gallery->image_url }}" 
                                                     alt="{{ $gallery->alt_text }}" 
                                                     class="card-img-top gallery-image"
                                                     style="height: 200px; object-fit: cover; cursor: pointer;"
                                                     onclick="openImageModal('{{ $gallery->image_url }}', '{{ $gallery->title }}')">
                                                
                                                <!-- Image Overlay -->
                                                <div class="gallery-overlay">
                                                    <div class="gallery-actions">
                                                        <button type="button" class="btn btn-light btn-sm" 
                                                                onclick="openImageModal('{{ $gallery->image_url }}', '{{ $gallery->title }}')">
                                                            <i class="ri-eye-line"></i>
                                                        </button>
                                                        <a href="{{ route('admin.gallery.edit', $gallery) }}" 
                                                           class="btn btn-primary btn-sm">
                                                            <i class="ri-edit-line"></i>
                                                        </a>
                                                        <form action="{{ route('admin.gallery.destroy', $gallery) }}" 
                                                              method="POST" class="d-inline-block" 
                                                              onsubmit="return confirm('Are you sure you want to delete this image?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm">
                                                                <i class="ri-delete-bin-line"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card-body p-3">
                                            <h6 class="card-title mb-2">{{ Str::limit($gallery->title, 30) }}</h6>
                                            @if($gallery->description)
                                                <p class="card-text small text-muted mb-2">
                                                    {{ Str::limit($gallery->description, 50) }}
                                                </p>
                                            @endif
                                            
                                            <div class="d-flex justify-content-between align-items-center">
                                                <small class="text-muted">Order: {{ $gallery->sort_order }}</small>
                                                <div>
                                                    <form action="{{ route('admin.gallery.toggle-status', $gallery) }}" 
                                                          method="POST" class="d-inline-block">
                                                        @csrf
                                                        <button type="submit" class="btn btn-sm {{ $gallery->is_active ? 'btn-success' : 'btn-secondary' }}">
                                                            {{ $gallery->is_active ? 'Active' : 'Inactive' }}
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                            
                                            <div class="mt-2">
                                                <small class="text-muted">
                                                    Uploaded: {{ $gallery->created_at->format('M j, Y') }}
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Pagination -->
                        <div class="row">
                            <div class="col-12">
                                {{ $galleries->links() }}
                            </div>
                        </div>

                    @else
                        <div class="text-center py-5">
                            <div class="mb-4">
                                <i class="ri-image-line" style="font-size: 4rem; color: #ccc;"></i>
                            </div>
                            <h5 class="text-muted">No images uploaded yet</h5>
                            <p class="text-muted">Start building your gallery by uploading some images.</p>
                            <a href="{{ route('admin.gallery.create') }}" class="btn btn-primary">
                                <i class="ri-add-line"></i> Upload Images
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Image Modal -->
<div class="modal fade" id="imageModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imageModalTitle"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center">
                <img id="modalImage" src="" alt="" class="img-fluid">
            </div>
        </div>
    </div>
</div>

@endsection

@section('styles')
<style>
.gallery-item {
    transition: transform 0.2s, box-shadow 0.2s;
    border-radius: 12px;
    overflow: hidden;
}

.gallery-item:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.1);
}

.gallery-image-container {
    position: relative;
    overflow: hidden;
}

.gallery-image {
    transition: transform 0.3s ease;
}

.gallery-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.7);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.gallery-item:hover .gallery-overlay {
    opacity: 1;
}

.gallery-item:hover .gallery-image {
    transform: scale(1.05);
}

.gallery-actions {
    display: flex;
    gap: 8px;
}

.gallery-checkbox {
    background: white;
    border: 2px solid #ddd;
}

.gallery-grid .col-xl-2:nth-child(6n+1),
.gallery-grid .col-lg-3:nth-child(4n+1),
.gallery-grid .col-md-4:nth-child(3n+1),
.gallery-grid .col-sm-6:nth-child(2n+1) {
    clear: left;
}

@media (max-width: 768px) {
    .gallery-overlay {
        opacity: 1;
        background: rgba(0, 0, 0, 0.3);
    }
}
</style>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const checkboxes = document.querySelectorAll('.gallery-checkbox');
    const bulkDeleteBtn = document.getElementById('bulkDeleteBtn');
    const bulkDeleteForm = document.getElementById('bulkDeleteForm');
    const selectedContainer = document.getElementById('selectedImagesContainer');

    // Handle checkbox changes
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            updateBulkActions();
        });
    });

    function updateBulkActions() {
        const selectedCheckboxes = document.querySelectorAll('.gallery-checkbox:checked');
        
        if (selectedCheckboxes.length > 0) {
            bulkDeleteBtn.style.display = 'inline-block';
        } else {
            bulkDeleteBtn.style.display = 'none';
        }
    }

    // Handle bulk delete
    bulkDeleteBtn.addEventListener('click', function() {
        const selectedCheckboxes = document.querySelectorAll('.gallery-checkbox:checked');
        
        if (selectedCheckboxes.length === 0) {
            alert('Please select at least one image to delete.');
            return;
        }

        if (confirm(`Are you sure you want to delete ${selectedCheckboxes.length} selected images?`)) {
            // Clear previous inputs
            selectedContainer.innerHTML = '';
            
            // Add selected image IDs to form
            selectedCheckboxes.forEach(checkbox => {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'selected_images[]';
                input.value = checkbox.value;
                selectedContainer.appendChild(input);
            });

            // Submit form
            bulkDeleteForm.submit();
        }
    });
});

function openImageModal(imageUrl, title) {
    const modal = new bootstrap.Modal(document.getElementById('imageModal'));
    document.getElementById('modalImage').src = imageUrl;
    document.getElementById('imageModalTitle').textContent = title;
    modal.show();
}
</script>
@endsection
