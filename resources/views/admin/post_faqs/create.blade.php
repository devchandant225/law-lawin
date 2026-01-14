@extends('layouts.admin')

@section('title', 'Add New FAQ - ' . $post->title)

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="mb-6">
        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-bold text-gray-900">Add New FAQ for "{{ $post->title }}"</h1>
            <nav class="text-sm breadcrumbs">
                <ol class="flex items-center space-x-2">
                    <li><a href="{{ route('admin.dashboard') }}" class="text-primary hover:underline">Dashboard</a></li>
                    <li><span class="text-gray-400">/</span></li>
                    <li><a href="{{ route('admin.posts.index') }}" class="text-primary hover:underline">Posts</a></li>
                    <li><span class="text-gray-400">/</span></li>
                    <li><a href="{{ route('admin.posts.edit', $post->id) }}" class="text-primary hover:underline">{{ $post->title }}</a></li>
                    <li><span class="text-gray-400">/</span></li>
                    <li><a href="{{ route('admin.posts.faqs.index', $post->id) }}" class="text-primary hover:underline">FAQs</a></li>
                    <li><span class="text-gray-400">/</span></li>
                    <li class="text-gray-500">Add New</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="bg-white border border-gray-200 rounded-xl shadow-sm">
        <div class="p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-6">FAQ Information</h2>

            <form action="{{ route('admin.posts.faqs.store', $post->id) }}" method="POST">
                @csrf

                <div class="mb-6">
                    <label for="question" class="block text-sm font-medium text-gray-700 mb-1">Question <span class="text-red-500">*</span></label>
                    <textarea name="question" id="question" class="block w-full rounded-lg border-gray-300 focus:border-primary focus:ring-primary @error('question') border-red-500 @enderror" rows="3" placeholder="Enter the FAQ question">{{ old('question') }}</textarea>
                    @error('question')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="answer" class="block text-sm font-medium text-gray-700 mb-1">Answer <span class="text-red-500">*</span></label>
                    <textarea name="answer" id="answer" class="block w-full rounded-lg border-gray-300 focus:border-primary focus:ring-primary @error('answer') border-red-500 @enderror" rows="5" placeholder="Enter the FAQ answer">{{ old('answer') }}</textarea>
                    @error('answer')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status <span class="text-red-500">*</span></label>
                    <select name="status" id="status" class="block w-full rounded-lg border-gray-300 focus:border-primary focus:ring-primary @error('status') border-red-500 @enderror">
                        <option value="active" {{ old('status', 'active') === 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ old('status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                    @error('status')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end gap-3">
                    <a href="{{ route('admin.posts.faqs.index', $post->id) }}" class="inline-flex items-center px-4 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50">Cancel</a>
                    <button type="submit" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-primary text-white hover:bg-purple-700 focus:ring-2 focus:ring-primary">
                        <i class="fas fa-save"></i>
                        <span>Save FAQ</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize CKEditor for the answer field
    if (typeof CKEDITOR !== 'undefined') {
        CKEDITOR.replace('answer', {
            height: 200,
            toolbar: [
                { name: 'clipboard', items: ['Cut', 'Copy', 'Paste', 'Undo', 'Redo'] },
                { name: 'basicstyles', items: ['Bold', 'Italic', 'Underline', 'Strike', '-', 'RemoveFormat'] },
                { name: 'paragraph', items: ['NumberedList', 'BulletedList', '-', 'Blockquote'] },
                { name: 'links', items: ['Link', 'Unlink'] },
                { name: 'insert', items: ['Image', 'Table', 'SpecialChar'] },
                { name: 'tools', items: ['Source'] }
            ],
            removeButtons: 'Subscript,Superscript',
            format_tags: 'p;h1;h2;h3;pre',
            removeDialogTabs: 'image:advanced;link:advanced'
        });
    }
});
</script>
@endsection