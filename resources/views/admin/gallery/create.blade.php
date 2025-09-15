@extends('layouts.admin')

@section('title', 'Upload Gallery Images')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Header -->
    <div class="mb-6">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
            <h1 class="text-2xl font-semibold text-gray-900">Upload Gallery Images</h1>
            <nav class="flex mt-3 sm:mt-0" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li>
                        <a href="{{ route('admin.dashboard') }}" class="text-blue-600 hover:text-blue-800 font-medium">Dashboard</a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                            <a href="{{ route('admin.gallery.index') }}" class="text-blue-600 hover:text-blue-800 font-medium">Gallery</a>
                        </div>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                            <span class="text-gray-500">Upload</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Alert Messages -->
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
            <h2 class="text-lg font-medium text-gray-900 mb-2">Upload Multiple Images</h2>
            <p class="text-sm text-gray-500">Select multiple images to upload to your gallery. Maximum file size: 10MB per image.</p>
        </div>

        <div class="p-6">
            <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data" id="gallery-form">
                @csrf
                
                <!-- File Upload Section -->
                <div class="mb-8">
                    <label class="block text-sm font-medium text-gray-700 mb-3">Select Images <span class="text-red-500">*</span></label>
                    <div class="dropzone" id="image-dropzone">
                        <div class="dz-message" data-dz-message>
                            <div class="mb-4">
                                <i class="fas fa-cloud-upload-alt text-4xl text-gray-400"></i>
                            </div>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Drop images here or click to upload</h3>
                            <p class="text-sm text-gray-500">Supports: JPG, PNG, GIF, WebP (max 10MB each)</p>
                        </div>
                    </div>
                    
                    <!-- Traditional File Input (fallback) -->
                    <div class="mt-4">
                        <input type="file" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" 
                               name="images[]" id="images" multiple 
                               accept="image/jpeg,image/png,image/jpg,image/gif,image/webp" 
                               onchange="enableSubmitButton()">
                        <p class="text-xs text-gray-500 mt-2">Hold Ctrl/Cmd to select multiple files</p>
                    </div>
                </div>

                <!-- Preview and Details Section -->
                <div id="image-preview-container" class="hidden">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Image Details</h3>
                    <div id="image-previews" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6"></div>
                </div>

                <!-- Form Actions -->
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between pt-6 border-t border-gray-200">
                    <a href="{{ route('admin.gallery.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white text-sm font-medium rounded-lg transition-colors duration-200 mb-3 sm:mb-0">
                        <i class="fas fa-arrow-left mr-2"></i> Back to Gallery
                    </a>
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors duration-200 disabled:opacity-50 disabled:cursor-not-allowed" id="submit-btn" disabled>
                        <i class="fas fa-upload mr-2"></i> Upload Images
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection


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


<script>
document.addEventListener('DOMContentLoaded', function() {
    const imageInput = document.getElementById('images');
    const previewContainer = document.getElementById('image-preview-container');
    const previewsContainer = document.getElementById('image-previews');
    const submitBtn = document.getElementById('submit-btn');
    const dropzone = document.getElementById('image-dropzone');
    
    let selectedFiles = [];
    let imageCounter = 0;
    
    // Debug logging
    console.log('Gallery upload script initialized');
    console.log('Submit button:', submitBtn);
    console.log('Image input:', imageInput);

    // Handle file input change
    imageInput.addEventListener('change', function(e) {
        console.log('Files selected:', e.target.files.length);
        
        // Enable button immediately if files are selected
        if (e.target.files.length > 0) {
            submitBtn.disabled = false;
            submitBtn.classList.remove('opacity-50', 'cursor-not-allowed');
            console.log('Submit button enabled - files selected');
        } else {
            submitBtn.disabled = true;
            submitBtn.classList.add('opacity-50', 'cursor-not-allowed');
            console.log('Submit button disabled - no files');
        }
        
        // Handle file processing for preview
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
        console.log('handleFiles called with', files.length, 'files');
        
        if (files.length === 0) {
            previewContainer.classList.add('hidden');
            submitBtn.disabled = true;
            console.log('No files - button disabled');
            return;
        }

        selectedFiles = Array.from(files);
        previewContainer.classList.remove('hidden');
        submitBtn.disabled = false;
        console.log('Files loaded - button enabled');
        
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
                <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-sm" data-index="${index}">
                    <div class="relative mb-4">
                        <img src="${e.target.result}" alt="Preview" class="w-full h-40 object-cover rounded-lg border border-gray-200">
                        <button type="button" class="absolute top-2 right-2 w-6 h-6 bg-red-500 hover:bg-red-600 text-white rounded-full flex items-center justify-center text-xs transition-colors duration-200" onclick="removeImage(${index})">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    
                    <div class="space-y-3">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Title <span class="text-red-500">*</span></label>
                            <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" 
                                   name="titles[]" value="${getFileNameWithoutExtension(file.name)}" required>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                            <textarea class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" 
                                      name="descriptions[]" rows="2" placeholder="Optional description"></textarea>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Alt Text</label>
                            <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" 
                                   name="alt_texts[]" value="${getFileNameWithoutExtension(file.name)}"
                                   placeholder="Alternative text for accessibility">
                        </div>
                    </div>
                    
                    <div class="mt-3 pt-3 border-t border-gray-200">
                        <p class="text-xs text-gray-500">
                            Size: ${(file.size / 1024 / 1024).toFixed(2)} MB | Type: ${file.type}
                        </p>
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
            previewContainer.classList.add('hidden');
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
        // Check if files are selected using the file input
        if (!imageInput.files || imageInput.files.length === 0) {
            e.preventDefault();
            alert('Please select at least one image to upload.');
            return false;
        }
        
        // Only check titles if preview is shown (advanced mode)
        const titles = document.querySelectorAll('input[name="titles[]"]');
        if (titles.length > 0) {
            let hasEmptyTitle = false;
            
            titles.forEach(input => {
                if (input.value.trim() === '') {
                    hasEmptyTitle = true;
                    input.classList.add('border-red-500');
                    input.classList.remove('border-gray-300');
                } else {
                    input.classList.remove('border-red-500');
                    input.classList.add('border-gray-300');
                }
            });
            
            if (hasEmptyTitle) {
                e.preventDefault();
                alert('Please fill in all required title fields.');
                return false;
            }
        }

        // Disable submit button to prevent double submission
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Uploading...';
    });
});

// Global fallback function for enabling submit button
function enableSubmitButton() {
    const imageInput = document.getElementById('images');
    const submitBtn = document.getElementById('submit-btn');
    
    console.log('enableSubmitButton called');
    
    if (imageInput && submitBtn) {
        if (imageInput.files && imageInput.files.length > 0) {
            submitBtn.disabled = false;
            submitBtn.classList.remove('opacity-50', 'cursor-not-allowed');
            console.log('Submit button enabled by global function');
        } else {
            submitBtn.disabled = true;
            submitBtn.classList.add('opacity-50', 'cursor-not-allowed');
            console.log('Submit button disabled by global function');
        }
    }
}
</script>

