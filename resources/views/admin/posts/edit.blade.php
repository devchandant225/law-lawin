@extends('layouts.admin')

@section('title', 'Edit Post')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Edit Post</h1>
        <div class="flex items-center gap-2">
            <a href="{{ route('admin.posts.show', $post) }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg border border-sky-300 text-sky-700 hover:bg-sky-50">
                <i class="fas fa-eye"></i>
                <span>View Post</span>
            </a>
            <a href="{{ route('admin.posts.index') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50">
                <i class="fas fa-arrow-left"></i>
                <span>Back to Posts</span>
            </a>
        </div>
    </div>

    <form action="{{ route('admin.posts.update', $post) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Main Content -->
            <div class="lg:col-span-2">
                <!-- Basic Information -->
                <div class="mb-6 bg-white border border-gray-200 rounded-xl shadow-sm">
                    <div class="px-4 py-3 border-b border-gray-200">
                        <h5 class="font-semibold text-gray-900">Basic Information</h5>
                    </div>
                    <div class="p-4 space-y-4">
                        <!-- Title & Slug -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Title <span class="text-red-600">*</span></label>
                                <input type="text" id="title" name="title" value="{{ old('title', $post->title) }}" required onkeyup="generateSlug()"
                                       placeholder="Enter post title" maxlength="120" data-count="title-count" data-max="120"
                                       class="block w-full rounded-lg border border-gray-300 px-3 py-2 focus:border-indigo-500 focus:ring-indigo-500 @error('title') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror" />
                                <div class="mt-1 flex items-center justify-between text-xs text-gray-500">
                                    <span>A concise, descriptive title.</span>
                                    <span id="title-count">0/120</span>
                                </div>
                                @error('title')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="slug" class="block text-sm font-medium text-gray-700 mb-1">Slug</label>
                                <input type="text" id="slug" name="slug" value="{{ old('slug', $post->slug) }}" placeholder="Auto-generated from title"
                                       class="block w-full rounded-lg border border-gray-300 px-3 py-2 focus:border-indigo-500 focus:ring-indigo-500 @error('slug') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror" />
                                @error('slug')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                                <p class="mt-1 text-xs text-gray-500">Used in the URL. Leave empty to auto-generate.</p>
                            </div>
                        </div>

                        <!-- Description -->
                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description <span class="text-red-600">*</span></label>
                            <textarea id="description" name="description" rows="8" required
                                      class="block w-full rounded-lg border border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 @error('description') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror">{{ old('description', $post->description) }}</textarea>
                                @error('description')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Bottom Description -->
                            <div>
                                <label for="bottom_description" class="block text-sm font-medium text-gray-700 mb-1">Bottom Description</label>
                                <textarea id="bottom_description" name="bottom_description" rows="4"
                                          placeholder="Additional content that appears at the bottom of the post..."
                                          class="block w-full rounded-lg border border-gray-300 px-3 py-2 focus:border-indigo-500 focus:ring-indigo-500 @error('bottom_description') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror">{{ old('bottom_description', $post->bottom_description) }}</textarea>
                                @error('bottom_description')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                                <p class="mt-1 text-xs text-gray-500">Content that appears after the main content and left-right sections</p>
                            </div>

                            <!-- Excerpt -->
                            <div>
                                <label for="excerpt" class="block text-sm font-medium text-gray-700 mb-1">Excerpt</label>
                                <textarea id="excerpt" name="excerpt" rows="3" placeholder="Short summary of the post" maxlength="200" data-count="excerpt-count" data-max="200"
                                          class="block w-full rounded-lg border border-gray-300 px-3 py-2 focus:border-indigo-500 focus:ring-indigo-500 @error('excerpt') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror">{{ old('excerpt', $post->excerpt) }}</textarea>
                                <div class="mt-1 flex items-center justify-between text-xs text-gray-500">
                                    <span>Shown in listings and previews.</span>
                                    <span id="excerpt-count">0/200</span>
                                </div>
                                    @error('excerpt')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                <p class="mt-1 text-xs text-gray-500">Brief summary that appears in post listings</p>
                            </div>
                        </div>
                    </div>

                        <!-- SEO Settings -->
                        <div class="mb-6 bg-white border border-gray-200 rounded-xl shadow-sm">
                            <div class="px-4 py-3 border-b border-gray-200">
                                <h5 class="font-semibold text-gray-900">SEO Settings</h5>
                            </div>
                            <div class="p-4 space-y-4">
                                <!-- Meta Title -->
                                <div>
                                    <label for="meta_title" class="block text-sm font-medium text-gray-700 mb-1">Meta Title</label>
                                    <input type="text" id="meta_title" name="meta_title" value="{{ old('meta_title', $post->meta_title) }}" maxlength="60" data-count="meta-title-count" data-max="60" placeholder="Up to 60 characters"
                                           class="block w-full rounded-lg border border-gray-300 px-3 py-2 focus:border-indigo-500 focus:ring-indigo-500 @error('meta_title') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror" />
                                    <div class="mt-1 flex items-center justify-between text-xs text-gray-500">
                                        <span>Important for search results.</span>
                                        <span id="meta-title-count">0/60</span>
                                    </div>
                                    @error('meta_title')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                    <p class="mt-1 text-xs text-gray-500">Recommended: 50-60 characters</p>
                                </div>

                                <!-- Meta Description -->
                                <div>
                                    <label for="meta_description" class="block text-sm font-medium text-gray-700 mb-1">Meta Description</label>
                                    <textarea id="meta_description" name="meta_description" rows="3" maxlength="160" data-count="meta-desc-count" data-max="160" placeholder="Up to 160 characters recommended"
                                              class="block w-full rounded-lg border border-gray-300 px-3 py-2 focus:border-indigo-500 focus:ring-indigo-500 @error('meta_description') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror">{{ old('meta_description', $post->meta_description) }}</textarea>
                                    <div class="mt-1 flex items-center justify-between text-xs text-gray-500">
                                        <span>Displayed under the title in search results.</span>
                                        <span id="meta-desc-count">0/160</span>
                                    </div>
                                    @error('meta_description')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                    <p class="mt-1 text-xs text-gray-500">Recommended: 150-160 characters</p>
                                </div>

                                <!-- Meta Keywords -->
                                <div>
                                    <label for="meta_keywords" class="block text-sm font-medium text-gray-700 mb-1">Meta Keywords</label>
                                    <input type="text" id="meta_keywords" name="meta_keywords" value="{{ old('meta_keywords', $post->meta_keywords) }}" placeholder="keyword1, keyword2, keyword3"
                                           class="block w-full rounded-lg border border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 @error('meta_keywords') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror" />
                                    @error('meta_keywords')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                    <p class="mt-1 text-xs text-gray-500">Comma-separated keywords</p>
                                </div>
                            </div>
                        </div>

                        <!-- Schema -->
                        <div class="mb-6 bg-white border border-gray-200 rounded-xl shadow-sm">
                            <div class="px-4 py-3 border-b border-gray-200">
                                <h5 class="font-semibold text-gray-900">Structured Data (JSON-LD)</h5>
                            </div>
                            <div class="p-4 space-y-6">
                                <x-schema-repeater name="schema_head" label="Schema JSON-LD (Head)" :data="$post->schema_head" />
                                <x-schema-repeater name="schema_body" label="Schema JSON-LD (Body)" :data="$post->schema_body" />
                            </div>
                        </div>
                    </div>

                    <!-- Sidebar -->
                    <div>
                        <!-- Post Settings -->
                        <div class="mb-6 bg-white border border-gray-200 rounded-xl shadow-sm">
                            <div class="px-4 py-3 border-b border-gray-200">
                                <h5 class="font-semibold text-gray-900">Post Settings</h5>
                            </div>
                            <div class="p-4 space-y-4">
                                <!-- Type -->
                                <div>
                                    <label for="type" class="block text-sm font-medium text-gray-700 mb-1">Type <span class="text-red-600">*</span></label>
                                    <select id="type" name="type" required
                                            class="block w-full rounded-lg border border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 @error('type') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror">
                                        <option value="">Select Type</option>
                                        <option value="service" {{ old('type', $post->type) == 'service' ? 'selected' : '' }}>Service</option>
                                        <option value="practice" {{ old('type', $post->type) == 'practice' ? 'selected' : '' }}>Practice</option>
                                        <option value="news" {{ old('type', $post->type) == 'news' ? 'selected' : '' }}>News</option>
                                        <option value="blog" {{ old('type', $post->type) == 'blog' ? 'selected' : '' }}>Blog</option>
                                        <option value="help_desk" {{ old('type', $post->type) == 'help_desk' ? 'selected' : '' }}>Help Desk</option>
                                    </select>
                                    @error('type')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Layout -->
                                <div>
                                    <label for="layout" class="block text-sm font-medium text-gray-700 mb-1">Layout <span class="text-red-600">*</span></label>
                                    <select id="layout" name="layout" required
                                            class="block w-full rounded-lg border border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 @error('layout') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror">
                                        <option value="with_sidebar" {{ old('layout', $post->layout) == 'with_sidebar' ? 'selected' : '' }}>With Sidebar</option>
                                        <option value="fullscreen" {{ old('layout', $post->layout) == 'fullscreen' ? 'selected' : '' }}>Fullscreen</option>
                                    </select>
                                    @error('layout')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Order Position -->
                                <div>
                                    <label for="orderposition" class="block text-sm font-medium text-gray-700 mb-1">Order Position</label>
                                    <input type="number" id="orderposition" name="orderposition" value="{{ old('orderposition', $post->orderposition ?? 0) }}" min="0"
                                           class="block w-full rounded-lg border border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 @error('orderposition') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror" />
                                    @error('orderposition')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                    <p class="mt-1 text-xs text-gray-500">Lower numbers appear first in listings</p>
                                </div>

                                <!-- Status -->
                                <div>
                                    <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status <span class="text-red-600">*</span></label>
                                    <select id="status" name="status" required
                                            class="block w-full rounded-lg border border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 @error('status') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror">
                                        <option value="draft" {{ old('status', $post->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                                        <option value="active" {{ old('status', $post->status) == 'active' ? 'selected' : '' }}>Active</option>
                                        <option value="inactive" {{ old('status', $post->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                    @error('status')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                <!-- Post Dates -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Post Information</label>
                                    <div class="text-sm text-gray-500 space-y-1">
                                        <div>Created: {{ $post->created_at->format('M d, Y \a\t g:i A') }}</div>
                                        <div>Updated: {{ $post->updated_at->format('M d, Y \a\t g:i A') }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Icon -->
                        <div class="mb-6 bg-white border border-gray-200 rounded-xl shadow-sm">
                            <div class="px-4 py-3 border-b border-gray-200">
                                <h5 class="font-semibold text-gray-900">Icon</h5>
                            </div>
                            <div class="p-4 space-y-4">
                                <!-- Current Icon -->
                                @if($post->icon)
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Current Icon</label>
                                        <img src="{{ $post->icon_url }}" alt="Icon" class="rounded border border-gray-200 w-16 h-16 object-contain">
                                    </div>
                                @endif

                                <div>
                                    <label for="icon" class="block text-sm font-medium text-gray-700 mb-1">{{ $post->icon ? 'Change Icon' : 'Upload Icon' }}</label>
                                    <input type="file" id="icon" name="icon" accept="image/*" onchange="previewIcon(this)"
                                           class="block w-full rounded-lg border border-gray-300 px-3 py-2 focus:border-indigo-500 focus:ring-indigo-500 @error('icon') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror" />
                                    @error('icon')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                    <p class="mt-1 text-xs text-gray-500">For Help Desk or Services (Max: 1MB)</p>
                                </div>
                                
                                <!-- Icon Preview -->
                                <div id="icon-preview" style="display: none;">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">New Icon Preview</label>
                                    <img id="icon-preview-img" src="" alt="Preview" class="rounded border border-gray-200 w-16 h-16 object-contain">
                                </div>
                            </div>
                        </div>

                        <!-- Featured Image -->
                        <div class="mb-6 bg-white border border-gray-200 rounded-xl shadow-sm">
                            <div class="px-4 py-3 border-b border-gray-200">
                                <h5 class="font-semibold text-gray-900">Featured Image</h5>
                            </div>
                            <div class="p-4 space-y-4">
                                <!-- Current Image -->
                                @if($post->feature_image)
                                        <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Current Image</label>
                                        <img src="{{ $post->feature_image_url }}" alt="{{ $post->title }}" class="rounded border border-gray-200 max-h-52">
                                    </div>
                                @endif

                                <div>
                                    <label for="feature_image" class="block text-sm font-medium text-gray-700 mb-1">{{ $post->feature_image ? 'Change Image' : 'Upload Image' }}</label>
                                    <input type="file" id="feature_image" name="feature_image" accept="image/*" onchange="previewImage(this)"
                                           class="block w-full rounded-lg border border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 @error('feature_image') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror" />
                                    @error('feature_image')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                    <p class="mt-1 text-xs text-gray-500">Supported formats: JPEG, PNG, JPG, GIF, WebP (Max: 2MB)</p>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="feature_image_alt" class="block text-sm font-medium text-gray-700 mb-1">Image Alt Text</label>
                                    <input type="text" id="feature_image_alt" name="feature_image_alt" value="{{ old('feature_image_alt', $post->feature_image_alt) }}"
                                           placeholder="SEO friendly alt text"
                                           class="block w-full rounded-lg border border-gray-300 px-3 py-2 focus:border-indigo-500 focus:ring-indigo-500 @error('feature_image_alt') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror" />
                                    @error('feature_image_alt')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                <!-- Image Preview -->
                                <div id="image-preview" style="display: none;">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">New Image Preview</label>
                                    <img id="preview" src="" alt="Preview" class="rounded border border-gray-200 max-h-52">
                                </div>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="bg-white border border-gray-200 rounded-xl shadow-sm">
                            <div class="p-4">
                                <div class="grid gap-2">
                                    <button type="submit" class="inline-flex items-center justify-center gap-2 px-4 py-2 rounded-lg bg-indigo-600 text-white hover:bg-indigo-700">
                                        <i class="fas fa-save"></i>
                                        <span>Update Post</span>
                                    </button>
                                    <a href="{{ route('admin.posts.show', $post) }}" class="inline-flex items-center justify-center gap-2 px-4 py-2 rounded-lg border border-sky-300 text-sky-700 hover:bg-sky-50">
                                        <i class="fas fa-eye"></i>
                                        <span>View Post</span>
                                    </a>
                                    <a href="{{ route('admin.posts.index') }}" class="inline-flex items-center justify-center px-4 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// Generate slug from title
function generateSlug() {
    const title = document.getElementById('title').value;
    const slug = title.toLowerCase()
        .replace(/[^a-z0-9 -]/g, '')
        .replace(/\s+/g, '-')
        .replace(/-+/g, '-')
        .trim('-');
    document.getElementById('slug').value = slug;
}

// Preview uploaded image
function previewImage(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('preview').src = e.target.result;
            document.getElementById('image-preview').style.display = 'block';
        }
        reader.readAsDataURL(input.files[0]);
    }
}

// Preview uploaded icon
function previewIcon(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('icon-preview-img').src = e.target.result;
            document.getElementById('icon-preview').style.display = 'block';
        }
        reader.readAsDataURL(input.files[0]);
    }
}

document.addEventListener('DOMContentLoaded', function() {
    if (typeof CKEDITOR !== 'undefined') {
        CKEDITOR.replace('description', {
            filebrowserUploadUrl: "{{ 'https://lawinpartners.com/upload_blog_editor_image?_token=' . csrf_token() }}",
            filebrowserUploadMethod: 'form'
        });

        CKEDITOR.replace('bottom_description', {
            filebrowserUploadUrl: "{{ 'https://lawinpartners.com/upload_blog_editor_image?_token=' . csrf_token() }}",
            filebrowserUploadMethod: 'form'
        });
    }
});
</script>
@endsection
