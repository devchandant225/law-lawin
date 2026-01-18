@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-white">Edit Left-Right Content for: {{ $post->title }}</h1>
        <a href="{{ route('admin.posts.left-right-contents.index', $post->id) }}" class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
            Back to List
        </a>
    </div>

    <div class="bg-gray-800 rounded-lg shadow-lg p-6 max-w-3xl mx-auto">
        <form action="{{ route('admin.posts.left-right-contents.update', [$post->id, $leftRightContent->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="title" class="block text-gray-300 mb-2">Title *</label>
                    <input type="text" name="title" id="title" value="{{ old('title', $leftRightContent->title) }}" required
                           class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @error('title')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="order" class="block text-gray-300 mb-2">Order *</label>
                    <input type="number" name="order" id="order" value="{{ old('order', $leftRightContent->order) }}" required
                           class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @error('order')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="status" class="block text-gray-300 mb-2">Status *</label>
                    <select name="status" id="status" required
                            class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="1" {{ old('status', $leftRightContent->status) == 1 ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ old('status', $leftRightContent->status) == 0 ? 'selected' : '' }}>Inactive</option>
                    </select>
                    @error('status')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="md:col-span-2">
                    <label for="image" class="block text-gray-300 mb-2">Image</label>
                    <input type="file" name="image" id="image"
                           class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @error('image')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                    <p class="text-gray-400 text-sm mt-1">Max file size: 2MB. Allowed formats: jpeg, png, jpg, gif</p>

                    @if($leftRightContent->image)
                        <div class="mt-2">
                            <p class="text-gray-300">Current Image:</p>
                            <img src="{{ asset('storage/' . $leftRightContent->image) }}" alt="Current" class="w-32 h-32 object-cover mt-2">
                        </div>
                    @endif
                </div>

                <div class="md:col-span-2">
                    <label for="description" class="block text-gray-300 mb-2">Description</label>
                    <textarea name="description" id="description" rows="4"
                              class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('description', $leftRightContent->description) }}</textarea>
                    @error('description')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mt-6">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded">
                    Update Content
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('description', {
        filebrowserUploadUrl: "{{ 'https://beinseo.com/upload_blog_editor_image?_token=' . csrf_token() }}",
        filebrowserUploadMethod: 'form'
    });
</script>
@endpush