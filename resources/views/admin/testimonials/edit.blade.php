@extends('layouts.admin')

@section('title', 'Edit Testimonial')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Header -->
    <div class="mb-6">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
            <div class="mb-4 sm:mb-0">
                <h1 class="text-2xl font-bold text-gray-900">Edit Testimonial</h1>
                <p class="text-gray-600 mt-1">Update testimonial information</p>
            </div>
            <a href="{{ route('admin.testimonials.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white font-medium rounded-lg transition duration-200">
                <i class="fas fa-arrow-left mr-2"></i>
                Back to List
            </a>
        </div>
    </div>

    <!-- Form Card -->
    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
        <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">Edit Testimonial Information</h3>
        </div>
        <div class="p-6">
            <form action="{{ route('admin.testimonials.update', $testimonial) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Left Column -->
                    <div class="space-y-6">
                        <!-- Name -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Client Name <span class="text-red-500">*</span></label>
                            <input type="text" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('name') border-red-500 focus:ring-red-500 focus:border-red-500 @enderror" 
                                   id="name" 
                                   name="name" 
                                   value="{{ old('name', $testimonial->name) }}" 
                                   required>
                            @error('name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Profession -->
                        <div>
                            <label for="profession" class="block text-sm font-medium text-gray-700 mb-2">Profession/Title <span class="text-red-500">*</span></label>
                            <input type="text" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('profession') border-red-500 focus:ring-red-500 focus:border-red-500 @enderror" 
                                   id="profession" 
                                   name="profession" 
                                   value="{{ old('profession', $testimonial->profession) }}" 
                                   placeholder="e.g., CEO of Company Name"
                                   required>
                            @error('profession')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Rating -->
                        <div>
                            <label for="rating" class="block text-sm font-medium text-gray-700 mb-2">Rating <span class="text-red-500">*</span></label>
                            <select class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('rating') border-red-500 focus:ring-red-500 focus:border-red-500 @enderror" 
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
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Sort Order -->
                        <div>
                            <label for="sort_order" class="block text-sm font-medium text-gray-700 mb-2">Sort Order</label>
                            <input type="number" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('sort_order') border-red-500 focus:ring-red-500 focus:border-red-500 @enderror" 
                                   id="sort_order" 
                                   name="sort_order" 
                                   value="{{ old('sort_order', $testimonial->sort_order) }}"
                                   min="0">
                            <p class="mt-1 text-sm text-gray-500">Lower numbers appear first</p>
                            @error('sort_order')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div class="space-y-6">
                        <!-- Current Image -->
                        @if($testimonial->img)
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Current Image</label>
                                <div>
                                    <img src="{{ $testimonial->image_url }}" 
                                         alt="{{ $testimonial->name }}" 
                                         class="max-w-xs h-auto rounded-lg border-2 border-gray-200">
                                </div>
                            </div>
                        @endif

                        <!-- New Image -->
                        <div>
                            <label for="img" class="block text-sm font-medium text-gray-700 mb-2">
                                {{ $testimonial->img ? 'Change Image' : 'Profile Image' }}
                            </label>
                            <input type="file" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('img') border-red-500 focus:ring-red-500 focus:border-red-500 @enderror" 
                                   id="img" 
                                   name="img"
                                   accept="image/*"
                                   onchange="previewImage(event)">
                            <p class="mt-1 text-sm text-gray-500">Accepted formats: JPEG, PNG, JPG, GIF. Max size: 2MB</p>
                            @error('img')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            
                            <!-- Image Preview -->
                            <div class="mt-3">
                                <img id="imagePreview" src="#" alt="Preview" class="max-w-xs h-auto rounded-lg border-2 border-gray-200 hidden">
                            </div>
                        </div>

                        <!-- Status -->
                        <div>
                            <div class="flex items-center">
                                <input type="checkbox" 
                                       class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2" 
                                       id="status" 
                                       name="status" 
                                       value="1"
                                       {{ old('status', $testimonial->status) ? 'checked' : '' }}>
                                <label class="ml-2 text-sm font-medium text-gray-700" for="status">
                                    Active Status
                                </label>
                            </div>
                            <p class="mt-1 text-sm text-gray-500">Inactive testimonials won't be displayed on the website</p>
                        </div>
                    </div>
                </div>

                <!-- Description -->
                <div class="mt-6">
                    <label for="desc" class="block text-sm font-medium text-gray-700 mb-2">Testimonial Description <span class="text-red-500">*</span></label>
                    <textarea class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('desc') border-red-500 focus:ring-red-500 focus:border-red-500 @enderror" 
                              id="desc" 
                              name="desc" 
                              rows="5" 
                              placeholder="Enter the client's testimonial here..."
                              required>{{ old('desc', $testimonial->desc) }}</textarea>
                    @error('desc')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit Buttons -->
                <div class="flex flex-col sm:flex-row sm:items-center gap-3 mt-8">
                    <button type="submit" class="inline-flex items-center px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition duration-200">
                        <i class="fas fa-save mr-2"></i>
                        Update Testimonial
                    </button>
                    <a href="{{ route('admin.testimonials.index') }}" class="inline-flex items-center px-6 py-2 bg-gray-600 hover:bg-gray-700 text-white font-medium rounded-lg transition duration-200">
                        <i class="fas fa-times mr-2"></i>
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
        output.classList.remove('hidden');
        output.classList.add('block');
    }
    reader.readAsDataURL(event.target.files[0]);
}
</script>
@endpush
