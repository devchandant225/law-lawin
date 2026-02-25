@extends('layouts.admin')

@section('title', 'Edit About Us Content Section')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div>
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-gray-900">Edit About Us Content Section</h1>
            <div class="flex items-center gap-2">
                <a href="{{ route('admin.about-us-contents.show', $aboutUsContent) }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50">
                    <i class="fas fa-eye"></i>
                    <span>View</span>
                </a>
                <a href="{{ route('admin.about-us-contents.index') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50">
                    <i class="fas fa-arrow-left"></i>
                    <span>Back to Content Sections</span>
                </a>
            </div>
        </div>

        <form action="{{ route('admin.about-us-contents.update', $aboutUsContent) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
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
                                <input type="text" id="title" name="title" value="{{ old('title', $aboutUsContent->title) }}" 
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
                                          class="block w-full rounded-lg border border-gray-300 px-3 py-2 focus:border-indigo-500 focus:ring-indigo-500 @error('desc_1') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror">{{ old('desc_1', $aboutUsContent->desc_1) }}</textarea>
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
                                          class="block w-full rounded-lg border border-gray-300 px-3 py-2 focus:border-indigo-500 focus:ring-indigo-500 @error('desc_2') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror">{{ old('desc_2', $aboutUsContent->desc_2) }}</textarea>
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
                                @if($aboutUsContent->image1)
                                    <div class="mb-3">
                                        <p class="text-sm text-gray-600 mb-2">Current Image:</p>
                                        <img src="{{ asset('storage/' . $aboutUsContent->image1) }}" alt="Current Image 1" class="w-32 h-32 object-cover rounded-lg border border-gray-300">
                                    </div>
                                @endif
                                <div class="flex items-center justify-center w-full">
                                    <label for="image1" class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 hover:border-gray-400 transition-colors @error('image1') border-red-500 @enderror">
                                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                            <i class="fas fa-cloud-upload-alt text-gray-400 text-2xl mb-2"></i>
                                            <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Click to upload</span> {{ $aboutUsContent->image1 ? 'new image' : 'or drag and drop' }}</p>
                                            <p class="text-xs text-gray-500">PNG, JPG, GIF, WEBP (MAX. 2MB)</p>
                                        </div>
                                        <input id="image1" name="image1" type="file" class="hidden" accept="image/*" onchange="previewImage(this, 'image1-preview')" />
                                    </label>
                                </div>
                                <div id="image1-preview" class="mt-2 hidden">
                                    <p class="text-sm text-gray-600 mb-2">New Image Preview:</p>
                                    <img src="" alt="Preview" class="w-20 h-20 object-cover rounded-lg border border-gray-300">
                                </div>
                                @error('image1')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                                <p class="mt-1 text-xs text-gray-500">{{ $aboutUsContent->image1 ? 'Upload a new image to replace the current one' : 'Upload the first image' }}</p>

                                <div class="mt-2">
                                    <label for="image1_alt" class="block text-sm font-medium text-gray-700 mb-1">Image 1 Alt Text</label>
                                    <input type="text" id="image1_alt" name="image1_alt" value="{{ old('image1_alt', $aboutUsContent->image1_alt) }}" 
                                           placeholder="Enter alt text for image 1"
                                           class="block w-full rounded-lg border border-gray-300 px-3 py-2 focus:border-indigo-500 focus:ring-indigo-500 @error('image1_alt') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror">
                                    @error('image1_alt')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Image 2 -->
                            <div>
                                <label for="image2" class="block text-sm font-medium text-gray-700 mb-1">Image 2</label>
                                @if($aboutUsContent->image2)
                                    <div class="mb-3">
                                        <p class="text-sm text-gray-600 mb-2">Current Image:</p>
                                        <img src="{{ asset('storage/' . $aboutUsContent->image2) }}" alt="Current Image 2" class="w-32 h-32 object-cover rounded-lg border border-gray-300">
                                    </div>
                                @endif
                                <div class="flex items-center justify-center w-full">
                                    <label for="image2" class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 hover:border-gray-400 transition-colors @error('image2') border-red-500 @enderror">
                                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                            <i class="fas fa-cloud-upload-alt text-gray-400 text-2xl mb-2"></i>
                                            <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Click to upload</span> {{ $aboutUsContent->image2 ? 'new image' : 'or drag and drop' }}</p>
                                            <p class="text-xs text-gray-500">PNG, JPG, GIF, WEBP (MAX. 2MB)</p>
                                        </div>
                                        <input id="image2" name="image2" type="file" class="hidden" accept="image/*" onchange="previewImage(this, 'image2-preview')" />
                                    </label>
                                </div>
                                <div id="image2-preview" class="mt-2 hidden">
                                    <p class="text-sm text-gray-600 mb-2">New Image Preview:</p>
                                    <img src="" alt="Preview" class="w-20 h-20 object-cover rounded-lg border border-gray-300">
                                </div>
                                @error('image2')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                                <p class="mt-1 text-xs text-gray-500">{{ $aboutUsContent->image2 ? 'Upload a new image to replace the current one' : 'Upload the second image' }}</p>

                                <div class="mt-2">
                                    <label for="image2_alt" class="block text-sm font-medium text-gray-700 mb-1">Image 2 Alt Text</label>
                                    <input type="text" id="image2_alt" name="image2_alt" value="{{ old('image2_alt', $aboutUsContent->image2_alt) }}" 
                                           placeholder="Enter alt text for image 2"
                                           class="block w-full rounded-lg border border-gray-300 px-3 py-2 focus:border-indigo-500 focus:ring-indigo-500 @error('image2_alt') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror">
                                    @error('image2_alt')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
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
                                            <option value="{{ $key }}" {{ old('page_type', $aboutUsContent->page_type) == $key ? 'selected' : '' }}>
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
                                            <option value="{{ $key }}" {{ old('status', $aboutUsContent->status) == $key ? 'selected' : '' }}>
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
                                    <input type="number" id="order_list" name="order_list" value="{{ old('order_list', $aboutUsContent->order_list) }}" 
                                           placeholder="0" min="0"
                                           class="block w-full rounded-lg border border-gray-300 px-3 py-2 focus:border-indigo-500 focus:ring-indigo-500 @error('order_list') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror">
                                    @error('order_list')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                    <p class="mt-1 text-xs text-gray-500">Display order (optional, lower numbers appear first)</p>
                                </div>
                            </div>
                        </div>

                        <!-- Meta Information -->
                        <div class="bg-white border border-gray-200 rounded-xl shadow-sm">
                            <div class="px-4 py-3 border-b border-gray-200">
                                <h5 class="font-semibold text-gray-900">Meta Information</h5>
                            </div>
                            <div class="p-4 space-y-2 text-sm text-gray-600">
                                <div class="flex justify-between">
                                    <span>Created:</span>
                                    <span>{{ $aboutUsContent->created_at->format('M d, Y H:i') }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span>Updated:</span>
                                    <span>{{ $aboutUsContent->updated_at->format('M d, Y H:i') }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span>ID:</span>
                                    <span>#{{ $aboutUsContent->id }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="bg-white border border-gray-200 rounded-xl shadow-sm">
                            <div class="p-4">
                                <div class="grid gap-2">
                                    <button type="submit" class="inline-flex items-center justify-center gap-2 px-4 py-2 rounded-lg bg-indigo-600 text-white hover:bg-indigo-700">
                                        <i class="fas fa-save"></i>
                                        <span>Update Content Section</span>
                                    </button>
                                    <a href="{{ route('admin.about-us-contents.show', $aboutUsContent) }}" class="inline-flex items-center justify-center px-4 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50">View Content</a>
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

document.addEventListener('DOMContentLoaded', function() {
    if (typeof CKEDITOR !== 'undefined') {
        CKEDITOR.replace('desc_1', {
            filebrowserUploadUrl: "{{ 'https://lawinpartners.com/upload_blog_editor_image?_token=' . csrf_token() }}",
            filebrowserUploadMethod: 'form'
        });

        CKEDITOR.replace('desc_2', {
            filebrowserUploadUrl: "{{ 'https://lawinpartners.com/upload_blog_editor_image?_token=' . csrf_token() }}",
            filebrowserUploadMethod: 'form'
        });
    }
});
</script>
@endsection
