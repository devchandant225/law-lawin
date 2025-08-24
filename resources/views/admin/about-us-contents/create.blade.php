@extends('layouts.admin')

@section('title', 'Create New About Us Content Section')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div>
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-gray-900">Create New About Us Content Section</h1>
            <a href="{{ route('admin.about-us-contents.index') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50">
                <i class="fas fa-arrow-left"></i>
                <span>Back to Content Sections</span>
            </a>
        </div>

        <form action="{{ route('admin.about-us-contents.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Main Content -->
                <div class="lg:col-span-2">
                    <!-- Content Information -->
                    <div class="mb-6 bg-white border border-gray-200 rounded-xl shadow-sm">
                        <div class="px-4 py-3 border-b border-gray-200">
                            <h5 class="font-semibold text-gray-900">Content Information</h5>
                        </div>
                        <div class="p-4 space-y-4">
                            <!-- Title -->
                            <div>
                                <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                                <input type="text" id="title" name="title" value="{{ old('title') }}" 
                                       placeholder="Enter content section title..."
                                       class="block w-full rounded-lg border border-gray-300 px-3 py-2 focus:border-indigo-500 focus:ring-indigo-500 @error('title') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror">
                                @error('title')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                                <p class="mt-1 text-xs text-gray-500">Optional title for the content section</p>
                            </div>

                            <!-- Description 1 -->
                            <div>
                                <label for="desc_1" class="block text-sm font-medium text-gray-700 mb-1">Description 1</label>
                                <textarea id="desc_1" name="desc_1" rows="4" 
                                          placeholder="Enter the first description..."
                                          class="block w-full rounded-lg border border-gray-300 px-3 py-2 focus:border-indigo-500 focus:ring-indigo-500 @error('desc_1') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror">{{ old('desc_1') }}</textarea>
                                @error('desc_1')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                                <p class="mt-1 text-xs text-gray-500">First description content</p>
                            </div>

                            <!-- Description 2 -->
                            <div>
                                <label for="desc_2" class="block text-sm font-medium text-gray-700 mb-1">Description 2</label>
                                <textarea id="desc_2" name="desc_2" rows="4" 
                                          placeholder="Enter the second description..."
                                          class="block w-full rounded-lg border border-gray-300 px-3 py-2 focus:border-indigo-500 focus:ring-indigo-500 @error('desc_2') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror">{{ old('desc_2') }}</textarea>
                                @error('desc_2')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                                <p class="mt-1 text-xs text-gray-500">Second description content</p>
                            </div>
                        </div>
                    </div>

                    <!-- Images -->
                    <div class="mb-6 bg-white border border-gray-200 rounded-xl shadow-sm">
                        <div class="px-4 py-3 border-b border-gray-200">
                            <h5 class="font-semibold text-gray-900">Images</h5>
                        </div>
                        <div class="p-4 space-y-4">
                            <!-- Image 1 -->
                            <div>
                                <label for="image1" class="block text-sm font-medium text-gray-700 mb-1">Image 1</label>
                                <div class="flex items-center justify-center w-full">
                                    <label for="image1" class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 hover:border-gray-400 transition-colors @error('image1') border-red-500 @enderror">
                                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                            <i class="fas fa-cloud-upload-alt text-gray-400 text-2xl mb-2"></i>
                                            <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                                            <p class="text-xs text-gray-500">PNG, JPG, GIF, WEBP (MAX. 2MB)</p>
                                        </div>
                                        <input id="image1" name="image1" type="file" class="hidden" accept="image/*" onchange="previewImage(this, 'image1-preview')" />
                                    </label>
                                </div>
                                <div id="image1-preview" class="mt-2 hidden">
                                    <img src="" alt="Preview" class="w-20 h-20 object-cover rounded-lg border border-gray-300">
                                </div>
                                @error('image1')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                                <p class="mt-1 text-xs text-gray-500">Upload the first image</p>
                            </div>

                            <!-- Image 2 -->
                            <div>
                                <label for="image2" class="block text-sm font-medium text-gray-700 mb-1">Image 2</label>
                                <div class="flex items-center justify-center w-full">
                                    <label for="image2" class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 hover:border-gray-400 transition-colors @error('image2') border-red-500 @enderror">
                                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                            <i class="fas fa-cloud-upload-alt text-gray-400 text-2xl mb-2"></i>
                                            <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                                            <p class="text-xs text-gray-500">PNG, JPG, GIF, WEBP (MAX. 2MB)</p>
                                        </div>
                                        <input id="image2" name="image2" type="file" class="hidden" accept="image/*" onchange="previewImage(this, 'image2-preview')" />
                                    </label>
                                </div>
                                <div id="image2-preview" class="mt-2 hidden">
                                    <img src="" alt="Preview" class="w-20 h-20 object-cover rounded-lg border border-gray-300">
                                </div>
                                @error('image2')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                                <p class="mt-1 text-xs text-gray-500">Upload the second image</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="lg:col-span-1">
                    <div class="lg:sticky lg:top-4 space-y-6">
                        <!-- Content Settings -->
                        <div class="mb-6 bg-white border border-gray-200 rounded-xl shadow-sm">
                            <div class="px-4 py-3 border-b border-gray-200">
                                <h5 class="font-semibold text-gray-900">Content Settings</h5>
                            </div>
                            <div class="p-4 space-y-4">
                                <!-- Page Type -->
                                <div>
                                    <label for="page_type" class="block text-sm font-medium text-gray-700 mb-1">Page Type <span class="text-red-600">*</span></label>
                                    <select id="page_type" name="page_type" required
                                            class="block w-full rounded-lg border border-gray-300 px-3 py-2 focus:border-indigo-500 focus:ring-indigo-500 @error('page_type') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror">
                                        <option value="">Select Page Type</option>
                                        @foreach($pageTypeOptions as $key => $label)
                                            <option value="{{ $key }}" {{ old('page_type') == $key ? 'selected' : '' }}>
                                                {{ $label }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('page_type')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                    <p class="mt-1 text-xs text-gray-500">Select which page this content belongs to</p>
                                </div>

                                <!-- Status -->
                                <div>
                                    <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status <span class="text-red-600">*</span></label>
                                    <select id="status" name="status" required
                                            class="block w-full rounded-lg border border-gray-300 px-3 py-2 focus:border-indigo-500 focus:ring-indigo-500 @error('status') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror">
                                        @foreach($statusOptions as $key => $label)
                                            <option value="{{ $key }}" {{ old('status', 'active') == $key ? 'selected' : '' }}>
                                                {{ $label }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('status')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                    <p class="mt-1 text-xs text-gray-500">Set content visibility status</p>
                                </div>

                                <!-- Order -->
                                <div>
                                    <label for="order_list" class="block text-sm font-medium text-gray-700 mb-1">Order</label>
                                    <input type="number" id="order_list" name="order_list" value="{{ old('order_list') }}" 
                                           placeholder="0" min="0"
                                           class="block w-full rounded-lg border border-gray-300 px-3 py-2 focus:border-indigo-500 focus:ring-indigo-500 @error('order_list') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror">
                                    @error('order_list')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                    <p class="mt-1 text-xs text-gray-500">Display order (optional, lower numbers appear first)</p>
                                </div>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="bg-white border border-gray-200 rounded-xl shadow-sm">
                            <div class="p-4">
                                <div class="grid gap-2">
                                    <button type="submit" class="inline-flex items-center justify-center gap-2 px-4 py-2 rounded-lg bg-indigo-600 text-white hover:bg-indigo-700">
                                        <i class="fas fa-save"></i>
                                        <span>Create Content Section</span>
                                    </button>
                                    <a href="{{ route('admin.about-us-contents.index') }}" class="inline-flex items-center justify-center px-4 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
function previewImage(input, previewId) {
    const preview = document.getElementById(previewId);
    const previewImg = preview.querySelector('img');
    
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            previewImg.src = e.target.result;
            preview.classList.remove('hidden');
        }
        
        reader.readAsDataURL(input.files[0]);
    } else {
        preview.classList.add('hidden');
        previewImg.src = '';
    }
}

   CKEDITOR.replace('desc_1', {
            filebrowserUploadUrl: "{{ 'https://beinseo.com/upload_blog_editor_image?_token=' . csrf_token() }}",
            filebrowserUploadMethod: 'form'
        })

           CKEDITOR.replace('desc_2', {
            filebrowserUploadUrl: "{{ 'https://beinseo.com/upload_blog_editor_image?_token=' . csrf_token() }}",
            filebrowserUploadMethod: 'form'
        })
</script>
@endsection
