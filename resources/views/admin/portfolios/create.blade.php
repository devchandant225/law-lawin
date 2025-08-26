@extends('layouts.admin')

@section('title', 'Create Portfolio')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
    <div>
        <!-- Header -->
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Create New Portfolio</h1>
                <p class="text-gray-600 mt-1">Add a new portfolio item to showcase your work.</p>
            </div>
            <a href="{{ route('admin.portfolios.index') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50">
                <i class="fas fa-arrow-left"></i>
                <span>Back to Portfolios</span>
            </a>
        </div>

        <!-- Form -->
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm">
            <div class="p-6">
                <form action="{{ route('admin.portfolios.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    <!-- Title -->
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Title *</label>
                        <input type="text" id="title" name="title" value="{{ old('title') }}" 
                            class="block w-full rounded-lg border-gray-300 focus:border-primary focus:ring-primary @error('title') border-red-300 @enderror" 
                            placeholder="Enter portfolio title" required>
                        @error('title')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Image -->
                    <div>
                        <label for="image" class="block text-sm font-medium text-gray-700 mb-2">Image</label>
                        <div class="flex items-center space-x-4">
                            <div class="flex-1">
                                <input type="file" id="image" name="image" accept="image/*" 
                                    class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-primary file:text-white hover:file:bg-purple-700 @error('image') border-red-300 @enderror">
                                <p class="mt-1 text-xs text-gray-500">Accepted formats: JPEG, PNG, WebP, GIF. Max size: 2MB</p>
                            </div>
                        </div>
                        @error('image')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror

                        <!-- Image Preview -->
                        <div id="imagePreview" class="mt-4 hidden">
                            <p class="text-sm font-medium text-gray-700 mb-2">Preview:</p>
                            <img id="previewImg" src="" alt="Preview" class="w-32 h-32 rounded-lg object-cover border border-gray-200">
                        </div>
                    </div>

                    <!-- Order -->
                    <div>
                        <label for="order" class="block text-sm font-medium text-gray-700 mb-2">Display Order *</label>
                        <input type="number" id="order" name="order" value="{{ old('order', 0) }}" min="0" 
                            class="block w-full rounded-lg border-gray-300 focus:border-primary focus:ring-primary @error('order') border-red-300 @enderror" 
                            placeholder="Enter display order" required>
                        <p class="mt-1 text-xs text-gray-500">Lower numbers will be displayed first</p>
                        @error('order')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status *</label>
                        <select id="status" name="status" 
                            class="block w-full rounded-lg border-gray-300 focus:border-primary focus:ring-primary @error('status') border-red-300 @enderror" required>
                            <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                        @error('status')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Form Actions -->
                    <div class="flex items-center justify-end gap-4 pt-4 border-t border-gray-200">
                        <a href="{{ route('admin.portfolios.index') }}" class="px-4 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50">
                            Cancel
                        </a>
                        <button type="submit" class="px-6 py-2 rounded-lg bg-primary text-white hover:bg-purple-700 focus:ring-2 focus:ring-primary">
                            Create Portfolio
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('image').addEventListener('change', function(e) {
    const file = e.target.files[0];
    const preview = document.getElementById('imagePreview');
    const previewImg = document.getElementById('previewImg');

    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            previewImg.src = e.target.result;
            preview.classList.remove('hidden');
        }
        reader.readAsDataURL(file);
    } else {
        preview.classList.add('hidden');
    }
});
</script>
@endsection
