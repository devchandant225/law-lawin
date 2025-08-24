@extends('layouts.admin')

@section('title', 'Create Slider')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-3xl font-bold text-gray-900 mt-6 mb-4">Create Slider</h1>
    <nav class="text-sm text-gray-600 mb-6" aria-label="Breadcrumb">
        <ol class="flex items-center space-x-2">
            <li><a href="{{ route('admin.dashboard') }}" class="hover:text-primary">Dashboard</a></li>
            <li class="flex items-center">
                <svg class="h-4 w-4 mx-2 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                </svg>
                <a href="{{ route('admin.sliders.index') }}" class="hover:text-primary">Sliders</a>
            </li>
            <li class="flex items-center">
                <svg class="h-4 w-4 mx-2 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                </svg>
                <span class="text-gray-500">Create</span>
            </li>
        </ol>
    </nav>

    <div class="max-w-4xl mx-auto">
        <form action="{{ route('admin.sliders.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <div class="px-6 py-4 bg-gray-50 border-b border-gray-200 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <h2 class="text-lg font-semibold text-gray-900">Add New Slider</h2>
                </div>
                
                <div class="p-6 space-y-6">
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                            Title <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="title" id="title" 
                               value="{{ old('title') }}" 
                               required
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent 
                                      @error('title') border-red-500 @enderror">
                        @error('title')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                            Description
                        </label>
                        <textarea name="description" id="description" rows="4" 
                                  class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent
                                         @error('description') border-red-500 @enderror"
                                  placeholder="Enter slider description...">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label for="image" class="block text-sm font-medium text-gray-700 mb-2">
                                Image <span class="text-red-500">*</span>
                            </label>
                            <input type="file" name="image" id="image" 
                                   accept="image/*" 
                                   required
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent
                                          file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold
                                          file:bg-primary file:text-white hover:file:bg-primary-600
                                          @error('image') border-red-500 @enderror">
                            <p class="mt-2 text-xs text-gray-500">
                                Supported formats: JPEG, PNG, JPG, GIF, SVG. Maximum size: 2MB.
                            </p>
                            @error('image')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror

                            <!-- Image Preview -->
                            <div id="imagePreview" class="mt-4 hidden">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Preview:</label>
                                <img id="previewImg" src="" alt="Image Preview" 
                                     class="max-w-full h-48 object-cover rounded-lg shadow-md">
                            </div>
                        </div>
                        
                        <div class="space-y-4">
                            <div>
                                <label for="orderlist" class="block text-sm font-medium text-gray-700 mb-2">
                                    Order <span class="text-red-500">*</span>
                                </label>
                                <input type="number" name="orderlist" id="orderlist" 
                                       value="{{ old('orderlist', 0) }}" 
                                       min="0" 
                                       required
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent
                                              @error('orderlist') border-red-500 @enderror">
                                <p class="mt-2 text-xs text-gray-500">
                                    Lower numbers will appear first.
                                </p>
                                @error('orderlist')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Status
                                </label>
                                <div class="flex items-center">
                                    <input type="checkbox" name="status" id="status" 
                                           value="1" 
                                           {{ old('status', true) ? 'checked' : '' }}
                                           class="h-4 w-4 text-primary border-gray-300 rounded focus:ring-primary">
                                    <label for="status" class="ml-2 block text-sm text-gray-900">
                                        Active
                                    </label>
                                </div>
                                <p class="mt-2 text-xs text-gray-500">
                                    Only active sliders will be displayed on the website.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="bg-gray-50 px-6 py-4 border-t border-gray-200 flex justify-end space-x-4">
                    <a href="{{ route('admin.sliders.index') }}" 
                       class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-lg text-gray-700 hover:bg-gray-100 transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                        Cancel
                    </a>
                    <button type="submit" 
                            class="inline-flex items-center px-6 py-2 bg-primary text-white text-sm font-medium rounded-lg hover:bg-primary-600 transition-colors focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/>
                        </svg>
                        Save Slider
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    // Image preview functionality
    $('#image').on('change', function(e) {
        const file = e.target.files[0];
        const preview = $('#imagePreview');
        const previewImg = $('#previewImg');
        
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImg.attr('src', e.target.result);
                preview.removeClass('hidden');
            };
            reader.readAsDataURL(file);
        } else {
            preview.addClass('hidden');
        }
    });
    
    // Form validation
    $('form').on('submit', function(e) {
        let isValid = true;
        
        // Title validation
        const title = $('#title').val().trim();
        if (!title) {
            $('#title').addClass('border-red-500');
            isValid = false;
        } else {
            $('#title').removeClass('border-red-500');
        }
        
        // Image validation
        const image = $('#image')[0].files.length;
        if (!image) {
            $('#image').addClass('border-red-500');
            isValid = false;
        } else {
            $('#image').removeClass('border-red-500');
        }
        
        // Order validation
        const orderlist = $('#orderlist').val();
        if (!orderlist || orderlist < 0) {
            $('#orderlist').addClass('border-red-500');
            isValid = false;
        } else {
            $('#orderlist').removeClass('border-red-500');
        }
        
        if (!isValid) {
            e.preventDefault();
            return false;
        }
    });
});
</script>
@endsection
