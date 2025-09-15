@extends('layouts.admin')

@section('title', 'Gallery Management')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Header -->
    <div class="mb-6">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
            <h1 class="text-2xl font-semibold text-gray-900">Gallery Management</h1>
            <nav class="flex mt-3 sm:mt-0" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li>
                        <a href="{{ route('admin.dashboard') }}" class="text-blue-600 hover:text-blue-800 font-medium">Dashboard</a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                            <span class="text-gray-500">Gallery</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Alert Messages -->
    @if(session('success'))
        <div class="mb-6 bg-green-50 border border-green-200 rounded-lg p-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <i class="fas fa-check-circle text-green-500 mr-3"></i>
                    <span class="text-green-800">{{ session('success') }}</span>
                </div>
                <button type="button" class="text-green-400 hover:text-green-600" onclick="this.parentElement.parentElement.remove()">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="mb-6 bg-red-50 border border-red-200 rounded-lg p-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <i class="fas fa-exclamation-circle text-red-500 mr-3"></i>
                    <span class="text-red-800">{{ session('error') }}</span>
                </div>
                <button type="button" class="text-red-400 hover:text-red-600" onclick="this.parentElement.parentElement.remove()">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
    @endif

    @if($errors->any())
        <div class="mb-6 bg-red-50 border border-red-200 rounded-lg p-4">
            <div class="flex items-start justify-between">
                <div class="flex items-start">
                    <i class="fas fa-exclamation-circle text-red-500 mr-3 mt-0.5"></i>
                    <div>
                        <ul class="text-red-800 list-disc list-inside">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <button type="button" class="text-red-400 hover:text-red-600" onclick="this.parentElement.parentElement.remove()">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
    @endif

    <!-- Main Content -->
    <div class="bg-white shadow-sm rounded-lg overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                <h2 class="text-lg font-medium text-gray-900 mb-3 sm:mb-0">Gallery Images</h2>
                <div class="flex items-center space-x-3">
                    <button type="button" class="hidden px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-lg transition-colors duration-200" id="bulkDeleteBtn">
                        <i class="fas fa-trash mr-2"></i> Delete Selected
                    </button>
                    <a href="{{ route('admin.gallery.create') }}" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors duration-200 inline-flex items-center">
                        <i class="fas fa-plus mr-2"></i> Upload Images
                    </a>
                </div>
            </div>
        </div>

        <div class="p-6">
@if($galleries->count() > 0)
                <!-- Bulk Actions Form -->
                <form id="bulkDeleteForm" action="{{ route('admin.gallery.bulk-delete') }}" method="POST" class="hidden">
                    @csrf
                    @method('DELETE')
                    <div id="selectedImagesContainer"></div>
                </form>

                <!-- Gallery Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-6 gap-6" id="gallery-grid">
                    @foreach($galleries as $gallery)
                        <div class="gallery-item bg-white rounded-xl shadow-sm hover:shadow-lg transition-all duration-300 overflow-hidden group">
                            <div class="relative">
                                <!-- Checkbox -->
                                <div class="absolute top-2 left-2 z-10">
                                    <input class="gallery-checkbox w-4 h-4 text-blue-600 bg-white border-gray-300 rounded focus:ring-blue-500" 
                                           type="checkbox" value="{{ $gallery->id }}" id="gallery{{ $gallery->id }}">
                                </div>
                                
                                <div class="gallery-image-container relative overflow-hidden">
                                    <img src="{{ $gallery->image_url }}" 
                                         alt="{{ $gallery->alt_text }}" 
                                         class="w-full h-48 object-cover cursor-pointer transition-transform duration-300 group-hover:scale-110"
                                         onclick="openImageModal('{{ $gallery->image_url }}', '{{ $gallery->title }}')">
                                    
                                    <!-- Image Overlay -->
                                    <div class="gallery-overlay absolute inset-0 bg-black bg-opacity-70 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                        <div class="flex items-center space-x-2">
                                            <button type="button" class="p-2 bg-white bg-opacity-20 hover:bg-opacity-30 rounded-lg text-white transition-colors duration-200" 
                                                    onclick="openImageModal('{{ $gallery->image_url }}', '{{ $gallery->title }}')">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <a href="{{ route('admin.gallery.edit', $gallery) }}" 
                                               class="p-2 bg-blue-600 hover:bg-blue-700 rounded-lg text-white transition-colors duration-200">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.gallery.destroy', $gallery) }}" 
                                                  method="POST" class="inline" 
                                                  onsubmit="return confirm('Are you sure you want to delete this image?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="p-2 bg-red-600 hover:bg-red-700 rounded-lg text-white transition-colors duration-200">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="p-4">
                                <h3 class="font-medium text-gray-900 mb-2 text-sm">{{ Str::limit($gallery->title, 30) }}</h3>
                                @if($gallery->description)
                                    <p class="text-xs text-gray-500 mb-3 line-clamp-2">
                                        {{ Str::limit($gallery->description, 50) }}
                                    </p>
                                @endif
                                
                                <div class="flex items-center justify-between mb-3">
                                    <span class="text-xs text-gray-400">Order: {{ $gallery->sort_order }}</span>
                                    <form action="{{ route('admin.gallery.toggle-status', $gallery) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="px-2 py-1 text-xs font-medium rounded-full transition-colors duration-200 {{ $gallery->is_active ? 'bg-green-100 text-green-800 hover:bg-green-200' : 'bg-gray-100 text-gray-800 hover:bg-gray-200' }}">
                                            {{ $gallery->is_active ? 'Active' : 'Inactive' }}
                                        </button>
                                    </form>
                                </div>
                                
                                <div class="text-xs text-gray-400">
                                    Uploaded: {{ $gallery->created_at->format('M j, Y') }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-8">
                    {{ $galleries->links() }}
                </div>

            @else
                <div class="text-center py-12">
                    <div class="mb-6">
                        <i class="fas fa-images text-6xl text-gray-300"></i>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">No images uploaded yet</h3>
                    <p class="text-gray-500 mb-6">Start building your gallery by uploading some images.</p>
                    <a href="{{ route('admin.gallery.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors duration-200">
                        <i class="fas fa-plus mr-2"></i> Upload Images
                    </a>
                </div>
            @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Image Modal -->
<div id="imageModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden items-center justify-center p-4">
    <div class="bg-white rounded-lg max-w-4xl max-h-screen overflow-hidden">
        <div class="flex items-center justify-between p-4 border-b border-gray-200">
            <h3 class="text-lg font-medium text-gray-900" id="imageModalTitle"></h3>
            <button type="button" class="text-gray-400 hover:text-gray-600 transition-colors duration-200" onclick="closeImageModal()">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>
        <div class="p-4 text-center">
            <img id="modalImage" src="" alt="" class="max-w-full max-h-96 object-contain">
        </div>
    </div>
</div>

@endsection

@section('styles')
<style>
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

@media (max-width: 768px) {
    .gallery-overlay {
        opacity: 1 !important;
        background: rgba(0, 0, 0, 0.3) !important;
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
    const modal = document.getElementById('imageModal');
    const modalImage = document.getElementById('modalImage');
    const modalTitle = document.getElementById('imageModalTitle');
    
    modalImage.src = imageUrl;
    modalTitle.textContent = title;
    
    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

function closeImageModal() {
    const modal = document.getElementById('imageModal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
}

// Close modal when clicking outside
document.getElementById('imageModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeImageModal();
    }
});

// Close modal with Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeImageModal();
    }
});
</script>
@endsection
